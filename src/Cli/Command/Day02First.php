<?php
declare(strict_types=1);

namespace Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day02First extends Command
{
    use \MeasurementTrait;

    protected function configure()
    {
        $this
            ->setName('aoc:02:first')->setDescription('Advent of Code 2021 - Day 2 - First Part')
            ->addArgument('courseFile', InputArgument::REQUIRED, 'Full path of the course file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $courseFile = $input->getArgument('courseFile');
        $instructions = explode(PHP_EOL, trim(file_get_contents($courseFile)));

        list ($horizontalPosition, $verticalPosition) = array_reduce($instructions, function ($wip, $instructions) {
            list ($what, $howMuch) = explode(' ', $instructions);

            if ($what === 'forward') {
                $wip[0] += $howMuch;
            }
            if ($what === 'up') {
                $wip[1] -= $howMuch;
            }
            if ($what === 'down') {
                $wip[1] += $howMuch;
            }

            return $wip;
        }, [0,0]);

        $result = $horizontalPosition * $verticalPosition;
        $output->writeln(sprintf('Result is %d', $result)) ;
        return 0;
    }
}
