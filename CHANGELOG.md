### 更新日志


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

