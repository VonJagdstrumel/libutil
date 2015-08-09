<?php

namespace LibUtil\CommandLine;

use LibUtil\Helper\ConsoleHelper;

/**
 *
 */
class ArgumentManager
{
    private $optDefinitionList;
    private $usage;
    private $description;

    /**
     *
     */
    public function __construct($usage, $description)
    {
        $this->optDefinitionList = new \SplDoublyLinkedList();
        $this->usage = $usage;
        $this->description = $description;
    }

    /**
     *
     * @param OptionDefinition $optDef
     * @throws \RuntimeException
     */
    public function addOptionDefinition(OptionDefinition $optDef)
    {
        if ($this->hasOptionDefinition($optDef)) {
            throw new \RuntimeException("Option definition already set.");
        }

        $this->optDefinitionList->push($optDef);
    }

    /**
     *
     * @param OptionDefinition $optDef
     * @return boolean
     */
    private function hasOptionDefinition(OptionDefinition $optDef)
    {
        $res = false;

        foreach ($this->optDefinitionList as $entry) {
            if ($optDef->conflictWith($entry)) {
                $res = true;
                break;
            }
        }

        return $res;
    }

    /**
     *
     * @return array
     */
    public function getReceivedOptionList()
    {
        $shortDefList = '';
        $longDefList = [];

        foreach ($this->optDefinitionList as $entry) {
            $shortDefList .= $entry->getShortIdentifier() . $entry->getFlag();
            $longDefList[] = $entry->getLongIdentifier() . $entry->getFlag();
        }

        return getopt($shortDefList, $longDefList);
    }

    /**
     *
     * @param string $identifier
     * @return mixed
     */
    public function getReceivedOption($identifier)
    {
        $optList = $this->getReceivedOptionList();

        return isset($optList[$identifier]) ? $optList[$identifier] : null;
    }

    /**
     *
     * @param string $identifier
     * @return boolean
     */
    public function hasReceivedOption($identifier)
    {
        $optList = $this->getReceivedOptionList();

        return isset($optList[$identifier]);
    }

    /**
     *
     * @return array
     */
    public function getArgumentList()
    {
        global $argv;

        $optList = $this->getReceivedOptionList();
        $index = 1;

        foreach ($optList as $optName => $optValue) {
            if ($optValue !== false) {
                $optPrefix = (strlen($optName) == 1) ? '-' : '--';

                if (preg_match("/^$optPrefix$optName\$/", $argv[$index])) {
                    ++$index;
                }
            }

            ++$index;
        }

        return array_splice($argv, $index);
    }

    /**
     * Overload this method in order to create your own formatting
     * @return string
     */
    public function generateHelp()
    {
        $helpString = sprintf("Usage: %s %s\n%s\n\n", basename($_SERVER['PHP_SELF']), $this->usage, $this->description);
        $spaceMarginWidth = 12;
        $spaceMargin = "\n" . str_repeat(" ", $spaceMarginWidth);
        $textWidth = ConsoleHelper::getTerminalWidth() - $spaceMarginWidth;

        foreach ($this->optDefinitionList as $entry) {
            $helpString .= sprintf("  %s%s%s\n", $entry->getBothSynthax(), $spaceMargin, wordwrap($entry->getDescription(), $textWidth, $spaceMargin));
        }

        return $helpString;
    }
}
