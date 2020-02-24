<?php

function task1($string_arr, $isReturn = false)
{
    $result = '';

    foreach($string_arr as $value) {
        if (!$isReturn) {
            $result .= "<p>". $value ."</p>";
        } else {
            $result .= $value;
        }
    }

    if ($isReturn) {
        return $result;
    } else {
        echo $result;
    }
}

function task2($operator) {
    $params = func_get_args();
    $paramsCnt = sizeof($params);

    if ($paramsCnt <= 2) {
        return "Недостаточное количество параметров";
    }

    $result = $params[1];

    for ($i = 2; $i < sizeof($params); $i++) {
        switch ($operator) {
            case '+':
                $result += $params[$i];
                break;
            case '-':
                $result -= $params[$i];
                break;
            case '*':
                $result *= $params[$i];
                break;
            case '/':
                $result /= $params[$i];
                break;
            default: 
                $result = "Некорректный оператор";
        }

    }

    return $result;
}

function task3($num1, $num2) {
    if (!is_int($num1) || !is_int($num2)) {
        throw new Exception('Некорректный параметр!');
    }

    echo "<table border='1' style='border-collapse: collapse;'>";
        for ($row = 1; $row <= $num1; $row++) {
            echo "<tr>";
                for ($col = 1; $col <= $num2; $col++) {

                    $value = $row * $col;

                    if ($col === 1 || $row === 1) {
                        $result = "<b>". $value ."</b>";
                    } else {
                        $result = $value;
                    }

                    echo "<td style='width: 30px; height: 30px; padding: 3px;'>$result</td>";
                }
            echo "</tr>";
        }
    echo "</table>";
}

function task4() {
    echo "<b>Текущее время:</b> ". date('d.m.yy h:m') ."<br/>";
    echo "<b>Время соответствующее 24.02.2016 00:00:00:</b> ". mktime(0, 0, 0, 2, 24, 2016);
}

function task5() {
    $str = "Карл у Клары украл Кораллы";
    echo str_replace('К', '', $str);

    echo "<br/>";

    $str2 = "Две бутылки лимонада";
    echo str_replace('Две', 'Три', $str2);
}

function task6($name) {
    echo file_get_contents($name);
}