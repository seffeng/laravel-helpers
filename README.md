## Laravel Helpers

### 安装

```shell
# 安装
$ composer require seffeng/laravel-helpers
```

### 目录说明

```
└─src
    ├─Handlers
    │   CacheHandler.php
    └─Helpers
        Arr.php
        Json.php
        ReplaceArrayValue.php
        Str.php
        TimeHelper.php
        UnsetArrayValue.php
        Util.php
        Xml.php
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
use Seffeng\LaravelHelpers\Helpers\TimeHelper;
use Seffeng\LaravelHelpers\Helpers\ReplaceArrayValue;

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
        var_dump(TimeHelper::asWeekCN(time()));
    }
}
```

### 备注

无

