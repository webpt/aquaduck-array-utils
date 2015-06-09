<?php

namespace Webpt\Aquaduck\ArrayUtilsTest;

class AbstractArrayFilteringMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    protected $middleware;

    protected function setUp()
    {
        $this->middleware = $this->getMockForAbstractClass(
            'Webpt\Aquaduck\ArrayUtils\AbstractArrayFilteringMiddleware'
        );
    }

    public function testDefaultFlagValue()
    {
        $this->assertNull($this->middleware->getFlag());
    }

    public function testExecuteCallsMapValue()
    {
        $this->middleware->expects($this->any())
            ->method('filterValue')
            ->willReturnCallback(function($value) {
                return ($value === 1);
            });

        $middleware = $this->middleware;
        $result = $middleware(array(1, 2));
        $this->assertInternalType('array', $result);
        $this->assertCount(1, $result);
        $this->assertContains(1, $result);
    }
}
