<?php

namespace Nautilus\Form\Container;

use Nautilus\Form\FormObjectInterface;

interface ContainerInterface extends \IteratorAggregate
{

    public function addObject(FormObjectInterface $object);
}