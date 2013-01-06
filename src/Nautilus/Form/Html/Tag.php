<?php

namespace Nautilus\Form\Html;

class Tag
{

    private $tag;

    private $attributes = array();

    private $html;

    public function __construct($tag)
    {
        $this->setTag($tag);
    }

    public function setTag($tag)
    {
        if (!preg_match('/^[a-z][a-z0-9\-]*$/', $tag)) {
            throw new \RuntimeException("Incorrect tag name \"{$tag}\"");
        }
        $this->tag = $tag;
        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setAttribute($attribute, $value)
    {
        if (!preg_match('/^[a-z_\-:][-a-z0-9_:\-]*$/', $attribute)) {
            throw new \RuntimeException("Incorrect attribute name \"{$attribute}\"");
        }
        $this->attributes[$attribute] = $value;
        return $this;
    }

    public function getAttribute($attribute)
    {
        if (!isset($this->attributes[$attribute])) {
            return '';
        }
        return $this->attributes[$attribute];
    }

    public function removeAttribute($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            unset($this->attributes[$attribute]);
        }
        return $this;
    }

    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function render()
    {
        $result = <<<HTML
<{$this->getTag()} {$this->getAttributesString()}>{$this->getHtml()}</{$this->getTag()}>
HTML;
        return $result;
    }

    public function __toString(){
        return $this->render();
    }

    private function getAttributesString()
    {
        $result = '';
        foreach ($this->attributes as $k => $v) {
            $v = $this->escapeValue($v);
            $result .= "$k=\"$v\" ";
        }
        return trim($result);
    }

    private function escapeValue($value)
    {
        return htmlentities($value, ENT_COMPAT, 'UTF-8');
    }

}