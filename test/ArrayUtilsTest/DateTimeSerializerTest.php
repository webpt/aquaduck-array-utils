<?php

namespace Webpt\Aquaduck\ArrayUtilsTest;

use Webpt\Aquaduck\ArrayUtils\DateTimeSerializer;
use DateTime;

class DateTimeSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializesDateTimeObjectsToSpecifiedFormat()
    {
        $serializer = new DateTimeSerializer('Y-m-d h:i:s');
        $date = new DateTime('2015-01-01 12:34:00');

        $result = $serializer(array($date));
        $this->assertInternalType('array', $result);
        $this->assertContains('2015-01-01 12:34:00', $result);
    }

    public function testReturnsNonDateTimeObject()
    {
        $serializer = new DateTimeSerializer('Y-m-d h:i:s');

        $result = $serializer(array('SOME-STRING'));
        $this->assertInternalType('array', $result);
        $this->assertContains('SOME-STRING', $result);
    }
}
