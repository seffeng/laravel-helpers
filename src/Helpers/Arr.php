<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelHelpers\Helpers;

class Arr extends \Seffeng\Helpers\Arr
{
    /**
     *
     * @param array $array
     * @param string|integer $key
     * @param string|mixed $default
     * @return mixed
     */
    public static function get($array, $key, $default = null)
    {
        return static::getValue($array, $key, $default);
    }
}
