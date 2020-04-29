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
        /**
         * @phpstan-ignore-next-line
         */
        $this->section = $this->output->section();
    }

    /**
     * @param array<int> $sudoku
     * @return void
     */
    public function execute(array $sudoku): void
    {
        $table = new Table($this->section);
        /**
         * @phpstan-ignore-next-line
         */
        $this->section->clear();

        $table->setRows(array_chunk(array_pad($sudoku, 81, 0), 9));
        $table->render();
        if ($this->output->isDebug()) {
            usleep(100000);
        }

        if (count($sudoku) > 80) {
            /**
             * @phpstan-ignore-next-line
             */
            $this->section->clear();
        }
    }
}
