<?php
declare(strict_types=1);

namespace Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day03First extends Command
{
    use \DiagnosticTrait;

    protected function configure()
    {
        $this
            ->setName('aoc:03:first')->setDescription('Advent of Code 2021 - Day 3 - First Part')
            ->addArgument('reportFile', InputArgument::REQUIRED, 'Full path of the diagnostic report file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reportFile = $input->getArgument('reportFile');
        $report = explode(PHP_EOL, trim(file_get_contents($reportFile)));

        $columnResultForGammaRate = $this->getBitCriteria($report, true);
        $columnResultForEpsilonRate = $this->getBitCriteria($report, false);

        $gammaRate = bindec(implode('', $columnResultForGammaRate));
        $epsilonRate = bindec(implode('', $columnResultForEpsilonRate));
        $output->writeln(sprintf('Power consumption is %d', $gammaRate * $epsilonRate));

        return 0;
    }
}
