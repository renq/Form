<?php

namespace Nautilus\Form\Html\Tests;

use Nautilus\Form\Html\Tag;

class TagTest extends \PHPUnit_Framework_TestCase
{

    public function testAttributes()
    {
        $h1 = new Tag('h1');
        $h1->setAttribute('class', 'big-header');
        $this->assertEquals('big-header', $h1->getAttribute('class'));

        $h1->removeAttribute('class');
        $this->assertEquals('', $h1->getAttribute('class'));
    }

    public function testHtml()
    {
        $div = new Tag('div');
        $this->assertEquals('', $div->getHtml());

        $html = '<p class="x">test &quot;</p>';
        $div->setHtml($html);
        $this->assertEquals($html, $div->getHtml());
    }

    public function testFluentInterface()
    {
        $ul = new Tag('ul');
        $this->assertEquals($ul, $ul->setAttribute('class', 'middle')->setHtml('<li>point 1</li>'));
        $this->assertEquals($ul, $ul->setHtml('<li>point 1</li>')->setAttribute('class', 'middle'));
    }

    public function testRender()
    {
        $div = new Tag('div');
        $this->assertXmlStringEqualsXmlString('<div></div>', $div->render());
        $this->assertXmlStringEqualsXmlString('<div></div>', (string)$div);

        $div->setAttribute('data-myvalue', '15')->setHtml('test');
        $this->assertXmlStringEqualsXmlString('<div data-myvalue="15">test</div>', $div->render());

        $div->setAttribute('data-tag', '"<div>"');
        $this->assertXmlStringEqualsXmlString('<div data-myvalue="15" data-tag="&quot;&lt;div&gt;&quot;">test</div>', $div->render());
    }

    public function testInvalidAttributeNameWithSpace()
    {
        $this->setExpectedException('\RuntimeException');
        $div = new Tag('div');
        $div->setAttribute('invalid attribute', 1);
    }

    public function testInvalidAttributeNameDigitFirst() {
        $this->setExpectedException('\RuntimeException');
        $div = new Tag('div');
        $div->setAttribute('123qwe', "456rty");
    }

    public function testInvalidTagName()
    {
        $this->setExpectedException('\RuntimeException');
        $div = new Tag('<div>');
    }

    public function testInvalidTagNameWithBraces()
    {
        $this->setExpectedException('\RuntimeException');
        $div = new Tag('<div>');
    }

    public function testInvalidTagNameWithSpace()
    {
        $this->setExpectedException('\RuntimeException');
        $div = new Tag('input checked');
    }
}
