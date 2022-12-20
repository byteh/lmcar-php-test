<?php

namespace App\Service;
use think\facade\Log;

// 策略接口 约定策略的行为
interface LogStrategy {
    public function dealMessage($message);
}

// TYPE_LOG4PHP
class Log4Strategy implements LogStrategy {

    private $logger;

    public function __construct()
    {
        $this->logger = \Logger::getLogger("Log");
    }

    public function dealMessage($message){
        return $message;
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}

// TYPE_ThinkLog
class ThinkLogStrategy implements LogStrategy {

    public function __construct()
    {
        Log::init([
            'default'	=>	'file',
            'channels'	=>	[
                'file'	=>	[
                    'type'	=>	'file',
                    'path'	=>	'./logs/',
                ],
            ],
        ]);
    }

    public function dealMessage($message){
        return strtoupper($message);
    }

    public function info($message = '')
    {
        Log::info($this->dealMessage($message));
    }

    public function debug($message = '')
    {
        Log::debug($this->dealMessage($message));
    }

    public function error($message = '')
    {
        Log::error($this->dealMessage($message));
    }
}


class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINKLOG = 'thinkLog';

    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        if ($type == self::TYPE_LOG4PHP) {
//            $this->logger = \Logger::getLogger("Log");
            $this->logger = new Log4Strategy();
        } else {
            $this->logger = new ThinkLogStrategy();
        }
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}

