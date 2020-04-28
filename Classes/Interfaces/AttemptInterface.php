<?php

namespace SahidJeurissen\Sudoku\Interfaces;

interface AttemptInterface
{
    /**
     * @param array $sudoku
     */
    public function execute(array $sudoku);
}
