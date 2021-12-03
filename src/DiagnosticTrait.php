<?php
declare(strict_types=1);

trait DiagnosticTrait
{
    public function getBitCriteria(array $report, bool $useTheMostCommonBit): array
    {
        $numberOfLines = count($report);

        $report = array_map(function ($line) {
            return array_map(function ($bit) {
                return (int)$bit;
            }, str_split($line));
        }, $report);

        $transposed = array_map(null, ...$report);

        $columnsSum = array_map(function ($column) {
            return array_sum($column);
        }, $transposed);

        $columnResult = array_map(function ($eachColumnSum) use ($numberOfLines, $useTheMostCommonBit) {
            if ($useTheMostCommonBit) {
                return $eachColumnSum >= $numberOfLines / 2 ? 1 : 0;
            }
            return $eachColumnSum < $numberOfLines / 2 ? 1 : 0;
        }, $columnsSum);

        return $columnResult;
    }
}
