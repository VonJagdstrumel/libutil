<?php

namespace LibUtil\DataFilter;

/**
 *
 */
class NullFilter implements LooseFilter
{

    public static function isTypeOf($var, $strict = false)
    {
        if ($strict) {
            $res = is_null($var);
        } else {
            $res = is_null($var) || preg_match('/^(null)$/i', $var);
        }

        return $res;
    }
}
