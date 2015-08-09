<?php

namespace LibUtil\CommandLine;

/**
 *
 */
class OptionDefinition
{
    const FLAG_NO_VALUE = '';
    const FLAG_MANDATORY_VALUE = ':';
    const FLAG_OPTIONAL_VALUE = '::';

    private $shortIdentifier;
    private $longIdentifier;
    private $flag;
    private $description;

    /**
     *
     * @param string $shortIdentifier
     * @param string $longIdentifier
     * @param string $flag
     * @param string $description
     * @throws \InvalidArgumentException
     */
    public function __construct($shortIdentifier, $longIdentifier, $flag = self::FLAG_NO_VALUE, $description = '')
    {
        $validSetup = is_null($shortIdentifier) && self::isIdentifier($longIdentifier, true);
        $validSetup |= is_null($longIdentifier) && self::isIdentifier($shortIdentifier);
        $validSetup |= self::isIdentifier($shortIdentifier) && self::isIdentifier($longIdentifier, true);
        $validSetup &= self::isFlag($flag);

        if (!$validSetup) {
            throw new \InvalidArgumentException('Invalid option definition');
        }

        $this->shortIdentifier = $shortIdentifier;
        $this->longIdentifier = $longIdentifier;
        $this->flag = $flag;
        $this->description = $description;
    }

    /**
     *
     * @param OptionDefinition $optDef
     * @return boolean
     */
    public function conflictWith(OptionDefinition $optDef)
    {
        return ($optDef->getLongIdentifier() == $this->longIdentifier) ||
            ($optDef->getShortIdentifier() == $this->shortIdentifier);
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
    private static function isIdentifier($string, $isLong = false)
    {
        $regex = !$isLong ? '/^[A-z0-9]$/' : '/^[A-z0-9]+$/';

        return is_string($string) && preg_match($regex, $string);
    }

    /**
     *
     * @param string $string
     * @return boolean
     */
    private static function isFlag($string)
    {
        return is_string($string) && preg_match('/^:{0,2}$/', $string);
    }
}
