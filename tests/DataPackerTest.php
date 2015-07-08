<?php

namespace LibUtil\Tests;

use LibUtil\DataPacker;

/**
 *
 */
class DataPackerTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testBigEndianPack()
    {
        $dataPacker = new DataPacker(DataPacker::ARCH_BIG_ENDIAN);
    }

    /**
     *
     */
    public function testLittleEndianPack()
    {
        $dataPacker = new DataPacker(DataPacker::ARCH_LITTLE_ENDIAN);
    }

    /**
     *
     */
    public function testBigEndianUnpack()
    {
        $dataPacker = new DataPacker(DataPacker::ARCH_BIG_ENDIAN);
    }

    /**
     *
     */
    public function testLittleEndianUnpack()
    {
        $dataPacker = new DataPacker(DataPacker::ARCH_LITTLE_ENDIAN);
    }
}
