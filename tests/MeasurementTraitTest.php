<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class MeasurementTraitTest extends TestCase
{
    use MeasurementTrait;

    public function testSlidingWindows(): void
    {
        $values = [1, 2, 3, 4, 5];
        $slidingWindowsOfOne = $this->getSlidingWindows($values, 1);
        $this->assertCount(5, $slidingWindowsOfOne);
        $this->assertEquals([[1], [2], [3], [4], [5]], $slidingWindowsOfOne);

        $slidingWindowsOfTwo = $this->getSlidingWindows($values, 2);
        $this->assertCount(4, $slidingWindowsOfTwo);
        $this->assertEquals([[1,2], [2,3], [3,4], [4,5]], $slidingWindowsOfTwo);

        $slidingWindowsOfFive = $this->getSlidingWindows($values, 5);
        $this->assertCount(1, $slidingWindowsOfFive);
        $this->assertEquals([$values], $slidingWindowsOfFive);
    }

    public function testSlidingWindowsWithInvalidSizeThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid sliding window size');

        $this->getSlidingWindows([1, 2, 3], 0);
    }

    public function testSlidingWindowsWithSizeTooLargeThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid sliding window size');

        $this->getSlidingWindows([1, 2, 3], 4);
    }

    public function testCountIncrements(): void
    {
        $this->markTestIncomplete('TODO');
    }
}
