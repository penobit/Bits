<?php

class BundleModel{
    protected $bundleID;
    protected $assets;
    protected $flip_direction;
    protected $cache;

    public function __construct($id = null){
        if(isset($id)){
            $this->load($id);
        }
    }

    public function load($id){
        $this->bundleID = $id;
        $cache = sprintf('assets/cache/bundles/%s.bundle', $id);
        $this->setCacheFile($cache);
        $contents = file_get_contents($cache);
        $assets = unserialize($contents);

        if(empty($assets)){
            $assets = [
                'js' => [],
                'css' => []
            ];
        }
        $this->setAssets($assets);

        return $this;
    }

    public function setID(string $id){
        $this->bundleID = $id;
    }

    public function getID(){
        return $this->bundleID;
    }

    public function makeID(){
        return $this->bundleID = md5($this->getSerializedAssets());
    }

    public function setCacheFile(string $path){
        $this->cache = $path;
        return $this;
    }
    
    public function getCacheFile(){
        if(empty($this->bundleID)) $this->makeID();
        return sprintf('assets/cache/bundles/%s.bundle', $this->bundleID);
    }

    public function setAssets(array $assets){
        $this->assets = $assets;
        return $this;
    }

    public function getAssets(){
        return $this->assets;
    }

    public function getSerializedAssets(){
        return serialize($this->assets);
    }

    public function getURI(string $type){
        if(empty($this->bundleID)) $this->makeID();
        return url(sprintf('bundles/%s.%s', $this->bundleID, $type));
    }

    public function save(){
        if(empty($this->bundleID)){
            $this->makeID();
        }

        $assets = $this->getSerializedAssets();
        $cache = $this->getCacheFile();

        file_put_contents($cache, $assets);
        
        return $this;
    }

    public function shouldFlip(bool $value = null){
        if(isset($value)){
            $this->flip_direction = $value;
            return $this;
        }else{
            return $this->flip_direction;
        }
    }

    public function output(string $type){
        $assets = $this->getAssets();
        $files = $assets[$type];
        $content = '';

        foreach ($files as $file) {
            $tmp = file_get_contents($file)."\n\n";

            if($type === 'css' && preg_match('/.scss$/', $file) > 0){
                try{
                    $compiler = new ScssPhp\ScssPhp\Compiler;
                    $compiler->setOutputStyle(ScssPhp\ScssPhp\OutputStyle::COMPRESSED);
					$compiler->addImportPath(dirname($file));
                    $tmp = $compiler->compile($tmp);
                }catch(ParseException $e){
                    $tmp = '';
                }
            }

            if($type == 'css'){
                $urlPattern = "/url\\(['\"]?(?'url'.*?)['\"]?\\)/usim";
                $directory = str_replace(ROOT_PATH.'/', '', dirname($file));
                preg_match_all($urlPattern, $tmp, $match);
                for ($x = 0; count($match['url']) > $x; ++$x) {
                    $url = $match['url'][$x];
                    if ('#' === substr($url, 0, 1)) {
                        continue;
                    }
                    $url = trim($url, '"\'');
                    $url = str_cut(url('', false).'/', $url);
                    if (!$url or preg_match("/(^data\:|^http(s)\:\/\/?|^\/)/", $url)) {
                        continue;
                    }
                    $urlArray = explode('?', $url);
                    $url = $urlArray[0];
                    $path = "/{$directory}/{$url}";
                    $path = preg_replace("/([^\/]*)\/..\//", '', $path);
                    $tmp = str_replace($url, $path, $tmp);
                }
            }
            $content .= "$tmp\n";
        }
        
        if (!empty($data['inline'][$type])) {
            $content .= join("\n", $data['inline'][$type]);
        }
        if ('css' === $type) {
            $minifier = new \MatthiasMullie\Minify\CSS();
            $minifier->add($content);
            $content = $minifier->minify();
			$language = iLite::getLanguage();
            $defLanguage = iLite::getDefaultLanguage();
            if($language != $defLanguage){
                $defLangData = iLite::getLanguageData();
				$langData = iLite::getLanguageData($language);
                if($defLangData->direction !== $langData->direction){
                    $cssFlip = new Penobit\CSSFlip\CSSFlip;
                    $content = $cssFlip->transform($content);
                }
            }
        } elseif ('js' === $type) {
            $minifier = new \MatthiasMullie\Minify\JS();
            $minifier->add($content);
        }

        echo $content;

        return $this;
    }
}