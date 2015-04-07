<?php

namespace LibUtil\Helper;

use LibUtil\DataFilter\IntegerFilter;
use LibUtil\DataFilter\ResourceFilter;
use LibUtil\DataFilter\StringFilter;
use LibUtil\Helper\AssertionHelper;

/**
 *
 */
class OutputHelper
{

    /**
     *
     * @param int $current
     * @param int $total
     * @param resource $destination
     */
    public static function printProgress($current, $total, $destination = STDOUT)
    {
        AssertionHelper::exception(IntegerFilter::isBetween($current, 0, $total));
        AssertionHelper::exception(ResourceFilter::isSubtypeOf($destination, 'stream'));

        $percent = (int) (($current / $total) * 100);
        fwrite($destination, "\r" . $percent . "%");
    }

    /**
     *
     * @param string $message
     * @param resource $destination
     */
    public static function printException($message, $destination = STDERR)
    {
        AssertionHelper::exception(StringFilter::isTypeOf($message));
        AssertionHelper::exception(ResourceFilter::isSubtypeOf($destination, 'stream'));

        fwrite($destination, "$message\n");
    }
}
