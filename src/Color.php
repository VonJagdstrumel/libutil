<?php

namespace LibUtil;

/**
 *
 */
class Color
{
    const MIN_VALUE = 0;
    const MAX_VALUE = 255;

    protected $redValue;
    protected $greenValue;
    protected $blueValue;
    protected $alphaValue;

    /**
     *
     */
    public function __construct()
    {
        $this->redValue = self::MIN_VALUE;
        $this->greenValue = self::MIN_VALUE;
        $this->blueValue = self::MIN_VALUE;
        $this->alphaValue = null;
    }

    /**
     *
     * @return int
     */
    public function getRedValue()
    {
        return $this->redValue;
    }

    /**
     *
     * @return int
     */
    public function getGreenValue()
    {
        return $this->greenValue;
    }

    /**
     *
     * @return int
     */
    public function getBlueValue()
    {
        return $this->blueValue;
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
     * @param string $color
     * @return int
     */
    public function getValueByColor($color)
    {
        return $this->{"{$color}Value"};
    }

    /**
     *
     * @param int $value
     */
    public function setRedValue($value)
    {
        Misc::checkRange($value, self::MIN_VALUE, self::MAX_VALUE);

        $this->redValue = $value;
    }

    /**
     *
     * @param int $value
     */
    public function setGreenValue($value)
    {
        Misc::checkRange($value, self::MIN_VALUE, self::MAX_VALUE);

        $this->greenValue = $value;
    }

    /**
     *
     * @param int $value
     */
    public function setBlueValue($value)
    {
        Misc::checkRange($value, self::MIN_VALUE, self::MAX_VALUE);

        $this->blueValue = $value;
    }

    /**
     *
     * @param int $value
     */
    public function setAlphaValue($value = null)
    {
        if ($value !== null) {
            Misc::checkRange($value, self::MIN_VALUE, self::MAX_VALUE);
        }

        $this->blueValue = $value;
    }

    /**
     *
     * @param string $color
     * @param int $value
     */
    public function setValueByColor($color, $value)
    {
        if ($color != 'alpha' || $value !== null) {
            Misc::checkRange($value, self::MIN_VALUE, self::MAX_VALUE);
        }

        $this->{"{$color}Value"} = $value;
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'red' => $this->redValue,
            'green' => $this->greenValue,
            'blue' => $this->blueValue,
            'alpha' => $this->alphaValue
        ];
    }
}
