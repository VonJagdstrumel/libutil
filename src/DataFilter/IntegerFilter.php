<?php

namespace LibUtil\DataFilter;

use LibUtil\Helper\AssertionHelper;
use LibUtil\Helper\MathHelper;

/**
 *
 */
class IntegerFilter implements LooseFilter
{

    public static function isTypeOf($var, $strict = false)
    {
        if ($strict) {
            $res = is_int($var);
        } else {
            $res = is_int($var) || ctype_digit($var);
        }

        return $res;
    }

    public static function isOver($number, $minValue)
    {
        AssertionHelper::exception(self::isTypeOf($number));
        AssertionHelper::exception(self::isTypeOf($minValue));

        return $number > $minValue;
    }

    public static function isUnder($number, $maxValue)
    {
        AssertionHelper::exception(self::isTypeOf($number));
        AssertionHelper::exception(self::isTypeOf($maxValue));

        return $number < $maxValue;
    }

    public static function isBetween($number, $minValue, $maxValue)
    {
        return self::isOver($number, $minValue) && self::isUnder($number, $maxValue);
    }

    public static function isNegative($number)
    {
        return self::isUnder($number, 0);
    }

    public static function isPowerOf($number, $power)
    {
        AssertionHelper::exception(self::isTypeOf($number));
        AssertionHelper::exception(self::isTypeOf($power));

        return FloatFilter::isWhole(log($number, $power));
    }

    public static function isDivisibleBy($number, $divisor)
    {
        AssertionHelper::exception(self::isTypeOf($number));
        AssertionHelper::exception(self::isTypeOf($divisor));

        return MathHelper::modulo($number, $divisor) == 0;
    }
}
