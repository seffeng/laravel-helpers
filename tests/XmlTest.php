<?php

use PHPUnit\Framework\TestCase;
use Seffeng\LaravelHelpers\Helpers\Xml;

class XmlTest extends TestCase
{
    private $value = ['a' => ['id' => 1,'name' => 'aaa']];

    public function testToXml()
    {
        var_dump(Xml::toXml($this->value));
    }
}