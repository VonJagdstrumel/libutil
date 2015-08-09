<?php

require_once 'vendor/autoload.php';

use LibUtil\CliArgument\ArgumentManager;
use LibUtil\CliArgument\OptionDefinition;

$one = new OptionDefinition('a', 'append', OptionDefinition::FLAG_NO_VALUE, 'Force append some shit in there');
$two = new OptionDefinition('r', 'recursive', OptionDefinition::FLAG_MANDATORY_VALUE, 'Do that shit recursively');
$three = new OptionDefinition('c', 'color', OptionDefinition::FLAG_OPTIONAL_VALUE, 'Color all the shit');
$four = new OptionDefinition('s', null, OptionDefinition::FLAG_NO_VALUE, 'Split the shit');
$five = new OptionDefinition(null, 'quiet', OptionDefinition::FLAG_NO_VALUE, 'Don\'t print any shit');
$five = new OptionDefinition(null, 't', OptionDefinition::FLAG_OPTIONAL_VALUE, 'Don\'t print any shit');

$manager = new ArgumentManager('[OPTIONS]', 'Hahaha! Something to test?');
$manager->addOptionDefinition($one);
$manager->addOptionDefinition($two);
$manager->addOptionDefinition($three);
$manager->addOptionDefinition($four);
$manager->addOptionDefinition($five);

print $manager->generateHelp();

var_dump($manager->getReceivedOptionList());
var_dump($manager->getArgumentList());
