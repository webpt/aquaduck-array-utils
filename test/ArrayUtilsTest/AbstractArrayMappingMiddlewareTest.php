<?php

namespace Webpt\Aquaduck\ArrayUtilsTest;

class AbstractArrayMappingMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    protected $middleware;

    protected function setUp()
    {
        $this->middleware = $this->getMockForAbstractClass(
            'Webpt\Aquaduck\ArrayUtils\AbstractArrayMappingMiddleware'
        );
    }

    public function testExecuteCallsMapValue()
    {
        $this->middleware->expects($this->any())
            ->method('mapValue')
            ->willReturnCallback(function($value) {
                return $value * 5;
        });

        $middleware = $this->middleware;
        $result = $middleware(array(1, 2));
        $this->assertInternalType('array', $result);
        $this->assertContains(5, $result);
        $this->assertContains(10, $result);
    }
}
