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
    protected $acceptFile;
    protected $acceptStdin;

    /**
     *
     */
    public function __construct($usage, $description, $acceptFile = false, $acceptStdin = false)
    {
        $this->argDefinitionList = new \SplDoublyLinkedList();
        $this->usage = $usage;
        $this->description = $description;
        $this->acceptFile = $acceptFile;
        $this->acceptStdin = $acceptStdin;
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
     * @return array
     */
    public function getReceivedArgumentList()
    {
        $shortDefList = '';
        $longDefList = [];

        foreach ($this->getArgumentDefinitionList() as $entry) {
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
    public function getReceivedArgument($identifier)
    {
        $argList = $this->getReceivedArgumentList();

        return isset($argList[$identifier]) ? $argList[$identifier] : null;
    }

    /**
     *
     * @param string $identifier
     * @return boolean
     */
    public function hasReceivedArgument($identifier)
    {
        $argList = $this->getReceivedArgumentList();

        return isset($argList[$identifier]);
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
