<?php

namespace LibUtil\DataFilter;

/**
 *
 */
interface LooseFilter
{

    static function isTypeOf($var, $strict = false);
}
