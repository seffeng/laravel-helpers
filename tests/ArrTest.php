<?php

use PHPUnit\Framework\TestCase;
use Seffeng\LaravelHelpers\Helpers\Arr;
use Seffeng\ArrHelper\ReplaceArrayValue;
use Seffeng\ArrHelper\UnsetArrayValue;

class ArrTest extends TestCase
{
    private $value = [
        'a' => ['id' => 3, 'name' => 'aaa', 'detail' => ['id' => 'aaa', 'name' => '---<span>aaaa</span>---']],
        'c' => ['id' => 1, 'name' => 'ccc', 'detail' => ['id' => 'ccc', 'name' => '---cccc---']],
        'd' => ['id' => 4, 'name' => 'ddd', 'detail' => ['id' => 'ddd', 'name' => '---dddd---']],
        'b' => ['id' => 2, 'name' => 'bbb', 'detail' => ['id' => 'bbb', 'name' => '---&lt;span&gt;bbbb&lt;/span&gt;---']]
    ];

    public function testGetValue()
    {
        var_dump(Arr::getValue($this->value, 'a.name', '000'));
        var_dump(Arr::getValue($this->value, 'a.age', '000'));
    }

    public function testGetDepth()
    {
        var_dump(Arr::getDepth($this->value));
    }

    public function testIndex()
    {
        print_r(Arr::index($this->value, 'id'));
    }

    public function testGetColumn()
    {
        print_r(Arr::getColumn($this->value, 'name'));
    }

    public function testMerge()
    {
        print_r(Arr::merge($this->value, ['b' => ['id' => 222], 'd' => ['id' => 5]]));

        print_r(Arr::merge($this->value, [
            'b' => new ReplaceArrayValue(['name' => 'new bbbb()']),
            'c' => [
                'cname' => '---ccc---',
                'detail' => '---detail---'
            ]
        ]));

        print_r(Arr::merge($this->value, ['b' => new UnsetArrayValue()]));
    }

    public function testMultisort()
    {
        Arr::multisort($this->value, 'id');
        print_r($this->value);
    }

    public function testHtmlEncode()
    {
        print_r(Arr::htmlEncode($this->value));
    }

    public function testHtmlDecode()
    {
        print_r(Arr::htmlDecode($this->value));
    }
}
