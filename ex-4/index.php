<?php

require "./classes.php";

try {
    $base = new BaseTariff(25);
    echo $base->calculate(12, 70);

    echo "<br>";

    $hourly = new HourlyTariff(35);
    echo $hourly->calculate(121);

    echo "<br>";

    $dayly = new DialyTariff(21);
    echo $dayly->calculate(5, 24.5);

    echo "<br>";

    $student = new StudentTariff(20);
    echo $student->calculate(5, 62, true);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
