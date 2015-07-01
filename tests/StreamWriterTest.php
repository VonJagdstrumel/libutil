<?php

namespace LibUtil\Tests;

use LibUtil\DataPacker;
use LibUtil\StructStream\StreamWriter;

class StreamWriterTest extends StreamHandlerTest
{

    public function setUp()
    {
        parent::setUp();
        $dataPacker = new DataPacker();
        $this->streamWriter = new StreamWriter($this->fileObject, $dataPacker);
    }

    public function testNegativeChar()
    {
        $this->streamWriter->writeChar(self::$sampleValues[0]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[0], $this->fileObject->fread(strlen(self::$sampleData[0])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testChar()
    {
        $this->streamWriter->writeChar(self::$sampleValues[1]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[1], $this->fileObject->fread(strlen(self::$sampleData[1])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testUnsignedChar()
    {
        $this->streamWriter->writeUnsignedChar(self::$sampleValues[2]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[2], $this->fileObject->fread(strlen(self::$sampleData[2])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testNegativeShort()
    {
        $this->streamWriter->writeShort(self::$sampleValues[3]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[3], $this->fileObject->fread(strlen(self::$sampleData[3])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testShort()
    {
        $this->streamWriter->writeShort(self::$sampleValues[4]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[4], $this->fileObject->fread(strlen(self::$sampleData[4])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testUnsignedShort()
    {
        $this->streamWriter->writeUnsignedShort(self::$sampleValues[5]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[5], $this->fileObject->fread(strlen(self::$sampleData[5])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testNegativeLong()
    {
        $this->streamWriter->writeLong(self::$sampleValues[6]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[6], $this->fileObject->fread(strlen(self::$sampleData[6])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testLong()
    {
        $this->streamWriter->writeLong(self::$sampleValues[7]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[7], $this->fileObject->fread(strlen(self::$sampleData[7])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testUnsignedLong()
    {
        $this->streamWriter->writeUnsignedLong(self::$sampleValues[8]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[8], $this->fileObject->fread(strlen(self::$sampleData[8])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testNegativeFloat()
    {
        $this->streamWriter->writeFloat(self::$sampleValues[9]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[9], $this->fileObject->fread(strlen(self::$sampleData[9])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testFloat()
    {
        $this->streamWriter->writeFloat(self::$sampleValues[10]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[10], $this->fileObject->fread(strlen(self::$sampleData[10])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testNegativeDouble()
    {
        $this->streamWriter->writeDouble(self::$sampleValues[11]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[11], $this->fileObject->fread(strlen(self::$sampleData[11])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testDouble()
    {
        $this->streamWriter->writeDouble(self::$sampleValues[12]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[12], $this->fileObject->fread(strlen(self::$sampleData[12])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testString()
    {
        $this->streamWriter->writeString(self::$sampleValues[13]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[13], $this->fileObject->fread(strlen(self::$sampleData[13])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testUnicodeString()
    {
        $this->streamWriter->writeUnicodeString(self::$sampleValues[14]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[14], $this->fileObject->fread(strlen(self::$sampleData[14])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testNullString()
    {
        $this->streamWriter->writeNullString(self::$sampleValues[15]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[15], $this->fileObject->fread(strlen(self::$sampleData[15])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testUnicodeNullString()
    {
        $this->streamWriter->writeUnicodeNullString(self::$sampleValues[16]);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[16], $this->fileObject->fread(strlen(self::$sampleData[16])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testStringBlock()
    {
        $this->streamWriter->writeStringBlock(self::$sampleValues[17], 42);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[17], $this->fileObject->fread(strlen(self::$sampleData[17])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testUnicodeStringBlock()
    {
        $this->streamWriter->writeUnicodeStringBlock(self::$sampleValues[18], 42);
        $this->fileObject->rewind();

        $this->assertEquals(self::$sampleData[18], $this->fileObject->fread(strlen(self::$sampleData[18])));
        $this->assertTrue($this->fileObject->eof());
    }

    public function testFull()
    {
        $this->streamWriter->writeChar(self::$sampleValues[0]);
        $this->streamWriter->writeChar(self::$sampleValues[1]);
        $this->streamWriter->writeUnsignedChar(self::$sampleValues[2]);
        $this->streamWriter->writeShort(self::$sampleValues[3]);
        $this->streamWriter->writeShort(self::$sampleValues[4]);
        $this->streamWriter->writeUnsignedShort(self::$sampleValues[5]);
        $this->streamWriter->writeLong(self::$sampleValues[6]);
        $this->streamWriter->writeLong(self::$sampleValues[7]);
        $this->streamWriter->writeUnsignedLong(self::$sampleValues[8]);
        $this->streamWriter->writeFloat(self::$sampleValues[9]);
        $this->streamWriter->writeFloat(self::$sampleValues[10]);
        $this->streamWriter->writeDouble(self::$sampleValues[11]);
        $this->streamWriter->writeDouble(self::$sampleValues[12]);
        $this->streamWriter->writeString(self::$sampleValues[13]);
        $this->streamWriter->writeUnicodeString(self::$sampleValues[14]);
        $this->streamWriter->writeNullString(self::$sampleValues[15]);
        $this->streamWriter->writeUnicodeNullString(self::$sampleValues[16]);
        $this->streamWriter->writeStringBlock(self::$sampleValues[17], 42);
        $this->streamWriter->writeUnicodeStringBlock(self::$sampleValues[18], 42);
        $this->fileObject->rewind();

        $sampleDataString = implode(self::$sampleData);
        $this->assertEquals($sampleDataString, $this->fileObject->fread(strlen($sampleDataString)));
        $this->assertTrue($this->fileObject->eof());
    }
}
