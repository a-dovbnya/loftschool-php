<?php

$size = 10;

echo "<table border='1' style='border-collapse: collapse;'>";
    for ($row = 1; $row < $size; $row++) {
        echo "<tr>";
            for ($col = 1; $col < $size; $col++) {

                $value = $row * $col;

                if ($col === 1 || $row === 1) {
                    $result = "<b>". $value ."</b>";
                } elseif ($row % 2 === 0 && $col % 2 === 0) {
                    $result = "(". $value .")";
                } elseif ($row % 2 !== 0 && $col % 2 !== 0) {
                    $result = "[". $value ."]";
                } else {
                    $result = $value;
                }

                echo "<td style='width: 30px; height: 30px; padding: 3px;'>$result</td>";
            }
        echo "</tr>";
    }
echo "</table>";
