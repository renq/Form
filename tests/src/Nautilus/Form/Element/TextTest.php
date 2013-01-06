<?php

namespace Nautilus\Form\Element\Tests;

use Nautilus\Validator\NotEmptyString;
use Nautilus\Form\Element\Text;

class TextTest extends \PHPUnit_Framework_TestCase
{

    public function testAttributesNameLabelRenderAndFluendInterface()
    {
        $text = new Text();
        $text
            ->setName('nick')
            ->setAttribute('class', 'left long')
            ->setAttribute('id', 'my-custom-id')
            ->setLabel('Enter your nick')
            ->addValidator(new NotEmptyString('Enter valid nick please.'));
        $html = (string)$text;

        $this->assertContains('class="left long"', $html);
        $this->assertContains('id="my-custom-id"', $html);
        $this->assertContains('<input', $html);
        $this->assertContains('type="text"', $html);
    }

    public function testValidate()
    {
        $text = new Text();
        $text
            ->setName('nick')
            ->addValidator(new NotEmptyString('Enter valid nick please.'));
        $this->assertFalse($text->validate());
        $this->assertTrue($text->setValue('rage guy')->validate());
    }
}
