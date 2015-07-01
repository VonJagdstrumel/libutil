<?php

namespace LibUtil\StructStream;

use LibUtil\DataPacker;

/**
 *
 */
abstract class StreamHandler
{
    protected $fileObject;
    protected $dataPacker;

    /**
     *
     * @param \SplFileObject $fileObject
     * @param DataPacker $dataPacker
     */
    function __construct(\SplFileObject $fileObject, DataPacker $dataPacker = null)
    {
        $this->fileObject = $fileObject;
        $this->dataPacker = $dataPacker ? : new DataPacker();
    }

    /**
     *
     * @return string
     */
    protected function getUnicodeEncoding()
    {
        return 'UCS-2' . $this->dataPacker->getSelectedEndianess();
    }
}
