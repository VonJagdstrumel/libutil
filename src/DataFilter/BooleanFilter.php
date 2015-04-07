<?php

namespace LibUtil\DataFilter;

/**
 *
 */
class BooleanFilter implements LooseFilter
{

    public static function isTypeOf($var, $strict = false)
    {
        if ($strict) {
            $res = is_bool($var);
        } else {
            $res = is_bool($var) || preg_match('/^(false|true)$/i', $var);
        }

        return $res;
    }
}
