#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';

use Cli\Command\Day01First;
use Cli\Command\Day01Second;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Day01First());
$application->add(new Day01Second());
$application->run();
