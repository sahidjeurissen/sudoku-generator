<?php
include_once 'vendor/autoload.php';

$application = new \Symfony\Component\Console\Application('generate');
$command = new \SahidJeurissen\Sudoku\Commands\GenerateSudokuCommand();

$application->add($command);
$application->setDefaultCommand($command->getName(), true);

$application->run();
