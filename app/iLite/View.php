<?php

/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

class View {
    public static $instance;
    protected $doc = null;
    private $vars = [];
    private $inline = ['script' => '', 'style' => ''];
    private $frameworks = [];
    private $title = '';
    private $baseDir = '';
    private $bundle;
    private $bundleID;
    private $assets = [
        'js' => [],
        'css' => [],
    ];

    public function __construct(string $path = '', array $vars = []) {
        $this->vars = $vars;
        $this->bundle = new BundleModel();
        if (!empty($path)) {
            $this->load($path, $vars);
        }
    }

    public static function instance() {
        return self::$instance = self::$instance ?: new View();
    }

    public function __toString() {
        return $this->doc ? $this->doc->save() : 'No View Loaded';
    }

    public function getDocument() {
        return $this->doc ?? null;
    }

    public function setDocument($doc) {
        return $this->doc = $doc;
    }

    public function render() {
        $output = $this->doc ? $this->doc->save() : 'No View Loaded';
        $output = $this->minifyHTML($output);

        // Minify HTML output
        // $search = ['/\>[^\S ]+/smui', '/[^\S ]+\</smui', '/\>\s+/smui', '/\s+\</smui', '/\>\n+/smui', '/\n+\</smui', '/<!--(.|\s)*?-->/'];
        // $replace = ['>', '<', '>','<', ">\n","\n<", ''];
        // $output = preg_replace($search, $replace, $output);

		$htmlMin = new voku\helper\HtmlMin();
        $output = $htmlMin->minify($output);
        
        echo $output;
        return $this;
    }

    public function makeBundle() {
        if (empty($doc = $this->getDocument())) {
            return $this;
        }

        $scripts = $doc->find_all('script[src]');
        $styles = $doc->find_all('link[rel=stylesheet]');
        $bundle = ['js' => [], 'css' => []];

        array_map(function($asset) use (&$bundle) {
            if ('link' === $asset->element->tagName) {
                $path = $asset->href;
                $path = trim($path, '/');
                if(!file_exists($path)){
                    if($path = $this->baseDir.'/'.$path){
                        if(!file_exists($path)) return;
                    }
                }
                $bundle['css'][] = $path;
            } elseif ('script' === $asset->element->tagName) {
                $path = $asset->src;
                $path = trim($path, '/');
                if(!file_exists($path)){
                    if($path = $this->baseDir.'/'.$path){
                        if(!file_exists($path)) return;
                    }
                }
                $bundle['js'][] = $path;
            }
            $asset->remove();
        }, array_merge($scripts, $styles));

        $inlineScripts = [];
        $inlineStyles = [];
        foreach ($doc->find_all('script') as $inlineScript) {
            $content = $inlineScript->html();
            $content = trim($content);
            $content = preg_replace("~\/\*\*?([^*/]*)\*\/~usim", '', $content);
            $inlineScripts[] = $content;
            $inlineScript->remove();
        }
        foreach ($doc->find_all('style') as $inlineStyle) {
            $content = $inlineStyle->html();
            $content = trim($content);
            $content = preg_replace("~\/\*\*?([^*/]*)\*\/~usim", '', $content);
            $inlineStyles[] = $content;
            $inlineStyle->remove();
        }
        if (count($inlineScripts)) {
            $inlineScripts = array_map(function($js) {
                return preg_replace("~\/\*\*?([^*/]*)\*\/~usim", '', $js);
            }, $inlineScripts);
            $scriptTag = new HtmlNode('<script>');
            $js = join("\n", $inlineScripts);
            $jsMinifier = new \MatthiasMullie\Minify\JS();
            $jsMinifier->add($js);
            $js = $jsMinifier->minify();
            $scriptTag->src = sprintf('data:application/javascript;base64,%s', base64_encode($js));
            $this->inline['script'] = $scriptTag;
        }
        if (count($inlineStyles)) {
            $inlineStyles = array_map(function($css) {
                return preg_replace("~\/\*\*?([^*/]*)\*\/~usim", '', $css);
            }, $inlineStyles);
            $styleTag = new HtmlNode('<link>');
            $css = join("\n", $inlineStyles);
            $cssMinifier = new \MatthiasMullie\Minify\CSS();
            $cssMinifier->add($css);
            $css = $cssMinifier->minify();
            // echo $css;exit;
            $styleTag->href = sprintf('data:text/css;base64,%s', base64_encode($css));
            $styleTag->rel = 'stylesheet';
            $styleTag->type = 'text/css';
            $this->inline['style'] = $styleTag;
        }

        // $this->bundle = $bundle;
        $this->bundle->setAssets($bundle)->save();

        return $this;
    }

