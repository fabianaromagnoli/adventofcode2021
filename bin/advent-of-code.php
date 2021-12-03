#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';

use Cli\Command\Day01First;
use Cli\Command\Day01Second;
use Cli\Command\Day02First;
use Cli\Command\Day02Second;
use Cli\Command\Day03First;
use Cli\Command\Day03Second;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Day01First());
$application->add(new Day01Second());
$application->add(new Day02First());
$application->add(new Day02Second());
$application->add(new Day03First());
$application->add(new Day03Second());
$application->run();
