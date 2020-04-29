<?php


namespace SahidJeurissen\Sudoku\Tests;


use PHPUnit\Framework\TestCase;
use SahidJeurissen\Sudoku\Validators\BaseValidator;

/**
 * Class BaseValidatorTest
 * @package SahidJeurissen\Sudoku\Tests
 */
class BaseValidatorTest extends TestCase
{

    /**
     * @dataProvider containsDuplicatesDataProvider
     * @throws \ReflectionException
     */
    public function testContainsDuplicates($sudoku, $expected)
    {
        $reflection = new \ReflectionClass(BaseValidator::class);
        $method = $reflection->getMethod('containsDuplicates');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @return array
     */
    public function containsDuplicatesDataProvider()
    {
        return [
            'Unique numbers' => [[1, 2, 3, 4, 5, 6, 7, 8, 9], false],
            'Duplicate number' => [[1, 2, 3, 4, 5, 6, 7, 8, 8], true,],
            'Unique numbers with single null value appended' => [[1, 2, 3, 4, 5, 6, 7, 8, null], false,],
            'Unique numberw with multiple null values appended' => [[1, 2, 3, 4, 5, 6, 7, null, null], false,],
            'Empty array' => [[], false,],
        ];
    }
}
