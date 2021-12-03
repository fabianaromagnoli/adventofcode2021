<?php
declare(strict_types=1);

namespace Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day03Second extends Command
{
    use \DiagnosticTrait;

    protected function configure()
    {
        $this
            ->setName('aoc:03:second')->setDescription('Advent of Code 2021 - Day 3 - Second Part')
            ->addArgument('reportFile', InputArgument::REQUIRED, 'Full path of the diagnostic report file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reportFile = $input->getArgument('reportFile');
        $report = explode(PHP_EOL, trim(file_get_contents($reportFile)));

        $oxygenGeneratorRate = $this->getRateWithMatchingBitCriteria($report, true);
        $co2ScrubberRate = $this->getRateWithMatchingBitCriteria($report, false);

        $output->writeln(sprintf('Result is %d', $oxygenGeneratorRate * $co2ScrubberRate)) ;
        return 0;
    }

    private function getRateWithMatchingBitCriteria($report, $useTheMostCommonBit): int
    {
        $position = 0;
        while (count($report) > 1) {
            $bitCriteria = $this->getBitCriteria($report, $useTheMostCommonBit);
            $report = array_filter(
                $report,
                function ($line) use ($bitCriteria, $position) {
                    return (int)$line[$position] === $bitCriteria[$position];
                }
            );
            $position++;
        }

        return bindec(reset($report));
    }
}
