<?php

namespace LibUtil\Helper;

/**
 *
 */
class HexDataHelper
{

    /**
     *
     * @param string $string
     * @param boolean $reverse
     * @return string
     */
    public static function stringToHex($string, $reverse = false)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); ++$i) {
            $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT);
        }
        if ($reverse) {
            $hex = self::reverseHex($hex);
        }
        return $hex;
    }

    /**
     *
     * @param string $hex
     * @param boolean $reverse
     * @return string
     */
    public static function hexToString($hex, $reverse = false)
    {
        if ($reverse) {
            $hex = self::reverseHex($hex);
        }
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }

    /**
     *
     * @param string $hex
     * @return string
     */
    public static function reverseHex($hex)
    {
        $hexArray = str_split($hex, 2);
        $lastIndex = count($hexArray) - 1;
        $hexArray[$lastIndex] = str_pad($hexArray[$lastIndex], 2, "0", STR_PAD_LEFT);
        $hexArray = array_reverse($hexArray);
        return implode($hexArray);
    }
}
