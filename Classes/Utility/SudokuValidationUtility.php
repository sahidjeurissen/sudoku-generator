<?php


namespace SahidJeurissen\Sudoku\Utility;


/**
 * Class SudokuValidationUtility
 * @package SahidJeurissen\Sudoku\Utility
 */
class SudokuValidationUtility
{
    /**
     * @param array $sudoku
     * @return bool
     */
    public static function validate(array $sudoku)
    {

        if (!self::validateHorizontals($sudoku)) {
            return false;
        }

        if (!self::validateVerticals($sudoku)) {
            return false;
        }

        if (!self::validateChunks($sudoku)) {
            return false;
        }

        return true;
    }

    /**
     * @param array $sudoku
     * @return bool
     */
    private static function validateHorizontals(array $sudoku): bool
    {
        $horizontals = array_chunk($sudoku, 9);

        foreach ($horizontals as $horizontal) {
            if (self::containsDuplicates($horizontal)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $sudoku
     * @return bool
     */
    private static function validateVerticals(array $sudoku): bool
    {
        $verticals = [];

        foreach ($sudoku as $i => $value) {
            $verticals[$i % 9][] = $value;
        }

        foreach ($verticals as $vertical) {
            if (self::containsDuplicates($vertical)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $sudoku
     * @return bool
     */
    private static function validateChunks(array $sudoku): bool
    {
        $groups = array_chunk($sudoku, 3);
        $columnChunks = [];

        foreach ($groups as $i => $group) {
            if (!isset($columnChunks[$i % 3])) {
                $columnChunks[$i % 3] = [];
            }
            $columnChunks[$i % 3] = array_merge($columnChunks[$i % 3], $group);
        }

        $columnChunks = array_map(function ($columnChunk) {
            return array_chunk($columnChunk, 9);
        }, $columnChunks);

        $chunks = array_reduce($columnChunks, function ($chunks, $columnChunk) {
            $chunks = array_merge($chunks, array_values($columnChunk));

            return $chunks;
        }, []);

        foreach ($chunks as $chunk) {
            if (self::containsDuplicates($chunk)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $array
     * @return bool
     */
    private static function containsDuplicates(array $array): bool
    {
        return !empty(array_filter(array_count_values($array), function ($count) {
            return $count > 1;
        }));
    }
}
