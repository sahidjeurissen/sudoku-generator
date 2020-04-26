<?php


namespace Sahid\Sudoku\Generators;


use Sahid\Sudoku\Utility\CellValidationUtility;
use Sahid\Sudoku\Utility\SudokuValidationUtility;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class SudokuGenerator
{
    protected $output;

    /**
     * SudokuGenerator constructor.
     * @param $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }


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
                $this->outputCurrentAttempt($tmpSudoku);

                if (CellValidationUtility::validate($tmpSudoku, count($tmpSudoku) - 1)) {
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

    private function outputCurrentAttempt($sudoku)
    {
        $section = $this->output->section();
        $table = new Table($section);

        $sudoku = array_chunk(array_pad($sudoku, 81, 0), 9);
        $table->setRows($sudoku);
        $table->render();

        if (count($sudoku) < 81) {
            $section->clear();
        }
    }
}
