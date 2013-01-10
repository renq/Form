<?php

namespace Nautilus\Form;

interface FormObjectInterface
{

    public function getErrors();

    public function validate();
}