<?php

namespace LibUtil\Helper;

use LibUtil\Exception\AssertionException;

/**
 *
 */
class AssertionHelper
{

    /**
     *
     * @param boolean $test
     * @param string $message
     * @throws AssertionException
     */
    public static function exception($test, $message = 'Invalid assertion.')
    {
        if (!$test) {
            throw new AssertionException($message);
        }
    }

    /**
     *
     * @param boolean $test
     * @param string $message
     * @param int $type
     */
    public static function error($test, $message = 'Invalid assertion.', $type = E_USER_ERROR)
    {
        if (!$test) {
            trigger_error($message, $type);
        }
    }
}
