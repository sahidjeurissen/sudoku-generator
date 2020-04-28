# Sudoku generator
This is a weekend project with the purpose of seeing if I was able to create a script that generates valid sudokus

## Installation
Use composer to install dependencies
```
composer install
```
## Usage
Run the application.php script in cli with php
```
php application.php
```
Three verbosity levels are included next to the base execution of the script -v or -vv
  
- Execution of the command without specifying verbosity outputs the sudoku as a table
- First level of verbosity (-v) outputs a validity result of the generated sudoku as well as a generation time in milliseconds  
- Second level of verbosity (-vv) outputs every attempted version of the sudoku during the generation process
- Third level of verbosity (-vvv) outputs the same as the second level only with a delay of 100ms between every attempt

