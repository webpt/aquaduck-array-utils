<?php

namespace Webpt\Aquaduck\ArrayUtils;

class StripNull extends AbstractArrayFilteringMiddleware
{
    public function filterValue($valueOrKey)
    {
        return ($valueOrKey !== null);
    }
}
