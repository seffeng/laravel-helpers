<?php

use PHPUnit\Framework\TestCase;
use Seffeng\LaravelHelpers\Helpers\Util;

class UtilTest extends TestCase
{
    public function testParseUrl()
    {
        $url = 'https://www.1kmi.com/view/2.php';
        print_r(Util::parseUrl($url));
    }

    public function testSizeFormat()
    {
        var_dump(Util::sizeFormat(1024 * 1024 * 1024 * 1023));
    }
}