<?php

namespace LibUtil\Helper;

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
        fwrite($destination, "$exception\n");
    }
}
