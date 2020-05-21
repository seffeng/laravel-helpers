<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2019 seffeng
 */
namespace Seffeng\LaravelHelpers\Helpers;

/**
 * 此类源于 yii2
 * Object that represents the removal of array value while performing [[Arr::merge()]].
 *
 * Usage example:
 *
 * ```php
 * $array1 = [
 *     'ids' => [
 *         1,
 *     ],
 *     'validDomains' => [
 *         'example.com',
 *         'www.example.com',
 *     ],
 * ];
 *
 * $array2 = [
 *     'ids' => [
 *         2,
 *     ],
 *     'validDomains' => new \Seffeng\LaravelHelpers\Helpers\UnsetArrayValue(),
 * ];
 *
 * $result = \Seffeng\LaravelHelpers\Helpers\Arr::merge($array1, $array2);
 * ```
 *
 * The result will be
 *
 * ```php
 * [
 *     'ids' => [
 *         1,
 *         2,
 *     ],
 * ]
 * ```
 *
 */
class UnsetArrayValue
{

}
