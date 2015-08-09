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
     * @throws \InvalidArgumentException
     */
    public static function modulo($dividend, $divisor)
    {
        if(!$divisor) {
            throw new \InvalidArgumentException('Cannot divide by 0');
        }

        return ($divisor + ($dividend % $divisor)) % $divisor;
    }
}
