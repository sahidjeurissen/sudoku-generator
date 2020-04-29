<?php


namespace SahidJeurissen\Sudoku\Validators;


/**
 * Class BaseValidator
 * @package SahidJeurissen\Sudoku\Validators
 */
class BaseValidator
{
    /**
     * @param array<int|null> $array
     * @return bool
     */
    protected static function containsDuplicates(array $array): bool
    {
        $array = array_filter($array);

        return !empty(array_filter(array_count_values($array), function ($count) {
            return $count > 1;
        }));
    }
}
