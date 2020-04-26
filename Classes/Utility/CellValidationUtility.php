<?php


namespace SahidJeurissen\Sudoku\Utility;


/**
 * Class CellValidationUtility
 * @package Sahid\Sudoku\Utility
 */
class CellValidationUtility
{
    /**
     * @var array
     */
    private static $chunkMap = [
        [0, 1, 2, 9, 10, 11, 18, 19, 20],
        [3, 4, 5, 12, 13, 14, 21, 22, 23],
        [6, 7, 8, 15, 16, 17, 24, 25, 26],
        [27, 28, 29, 36, 37, 38, 45, 46, 47],
        [30, 31, 32, 39, 40, 41, 48, 49, 50],
        [33, 34, 35, 42, 43, 44, 51, 52, 53],
        [54, 55, 56, 63, 64, 65, 72, 73, 74],
        [57, 58, 59, 66, 67, 68, 75, 76, 77],
        [60, 61, 62, 69, 70, 71, 78, 79, 80],
    ];

    /**
     * @param array $sudoku
     * @param int $index
     * @return bool
     */
    public static function validate(array $sudoku, int $index): bool
    {
        if (!self::validateHorizontal($sudoku, $index)) {
            return false;
        }

        if (!self::validateVertical($sudoku, $index)) {
            return false;
        }

        if (!self::validateChunk($sudoku, $index)) {
            return false;
        }

        return true;
    }

    /**
     * @param array $sudoku
     * @param int $index
     * @return bool
     */
    public static function validateHorizontal(array $sudoku, int $index): bool
    {
        $y = (int)floor($index / 9);

        $values = array_map(function ($index) use ($sudoku, $y) {
            return self::getValueBy2D($sudoku, $index, $y);
        }, range(0, 8));

        return !self::containsDuplicates($values);
    }

    /**
     * @param array $sudoku
     * @param int $index
     * @return bool
     */
    public static function validateVertical(array $sudoku, int $index): bool
    {
        $x = $index % 9;

        $values = array_map(function ($index) use ($sudoku, $x) {
            return self::getValueBy2D($sudoku, $x, $index);
        }, range(0, 8));

        return !self::containsDuplicates($values);
    }

    /**
     * @param array $sudoku
     * @param int $index
     * @return bool
     */
    public static function validateChunk(array $sudoku, int $index): bool
    {
        $currentChunk = array_filter(self::$chunkMap, function ($chunk) use ($index) {
            return in_array($index, $chunk);
        });

        $currentChunk = array_pop($currentChunk);

        $values = array_map(function ($index) use ($sudoku) {
            return $sudoku[$index] ?? null;
        }, $currentChunk);

        return !self::containsDuplicates($values);
    }

    /**
     * @param array $sudoku
     * @param int $x
     * @param int $y
     * @return int
     */
    private static function getValueBy2D(array $sudoku, int $x, int $y): ?int
    {
        return $sudoku[$x + 9 * $y] ?? null;
    }

    /**
     * @param array $array
     * @return bool
     */
    public static function containsDuplicates(array $array): bool
    {
        $array = array_filter($array);

        return !empty(array_filter(array_count_values($array), function ($count) {
            return $count > 1;
        }));
    }
}
