<?php

$bmw = [
    'model' => 'X5',
    'speed' => '120',
    'doors' => '5',
    'year' => '2015'
];

$toyota = [
    'model' => 'RAV4',
    'speed' => '150',
    'doors' => '5',
    'year' => '2012'
];

$opel = [
    'model' => 'Astra',
    'speed' => '160',
    'doors' => '3',
    'year' => '2016'
];

$cars = [
    'bmw' => $bmw,
    'toyota' => $toyota,
    'opel' => $opel
];


foreach ($cars as $key => $value) {
    echo "CAR ". $key ." <br/>";
    echo $cars[$key]['model'] ." ". $cars[$key]['speed'] ." ". $cars[$key]['doors'] ." ". $cars[$key]['year'] ."<br/><br/>";
}
