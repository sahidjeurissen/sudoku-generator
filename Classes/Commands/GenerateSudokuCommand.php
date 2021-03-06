<?php


namespace SahidJeurissen\Sudoku\Commands;


use SahidJeurissen\Sudoku\Generators\SudokuGenerator;
use SahidJeurissen\Sudoku\Utility\AttemptOutputUtility;
use SahidJeurissen\Sudoku\Validators\SudokuValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Class GenerateSudokuCommand
 * @package SahidJeurissen\Sudoku\Commands
 */
class GenerateSudokuCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:generate';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stopwatch = new Stopwatch();

        $sudokuGenerator = new SudokuGenerator();

        $attemptOutput = new AttemptOutputUtility($output);

        if ($output->isVeryVerbose()) {
            $sudokuGenerator->setAttemptCallback($attemptOutput);
        }

        $stopwatch->start('generation');
        $sudoku = $sudokuGenerator->generate();
        $event = $stopwatch->stop('generation');

        /**
         * @phpstan-ignore-next-line
         * TODO: Check if $output->section() can be made certain to exist to fix phpstan error
         */
        $section = $output->section();
        $table = new Table($section);

        $sudokuOutput = array_chunk(array_pad($sudoku, 81, 0), 9);
        $table->setRows($sudokuOutput);
        $table->render();

        if ($output->isVerbose()) {
            $section->writeln('Sudoku valid: ' . (SudokuValidator::validate($sudoku) ? 'Yes' : 'No'));
            $section->writeln('Generation time: ' . $event->getDuration() . 'ms');
        }

        return 0;
    }

}
