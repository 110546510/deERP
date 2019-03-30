<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace think\queue;


use Exception;
use think\Cache;
use think\Config;
use think\exception\Handle;
use think\exception\ThrowableError;
use think\Hook;
use Throwable;

class Worker
{


    /**
     * 启动一个守护进程执行任务.
     *
     * @param  string $queue
     * @param  int    $delay
     * @param  int    $memory
     * @param  int    $sleep
     * @param  int    $maxTries
     * @return array
     */
    public function daemon($queue = null, $delay = 0, $memory = 128, $sleep = 3, $maxTries = 0)
    {
        $lastRestart = $this->getTimestampOfLastQueueRestart();

        while (true) {
            $this->runNextJobForDaemon(
                $queue, $delay, $sleep, $maxTries
            );

            if ($this->memoryExceeded($memory) || $this->queueShouldRestart($lastRestart)) {
                $this->stop();
            }
        }
    }

    /**
     * 以守护进程的方式执行下个任务.
     *
     * @param  string $queue
     * @param  int    $delay
     * @param  int    $sleep
     * @param  int    $maxTries
     * @return void
     */
    protected function runNextJobForDaemon($queue, $delay, $sleep, $maxTries)
    {
        try {
            $this->pop($queue, $delay, $sleep, $maxTries);
        } catch (Exception $e) {
            $this->getExceptionHandler()->report($e);
        } catch (Throwable $e) {
            $this->getExceptionHandler()->report(new ThrowableError($e));
        }
    }

    /**
     * 执行下个任务
     * @param  string $queue
     * @param  int    $delay
     * @param  int    $sleep
     * @param  int    $maxTries
     * @return array
     */
    public function pop($queue = null, $delay = 0, $sleep = 3, $maxTries = 0)
    {

        $job = $this->getNextJob($queue);

        if (!is_null($job)) {
            return $this->process($job, $maxTries, $delay);
        }

        $this->sleep($sleep);

        return ['job' => null, 'failed' => false];
    }

    /**
     * 获取下个任务
     * @param  string $queue
     */
    protected function getNextJob($queue)
    {
        if (is_null($queue)) {
            return Queue::pop();
        }

        foreach (explode(',', $queue) as $queue) {
            if (!is_null($job = Queue::pop($queue))) {
                return $job;
            }
        }
    }

    /**
     * Process a given job from the queue.
     * @param \think\queue\Job $job
     * @param  int             $maxTries
     * @param  int             $delay
     * @return array
     * @throws Exception
     */
    public function process(Job $job, $maxTries = 0, $delay = 0)
    {
        if ($maxTries > 0 && $job->attempts() > $maxTries) {
            return $this->logFailedJob($job);
        }

        try {
            $job->fire();

            return ['job' => $job, 'failed' => false];
        } catch (Exception $e) {
            if (!$job->isDeleted()) {
                $job->release($delay);
            }

            throw $e;
        }
    }

    /**
     * Log a failed job into storage.
     * @param  \Think\Queue\Job $job
     * @return array
     */
    protected function logFailedJob(Job $job)
    {
        if (Hook::listen('queue.failed', $job, null, true)) {
            $job->delete();
            $job->failed();
        }

        return ['job' => $job, 'failed' => true];
    }


    /**
     * 检查内存是否超出
     * @param  int $memoryLimit
     * @return bool
     */
    public function memoryExceeded($memoryLimit)
    {
        return (memory_get_usage() / 1024 / 1024) >= $memoryLimit;
    }

    /**
     * 停止执行任务的守护进程.
     * @return void
     */
    public function stop()
    {
        die;
    }

    /**
     * Sleep the script for a given number of seconds.
     * @param  int $seconds
     * @return void
     */
    public function sleep($seconds)
    {
        sleep($seconds);
    }

    /**
     * 获取上次重启守护进程的时间
     *
     * @return int|null
     */
    protected function getTimestampOfLastQueueRestart()
    {
        return Cache::get('think:queue:restart');
    }

    /**
     * 检查是否要重启守护进程
     *
     * @param  int|null $lastRestart
     * @return bool
     */
    protected function queueShouldRestart($lastRestart)
    {
        return $this->getTimestampOfLastQueueRestart() != $lastRestart;
    }


    /**
     * 获取异常处理实例
     *
     * @return \think\exception\Handle
     */
    protected static function getExceptionHandler()
    {
        static $handle;

        if (!$handle) {

            if ($class = Config::get('exception_handle')) {
                if (class_exists($class) && is_subclass_of($class, "\\think\\exception\\Handle")) {
                    $handle = new $class;
                }
            }
            if (!$handle) {
                $handle = new Handle();
            }
        }

        return $handle;
    }

}