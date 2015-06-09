<?php

namespace Webpt\Aquaduck\ArrayUtilsTest;

use Webpt\Aquaduck\ArrayUtils\StripNull;

class StripNullTest extends \PHPUnit_Framework_TestCase
{
    public function testRemovesNullArrayValues()
    {
        $filter = new StripNull();
        $result = $filter(array(2, '1', null, 'string', $testClass = new \stdClass()));
        $this->assertInternalType('array', $result);
        $this->assertCount(4, $result);
        $this->assertContains(2, $result);
        $this->assertContains('1', $result);
        $this->assertContains('string', $result);
        $this->assertContains($testClass, $result);
    }
}
