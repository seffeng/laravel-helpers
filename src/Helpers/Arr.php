<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelHelpers\Helpers;

use Seffeng\ArrHelper\Traits\ArrTrait;

class Arr extends \Illuminate\Support\Arr
{
    use ArrTrait;

    /**
     *
     * @author zxf
     * @date   2022年9月16日
     * @param array $array
     * @param string|integer $key
     * @param mixed $default
     * @return mixed|array|object
     */
    public static function get($array, $key, $default = null)
    {
        return static::getValue($array, $key, $default);
    }
}
