<?php

namespace Nautilus\Form\Container;

use Nautilus\Form\FormObjectInterface;

class BaseContainer implements FormObjectInterface, ContainerInterface
{

    private $objects;

    public function getErrors()
    {
        $result = array();
        foreach ($this as $object) {
            /* @var FormObjectInterface $object  */
            $result = array_merge($result, $object->getErrors());
        }
        return $result;
    }

    public function validate()
    {
        $result = true;
        foreach ($this as $object) {
            /* @var $object FormObjectInterface */
            $result = $result && $object->validate();
        }
        return $result;
    }

    public function addObject(FormObjectInterface $object)
    {
        $this->objects[] = $object;
        return $this;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->objects);
    }
}