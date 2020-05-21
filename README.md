## Laravel Helpers

### 安装

```shell
# 安装
$ composer require seffeng/laravel-helpers
```

### 目录说明

```
└─src
    └─Helpers
        Arr.php
        Json.php
        ReplaceArrayValue.php
        TimeHelper.php
        UnsetArrayValue.php
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
            'b' => [
                'b' => [
                    'c' => 'ccc'
                ]
            ]
        ]
        var_dump(Arr::get($arr, 'a.b.c', ''));
        var_dump(Json::encode($arr));
        var_dump(TimeHelper::asWeekCN(time()));
    }
}
```

### 备注

无



