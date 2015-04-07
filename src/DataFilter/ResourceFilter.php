<?php

namespace LibUtil\DataFilter;

use LibUtil\Helper\AssertionHelper;

/**
 *
 */
class ResourceFilter implements StrictFilter
{

    public static function isTypeOf($var)
    {
        return is_resource($var);
    }

    public static function isSubtypeOf($resource, $typeName)
    {
        AssertionHelper::exception(self::isTypeOf($resource));
        AssertionHelper::exception(StringFilter::isTypeOf($resource));

        return get_resource_type($resource) == $typeName;
    }
}
