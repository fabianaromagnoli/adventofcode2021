<?php
declare(strict_types=1);

namespace Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day02Second extends Command
{
    use \MeasurementTrait;

    protected function configure()
    {
        $this
            ->setName('aoc:02:second')->setDescription('Advent of Code 2021 - Day 2 - Second Part')
            ->addArgument('courseFile', InputArgument::REQUIRED, 'Full path of the course file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $courseFile = $input->getArgument('courseFile');
        $instructions = explode(PHP_EOL, trim(file_get_contents($courseFile)));

        $coordinates = array_reduce($instructions, function ($wip, $instructions) {
            list ($what, $howMuch) = explode(' ', $instructions);

            if ($what === 'forward') {
                $wip['x'] += $howMuch;
                $wip['y'] += $howMuch * $wip['aim'];
            }
            if ($what === 'up') {
                $wip['aim'] -= $howMuch;
            }
            if ($what === 'down') {
                $wip['aim'] += $howMuch;
            }

            return $wip;
        }, ['x' => 0, 'y' => 0, 'aim' => 0]);

        $result = $coordinates['x'] * $coordinates['y'];
        $output->writeln(sprintf('Result is %d', $result)) ;
        return 0;
    }
}
