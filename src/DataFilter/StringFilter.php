<?php

namespace LibUtil\DataFilter;

use LibUtil\Helper\AssertionHelper;

/**
 *
 */
class StringFilter implements LooseFilter
{

    public static function isTypeOf($var, $strict = false)
    {
        if ($strict) {
            $res = is_string($var);
        } else {
            $res = is_string($var) || is_numeric($var);
        }

        return $res;
    }

    public static function isEmpty($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return empty($string);
    }

    public static function isSizeOf($string, $size)
    {
        AssertionHelper::exception(self::isTypeOf($string));
        AssertionHelper::exception(IntegerFilter::isTypeOf($size));

        return strlen($string) == $size;
    }

    public static function isIpv4($string, $network = false)
    {
        return null;
    }

    public static function isIpv6($string, $network = false)
    {
        return null;
    }

    public static function isMac($string)
    {
        return null
    }

    public static function isEmailAddress($string)
    {
        return null;
    }

    public static function isDomainName($string)
    {
        return null;
    }

    public static function isUnixPath($string)
    {
        return null;
    }

    public static function isOctal($string, $strict = false)
    {
        return null;
    }

    public static function isBinary($string, $strict = false)
    {
        return null;
    }

    public static function isHexadecimal($string, $strict = false)
    {
        return null;
    }

    public static function isBase64($string, $strict = false)
    {
        return null;
    }
}
