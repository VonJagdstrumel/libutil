<?php

require_once 'vendor/autoload.php';

use LibArg\ArgumentManager;
use LibArg\ArgumentDefinition;

$one = new ArgumentDefinition('a', 'append', '', 'Force append some shit in there');
$two = new ArgumentDefinition('r', 'recursive', ':', 'Do that shit recursively');
$three = new ArgumentDefinition('c', 'color', '::', 'Color all the shit');
$four = new ArgumentDefinition('s', '', '', 'Split the shit');
$five = new ArgumentDefinition('', 'quiet', '', 'Don\'t print any shit');

$manager = new ArgumentManager('[OPTIONS]', 'Hahaha! Something to test?');
$manager->addArgumentDefinition($one);
$manager->addArgumentDefinition($two);
$manager->addArgumentDefinition($three);
$manager->addArgumentDefinition($four);
$manager->addArgumentDefinition($five);

print $manager->generateHelp();

var_dump($manager->getReceivedArgumentList());
