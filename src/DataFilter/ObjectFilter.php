<?php

namespace LibUtil\DataFilter;

use LibUtil\Helper\AssertionHelper;

/**
 *
 */
class ObjectFilter implements StrictFilter
{

    public static function isTypeOf($var)
    {
        return is_object($var);
    }

    public static function isInstanceOf($object, $className)
    {
        AssertionHelper::exception(self::isTypeOf($object));
        AssertionHelper::exception(StringFilter::isTypeOf($className));

        return $object instanceof $className;
    }

    public static function isSubclassOf($object, $className)
    {
        AssertionHelper::exception(self::isTypeOf($object));
        AssertionHelper::exception(StringFilter::isTypeOf($className));

        return is_subclass_of($object, $className);
    }

    public static function hasProperty($object, $propertyName)
    {
        AssertionHelper::exception(self::isTypeOf($object));
        AssertionHelper::exception(StringFilter::isTypeOf($propertyName));

        return property_exists($object, $propertyName);
    }

    public static function hasMethod($object, $methodName)
    {
        AssertionHelper::exception(self::isTypeOf($object));
        AssertionHelper::exception(StringFilter::isTypeOf($object));

        return method_exists($object, $methodName);
    }
}
