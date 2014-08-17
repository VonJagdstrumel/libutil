<?php

namespace ArgumentHandler;

/**
 *
 */
class Definition
{
    const FLAG_NO_VALUE = '';
    const FLAG_MANDATORY_VALUE = ':';
    const FLAG_OPTIONAL_VALUE = '::';

    protected $shortIdentifier;
    protected $longIdentifier;
    protected $flag;
    protected $description;

    /**
     *
     * @param string $shortIdentifier
     * @param string $longIdentifier
     * @param string $flag
     * @param string $description
     * @throws InvalidArgumentException
     */
    public function __construct($shortIdentifier, $longIdentifier, $flag, $description)
    {
        $validParameters = self::isCharacter($shortIdentifier);
        $validParameters &=self::isString($longIdentifier);
        $validParameters &=self::isFlag($flag);
        $validParameters &=self::isString($description);

        if (!$validParameters) {
            throw new InvalidArgumentException();
        }

        $this->shortIdentifier = $shortIdentifier;
        $this->longIdentifier = $longIdentifier;
        $this->flag = $flag;
        $this->description = $description;
    }

    /**
     *
     * @param Definition $argDef
     * @return int
     */
    public function compareTo(Definition $argDef)
    {
        $isSame = $argDef->getLongIdentifier() == $this->longIdentifier;
        $isSame |= $argDef->getShortIdentifier() == $this->shortIdentifier;

        return $isSame ? 0 : 1;
    }

    /**
     *
     * @return string
     */
    public function getShortIdentifier()
    {
        return $this->shortIdentifier;
    }

    /**
     *
     * @param string $identifier
     * @throws InvalidArgumentException
     */
    public function setShortIdentifier($identifier)
    {
        if (!self::isCharacter($identifier)) {
            throw new InvalidArgumentException();
        }

        $this->shortIdentifier = $identifier;
    }

    /**
     *
     * @return string
     */
    public function getLongIdentifier()
    {
        return $this->longIdentifier;
    }

    /**
     *
     * @param string $identifier
     * @throws InvalidArgumentException
     */
    public function setLongIdentifier($identifier)
    {
        if (!self::isString($identifier)) {
            throw new InvalidArgumentException();
        }

        $this->longIdentifier = $identifier;
    }

    /**
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     *
     * @param string $flag
     * @throws InvalidArgumentException
     */
    public function setFlag($flag)
    {
        if (!self::isFlag($flag)) {
            throw new InvalidArgumentException();
        }

        $this->flag = $flag;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param string $description
     * @throws InvalidArgumentException
     */
    public function setDescription($description)
    {
        if (!self::isString($description)) {
            throw new InvalidArgumentException();
        }

        $this->description = $description;
    }

    /**
     *
     * @return string
     */
    public function getFormattedShort()
    {
        $formatted = $this->shortIdentifier;

        if ($this->flag != self::FLAG_NO_VALUE) {
            $valueSuffix = '<value>';

            if ($this->flag == self::FLAG_OPTIONAL_VALUE) {
                $valueSuffix = "[$valueSuffix]";
            }

            $formatted .= " $valueSuffix";
        }

        return $formatted;
    }

    /**
     *
     * @return string
     */
    public function getFormattedLong()
    {
        $formatted = $this->longIdentifier;

        if ($this->flag != self::FLAG_NO_VALUE) {
            $valueSuffix = '=<value>';

            if ($this->flag == self::FLAG_OPTIONAL_VALUE) {
                $valueSuffix = "[$valueSuffix]";
            }

            $formatted .= $valueSuffix;
        }

        return $formatted;
    }

    /**
     *
     * @param string $string
     * @return boolean
     */
    protected static function isCharacter($string)
    {
        return (is_string($string) && preg_match('/^[A-z]$/', $string));
    }

    /**
     *
     * @param string $string
     * @return boolean
     */
    protected static function isString($string)
    {
        return (is_string($string) && !empty($string));
    }

    /**
     *
     * @param string $string
     * @return boolean
     */
    protected static function isFlag($string)
    {
        return (is_string($string) && preg_match('/^:{0,2}$/', $string));
    }
}
