<?php

$bmw = [
    'name' => 'bmw',
    'model' => 'X5',
    'speed' => '120',
    'doors' => '5',
    'year' => '2015'
];

$toyota = [
    'name' => 'toyota',
    'model' => 'RAV4',
    'speed' => '150',
    'doors' => '5',
    'year' => '2012'
];

$opel = [
    'name' => 'opel',
    'model' => 'Astra',
    'speed' => '160',
    'doors' => '3',
    'year' => '2016'
];

$cars = [$bmw, $toyota, $opel];

foreach ($cars as $car) {
    echo "CAR ". $car['name'] ." <br/>";
    echo $car['model'] ." ". $car['speed'] ." ". $car['doors'] ." ". $car['year'] ."<br/><br/>";
}
