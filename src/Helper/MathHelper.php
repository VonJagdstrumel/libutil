<?php

namespace LibUtil\Helper;

/**
 *
 */
class MathHelper
{

    /**
     *
     * @param int $dividend
     * @param int $divisor
     * @return int
     */
    public static function modulo($dividend, $divisor)
    {
        return ($divisor + ($dividend % $divisor)) % $divisor;
    }
}
