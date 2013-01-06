<?php

namespace Nautilus\Form\Html;

class Attributes implements AttributesInterface
{

    private $attributes = array();

    public function __construct()
    {
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

    public function setAttributes(array $attributes)
    {
        $this->removeAttributes();
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function removeAttributes()
    {
        $this->attributes = array();
    }

    public function getAttributesAsString()
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