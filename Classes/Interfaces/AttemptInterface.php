<?php

namespace SahidJeurissen\Sudoku\Interfaces;

/**
 * Interface AttemptInterface
 * @package SahidJeurissen\Sudoku\Interfaces
 */
interface AttemptInterface
{
    /**
     * @param array<int> $sudoku
     * @return void
     */
    public function execute(array $sudoku): void;
}
