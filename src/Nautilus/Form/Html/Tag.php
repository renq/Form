<?php

namespace Nautilus\Form\Html;

class Tag implements AttributesInterface
{

    private $tag;

    private $attributes;

    private $html;

    public function __construct($tag)
    {
        $this->setTag($tag);
        $this->attributes = new Attributes();
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
        $attributes = $this->getAttributesAsString();
        if (strlen($attributes)) {
            $attributes = " {$attributes}";
        }

        $closing = '';
        if (!in_array($this->getTag(), array('br', 'hr', 'input'))) {
            $closing = '</' . $this->getTag() . '>';
        }

        $result = <<<HTML
<{$this->getTag()}{$attributes}>{$this->getHtml()}{$closing}
HTML;
        return $result;
    }

    public function __toString(){
        return $this->render();
    }

    // metods from interface AttributesInterface

    public function setAttribute($attribute, $value)
    {
        $this->attributes->setAttribute($attribute, $value);
        return $this;
    }

    public function getAttribute($attribute)
    {
        return $this->attributes->getAttribute($attribute);
    }

    public function removeAttribute($attribute)
    {
        $this->attributes->removeAttribute($attribute);
        return $this;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes->setAttributes($attributes);
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes->getAttributes();
    }

    public function removeAttributes()
    {
        $this->attributes->removeAttributes();
        return $this;
    }

    public function getAttributesAsString()
    {
        return $this->attributes->getAttributesAsString();
    }
}