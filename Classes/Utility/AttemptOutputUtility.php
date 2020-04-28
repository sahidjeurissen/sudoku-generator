<?php

namespace SahidJeurissen\Sudoku\Utility;

use SahidJeurissen\Sudoku\Interfaces\AttemptInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AttemptOutputUtility
 * @package SahidJeurissen\Sudoku\Utility
 */
class AttemptOutputUtility implements AttemptInterface
{
    /**
     * @var OutputInterface
     */
    public $output = null;

    /**
     * @var OutputInterface
     */
    protected $section = null;

    /**
     * AttemptOutputUtility constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
        $this->section = $this->output->section();
    }

    /**
     * @param array $sudoku
     */
    public function execute(array $sudoku)
    {
        $table = new Table($this->section);
        $this->section->clear();

        $table->setRows(array_chunk(array_pad($sudoku, 81, 0), 9));
        $table->render();

        if(count($sudoku) > 80){
            $this->section->clear();
        }
    }
}
