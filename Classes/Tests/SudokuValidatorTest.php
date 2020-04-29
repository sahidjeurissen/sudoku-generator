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
     * @dataProvider validateHorizontalsDataProvider
     * @throws \ReflectionException
     */
    public function testValidateHorizontals($sudoku, $expected)
    {
        $reflection = new \ReflectionClass(SudokuValidator::class);
        $method = $reflection->getMethod('validateHorizontals');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @dataProvider validateVerticalsDataProvider
     * @throws \ReflectionException
     */
    public function testValidateVerticals($sudoku, $expected)
    {
        $reflection = new \ReflectionClass(SudokuValidator::class);
        $method = $reflection->getMethod('validateVerticals');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @dataProvider validateChunksDataProvider
     * @throws \ReflectionException
     */
    public function testValidateChunks($sudoku, $expected)
    {
        $reflection = new \ReflectionClass(SudokuValidator::class);
        $method = $reflection->getMethod('validateChunks');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs(null, [$sudoku]));
    }

    /**
     * @dataProvider validateDataProvider
     */
    public function testValidate($sudoku, $expected)
    {
        $this->assertEquals($expected, SudokuValidator::validate($sudoku));
    }

    /**
     * @return array
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
     * @return array
     */
    public function validateVerticalsDataProvider()
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
            // should be invalid since duplicate is only present in verticals
            'Partial invalid sudoku vertical' => [$partialInvalidSudokuVertical, false],
            // should be valid since duplicate is only present in horizontals not verticals
            'Partial invalid sudoku horizontal' => [$partialInvalidSudokuHorizontal, true],
            // should be valid since duplicate is only present in chunks
            'Partial invalid sudoku chunk' => [$partialInvalidSudokuChunk, true],
        ];
    }

    /**
     * @return array
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
     * @return array
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
