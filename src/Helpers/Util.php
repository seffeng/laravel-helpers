<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelHelpers\Helpers;

class Util
{
    /**
     *
     * @author zxf
     * @date   2020年5月26日
     * @param int $size 被转换的数字 字节[Byte]
     * @param int $decim 小数点位数 default[2]2位小数点
     * @param int $units 进制单位大小 default[1024]
     * @param int $valCrf 取整类型 default[0]0-四舍五入,1-向下取整,2-向上取整
     * @param int $pad 连接符
     * @return string
     */
    public static function sizeFormat(int $size, int $decim = 2, int $units = 1024, int $valCrf = 0, string $pad = ' ')
    {
        $unitItems = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $i = 1;
        $j = count($unitItems);
        $decimPow = pow(10, $decim);
        while ($size >= pow($units, $i) && $i <= $j) {
            ++$i;
        }
        if ($valCrf == 2) {
            return ceil(($size / pow($units, $i - 1)) * $decimPow) / $decimPow . $pad . $unitItems[$i - 1];
        } elseif ($valCrf == 1) {
            return round(($size / pow($units, $i - 1)) * $decimPow) / $decimPow . $pad . $unitItems[$i - 1];
        } else {
            return floor(($size / pow($units, $i - 1)) * $decimPow) / $decimPow .$pad . $unitItems[$i - 1];
        }
    }
}
