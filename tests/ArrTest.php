<?php

use PHPUnit\Framework\TestCase;
use Seffeng\LaravelHelpers\Helpers\Arr;

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
        var_dump(Arr::get($this->value, 'a.name', '000'));
        var_dump(Arr::get($this->value, 'a.age', '000'));
    }
}
