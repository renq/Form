<?php

namespace Nautilus\Form\Element;

use Nautilus\Form\Html\AttributesInterface;
use Nautilus\Form\Html\Tag;

class Text extends Element implements AttributesInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $tag = new Tag('input');
        $tag
            ->setAttributes($this->getAttributes())
            ->setAttribute('value', $this->getValue())
            ->setAttribute('name', $this->getName())
            ->setAttribute('type', 'text');
        return (string)$tag;
    }
}
