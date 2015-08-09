<?php

namespace LibUtil\Helper;

/**
 *
 */
class ConsoleHelper
{
    const FD_STDIN = 0;
    const FD_STDOUT = 1;
    const FD_STDERR = 2;

    /**
     *
     * @return int
     */
    public static function getTerminalWidth()
    {
        if (substr(PHP_OS, 0, 3) == 'WIN') {
            preg_match('/CON:(?:\n.+?){3}([0-9]+)/', `mode`, $matches);
            $termWidth = $matches[1];
        } else {
            $termWidth = `tput cols`;
        }

        return (int) trim($termWidth);
    }

    /**
     *
     * @param int $fd
     * @return \SplFileObject
     * @throws \InvalidArgumentException
     */
    public static function getStdStream($fd)
    {
        if (!in_array($fd, [self::FD_STDIN, self::FD_STDOUT, self::FD_STDERR])) {
            throw new \InvalidArgumentException('Not a standard file descriptor');
        }

        return new \SplFileObject("php://fd/$fd");
    }
}
