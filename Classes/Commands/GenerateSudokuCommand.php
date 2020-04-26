<?php


namespace Sahid\Sudoku\Commands;


use Sahid\Sudoku\Generators\SudokuGenerator;
use Sahid\Sudoku\Utility\CellValidationUtility;
use Sahid\Sudoku\Utility\SudokuValidationUtility;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class GenerateSudokuCommand extends Command
{
    protected static $defaultName = 'app:generate';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $validSudoku;
        $stopwatch = new Stopwatch();

        $sudokuGenerator = new SudokuGenerator($output);

        $stopwatch->start('generation');
        $sudoku = $sudokuGenerator->generate();
        $event = $stopwatch->stop('generation');

        $section = $output->section();
        $table = new Table($section);
        $sudokuRender = array_chunk(array_pad($sudoku, 81, 0), 9);
        $table->setRows($sudokuRender);
        $table->render();

        $section->writeln('Sudoku valid: ' . SudokuValidationUtility::validate($sudoku));
        $section->writeln('Generation time: ' . $event->getDuration() . 'ms');


        return 0;
    }

}
