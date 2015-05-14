<?php

namespace LibArg;

use LibArg\ArgumentDefinition;

/**
 *
 */
class ArgumentManager
{
    protected $argDefinitionList;
    protected $usage;
    protected $description;

    /**
     *
     */
    public function __construct($usage, $description)
    {
        $this->argDefinitionList = new \SplDoublyLinkedList();
        $this->usage = $usage;
        $this->description = $description;
    }

    /**
     *
     * @param ArgumentDefinition $argDef
     * @throws \RuntimeException
     */
    public function addArgumentDefinition(ArgumentDefinition $argDef)
    {
        if ($this->hasArgumentDefinition($argDef)) {
            throw new \RuntimeException("Argument definition already set.");
        }

        $this->argDefinitionList->push($argDef);
    }

    /**
     *
     * @return \SplDoublyLinkedList
     */
    public function getArgumentDefinitionList()
    {
        return $this->argDefinitionList;
    }

    /**
     *
     * @param ArgumentDefinition $argDef
     * @return boolean
     */
    public function hasArgumentDefinition(ArgumentDefinition $argDef)
    {
        $res = false;

        foreach ($this->argDefinitionList as $entry) {
            if ($argDef->compareTo($entry) == 0) {
                $res = true;
                break;
            }
        }

        return $res;
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
     * @version NOT_USABLE
     * @return \SplFixedArray
     */
    public function getReceivedArgumentList()
    {
        $argList = getopt('', []);

        return \SplFixedArray::fromArray($argList);
    }

    /**
     *
     * @param string $argString
     * @return boolean
     */
    public function hasReceivedArgument($argString)
    {
        $argList = $this->getReceivedArgumentList();

        return isset($argList[$argString]);
    }

    /**
     *
     * @return int
     */
    public function receivedArgumentCount()
    {
        return $this->getReceivedArgumentList()->count();
    }

    /**
     *
     * @return string
     */
    public function generateHelp()
    {
        $helpString = sprintf("Usage: %s %s\n%s\n", basename($_SERVER['PHP_SELF']), $this->usage, $this->description);

        foreach ($this->argDefinitionList as $entry) {
            $helpString .= sprintf("  %s\n     %s\n", $entry->getBothSynthax(), wordwrap($entry->getDescription(), 75, '\n     '));
        }

        return $helpString;
    }
}
