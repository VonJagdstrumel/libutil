<?php

namespace LibUtil\StructStream;

use LibUtil\DataPacker;

/**
 *
 */
class StreamReader extends StreamHandler
{

    /**
     *
     * @return int
     */
    public function readChar()
    {
        $data = $this->fileObject->fread(1);
        return $this->dataPacker->unpack(DataPacker::FORMAT_CHAR, $data);
    }

    /**
     *
     * @return int
     */
    public function readUnsignedChar()
    {
        $data = $this->fileObject->fread(1);
        return $this->dataPacker->unpack(DataPacker::FORMAT_UCHAR, $data);
    }

    /**
     *
     * @return int
     */
    public function readShort()
    {
        $data = $this->fileObject->fread(2);
        return $this->dataPacker->unpack(DataPacker::FORMAT_SHORT, $data);
    }

    /**
     *
     * @return int
     */
    public function readUnsignedShort()
    {
        $data = $this->fileObject->fread(2);
        return $this->dataPacker->unpack(DataPacker::FORMAT_USHORT, $data);
    }

    /**
     *
     * @return int
     */
    public function readLong()
    {
        $data = $this->fileObject->fread(4);
        return $this->dataPacker->unpack(DataPacker::FORMAT_LONG, $data);
    }

    /**
     *
     * @return int
     */
    public function readUnsignedLong()
    {
        $data = $this->fileObject->fread(4);
        return $this->dataPacker->unpack(DataPacker::FORMAT_ULONG, $data);
    }

    /**
     *
     * @return float
     */
    public function readFloat()
    {
        $data = $this->fileObject->fread(4);
        return $this->dataPacker->unpack(DataPacker::FORMAT_FLOAT, $data);
    }

    /**
     *
     * @return float
     */
    public function readDouble()
    {
        $data = $this->fileObject->fread(8);
        return $this->dataPacker->unpack(DataPacker::FORMAT_DOUBLE, $data);
    }

    /**
     *
     * @param int $length
     * @return string
     */
    public function readString($length)
    {
        return $this->fileObject->fread($length);
    }

    /**
     *
     * @param int $length
     * @return string
     */
    public function readUnicodeString($length)
    {
        $data = $this->fileObject->fread($length * 2);
        return iconv($this->getUnicodeEncoding(), 'ASCII//TRANSLIT//IGNORE', $data);
    }

    /**
     *
     * @return string
     */
    public function readNullString()
    {
        $data = '';
        $char = $this->fileObject->fread(1);
        while ($char != "\x00") {
            $data .= $char;
            $char = $this->fileObject->fread(1);
        }
        return $data;
    }

    /**
     *
     * @return string
     */
    public function readUnicodeNullString()
    {
        $data = '';
        $char = $this->fileObject->fread(2);
        while ($char != "\x00\x00") {
            $data .= $char;
            $char = $this->fileObject->fread(2);
        }
        return iconv($this->getUnicodeEncoding(), 'ASCII//TRANSLIT//IGNORE', $data);
    }

    /**
     *
     * @param int $length
     * @param string $padding
     * @return string
     */
    public function readStringBlock($length, $padding = "\x00")
    {
        $data = $this->fileObject->fread($length);
        return rtrim($data, $padding);
    }

    /**
     *
     * @param int $length
     * @param string $padding
     * @return string
     */
    public function readUnicodeStringBlock($length, $padding = "\x00")
    {
        $data = $this->fileObject->fread($length * 2);
        $data = iconv($this->getUnicodeEncoding(), 'ASCII//TRANSLIT//IGNORE', $data);
        return rtrim($data, $padding);
    }
}
