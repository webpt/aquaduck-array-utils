<?php

namespace Webpt\Aquaduck\ArrayUtils;

use Webpt\Aquaduck\ArrayUtils\Exception\InvalidArgumentException;
use Webpt\Aquaduck\MiddlewareInterface;

abstract class AbstractArrayMiddleware implements MiddlewareInterface
{
    const ORDER_PREPEND = 'prepend';
    const ORDER_APPEND  = 'append';

    protected $order = 'append';

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function isPrepend()
    {
        return ($this->getOrder() === static::ORDER_PREPEND);
    }

    public function isAppend()
    {
        return ($this->getOrder() === static::ORDER_APPEND);
    }

    public function __invoke($subject, $next = null)
    {
        if (!is_array($subject)) {
            throw new InvalidArgumentException(
                sprintf('First parameter must be an array; received "%s"', gettype($subject))
            );
        }

        if ($next && !is_callable($next)) {
            throw new InvalidArgumentException(
                sprintf('Second parameter must be a valid callback or null; received "%s"', gettype($next))
            );
        }

        if ($this->isPrepend() && $next) {
            $subject = $next($subject);
        }

        $transformed = $this->execute($subject);

        if ($this->isAppend() && $next) {
            return $next($transformed);
        }

        return $transformed;
    }

    abstract protected function execute(array $subject);
}
