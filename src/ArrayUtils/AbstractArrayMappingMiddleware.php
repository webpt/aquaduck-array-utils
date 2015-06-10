<?php

namespace Webpt\Aquaduck\ArrayUtils;

abstract class AbstractArrayMappingMiddleware extends AbstractArrayMiddleware
{
    protected function executeArray(array $subject)
    {
        return array_map(array($this, 'mapValue'), $subject);
    }

    abstract public function mapValue($subject);
}
