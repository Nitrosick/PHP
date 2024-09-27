<?php

$array = [];

for ($i = 1; $i <= 500; $i++) {
    $array[] = mt_rand(1, 100);
}

function delete(array &$array, int $element)
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i] === $element) {
            unset($array[$i]);
            $i--;
        }
    }
}

echo 'Стартовый массив<br><br>';

foreach ($array as $value) {
    echo $value . ', ';
}

echo '<br><br>Массив после удаления элементов со значением 50<br><br>';

delete($array, 50);

foreach ($array as $value) {
    echo $value . ', ';
}
