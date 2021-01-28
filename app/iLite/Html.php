<?php

/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

class Html {
    public static $instance;

    public function __construct($content = false) {
        $this->doc = new DOMDocument(1.0, 'utf-8');
        $this->format_output(false);
        if ($content) {
            $this->load($content);
        }
        self::$instance = $this;
    }

    public function __toString() {
        return $this->output();
    }

    public static function instance() {
        return self::$instance ?: self::$instance = new self();
    }

    public function load($content) {
        // $content = view::minify_html($content);
        libxml_use_internal_errors(true);
        $this->doc->loadHTML($content);
        libxml_use_internal_errors(false);
        $this->doc->preserveWhiteSpace = !1;
        $charset = $this->find("meta[charset='utf-8']", -1);
        if (count($charset)) {
            foreach ($charset as $cs) {
                $cs->remove();
            }
        }
        $meta = new HtmlNode('<meta');
        $meta->{'http-equiv'} = 'content-type';
        $meta->content = 'text/html;charset=UTF-8';
        $head = $this->find('head', 0);
        if ($head) {
            $head->prepend($meta);
        }
    }

    public function format_output($format = true) {
        $this->doc->format_output = $format;
    }

    public function output($node = null) {
        Header::html();
        $charset = $this->find("meta[http-equiv='content-type']", -1);
        if (1 != count($charset)) {
            foreach ($charset as $cs) {
                $cs->remove();
            }
            $meta = new HtmlNode('<meta>');
            $meta->{'http-equiv'} = 'content-type';
            $meta->content = 'text/html;charset=UTF-8';
            $head = $this->find('head', 0);
            if ($head) {
                $head->prepend($meta);
            }
        }
        $output = $this->doc->saveHTML($node);

        return $output;
    }

    public function css_to_xpath($query = false) {
        if (empty($query)) {
            return;
        }
        $tag_pattern = "/^\w+/";
        $id_pattern = "/\#([^.#[:]*)/";
        $class_pattern = "/\.([^.#[:]*)/";
        $attr_pattern = "/\[([^]]*)\]/";
        $dot_pattern = "/\:([^.#[:]*)/";
        $selector = '';

        preg_match($tag_pattern, $query, $tag);
        $selector .= $tag[0] ?: '*';

        preg_match($id_pattern, $query, $id);
        $id = $id[1] ?? '';
        $selector .= $id ? "[@id='$id']" : '';

        preg_match_all($class_pattern, $query, $classes);
        foreach ($classes[1] as $cls) {
            $selector .= "[@class='$cls']";
        }

        preg_match_all($attr_pattern, $query, $attrs);
        foreach ($attrs[1] as $attr) {
            $selector .= $this->attr_selector_to_xpath($attr);
        }

        return $selector;
    }

    public function attr_selector_to_xpath($attr = false) {
        if (empty($attr)) {
            return;
        }
        $func = false !== strpos($attr, '^=') ? 'starts-with' : (false !== strpos($attr, '*=') ? 'contains' : '');
        $operator = false !== strpos($attr, '^=') ? '^=' : (false !== strpos($attr, '*=') ? '*=' : '=');
        $split = explode($operator, $attr);
        $key = $split[0];
        $value = $split[1] ?? null;
        $key = trim($key);
        $value = trim($value, "'\"");
        if (empty($value)) {
            return "[@$key]";
        }
        if ($func) {
            $res = "[$func(@$key,'$value')]";
        } else {
            $res = "[@$key='$value']";
        }

        return $res;
    }

    public function find($query, $index = '0') {
        if (!$query) {
            return [];
        }
        $query = $this->css_to_xpath($query);
        if (str_starts('[', $query)) {
            $query = "*$query";
        }
        if (!str_starts('/', $query)) {
            $query = "//$query";
        }
        $xpath = new DOMXPath($this->doc);
        $nodes = $xpath->query($query);
        $result = [];
        
        foreach (is_array($nodes) || is_object($nodes) ? $nodes : [] as $node) {
            $result[] = new HtmlNode($node);
        }
        if (-1 === $index) {
            return $result;
        }

        return (-1 < $index) ? ($result[$index] ?? false) : (1 === count($result) ? array_pop($result) : ($result ?? false));
    }

    public function find_all($query) {
        return $this->find($query, -1);
    }

    public function save($node = null) {
        return $this->output($node);
    }
}
new html();
