<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelHelpers\Helpers;

/**
 *
 * @author zxf
 * @date   2020年6月10日
 */
class Str extends \Illuminate\Support\Str
{
    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  int $length
     * @param  bool $diff   区分大小写
     * @return string
     */
    public static function generateChatCode(int $length, bool $diff = false)
    {
        $letters = 'bcdfghjklmnpqrstvwxyz';
        $letterUpper = 'BCDFGHJKLMNPQRSTVWXYZ';
        $vowels = 'aeiou';
        $vowelUpper = 'AEIOU';

        if ($diff) {
            $letters .= $letterUpper;
            $vowels .= $vowelUpper;
        }

        return self::generateAlgorithm($letters, $vowels, $length);
    }

    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  int $length
     * @return string
     */
    public static function generateNumberCode(int $length)
    {
        $letters = '24680';
        $vowels = '13579';

        return self::generateAlgorithm($letters, $vowels, $length);
    }

    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  int $length
     * @param  bool $diff   区分大小写
     * @return string
     */
    public static function generateStringCode(int $length, bool $diff = false)
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $letterUpper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $vowels = '1234567890';

        $diff && $letters .= $letterUpper;

        return self::generateAlgorithm($letters, $vowels, $length);
    }

    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  int $length
     * @return string
     */
    public static function generateAlgorithm(string $letters, string $vowels, int $length)
    {
        $vowelsLength = strlen($vowels) - 1;
        $lettersLength = strlen($letters) - 1;
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
                $code .= $vowels[mt_rand(0, $vowelsLength)];
            } else {
                $code .= $letters[mt_rand(0, $lettersLength)];
            }
        }

        return $code;
    }
}
