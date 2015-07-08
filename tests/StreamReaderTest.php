<?php

namespace LibUtil\Tests;

use LibUtil\DataPacker;
use LibUtil\StructStream\StreamReader;

/**
 *
 */
class StreamReaderTest extends StreamHandlerTest
{

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $dataPacker = new DataPacker();
        $this->streamReader = new StreamReader($this->fileObject, $dataPacker);
    }

    /**
     *
     */
    public function testNegativeChar()
    {
        $this->fileObject->fwrite(self::$sampleData[0]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[0], $this->streamReader->readChar());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testChar()
    {
        $this->fileObject->fwrite(self::$sampleData[1]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[1], $this->streamReader->readChar());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testUnsignedChar()
    {
        $this->fileObject->fwrite(self::$sampleData[2]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[2], $this->streamReader->readUnsignedChar());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testNegativeShort()
    {
        $this->fileObject->fwrite(self::$sampleData[3]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[3], $this->streamReader->readShort());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testShort()
    {
        $this->fileObject->fwrite(self::$sampleData[4]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[4], $this->streamReader->readShort());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testUnsignedShort()
    {
        $this->fileObject->fwrite(self::$sampleData[5]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[5], $this->streamReader->readUnsignedShort());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testNegativeLong()
    {
        $this->fileObject->fwrite(self::$sampleData[6]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[6], $this->streamReader->readLong());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testLong()
    {
        $this->fileObject->fwrite(self::$sampleData[7]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[7], $this->streamReader->readLong());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testUnsignedLong()
    {
        $this->fileObject->fwrite(self::$sampleData[8]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[8], $this->streamReader->readUnsignedLong());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testNegativeFloat()
    {
        $this->fileObject->fwrite(self::$sampleData[9]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[9], $this->streamReader->readFloat(), '', 1e-2);
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testFloat()
    {
        $this->fileObject->fwrite(self::$sampleData[10]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[10], $this->streamReader->readFloat(), '', 1e-2);
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testNegativeDouble()
    {
        $this->fileObject->fwrite(self::$sampleData[11]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[11], $this->streamReader->readDouble(), '', 1e-2);
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testDouble()
    {
        $this->fileObject->fwrite(self::$sampleData[12]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[12], $this->streamReader->readDouble(), '', 1e-2);
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testString()
    {
        $this->fileObject->fwrite(self::$sampleData[13]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[13], $this->streamReader->readString(4));
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testUnicodeString()
    {
        $this->fileObject->fwrite(self::$sampleData[14]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[14], $this->streamReader->readUnicodeString(4));
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testNullString()
    {
        $this->fileObject->fwrite(self::$sampleData[15]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[15], $this->streamReader->readNullString());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testUnicodeNullString()
    {
        $this->fileObject->fwrite(self::$sampleData[16]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[16], $this->streamReader->readUnicodeNullString());
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testStringBlock()
    {
        $this->fileObject->fwrite(self::$sampleData[17]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[17], $this->streamReader->readStringBlock(42));
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testUnicodeStringBlock()
    {
        $this->fileObject->fwrite(self::$sampleData[18]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[18], $this->streamReader->readUnicodeStringBlock(42));
        $this->assertTrue($this->fileObject->eof());
    }

    /**
     *
     */
    public function testFull()
    {
        $this->fileObject->fwrite(implode(self::$sampleData));
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleValues[0], $this->streamReader->readChar());
        $this->assertEquals(self::$sampleValues[1], $this->streamReader->readChar());
        $this->assertEquals(self::$sampleValues[2], $this->streamReader->readUnsignedChar());
        $this->assertEquals(self::$sampleValues[3], $this->streamReader->readShort());
        $this->assertEquals(self::$sampleValues[4], $this->streamReader->readShort());
        $this->assertEquals(self::$sampleValues[5], $this->streamReader->readUnsignedShort());
        $this->assertEquals(self::$sampleValues[6], $this->streamReader->readLong());
        $this->assertEquals(self::$sampleValues[7], $this->streamReader->readLong());
        $this->assertEquals(self::$sampleValues[8], $this->streamReader->readUnsignedLong());
        $this->assertEquals(self::$sampleValues[9], $this->streamReader->readFloat(), '', 1e-2);
        $this->assertEquals(self::$sampleValues[10], $this->streamReader->readFloat(), '', 1e-2);
        $this->assertEquals(self::$sampleValues[11], $this->streamReader->readDouble(), '', 1e-2);
        $this->assertEquals(self::$sampleValues[12], $this->streamReader->readDouble(), '', 1e-2);
        $this->assertEquals(self::$sampleValues[13], $this->streamReader->readString(4));
        $this->assertEquals(self::$sampleValues[14], $this->streamReader->readUnicodeString(4));
        $this->assertEquals(self::$sampleValues[15], $this->streamReader->readNullString());
        $this->assertEquals(self::$sampleValues[16], $this->streamReader->readUnicodeNullString());
        $this->assertEquals(self::$sampleValues[17], $this->streamReader->readStringBlock(42));
        $this->assertEquals(self::$sampleValues[18], $this->streamReader->readUnicodeStringBlock(42));
        $this->assertTrue($this->fileObject->eof());
    }
}
