<?php

use PHPUnit\Framework\TestCase;
use Seffeng\LaravelHelpers\Helpers\Json;

class JsonTest extends TestCase
{
    private $value = ['a' => ['id' => 1,'name' => 'aaa']];

    public function testEncode()
    {
        var_dump(Json::encode($this->value));
    }

    public function testDecode()
    {
        print_r(Json::decode(Json::encode($this->value)));
    }
}