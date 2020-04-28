<?php


namespace SahidJeurissen\Sudoku\Generators;


use SahidJeurissen\Sudoku\Interfaces\AttemptInterface;
use SahidJeurissen\Sudoku\Validators\CellValidator;

/**
 * Class SudokuGenerator
 * @package SahidJeurissen\Sudoku\Generators
 */
class SudokuGenerator
{
    /**
     * @var AttemptInterface
     */
    protected $attemptCallback = null;

    /**
     * @param AttemptInterface $attemptCallback
     */
    public function setAttemptCallback(AttemptInterface $attemptCallback): void
    {
        $this->attemptCallback = $attemptCallback;
    }


    /**
     * @return array
     */
    public function generate()
    {
        $sudoku = [];
        $unattemptedNumbers = [];

        while (count($sudoku) < 81) {
            if (!isset($unattemptedNumbers[count($sudoku)])) {
                $unattemptedNumbers[count($sudoku)] = range(1, 9);
                shuffle($unattemptedNumbers[count($sudoku)]);
            }

            $added = false;
            foreach ($unattemptedNumbers[count($sudoku)] as $unattemptedNumber) {
                $unattemptedNumbers[count($sudoku)] = array_filter($unattemptedNumbers[count($sudoku)],
                    function ($number) use ($unattemptedNumber) {
                        return $number !== $unattemptedNumber;
                    });

                $tmpSudoku = array_merge($sudoku, [$unattemptedNumber]);
                if ($this->attemptCallback) {
                    $this->attemptCallback->execute($tmpSudoku);
                }

                if (CellValidator::validate($tmpSudoku, count($tmpSudoku) - 1)) {
                    $sudoku[] = $unattemptedNumber;
                    $added = true;
                    break;
                }
            }

            if (!$added) {
                array_pop($unattemptedNumbers);
                array_pop($sudoku);
            }
        }

        return $sudoku;
    }
}
