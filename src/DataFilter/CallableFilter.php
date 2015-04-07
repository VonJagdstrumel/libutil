<?php

namespace LibUtil\DataFilter;

use LibUtil\Helper\AssertionHelper;

/**
 *
 */
class CallableFilter implements StrictFilter
{

    public static function isTypeOf($var)
    {
        return is_callable($var);
    }

    public static function isFunction($callable)
    {
        AssertionHelper::exception(self::isTypeOf($callable));

        return StringFilter::isTypeOf($callable);
    }

    public static function isMethod(array $callable)
    {
        AssertionHelper::exception(self::isTypeOf($callable));

        return ArrayFilter::isTypeOf($callable[0]);
    }

    public static function isStatic(array $callable)
    {
        AssertionHelper::exception(self::isTypeOf($callable));

        return StringFilter::isTypeOf($callable[0]);
    }
}
