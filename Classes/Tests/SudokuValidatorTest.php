<?php


namespace SahidJeurissen\Sudoku\Tests;


use PHPUnit\Framework\TestCase;
use SahidJeurissen\Sudoku\Validators\SudokuValidator;

/**
 * Class SudokuValidatorTest
 * @package SahidJeurissen\Sudoku\Tests
 */
class SudokuValidatorTest extends TestCase
{

    /**
     * @param array<int> $sudoku
     * @param bool $expected
     *
     * @dataProvider validateHorizontalsDataProvider
     * @return void
     * @throws \ReflectionException
     */
    public function testValidateHorizontals(array $sudoku, bool $expected): void
    {
        $reflection = new \ReflectionClass(SudokuValidator::class);
        $method = $reflection->getMethod('validateHorizontals');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @param array<int> $sudoku
     * @param bool $expected
     *
     * @dataProvider validateVerticalsDataProvider
     * @return void
     * @throws \ReflectionException
     */
    public function testValidateVerticals(array $sudoku, bool $expected): void
    {
        $reflection = new \ReflectionClass(SudokuValidator::class);
        $method = $reflection->getMethod('validateVerticals');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @param array<int> $sudoku
     * @param bool $expected
     *
     * @dataProvider validateChunksDataProvider
     * @return void
     * @throws \ReflectionException
     */
    public function testValidateChunks(array $sudoku, bool $expected): void
    {
        $reflection = new \ReflectionClass(SudokuValidator::class);
        $method = $reflection->getMethod('validateChunks');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @param array<int> $sudoku
     * @param bool $expected
     *
     * @dataProvider validateDataProvider
     * @return void
     */
    public function testValidate(array $sudoku, bool $expected): void
    {
        $this->assertEquals($expected, SudokuValidator::validate($sudoku));
    }

    /**
     * @return array<array>
     */
    public function validateHorizontalsDataProvider()
    {
        $fullValidSudoku = require(__DIR__ . '/data/fullValidSudoku.php');
        $fullInvalidSudoku = require(__DIR__ . '/data/fullInvalidSudoku.php');
        $partialValidSudoku = require(__DIR__ . '/data/partialValidSudoku.php');
        $partialInvalidSudoku = require(__DIR__ . '/data/partialInvalidSudoku.php');
        $partialInvalidSudokuVertical = require(__DIR__ . '/data/partialInvalidSudokuVertical.php');
        $partialInvalidSudokuHorizontal = require(__DIR__ . '/data/partialInvalidSudokuHorizontal.php');
        $partialInvalidSudokuChunk = require(__DIR__ . '/data/partialInvalidSudokuChunk.php');

        return [
            // should be valid
            'Full valid sudoku' => [$fullValidSudoku, true],
            // should be invalid
            'Full invalid sudoku' => [$fullInvalidSudoku, false],
            // should be valid
            'Partial valid sudoku' => [$partialValidSudoku, true],
            // should be invalid since 2 is next to 2 in same row
            'Partial invalid sudoku' => [$partialInvalidSudoku, false],
            // should be valid since duplicate is only present in verticals not horizontals
            'Partial invalid sudoku vertical' => [$partialInvalidSudokuVertical, true],
            // should be invalid since duplicate is only present in horizontals
            'Partial invalid sudoku horizontal' => [$partialInvalidSudokuHorizontal, false],
            // should be valid since duplicate is only present in chunks
            'Partial invalid sudoku chunk' => [$partialInvalidSudokuChunk, true],
        ];
    }

    /**
     * @return array<array>
     */
    public function validateVerticalsDataProvider()
    {
        /**
         * @var array<int> $fullValidSudoku
         */
        $fullValidSudoku = require(__DIR__ . '/data/fullValidSudoku.php');
        /**
         * @var array<int> $fullInvalidSudoku
         */
        $fullInvalidSudoku = require(__DIR__ . '/data/fullInvalidSudoku.php');
        /**
         * @var array<int> $partialValidSudoku
         */
        $partialValidSudoku = require(__DIR__ . '/data/partialValidSudoku.php');
        /**
         * @var array<int> $partialInvalidSudoku
         */
        $partialInvalidSudoku = require(__DIR__ . '/data/partialInvalidSudoku.php');
        /**
         * @var array<int> $partialInvalidSudokuVertical
         */
        $partialInvalidSudokuVertical = require(__DIR__ . '/data/partialInvalidSudokuVertical.php');
        /**
         * @var array<int> $partialInvalidSudokuHorizontal
         */
        $partialInvalidSudokuHorizontal = require(__DIR__ . '/data/partialInvalidSudokuHorizontal.php');
        /**
         * @var array<int> $partialInvalidSudokuChunk
         */
        $partialInvalidSudokuChunk = require(__DIR__ . '/data/partialInvalidSudokuChunk.php');

        return [
            // should be valid
            'Full valid sudoku' => [$fullValidSudoku, true],
            // should be invalid
            'Full invalid sudoku' => [$fullInvalidSudoku, false],
            // should be valid
            'Partial valid sudoku' => [$partialValidSudoku, true],
            // should be invalid since 2 is next to 2 in same row
            'Partial invalid sudoku' => [$partialInvalidSudoku, false],
            // should be invalid since duplicate is only present in verticals
            'Partial invalid sudoku vertical' => [$partialInvalidSudokuVertical, false],
            // should be valid since duplicate is only present in horizontals not verticals
            'Partial invalid sudoku horizontal' => [$partialInvalidSudokuHorizontal, true],
            // should be valid since duplicate is only present in chunks
            'Partial invalid sudoku chunk' => [$partialInvalidSudokuChunk, true],
        ];
    }

    /**
     * @return array<array>
     */
    public function validateChunksDataProvider()
    {
        $fullValidSudoku = require(__DIR__ . '/data/fullValidSudoku.php');
        $fullInvalidSudoku = require(__DIR__ . '/data/fullInvalidSudoku.php');
        $partialValidSudoku = require(__DIR__ . '/data/partialValidSudoku.php');
        $partialInvalidSudoku = require(__DIR__ . '/data/partialInvalidSudoku.php');
        $partialInvalidSudokuVertical = require(__DIR__ . '/data/partialInvalidSudokuVertical.php');
        $partialInvalidSudokuHorizontal = require(__DIR__ . '/data/partialInvalidSudokuHorizontal.php');
        $partialInvalidSudokuChunk = require(__DIR__ . '/data/partialInvalidSudokuChunk.php');

        return [
            // should be valid
            'Full valid sudoku' => [$fullValidSudoku, true],
            // should be invalid
            'Full invalid sudoku' => [$fullInvalidSudoku, false],
            // should be valid
            'Partial valid sudoku' => [$partialValidSudoku, true],
            // should be invalid since 2 is in same chunk as 2
            'Partial invalid sudoku' => [$partialInvalidSudoku, false],
            // should be valid since duplicate is not present in chunk
            'Partial invalid sudoku vertical' => [$partialInvalidSudokuVertical, true],
            // should be valid since duplicate is only present in horizontals not chunk
            'Partial invalid sudoku horizontal' => [$partialInvalidSudokuHorizontal, true],
            // should be invalid since duplicate is present in chunks
            'Partial invalid sudoku chunk' => [$partialInvalidSudokuChunk, false],
        ];
    }

    /**
     * @return array<array>
     */
    public function validateDataProvider()
    {
        $fullValidSudoku = require(__DIR__ . '/data/fullValidSudoku.php');
        $fullInvalidSudoku = require(__DIR__ . '/data/fullInvalidSudoku.php');
        $partialValidSudoku = require(__DIR__ . '/data/partialValidSudoku.php');
        $partialInvalidSudoku = require(__DIR__ . '/data/partialInvalidSudoku.php');
        $partialInvalidSudokuVertical = require(__DIR__ . '/data/partialInvalidSudokuVertical.php');
        $partialInvalidSudokuHorizontal = require(__DIR__ . '/data/partialInvalidSudokuHorizontal.php');
        $partialInvalidSudokuChunk = require(__DIR__ . '/data/partialInvalidSudokuChunk.php');

        return [
            'Full valid sudoku' => [$fullValidSudoku, true],
            'Full invalid sudoku' => [$fullInvalidSudoku, false],
            'Partial valid sudoku' => [$partialValidSudoku, true],
            'Partial invalid sudoku' => [$partialInvalidSudoku, false],
            'Partial invalid sudoku vertical' => [$partialInvalidSudokuVertical, false],
            'Partial invalid sudoku horizontal' => [$partialInvalidSudokuHorizontal, false],
            'Partial invalid sudoku chunk' => [$partialInvalidSudokuChunk, false],
        ];
    }
}
