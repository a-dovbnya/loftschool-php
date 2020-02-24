<?php

require "src/functions.php";

echo "<h4>Task 1</h4>";
task1(['str_1', 'str_2']);

echo "<h4>Task 2</h4>";
echo task2('+', 1, 2, 3, 4);

echo "<h4>Task 3</h4>";
try {
    task3(8, 8);
} catch (Exception $e) {
    echo 'Произошла ошибка: ',  $e->getMessage();
}

echo "<h4>Task 4</h4>";
task4();

echo "<h4>Task 5</h4>";
task5();

echo "<h4>Task 6</h4>";
// create file
file_put_contents("test.txt", "Hello again!");
task6("test.txt");