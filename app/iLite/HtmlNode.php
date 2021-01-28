<?php

/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

class htmlNode {
    public $doc;
    public $node;
    public $element;

    public function __construct($node = null) {
        if ($node) {
            if (is_string($node)) {
                // $node = utf8_encode($node);
                $doc = new DOMDocument(1.0, 'utf-8');
                libxml_use_internal_errors(true);
                $doc->loadHTML("<root>$node</root>");
                libxml_use_internal_errors(false);
                $node = $doc->getElementsByTagName('root')->item(0)->firstChild;
            }
            // $this->tempDoc = new DOMDocument(1.0,"utf-8");
            $this->element = $node;
        }
    }

    public function __get(string $prop = '') {
        if (empty($this->$prop) && $this->attr($prop)) {
            return $this->attr($prop);
        }

        return $this->$prop ?? null;
    }

    public function __set(string $prop, $value) {
        // $value and $value = utf8_encode($value);
        if (!empty($this->$prop)) {
            return $this->$prop = $value;
        }
        if ($this->node()) {
            return $this->attr($prop, $value);
        }
    }

    public function __toString() {
        return $this->outer();
    }

    public function doc() {
        return $this->node()->ownerDocument;
    }

    public function children() {
        $childs = $this->node()->childNodes;
        $children = [];
        foreach ($childs as $child) {
            $children[] = new self($child);
        }

        return $children;
    }

    public function prepend($html) {
        if (is_string($html)) {
            // $html = utf8_encode($html);
            $doc = new DOMDocument(1.0, 'utf-8'); //$this->node()->ownerDocument;//$this->tempDoc;
            libxml_use_internal_errors(true);
            $doc->loadHTML("<html><head><meta charset=\"utf-8\"></head><body>$html</body></html>");
            libxml_use_internal_errors(false);
            $fragment = $doc->createDocumentFragment();
            $fragment = ($doc->getElementsByTagName('body')->item(0)->firstChild);
            $fragment = $this->doc()->importNode($fragment, true);
        }
        if ($html instanceof self) {
            $fragment = $html->node();
            $fragment = $this->doc()->importNode($fragment, true);
        }
        if ($html instanceof DOMElement) {
            $fragment = $html;
            $fragment = $this->doc()->importNode($fragment, true);
        }
        $target = $this->node()->firstChild;
        $this->node()->insertBefore($fragment, $target);
    }

    public function addClass($class) {
        if (!$this->doc) {
            return;
        }
        $classes = explode($this->class, ' ');
        if (in_array($class, $classes, true)) {
            return;
        }
        $this->class = $this->class." $class";
    }

    public function removeClass($class) {
        if (!$this->doc) {
            return;
        }
        $classes = explode($this->class, ' ');
        $new = [];
        foreach ($classes as $cls) {
            if ($class == $cls) {
                continue;
            }
            $newp[] = $cls;
        }
        $new = implode(' ', $new);

        return $new;
    }

    public function append($html) {
        if (is_string($html)) {
            // $html = utf8_encode($html);
            $doc = new DOMDocument(1.0, 'utf-8'); //$this->node()->ownerDocument;//$this->tempDoc;
            libxml_use_internal_errors(true);
            $doc->loadHTML("<html><head><meta charset=\"utf-8\"></head><body>$html</body></html>");
            libxml_use_internal_errors(false);
            $fragment = $doc->createDocumentFragment();
            $fragment = ($doc->getElementsByTagName('body')->item(0)->firstChild);
            $fragment = $this->doc()->importNode($fragment, true);
        }
        if ($html instanceof self) {
            $fragment = $html->node();
            $fragment = $this->doc()->importNode($fragment, true);
        }
        if ($html instanceof DOMElement) {
            $fragment = $html;
            $fragment = $this->doc()->importNode($fragment, true);
        }
        $this->node()->appendChild($fragment);

        return $this;
    }

    public function outer() {
        if ($this->node() instanceof DOMElement) {
            return $this->node()->ownerDocument->saveHTML($this->node());
        }

        return $this->node()->doc()->saveHTML($this->node());
    }

    public function html($value = null) {
        $node = $this->node();
        if ($value) {
            $node->nodeValue = $node->textContent = '';
            if (!isHTML($value)) {
                $node->textContent = $value;
            } else {
                $this->append($value);
            }
        } else {
            $children = $node->childNodes;
            $html = '';
            foreach ($children as $child) {
                $html .= $child->ownerDocument->saveHTML($child);
            }

            return $html;
        }
    }

    public function parent() {
        return $this->node()->parentNode;
    }

    public function attr($attr = null, $value = null) {
        if (!$this->node()) {
            return;
        }
        if (!$attr) {
            return $this->node()->getAttributes();
        }
        if (empty($value)) {
            return $this->node()->getAttribute($attr);
        }
        $this->node()->setAttribute($attr, $value);

        return $this;
    }

    public function node($node = null) {
        if ($node) {
            return $this->element = $node;
        }

        return $this->element ?? null;
    }

    public function remove() {
        return $this->node()->parentNode->removeChild($this->node());
    }
}
