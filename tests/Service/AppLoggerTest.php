<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{

    public function testInfoLog()
    {
        $msg = 'This is info log message';

        $logger = new AppLogger('log4php');
        $logger->info($msg);
        $logger->debug($msg);
        $logger->error($msg);

        $loggerT = new AppLogger('thinkLog');
        $loggerT->info($msg);
        $loggerT->debug($msg);
        $loggerT->error($msg);

        $this->assertEquals('This is info log message', $msg);
    }
}