## Laravel Helpers

### 安装

```shell
# 安装
$ composer require seffeng/laravel-helpers
```

### 目录说明

```
+---src
|   +---Commands
|   |       Crypt.php
|   +---Handlers
|   |       CacheHandler.php
|   +---Helpers
|   |       Arr.php
|   |       Json.php
|   |       Str.php
|   |       Time.php
|   |       Util.php
|   |       Xml.php
|   \---Listeners
|           QueryExecutedListener.php
+---tests
|       ArrTest.php
|       JsonTest.php
|       StrTest.php
|       TimeTest.php
|       UtilTest.php
|       XmlTest.php
```

### 示例

```php
/**
 * TestController.php
 * 示例
 */
namespace App\Http\Controllers;

use Seffeng\LaravelHelpers\Helpers\Arr;
use Seffeng\LaravelHelpers\Helpers\Json;
use Seffeng\LaravelHelpers\Helpers\Time;
use Seffeng\ArrHelper\ReplaceArrayValue;

class TestController extends Controller
{
    public function index()
    {
        $arr = [
            'a' => [
                'b' => [
                    'c' => 'ccc'
                ]
            ],
            'd' => [
                'b' => 'ccc',
                'e' => [
                    'f' => 'hhh'
                ]
            ]
        ];
        echo '<pre>';
        var_dump(Arr::get($arr, 'a.b.c', ''));
        var_dump(Arr::getDepth($arr));
        print_r(Arr::getColumn($arr, 'b'));
        print_r($arr);
        print_r(Arr::merge($arr, [
            'd' => new ReplaceArrayValue(['hhh' => 'iii']),
            'i' => [
                'j' => 'kkk'
            ]
        ]));
        $json = Json::encode($arr);
        var_dump($json);
        print_r(Json::decode($json));
        var_dump(Time::asWeekCN(time()));
    }
}
```

### 备注

无

### 更新

* [changelog](./CHANGELOG.md)
  * 2022-03-17
  * 2021-06-17
  * 2020-07-21