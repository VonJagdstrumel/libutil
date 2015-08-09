<?php

namespace LibUtil;

/**
 *
 */
class Vigenere
{
    const ROT_WAY_ENCODE = false;
    const ROT_WAY_DECODE = true;

    private $key;

    /**
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     *
     * @param string $rawString
     * @param boolean $way
     * @return string
     */
    private function transform($rawString, $way)
    {
        $res = '';
        $string = preg_replace('/[^\x20-\x7D]/', '', $rawString);
        $stringLength = strlen($string);
        $keyLength = strlen($this->key);

        for ($i = 0; $i < $stringLength; ++$i) {
            $keyChar = $this->key[$i % $keyLength];

            switch ($way) {
                case self::ROT_WAY_DECODE:
                    $res .= chr((94 + ord($string[$i]) - ord($keyChar)) % 94 + 32);
                    break;
                case SELF::ROT_WAY_ENCODE:
                    $res .= chr((30 + ord($string[$i]) + ord($keyChar)) % 94 + 32);
                    break;
            }
        }

        return $res;
    }

    /**
     *
     * @param string $string
     * @return string
     */
    public function encode($string)
    {
        return $this->transform($string, self::ROT_WAY_ENCODE);
    }

    /**
     *
     * @param string $string
     * @return string
     */
    public function decode($string)
    {
        return $this->transform($string, self::ROT_WAY_DECODE);
    }
}
