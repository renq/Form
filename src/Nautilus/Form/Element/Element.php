<?php

namespace Nautilus\Form\Element;

use Nautilus\Form\FormObjectInterface;
use Nautilus\Form\Html\Attributes;
use Nautilus\Form\Html\Tag;
use Nautilus\Validator\ValidatorInterface;

abstract class Element implements FormObjectInterface
{

    private $name;

    private $label;

    private $value;

    private $attributes;

    private $description;

    private $validators;

    private $validationErrors = array();

    public function __construct()
    {
        $this->attributes = new Attributes();
    }

    abstract public function render();

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    /**
     *
     * @param string $value
     * @return Element
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setValidators(array $validators)
    {
        $this->clearValidators;
        foreach ($validators as $validator) {
            $this->addValidator($validator);
        }
        return $this;
    }

    public function addValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    public function removeValidators()
    {
        $this->validators = array();
        return $this;
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function validate()
    {
        $result = true;
        foreach ($this->validators as $validator) {
            /* @var $validator ValidatorInterface */
            $validator->setValue($this->getValue());
            $validatorResult = $validator->validate();
            if (!$validatorResult) {
                $result = false;
                $this->validationErrors = array_merge($this->validationErrors, $validator->getErrors());
            }
        }
        return $result;
    }

    public function getErrors()
    {
        $this->validate();
        return $this->validationErrors;
    }

    public function __toString()
    {
        return $this->render();
    }

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
