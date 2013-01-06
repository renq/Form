<?php

namespace Nautilus\Form\Html;

interface AttributesInterface
{

    public function setAttribute($attribute, $value);

    public function getAttribute($attribute);

    public function removeAttribute($attribute);

    public function setAttributes(array $attributes);

    public function getAttributes();

    public function removeAttributes();

    public function getAttributesAsString();
}