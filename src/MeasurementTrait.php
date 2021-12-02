<?php
declare(strict_types=1);

trait MeasurementTrait
{
    public function getSlidingWindows(array $values, int $size): array {
        if ($size === 0 || $size > count($values)) {
            throw new InvalidArgumentException('Invalid sliding window size');
        }

        $windows = [];
        while (count($values) >= $size) {
            $windows[] = array_slice($values, 0, $size);
            array_shift($values);
        }
        return $windows;
    }

    public function countIncrements(array $values): int
    {
        $steps = $this->getSlidingWindows($values, 2);
        $increments = array_filter($steps, function ($step) {
            return $step[1] > $step[0];
        });
        return count($increments);
    }
}
