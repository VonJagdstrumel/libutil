<?php

namespace LibUtil;

/**
 *
 */
class ArgumentDefinition
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
     * @throws \InvalidArgumentException
     */
    public function __construct($shortIdentifier, $longIdentifier, $flag, $description)
    {
        $validParameters = is_null($shortIdentifier) && self::isIdentifier($longIdentifier, true);
        $validParameters |= is_null($longIdentifier) && self::isIdentifier($shortIdentifier);
        $validParameters |= self::isIdentifier($shortIdentifier) && self::isIdentifier($longIdentifier, true);
        $validParameters &= self::isFlag($flag);

        if (!$validParameters) {
            throw new \InvalidArgumentException('Invalid identifier definition');
        }

        $this->shortIdentifier = $shortIdentifier;
        $this->longIdentifier = $longIdentifier;
        $this->flag = $flag;
        $this->description = $description;
    }

    /**
     *
     * @param ArgumentDefinition $argDef
     * @return int
     */
    public function compareTo(ArgumentDefinition $argDef)
    {
        $isSame = $argDef->getLongIdentifier() == $this->longIdentifier;
        $isSame |= $argDef->getShortIdentifier() == $this->shortIdentifier;

        return (int) !$isSame;
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
     * @return string
     */
    public function getLongIdentifier()
    {
        return $this->longIdentifier;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @return string
     */
    public function getShortSynthax()
    {
        $synthax = $this->shortIdentifier;

        if ($synthax) {
            $synthax = '-' . $synthax;

            if ($this->flag == self::FLAG_MANDATORY_VALUE) {
                $synthax .= ' VALUE';
            } elseif ($this->flag == self::FLAG_OPTIONAL_VALUE) {
                $synthax .= '[=VALUE]';
            }
        }

        return $synthax;
    }

    /**
     *
     * @return string
     */
    public function getLongSynthax()
    {
        $synthax = $this->longIdentifier;

        if ($synthax) {
            $synthax = '--' . $synthax;

            if ($this->flag == self::FLAG_MANDATORY_VALUE) {
                $synthax .= '=VALUE';
            } elseif ($this->flag == self::FLAG_OPTIONAL_VALUE) {
                $synthax .= '[=VALUE]';
            }
        }

        return $synthax;
    }

    /**
     *
     * @return string
     */
    public function getBothSynthax()
    {
        $synthax = $this->getShortSynthax();

        if ($this->shortIdentifier && $this->longIdentifier) {
            $synthax .= ', ';
        }

        $synthax .= $this->getLongSynthax();

        return $synthax;
    }

    /**
     *
     * @param string $string
     * @param boolean $isLong
     * @return boolean
     */
    protected static function isIdentifier($string, $isLong = false)
    {
        $regex = !$isLong ? '/^[A-z0-9]$/' : '/^[A-z0-9]+$/';

        return (boolean) preg_match($regex, $string);
    }

    /**
     *
     * @param string $string
     * @return boolean
     */
    protected static function isFlag($string)
    {
        return (boolean) preg_match('/^:{0,2}$/', $string);
    }
}
