<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelHelpers\Handlers;

use Seffeng\LaravelHelpers\Helpers\Json;
use Illuminate\Support\Facades\Cache;

class CacheHandler
{
    /**
     *
     * @var boolean
     */
    protected $isCache = true;

    /**
     *
     * @var integer
     */
    protected $ttl = 60;

    /**
     *
     * @var mixed
     */
    protected $object;

    /**
     *
     * @var string
     */
    protected $prefix = 'result_from_cache_1595260800:';

    /**
     *
     * @var boolean
     */
    protected $refresh = false;

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @param mixed $object
     * @param int $ttl
     * @param string $prefix
     */
    public function __construct(object $object = null, int $ttl = null, string $prefix = null)
    {
        $this->object = $object;
        !is_null($ttl) && $this->setTTL($ttl);
        !is_null($prefix) && $this->setPrefix($prefix);
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @param string $method
     * @param mixed ...$params
     */
    public function __call($method, $parameters)
    {
        try {
            $key = $this->getPrefix() . get_class($this->object) . ':' . md5($method . Json::encode($parameters));
            $result = null;
            if ($this->getIsCache() && !$this->getRefresh() && $result = Cache::get($key)) {
                return $result;
            } elseif ($this->object && method_exists($this->object, $method)) {
                $result = $this->object->$method(...$parameters);
            } elseif (function_exists($method)) {
                $result = $parameters ? call_user_func_array($method, $parameters) : call_user_func($method);
            } else {
                throw new \Exception('Call to undefined function '. $method .'.');
            }
            $this->getIsCache() && $result && Cache::put($key, $result, $this->getTTL());
            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @param string $prefix
     * @return \Seffeng\LaravelHelpers\Handlers\CacheHandler
     */
    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @return boolean
     */
    public function getRefresh()
    {
        return $this->refresh;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @param bool $refresh
     * @return \Seffeng\LaravelHelpers\Handlers\CacheHandler
     */
    public function setRefresh(bool $refresh)
    {
        $this->refresh = $refresh;
        return $this;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @return boolean
     */
    public function getIsCache()
    {
        return $this->isCache;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @param bool $isCache
     * @return \Seffeng\LaravelHelpers\Handlers\CacheHandler
     */
    public function setIsCache(bool $isCache)
    {
        $this->isCache = $isCache;
        return $this;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @return number
     */
    public function getTTL()
    {
        return $this->ttl;
    }

    /**
     *
     * @author zxf
     * @date   2020年7月21日
     * @param int $ttl
     * @return \Seffeng\LaravelHelpers\Handlers\CacheHandler
     */
    public function setTTL(int $ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }
}
