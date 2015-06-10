<?php

namespace Webpt\Aquaduck\ArrayUtils;

use Webpt\Aquaduck\ArrayUtils\Exception\InvalidArgumentException;
use Webpt\Aquaduck\Middleware\AbstractMiddleware;

abstract class AbstractArrayMiddleware extends AbstractMiddleware
{
    public function __invoke($subject, $next = null)
    {
        if (!is_array($subject)) {
            throw new InvalidArgumentException(
                sprintf('First parameter must be an array; received "%s"', gettype($subject))
            );
        }

        return parent::__invoke($subject, $next);
    }

    protected function execute($subject)
    {
        return $this->executeArray($subject);
    }

    abstract protected function executeArray(array $subject);
}
