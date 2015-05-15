<?php

require_once 'vendor/autoload.php';

use LibArg\ArgumentManager;
use LibArg\ArgumentDefinition;

$one = new ArgumentDefinition('a', 'append', ArgumentDefinition::FLAG_NO_VALUE, 'Force append some shit in there');
$two = new ArgumentDefinition('r', 'recursive', ArgumentDefinition::FLAG_MANDATORY_VALUE, 'Do that shit recursively');
$three = new ArgumentDefinition('c', 'color', ArgumentDefinition::FLAG_OPTIONAL_VALUE, 'Color all the shit');
$four = new ArgumentDefinition('s', null, ArgumentDefinition::FLAG_NO_VALUE, 'Split the shit');
$five = new ArgumentDefinition(null, 'quiet', ArgumentDefinition::FLAG_NO_VALUE, 'Don\'t print any shit');

$manager = new ArgumentManager('[OPTIONS]', 'Hahaha! Something to test?');
$manager->addArgumentDefinition($one);
$manager->addArgumentDefinition($two);
$manager->addArgumentDefinition($three);
$manager->addArgumentDefinition($four);
$manager->addArgumentDefinition($five);

print $manager->generateHelp();

var_dump($manager->getReceivedArgumentList());

//$u = new ArgumentDefinition('.', '.', '', '');
//$u = new ArgumentDefinition('.', null, '', '');
//$u = new ArgumentDefinition(null, '.', '', '');
//$u = new ArgumentDefinition(null, null, '', '');

//$u = new ArgumentDefinition('.', 'a', '', '');
//$u = new ArgumentDefinition(null, 'a', '', '');

//$u = new ArgumentDefinition('a', '.', '', '');
//$u = new ArgumentDefinition('a', null, '', '');

//$u = new ArgumentDefinition('a', 'a', '', '');
