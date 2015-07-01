<?php

namespace LibUtil;

/**
 *
 */
class DataPacker
{
    const FORMAT_CHAR = 'c';
    const FORMAT_UCHAR = 'C';
    const FORMAT_SHORT = 's';
    const FORMAT_USHORT = 'S';
    const FORMAT_LONG = 'l';
    const FORMAT_ULONG = 'L';
    const FORMAT_FLOAT = 'f';
    const FORMAT_DOUBLE = 'd';
    const ARCH_BIG_ENDIAN = 'BE';
    const ARCH_LITTLE_ENDIAN = 'LE';

    private $systemEndianess;
    private $selectedEndianess;

    /**
     *
     * @param string $endianess
     */
    function __construct($endianess = self::ARCH_LITTLE_ENDIAN)
    {
        $this->systemEndianess = (pack('S', 1) == pack('v', 1)) ?
            self::ARCH_LITTLE_ENDIAN :
            self::ARCH_BIG_ENDIAN;
        $this->selectedEndianess = $endianess;
    }

    /**
     *
     * @return string
     */
    public function getSelectedEndianess()
    {
        return $this->selectedEndianess;
    }

    /**
     *
     * @param string $endianess
     */
    public function setSelectedEndianess($endianess)
    {
        $this->selectedEndianess = $endianess;
    }

    /**
     *
     * @param string $format
     * @param string $value
     * @return string
     */
    public function pack($format, $value)
    {
        $data = pack($format, $value);
        return $this->normalize($format, $data);
    }

    /**
     *
     * @param string $format
     * @param string $data
     * @return string
     */
    public function unpack($format, $data)
    {
        $data = $this->normalize($format, $data);
        $unpacked = unpack("{$format}n", $data);
        return $unpacked['n'];
    }

    /**
     *
     * @param string $format
     * @param string $data
     * @return string
     */
    private function normalize($format, $data)
    {
        $numberFormats = [
            self::FORMAT_SHORT,
            self::FORMAT_USHORT,
            self::FORMAT_LONG,
            self::FORMAT_ULONG,
            self::FORMAT_FLOAT,
            self::FORMAT_DOUBLE
        ];

        return ($this->systemEndianess != $this->selectedEndianess && in_array($format[0], $numberFormats)) ?
            strrev($data) :
            $data;
    }
}
