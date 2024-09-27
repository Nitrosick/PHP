<?php

$start = microtime(true);
$array = [];

for ($i = 1; $i <= 1000000; $i++) {
    $array[] = mt_rand(1, 1000);
}

function bubbleSort(&$array){
    for($i=0; $i<count($array); $i++){
$count = count($array);
       for($j=$i+1; $j<$count; $j++){
           if($array[$i]>$array[$j]){
               $temp = $array[$j];
               $array[$j] = $array[$i];
               $array[$i] = $temp;
           }
      }
   }
   return $array;
}


function shakerSort (&$array) {
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    do {
    for ($i = $left; $i < $right; $i++) {
    if ($array[$i] > $array[$i + 1]) {
    list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
    }
    }
    $right -= 1;
    for ($i = $right; $i > $left; $i--) {
    if ($array[$i] < $array[$i - 1]) {
    list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
    }
    }
    $left += 1;
    } while ($left <= $right);
}


function quickSort(&$arr, $low, $high) {
    $i = $low;
    $j = $high;
    $middle = $arr[ ( $low + $high ) / 2 ];   // middle – опорный элемент; в нашей реализации он находится посередине между low и high
    do {
        while($arr[$i] < $middle) ++$i;  // Ищем элементы для правой части
         while($arr[$j] > $middle) --$j;   // Ищем элементы для левой части
            if($i <= $j){
// Перебрасываем элементы
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp;
// Следующая итерация
            $i++; $j--;
        }
    }
    while($i < $j);

    if($low < $j){
// Рекурсивно вызываем сортировку для левой части
      quickSort($arr, $low, $j);
    }

    if($i < $high){
// Рекурсивно вызываем сортировку для правой части
      quickSort($arr, $i, $high);
    }
}

// quickSort($array, 0, 1000000);

// foreach ($array as $value) {
//     echo $value . ', ';
// }

echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';
