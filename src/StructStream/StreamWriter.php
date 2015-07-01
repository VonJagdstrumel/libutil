<?php

namespace LibUtil\StructStream;

use LibUtil\DataPacker;

/**
 *
 */
class StreamWriter extends StreamHandler
{

    /**
     *
     * @return int
     */
    public function writeChar($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_CHAR, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return int
     */
    public function writeUnsignedChar($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_UCHAR, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return int
     */
    public function writeShort($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_SHORT, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return int
     */
    public function writeUnsignedShort($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_USHORT, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return int
     */
    public function writeLong($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_LONG, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return int
     */
    public function writeUnsignedLong($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_ULONG, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return float
     */
    public function writeFloat($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_FLOAT, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @return float
     */
    public function writeDouble($value)
    {
        $data = $this->dataPacker->pack(DataPacker::FORMAT_DOUBLE, $value);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @param string $string
     */
    public function writeString($string)
    {
        $this->fileObject->fwrite($string);
    }

    /**
     *
     * @param string $string
     */
    public function writeUnicodeString($string)
    {
        $data = iconv('ASCII', $this->getUnicodeEncoding(), $string);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @param string $string
     */
    public function writeNullString($string)
    {
        $this->fileObject->fwrite($string . "\x00");
    }

    /**
     *
     * @param string $string
     */
    public function writeUnicodeNullString($string)
    {
        $data = iconv('ASCII', $this->getUnicodeEncoding(), $string);
        $this->fileObject->fwrite($data . "\x00\x00");
    }

    /**
     *
     * @param string $string
     * @param int $length
     * @param string $padding
     */
    public function writeStringBlock($string, $length, $padding = "\x00")
    {
        $data = str_pad($string, $length, $padding);
        $this->fileObject->fwrite($data);
    }

    /**
     *
     * @param string $string
     * @param type $length
     * @param type $padding
     */
    public function writeUnicodeStringBlock($string, $length, $padding = "\x00")
    {
        $data = str_pad($string, $length, $padding);
        $data = iconv('ASCII', $this->getUnicodeEncoding(), $data);
        $this->fileObject->fwrite($data);
    }
}
