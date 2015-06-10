<?php

namespace Webpt\Aquaduck\ArrayUtils;

use Webpt\Aquaduck\ArrayUtils\Exception\InvalidArgumentException;
use Webpt\Aquaduck\Middleware\AbstractMiddleware;

abstract class AbstractArrayMiddleware extends AbstractMiddleware
{
    protected function execute($subject)
    {
        if (!is_array($subject)) {
            throw new InvalidArgumentException(
                sprintf('AbstractArrayMiddleware::execute must be passed an array; received "%s"', gettype($subject))
            );
        }

        return $this->executeArray($subject);
    }

    abstract protected function executeArray(array $subject);
}
