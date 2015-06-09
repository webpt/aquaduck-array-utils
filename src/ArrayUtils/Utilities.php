<?php

namespace Webpt\Aquaduck\ArrayUtils;

use Webpt\Aquaduck\ArrayUtils\Exception\InvalidArgumentException;

final class Utilities
{
    /**
     * Compatibility Flag for Utilities::filter
     */
    const ARRAY_FILTER_USE_BOTH = 1;

    /**
     * Compatibility Flag for Utilities::filter
     */
    const ARRAY_FILTER_USE_KEY  = 2;

    private function __construct(){}

    /**
     * Compatibility Method for array_filter on <5.6 systems
     *
     * @param array $data
     * @param callable $callback
     * @param null|int $flag
     * @return array
     */
    public static function filter(array $data, $callback, $flag = null)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException(sprintf(
                'Second parameter of %s must be callable',
                __METHOD__
            ));
        }

        if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
            return array_filter($data, $callback, $flag);
        }

        $output = [];
        foreach ($data as $key => $value) {
            $params = [$value];

            if ($flag === static::ARRAY_FILTER_USE_BOTH) {
                $params[] = $key;
            }

            if ($flag === static::ARRAY_FILTER_USE_KEY) {
                $params = [$key];
            }

            $response = call_user_func_array($callback, $params);

            if ($response) {
                $output[$key] = $value;
            }
        }

        return $output;
    }
}
