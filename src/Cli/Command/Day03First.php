<?php
declare(strict_types=1);

namespace Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day03First extends Command
{
    use \MeasurementTrait;

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
        $numberOfLines = count($report);

        $report = array_map(function ($line) {
            return array_map(function ($bit) {
                return (int) $bit;
            },str_split($line));
        }, $report);

        $transposed = array_map(null, ...$report);

        $columnsSum = array_map(function ($column) {
            return array_sum($column);
        }, $transposed);

        $columnResultForGammaRate = array_map(function ($eachColumnSum) use ($numberOfLines) {
            return $eachColumnSum > $numberOfLines/2 ? 1 : 0;
        }, $columnsSum);

        $columnResultForEpsilonRate = array_map(function ($eachColumnSum) use ($numberOfLines) {
            return $eachColumnSum < $numberOfLines/2 ? 1 : 0;
        }, $columnsSum);

        $gammaRate = bindec(implode('', $columnResultForGammaRate));
        $epsilonRate = bindec(implode('', $columnResultForEpsilonRate));


        $output->writeln(sprintf('Result is %d', $gammaRate * $epsilonRate)) ;
        return 0;
    }
}
