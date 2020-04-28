<?php

namespace SahidJeurissen\Sudoku\Interfaces;

/**
 * Interface AttemptInterface
 * @package SahidJeurissen\Sudoku\Interfaces
 */
interface AttemptInterface
{
    /**
     * @param array $sudoku
     */
    public function execute(array $sudoku);
}
