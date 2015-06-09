<?php

namespace Webpt\Aquaduck\ArrayUtils;

use DateTime;

class DateTimeSerializer extends AbstractArrayMappingMiddleware
{
    protected $format;

    public function __construct($format = DateTime::RFC850)
    {
        $this->format = $format;
    }

    public function mapValue($subject)
    {
        if ($subject instanceof DateTime) {
            return $subject->format($this->format);
        }

        return $subject;
    }
}
