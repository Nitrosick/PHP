<?php

echo "<a href='../index.php'><</a><br><br>";

require_once $_SERVER['DOCUMENT_ROOT'] . '/index.php';

function simpleDividers($num) {
    $divisors = [];
    $d = 2;
    while ($d * $d <= $num) {
        if ($num % $d === 0) {
            $divisors[] = $d;
            $num /= $d;
        } else {
            $d++;
        }
    }
    if ($num > 1) {
        $divisors[] = $num;
    }
    return $divisors;
}

foreach (simpleDividers(13195) as $value) {
    echo $value . "<br>";
}

echo("<br>");

echo max(simpleDividers(600851475143));
