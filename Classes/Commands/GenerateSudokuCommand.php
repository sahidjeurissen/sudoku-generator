<?php


namespace Sahid\Sudoku\Commands;


use Sahid\Sudoku\Generators\SudokuGenerator;
use Sahid\Sudoku\Utility\CellValidationUtility;
use Sahid\Sudoku\Utility\SudokuValidationUtility;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSudokuCommand extends Command
{
    protected static $defaultName = 'app:generate';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $validSudoku;

        $sudokuGenerator = new SudokuGenerator($output);

        $sudoku = $sudokuGenerator->generate();

        var_dump(SudokuValidationUtility::validate($sudoku));

        $section = $output->section();
        $table = new Table($section);
        $sudokuRender = array_chunk(array_pad($sudoku, 81, 0), 9);
        $table->setRows($sudokuRender);
        $table->render();

        return 0;
    }

}
