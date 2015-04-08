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

    public static function isIpv4($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) filter_var($string, FILTER_VALIDATE_IP, ['flags' => FILTER_FLAG_IPV4]);
    }

    public static function isIpv6($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) filter_var($string, FILTER_VALIDATE_IP, ['flags' => FILTER_FLAG_IPV6]);
    }

    public static function isMac($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) preg_match('/^([0-9a-f]{2}[-:]){5}[0-9a-f]{2}$/i', $string);
    }

    public static function isEmailAddress($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    public static function isUrl($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) filter_var($string, FILTER_VALIDATE_URL);
    }

    public static function isDomainName($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) preg_match('/^(([a-z0-9]|[a-z0-9][a-z0-9\-]*[a-z0-9])\.)*([a-z0-9]|[a-z0-9][a-z0-9\-]*[a-z0-9])$/i');
    }

    public static function isOctal($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) preg_match('/^(0o)?[0-7]+$/i', $string);
    }

    public static function isBinary($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) preg_match('/^(0b)?[01]+$/i', $string);
    }

    public static function isHexadecimal($string)
    {
        AssertionHelper::exception(self::isTypeOf($string));

        return (bool) preg_match('/^(0x)?[0-9a-f]+$/i', $string);
    }

    public static function isBase64($string)
    {
        return (bool) base64_decode($string, true);
    }
}
