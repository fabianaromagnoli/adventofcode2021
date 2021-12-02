<?php
declare(strict_types=1);

namespace Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day01First extends Command
{
    use \MeasurementTrait;

    protected function configure()
    {
        $this
            ->setName('aoc:01:first')->setDescription('Advent of Code 2021 - Day 1 - First Part')
            ->addArgument('measurementsFile', InputArgument::REQUIRED, 'Full path of the measurements file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $measurementsFile = $input->getArgument('measurementsFile');
        $measurements = explode(PHP_EOL, trim(file_get_contents($measurementsFile)));
        $increments = $this->countIncrements($measurements);
        $output->writeln(sprintf('There are %d measurements larger than the previous', $increments)) ;
        return 0;
    }
}
