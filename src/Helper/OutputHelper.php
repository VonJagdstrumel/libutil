<?php

namespace LibUtil\Helper;

use LibUtil\DataFilter\IntegerFilter;
use LibUtil\DataFilter\ResourceFilter;
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
     * @param \Exception $exception
     * @param resource $destination
     */
    public static function printException(\Exception $exception, $destination = STDERR)
    {
        AssertionHelper::exception(ResourceFilter::isSubtypeOf($destination, 'stream'));

        fwrite($destination, "$exception\n");
    }
}
