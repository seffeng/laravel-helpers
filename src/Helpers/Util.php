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

    /**
     * 解析URL
     * @author zxf
     * @date   2022年1月7日
     * @param string $url
     * @param int $component
     * @return string|boolean
     */
    public static function parseUrl(string $url, int $component = -1)
    {
        $parseUrl = parse_url($url, $component);
        if ($parseUrl) {
            $host = Arr::get($parseUrl, 'host', '');
            $port = Arr::get($parseUrl, 'port', '');
            $user = Arr::get($parseUrl, 'user', '');
            $pass = Arr::get($parseUrl, 'pass', '');
            $path = Arr::get($parseUrl, 'path', '');
            $query = Arr::get($parseUrl, 'query', '');
            $fragment = Arr::get($parseUrl, 'fragment', '');

            $url = '';
            $user && $url .= $user;
            $pass && $url .= ':' . $pass;
            $user && $url .= '@';
            $url .= $host;
            $port && $url .= ':' . $port;
            $path && $url .= $path;

            if ($query) {
                $queryArr = [];
                parse_str($query, $queryArr);
                ksort($queryArr);
                $url .= '?';
                $i = 0;
                foreach ($queryArr as $k => $q) {
                    $url .= ($i > 0 ? '&' : '') . $k . '=' . $q;
                    $i++;
                }
            }

            $fragment && $url .= '#' . $fragment;
            $parseUrl['url'] = $url;
            return $parseUrl;
        }
        return false;
    }
}
