<?php

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\App\Demo;
use App\Service\AppLogger;
use App\Util\HttpRequest;


class DemoTest extends TestCase
{

    public function test_foo()
    {
        $logger = new AppLogger();
        $req = new HttpRequest();
        $svc = New Demo($logger, $req);

        $v = $svc->foo($this->products);
        $this->assertEquals("bar",$v);
    }

    public function test_get_user_info()
    {
        $stub = $this->createStub(Demo::class);
        $mock_result = array(
            "error"=>0,
            "data"=>array(
                "id"=>1,
                "username"=>"hello world"
            )
        );
        $stub->method('get_user_info')
            ->will($this->returnValueMap($mock_result));
        $result = $stub->get_user_info();
        $this->assertEquals(0, $result["error"]);
    }
}
