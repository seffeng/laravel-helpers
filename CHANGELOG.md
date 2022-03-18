### 更新日志

* 2022-03-17

  * 增加sql查询日志

    ```php
    # 1、App\Providers\EventServiceProvider 中增加监听
    
    use Illuminate\Database\Events\QueryExecuted;
    use Seffeng\LaravelHelpers\Listeners\QueryExecutedListener;
    
    protected $listen = [
        QueryExecuted::class => [
            QueryExecutedListener::class // 此类可用第3步的替换
        ],
    ];
    
    # 2、[可选]增加日志配置 config/logging.php，不配置时用默认日志
    'channels' => [
        ...
    
        'sqllog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/query.log'),
            'level' => 'debug',
            'days' => 7,
        ],
    
        ...
    ];
    
    # 3、[可选]增加类继承 QueryExecutedListener，用于配置日志记录通道
    
    use Seffeng\LaravelHelpers\Listeners\QueryExecutedListener;
    class QueryListener extends QueryExecutedListener
    {
        /**
         * 对应第2步的配置，不设置此属性将使用默认日志通道
         * @var string
         */
        protected $channel = 'sqllog';
        
        /**
         * 设置是否记录日志[true时记录，null时当 app.debug=true 时记录]
         * @var boolean
         */
        protected $debug;
    }
    
    ```

---

* 2021-06-17

  * 增加控制台加密解密命令

  ```php
  # 配置
  文件 app/Console/Kernel.php 添加代码
  
  protected $commands = [
      // ...
      \Seffeng\LaravelHelpers\Commands\Crypt::class,
  ];
  ```

  ```shell
  # 示例，加密字符串 aa 或 文件内字符串
  $ php artisan crypt aa
  $ php artisan crypt ./aa.txt
  
  # 示例，解密被加密字符串 或 文件内字符串
  $ php artisan crypt -d eyJpdiI6Ik5sMXA....
  $ php artisan crypt -d ./aa.txt
  
  # 帮助
  $ php artisan crypt -h
  
  # 注意
  1、.env 文件必须存在配置项：APP_KEY=
  2、本命令使用 .env 文件 APP_KEY 作为加密key，若 APP_KEY 为空时会自动生成 APP_KEY；
  ```
---

* 2020-07-21

  * 增加缓存处理类

  ```php
  # 示例
  use Seffeng\LaravelHelpers\Handlers\CacheHandler;
  
  ## 获取用户信息，原使用方式
  $userService = new UserService();
  $userService->getUserInfo($userId);
  
  ## 获取用户信息，使用缓存
  $userService = new UserService();
  $cache = new CacheHandler($userService);
  //$cache->setTTL(60); // 缓存时长，默认60s
  $cache->getUserInfo($userId);  // 缓存 key 通过该方法名和参数生成
  
  # 注意
  # 缓存 key 通过方法名和参数生成；若参数为 Object，注意可变的属性是否为 public；
  ```