    public function addBundle() {
        $doc = $this->getDocument();
        $head = $doc->find('head');
        $body = $doc->find('body');

        if(!empty($this->bundle->getAssets())){
            $js = new HtmlNode('<script>');
            $js->src = $this->bundle->getURI('js');
            $js->type = 'application/javascript';

            $css = new HtmlNode('<link>');
            $css->rel = 'stylesheet';
            $css->type = 'text/css';
            $css->href = $this->bundle->getURI('css');;
    
            $head->append($css);
            $body->append($js);
        }

        if (isset($this->inline['script']) && !empty($this->inline['script'])) {
            $body->append($this->inline['script']);
        }
        if (isset($this->inline['style']) && !empty($this->inline['style'])) {
            $head->append($this->inline['style']);
        }

        return $this;
    }

    public function fixAssets(){
        $doc = $this->getDocument();
        if(empty($doc))return;
        $images = $doc->find_all('img');
        foreach($images as $img){
            $source = $img->src;
            if(preg_match('/(^\/|^data:|^https?:\/\/)/', $source, $match)) continue;
            if(!file_exists($source)){
                if(file_exists($source = "{$this->baseDir}/$source")){
                    $img->src = sprintf("/%s", str_replace(ROOT_PATH.'/', '', $source));
                }
            }
        }
    }

    public function setMeta($key, string $value = '') {
        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->setMeta($name, $value);
            }

            return $this;
        }
        $doc = $this->getDocument();
        $head = $doc->find('head');
        if (empty($doc) || empty($head)) {
            return $this;
        }
        $meta = $doc->find("meta[name=$key]");
        if ($meta) {
            $meta->content = $value;
        } else {
            $meta = new HtmlNode("<meta name=\"$key\" content=\"$value\">");
            $head->prepend($meta);
        }

        return $this;
    }

    public static function minifyHTML(string $code) {
        $r = ["\r", "\n", '	', '    ', '   ', '  ', "\t"];
        // $code = preg_replace('/<!--(.|\s)*?-->/', '', $code);
        // $code = str_replace($r, '', $code);

        return $code;
    }

    public function load(string $path, array $vars = []) {
        $path = rtrim($path, '/');
        
        if (!file_exists($path)) {
            return iLite::notFound();
            exit;
        }

        $this->baseDir = dirname($path);
        ob_start();
        extract($vars, EXTR_OVERWRITE);
        require $path;
        $contents = ob_get_clean();
        $contents = preg_replace('/\<\!\-\-[^-->]*\-\-\>/usim', '', $contents);
        $doc = new Html($contents);
        $this->setDocument($doc);

        // Make Css & Js Bundle
        $this->makeBundle()->addBundle()->fixAssets();

        // Adding MetaTags
        $this->setMeta([
            'charset' => 'UTF-8',
            'viewport' => 'initial-scale=1.0,width=device-width,maximum-scale=1.0,user-scalable=no',
            'author' => 'Penobit'
        ]);

        return $this;
    }

    public function setTitle(string $text = ''){
        if(empty($text)) return $this;
        $doc = $this->getDocument();
        $title = $doc->find('title');
        if(!$title) return $this;
        $title->html($text);
        
        return $this;
    }
}