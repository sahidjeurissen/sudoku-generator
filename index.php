<?php
include_once 'vendor/autoload.php';

// valid sudoku for testing purposes
$validSudoku = require './validSudoku.php';

$application = new \Symfony\Component\Console\Application('generate');
$command = new \Sahid\Sudoku\Commands\GenerateSudokuCommand();

$application->add($command);
$application->setDefaultCommand($command->getName(), true);

$application->run();
