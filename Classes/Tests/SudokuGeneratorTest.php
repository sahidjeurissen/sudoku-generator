<?php


namespace SahidJeurissen\Sudoku\Tests;


use PHPUnit\Framework\TestCase;
use SahidJeurissen\Sudoku\Generators\SudokuGenerator;
use SahidJeurissen\Sudoku\Validators\SudokuValidator;

/**
 * Class SudokuGeneratorTest
 * @package SahidJeurissen\Sudoku\Tests
 */
class SudokuGeneratorTest extends TestCase
{
    /**
     * @var SudokuGenerator
     */
    private $sudokuGenerator;

    protected function setUp(): void
    {
        $this->sudokuGenerator = new SudokuGenerator();
    }

    /**
     * @return void
     */
    public function testGenerateValidity(): void
    {
        $sudoku = $this->sudokuGenerator->generate();

        /**
         * Assert type
         * Sudokus must be of type array
         */
        $this->assertIsArray($sudoku, 'Sudoku must be of type array');

        /**
         * Assert length
         * Sudokus must have a length of 81
         */
        $this->assertCount(81, $sudoku, 'Sudoku must be of length 81');


        /**
         * Assert types in array
         * Sudokus must only contain integers
         *
         * TODO: Create custom assertion for array values type matching
         */
        $disallowedTypesInArray = array_filter($sudoku, function ($item) {
            return !is_int($item);
        });

        $this->assertEmpty($disallowedTypesInArray, 'Sudoku should not contain non integer values');

        /**
         * Assert validity of sudoku
         * Sudokus must be valid
         */
        $this->assertTrue(SudokuValidator::validate($sudoku));
    }

    /**
     * @param int $seed
     * @param array<int> $expected
     *
     * @dataProvider generateBySeedsDataProvider
     *
     * @return void
     */
    public function testGenerateBySeeds(int $seed, array $expected): void
    {
        srand($seed);
        $this->assertEquals($expected, $this->sudokuGenerator->generate());
    }

    /**
     * @return array<array>
     */
    public function generateBySeedsDataProvider()
    {
        return [
            'Seed: 1' => [1, require(__DIR__ . '/data/seeded/seed1.php')],
            'Seed: 2' => [2, require(__DIR__ . '/data/seeded/seed2.php')],
            'Seed: 3' => [3, require(__DIR__ . '/data/seeded/seed3.php')],
        ];
    }
}
