<?php

namespace Webpt\Aquaduck\ArrayUtils;

abstract class AbstractArrayMappingMiddleware extends AbstractArrayMiddleware
{
    protected function execute(array $subject)
    {
        return array_map(array($this, 'mapValue'), $subject);
    }

    abstract public function mapValue($subject);
}
