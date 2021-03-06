<?php

namespace Webpt\Aquaduck\ArrayUtilsTest;

use Webpt\Aquaduck\ArrayUtils\Utilities;

class UtilitiesTest extends \PHPUnit_Framework_TestCase
{
    public function filterArrays()
    {
        return array(
            array(
                array('foo' => 'bar', 'fiz' => 'buz'),
                function ($value) {
                    if ($value == 'bar') {
                        return false;
                    }
                    return true;
                },
                null,
                array('fiz' => 'buz')
            ),
            array(
                array('foo' => 'bar', 'fiz' => 'buz'),
                function ($value, $key) {
                    if ($value == 'buz') {
                        return false;
                    }
                    if ($key == 'foo') {
                        return false;
                    }
                    return true;
                },
                Utilities::ARRAY_FILTER_USE_BOTH,
                array()
            ),
            array(
                array('foo' => 'bar', 'fiz' => 'buz'),
                function ($key) {
                    if ($key == 'foo') {
                        return false;
                    }
                    return true;
                },
                Utilities::ARRAY_FILTER_USE_KEY,
                array('fiz' => 'buz')
            ),
        );
    }
    /**
     * @dataProvider filterArrays
     */
    public function testFiltersArray($data, $callback, $flag, $result)
    {
        $this->assertEquals($result, Utilities::filter($data, $callback, $flag));
    }
    /**
     * @expectedException \Webpt\Aquaduck\ArrayUtils\Exception\InvalidArgumentException
     */
    public function testInvalidCallableRaiseInvalidArgumentException()
    {
        Utilities::filter(array(), "INVALID");
    }
}
