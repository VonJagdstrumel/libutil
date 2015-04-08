<?php

namespace LibUtil\DataFilter;

use LibUtil\Helper\AssertionHelper;

/**
 *
 */
class ArrayFilter implements StrictFilter
{

    public static function isTypeOf($var)
    {
        return is_array($var);
    }

    public static function isEmpty(array $array)
    {
        return empty($array);
    }

    public static function isSizeOf(array $array, $size)
    {
        AssertionHelper::exception(IntegerFilter::isTypeOf($size));

        return count($array) == $size;
    }

    public static function isAssoc(array $array)
    {
        return empty(array_filter(array_keys($array), 'is_string'));
    }
}
