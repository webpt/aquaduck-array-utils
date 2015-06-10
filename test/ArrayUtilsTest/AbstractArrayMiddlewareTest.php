<?php

namespace Webpt\Aquaduck\ArrayUtilsTest;

use Webpt\Aquaduck\ArrayUtils\AbstractArrayMiddleware;
use Webpt\Aquaduck\Middleware\AbstractMiddleware;

class AbstractArrayMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    protected $middleware;

    protected function setUp()
    {
        $this->middleware = $this->getMockForAbstractClass(
            'Webpt\Aquaduck\ArrayUtils\AbstractArrayMiddleware'
        );
    }

    public function testInvokeExecutesMiddleware()
    {
        $this->middleware->expects($this->once())
            ->method('executeArray')
            ->willReturnCallback(function($data) {
                return array_map(function($value) {
                    return $value * 2;
                }, $data);
            });

        $middleware = $this->middleware;
        $result = $middleware(array(1, 2));

        $this->assertInternalType('array', $result);
        $this->assertCount(2, $result);
        $this->assertContains(2, $result);
        $this->assertContains(4, $result);
    }

    /**
     * @expectedException \Webpt\Aquaduck\ArrayUtils\Exception\InvalidArgumentException
     */
    public function testThrowsExceptionOnNonArray()
    {
        $middleware = $this->middleware;
        $middleware('INVALID-STRING');
    }
}
