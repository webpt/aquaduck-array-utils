<?php

namespace Webpt\Aquaduck\ArrayUtils;

abstract class AbstractArrayFilteringMiddleware extends AbstractArrayMiddleware
{
    protected $flag;

    /**
     * @return int
     */
    public function getFlag()
    {
        return $this->flag;
    }

    protected function executeArray(array $subject)
    {
        return Utilities::filter($subject, array($this, 'filterValue'), $this->getFlag());
    }

    abstract public function filterValue($valueOrKey);
}
