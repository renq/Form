<?php

namespace Nautilus\Form\Container\Tests;

use Nautilus\Validator\Email;
use Nautilus\Validator\NotEmptyString;
use Nautilus\Form\Element\Text;
use Nautilus\Form\Container\BaseContainer;

class BaseContainerTest extends \PHPUnit_Framework_TestCase
{

    private function getNick()
    {
        $nick = new Text();
        $nick
            ->setName('nick')
            ->setLabel('Nick')
            ->addValidator(new NotEmptyString('Enter your nick'));
        return $nick;
    }

    private function getEmail()
    {
        $email = new Text();
        $email
            ->setName('email')
            ->setLabel('email')
            ->addValidator(new Email('Enter valid e-mail'));
        return $email;
    }

    public function testFluentInterface()
    {
        $container = new BaseContainer();
        $object = $container->addObject($this->getNick())->addObject($this->getEmail());
        $this->assertEquals($container, $object);
    }

    public function testIterator()
    {
        $field[] = $this->getNick();
        $field[] = $this->getEmail();

        $container = new BaseContainer();
        $container
            ->addObject($field[0])
            ->addObject($field[1]);

        $i = 0;
        foreach ($container->getIterator() as $object) {
            $this->assertEquals($field[$i], $object);
            $i++;
        }
        $this->assertEquals(2, $i);
    }
}
