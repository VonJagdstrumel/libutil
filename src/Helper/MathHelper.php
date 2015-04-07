<?php

namespace LibUtil\Helper;

use LibUtil\DataFilter\IntegerFilter;
use LibUtil\Helper\AssertionHelper;

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
        AssertionHelper::exception(IntegerFilter::isTypeOf($dividend));
        AssertionHelper::exception(IntegerFilter::isTypeOf($divisor));

        return ($divisor + ($dividend % $divisor)) % $divisor;
    }
}
