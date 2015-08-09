<?php

namespace LibUtil\Color;

/**
 *
 */
class AlphaColor extends PlainColor
{
    private $alphaValue;

    /**
     *
     */
    function __construct($red = self::MIN_VALUE, $green = self::MIN_VALUE, $blue = self::MIN_VALUE, $alpha = self::MIN_VALUE)
    {
        parent::__construct($red, $green, $blue);
        $this->alphaValue = $alpha;
    }

    /**
     *
     * @return int
     */
    public function getAlphaValue()
    {
        return $this->alphaValue;
    }

    /**
     *
     * @param int $value
     */
    public function setAlphaValue($value = null)
    {
        $this->blueValue = $value;
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {
        return parent::toArray() + [
            'alpha' => $this->alphaValue
        ];
    }
}
