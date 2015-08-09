<?php

namespace LibUtil\Color;

/**
 *
 */
class PlainColor
{
    const MIN_VALUE = 0;
    const MAX_VALUE = 255;

    private $redValue;
    private $greenValue;
    private $blueValue;

    /**
     *
     */
    function __construct($red = self::MIN_VALUE, $green = self::MIN_VALUE, $blue = self::MIN_VALUE)
    {
        $this->redValue = $red;
        $this->greenValue = $green;
        $this->blueValue = $blue;
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
     * @param string $name
     * @return int
     */
    public function getValueByName($name)
    {
        return $this->{"{$name}Value"};
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
     * @param string $name
     * @param int $value
     */
    public function setValueByName($name, $value)
    {
        $this->{"{$name}Value"} = $value;
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
            'blue' => $this->blueValue
        ];
    }
}
