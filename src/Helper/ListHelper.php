<?php

namespace LibUtil\Helper;

/**
 *
 */
class ListHelper
{

    /**
     *
     * @param array $array
     * @return \SplDoublyLinkedList
     */
    public static function arrayToList(array $array)
    {
        $queue = new \SplDoublyLinkedList();
        foreach ($array as $item) {
            $queue->push($item);
        }
        return $queue;
    }

    /**
     *
     * @param \SplDoublyLinkedList $list
     * @return array
     */
    public static function listToArray(\SplDoublyLinkedList $list)
    {
        $array = [];
        foreach ($list as $item) {
            $array[] = $item;
        }
        return $array;
    }
}
