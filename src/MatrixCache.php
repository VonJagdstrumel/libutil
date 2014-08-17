<?php

namespace UtilLib;

/**
 *
 */
class MatrixCache
{
    protected $length;
    protected $defaultCount;
    protected $itemVector;
    protected $countVector;

    /**
     *
     * @param int $length
     */
    public function __construct($length)
    {
        // TODO: Check arguments
        $this->length = $length;
        $this->itemVector = new SplFixedArray(pow($length, 2));
        $this->countVector = new SplFixedArray(pow($length, 2));
    }

    /**
     *
     * @param int $x
     * @param int $y
     * @param mixed $item
     * @param int $count
     */
    public function setItem($x, $y, $item, $count)
    {
        // TODO: Check arguments
        $offset = $this->toVectorOffset($x, $y);
        $this->itemVector[$offset] = $item;
        $this->countVector[$offset] = $count;
    }

    public function getItem($x, $y)
    {
        // TODO: Check arguments
        if (!$this->hasItem($x, $y)) {
            throw new RuntimeException('No item defined at these coordinates.');
        }

        $item = $this->itemVector[$this->toVectorOffset($x, $y)];
        $this->decrementCount($x, $y);
        return $item;
    }

    /**
     *
     * @param int $x
     * @param int $y
     * @return boolean
     */
    public function hasItem($x, $y)
    {
        // TODO: Check arguments
        return !is_null($this->countVector[$this->toVectorOffset($x, $y)]);
    }

    /**
     *
     * @param int $x
     * @param int $y
     * @throws RuntimeException
     */
    protected function removeItem($x, $y)
    {
        // TODO: Check arguments
        if (!$this->hasItem($x, $y)) {
            throw new RuntimeException('No item defined at these coordinates.');
        }

        $offset = $this->toVectorOffset($x, $y);
        unset($this->itemVector[$offset]);
        unset($this->countVector[$offset]);
    }

    /**
     *
     * @param int $x
     * @param int $y
     * @throws RuntimeException
     */
    protected function decrementCount($x, $y)
    {
        // TODO: Check arguments
        if (!$this->hasItem($x, $y)) {
            throw new RuntimeException('No item defined at these coordinates.');
        }

        $offset = $this->toVectorOffset($x, $y);
        $this->countVector[$offset] -= 1;

        if (!$this->countVector[$offset]) {
            $this->removeItem($x, $y);
        }
    }

    /**
     *
     * @param int $x
     * @param int $y
     * @return int
     */
    protected function toVectorOffset($x, $y)
    {
        // TODO: Check arguments
        return $y * $this->length + $x;
    }

    /**
     * @deprecated since version 0.1.0
     */
    public function printDebug()
    {
        $print = '';

        for ($y = 0; $y < $this->length; ++$y) {
            for ($x = 0; $x < $this->length; ++$x) {
                $offset = $this->toVectorOffset($x, $y);
                $print .= (($this->countVector[$offset] !== null) ? $this->countVector[$offset] : 'x') . "\t";
            }
            $print .= PHP_EOL;
        }

        print $print;
    }
}
