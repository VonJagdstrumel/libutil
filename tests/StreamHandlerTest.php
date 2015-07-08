<?php

namespace LibUtil\Tests;

/**
 *
 */
abstract class StreamHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected static $sampleValues;
    protected static $sampleGenerators;
    protected static $sampleData;
    protected $fileObject;
    protected $streamReader;

    /**
     *
     */
    public static function setUpBeforeClass()
    {
        self::$sampleValues = [
            -42,
            42,
            42,
            -4200,
            4200,
            4200,
            -420000,
            420000,
            420000,
            -42.42,
            42.42,
            -42.42,
            42.42,
            'test',
            'test',
            'test',
            'test',
            'test',
            'test'
        ];
        self::$sampleGenerators = [
            'pack("c", %s)',
            'pack("c", %s)',
            'pack("C", %s)',
            'pack("s", %s)',
            'pack("s", %s)',
            'pack("S", %s)',
            'pack("l", %s)',
            'pack("l", %s)',
            'pack("L", %s)',
            'pack("f", %s)',
            'pack("f", %s)',
            'pack("d", %s)',
            'pack("d", %s)',
            '"%s"',
            'iconv("ASCII", "UCS-2LE", "%s")',
            '"%s\x00"',
            'iconv("ASCII", "UCS-2LE", "%s\x00")',
            'str_pad("%s", 42, "\x00")',
            'iconv("ASCII", "UCS-2LE", str_pad("%s", 42, "\x00"))'
        ];

        for ($i = 0; $i < count(self::$sampleGenerators); ++$i) {
            eval('self::$sampleData[$i] = ' . sprintf(self::$sampleGenerators[$i], self::$sampleValues[$i]) . ';');
        }
    }

    /**
     *
     */
    public function setUp()
    {
        $this->fileObject = new \SplTempFileObject();
    }

    /**
     * 
     */
    public function tearDown()
    {
        $this->fileObject = null;
        $this->streamWriter = null;
    }
}
