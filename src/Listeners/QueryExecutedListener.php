<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2022 seffeng
 */
namespace Seffeng\LaravelHelpers\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryExecutedListener
{
    /**
     * SQL日志channel
     * config/logging.php [Channels]
     * @var string
     */
    protected $channel;

    /**
     *
     * @var boolean
     */
    protected $debug;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        is_null($this->debug) && $this->debug = config('app.debug');
    }

    /**
     * Handle the event.
     *
     * @param QueryExecuted $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        if ($this->getIsDebug()) {
            foreach ($event->bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $event->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else {
                    if (is_string($binding)) {
                        $event->bindings[$i] = "'$binding'";
                    }
                }
            }

            $query = str_replace(array('%', '?'), array('%%', '%s'), $event->sql);
            $query = vsprintf($query, $event->bindings);

            Log::channel($this->getChannel())->debug($query, ['connectionName' => $event->connectionName, 'time' => $event->time]);
        }
    }

    /**
     *
     * @author zxf
     * @date   2022年3月17日
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     *
     * @author zxf
     * @date   2022年3月17日
     * @return boolean
     */
    public function getIsDebug()
    {
        return $this->debug;
    }
}
