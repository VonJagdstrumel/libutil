<?php

namespace ArgumentHandler;

/**
 *
 */
class Core
{
    protected $argDefinitionList;

    /**
     *
     */
    public function __construct()
    {
        $this->argDefinitionList = new SplDoublyLinkedList();
    }

    /**
     *
     * @param Definition $argDef
     * @throws LogicException
     */
    public function addArgumentDefinition(Definition $argDef)
    {
        if ($this->hasArgumentDefinition($argDef)) {
            throw new LogicException("Argument definition already set.");
        }

        $this->argDefinitionList->push($argDef);
    }

    /**
     *
     * @return SplDoublyLinkedList
     */
    public function getArgumentDefinitionList()
    {
        return $this->argDefinitionList;
    }

    /**
     * @version NOT_USABLE
     * @return array
     */
    public function getArgumentReceivedList()
    {
        return getopt('', []);
    }

    /**
     *
     * @param Definition $argDef
     * @return boolean
     */
    public function hasArgumentDefinition(Definition $argDef)
    {
        $hasArgDef = false;

        foreach ($this->argDefinitionList as $argDefListEntry) {
            if ($argDef->compareTo($argDefListEntry) == 0) {
                $hasArgDef = true;
                break;
            }
        }

        return $hasArgDef;
    }

    /**
     *
     * @return int
     */
    protected function getShortArgumentColumnWidth()
    {
        $columnWidth = 1;

        foreach ($this->argDefinitionList as $argDefListEntry) {
            $currLength = strlen($argDefListEntry->getLongIdentifier());

            if ($currLength > $columnWidth) {
                $columnWidth = $currLength;
            }
        }

        return $columnWidth;
    }

    /**
     *
     * @return int
     */
    protected function getLongArgumentColumnWidth()
    {
        $columnWidth = 1;

        foreach ($this->argDefinitionList as $argDefListEntry) {
            $currLength = strlen($argDefListEntry->getShortIdentifier());

            if ($currLength > $columnWidth) {
                $columnWidth = $currLength;
            }
        }

        return $columnWidth;
    }

    /**
     *
     * @version NOT_FINISHED
     * @return string
     */
    public function generateHelp()
    {
        $longestShortArgDefinition = $this->getShortArgumentColumnWidth();
        $longestLongArgDefinition = $this->getLongArgumentColumnWidth();
        $helpString = 'Help for ' . basename($_SERVER['PHP_SELF']) . ':' . PHP_EOL;

        foreach ($this->argDefinitionList as $argDefListEntry) {
            $helpString .= $argDefListEntry->getFormattedShort();
            $helpString .= $argDefListEntry->getFormattedLong();
            $helpString .= $argDefListEntry->getDescription();
            $helpString .= PHP_EOL;
        }

        return $helpString;
    }

    /**
     *
     * @version NOT_FINISHED
     * @param type $argString
     * @return boolean
     */
    public function hasReceivedArgument($argString)
    {
        $rawReceivedArgs = getopt('', []);
        return false;
    }

    /**
     *
     * @return int
     */
    public function argumentDefinitionCount()
    {
        return $this->argDefinitionList->count();
    }

    /**
     *
     * @version NOT_FINISHED
     * @return int
     */
    public function argumentReceivedCount()
    {
        return 0;
    }
}
