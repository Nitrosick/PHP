<?php

$array = [];
$counter = 0;

for ($i = 1; $i <= 50; $i++) {
    $array[] = mt_rand(1, 50);
}

function bubbleSort(&$array, &$counter){
    for($i=0; $i<count($array); $i++){
        $count = count($array);
        $counter++;
       for($j=$i+1; $j<$count; $j++){
           if($array[$i]>$array[$j]){
               $temp = $array[$j];
               $counter++;
               $array[$j] = $array[$i];
               $counter++;
               $array[$i] = $temp;
               $counter++;
           }
      }
   }
   $counter++;
   return $array;
}


function shakerSort (&$array, &$counter) {
    $n = count($array);
    $counter++;
    $left = 0;
    $counter++;
    $right = $n - 1;
    $counter++;
    do {
    for ($i = $left; $i < $right; $i++) {
        if ($array[$i] > $array[$i + 1]) {
        list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
        $counter++;
        }
    }
    $right -= 1;
    $counter++;
    for ($i = $right; $i > $left; $i--) {
        if ($array[$i] < $array[$i - 1]) {
        list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
        $counter++;
        }
    }
    $left += 1;
    $counter++;
    } while ($left <= $right);
}


function quickSort(&$arr, $low, $high, &$counter) {
    $i = $low;
    $counter++;
    $j = $high;
    $counter++;
    $middle = $arr[ ( $low + $high ) / 2 ];
    $counter++;
    do {
        while($arr[$i] < $middle) ++$i;
         while($arr[$j] > $middle) --$j;
            if($i <= $j){
            $temp = $arr[$i];
            $counter++;
            $arr[$i] = $arr[$j];
            $counter++;
            $arr[$j] = $temp;
            $counter++;
            $i++;
            $counter++;
            $j--;
            $counter++;
        }
    }
    while($i < $j);

    if($low < $j){
      quickSort($arr, $low, $j, $counter);
    }

    if($i < $high){
      quickSort($arr, $i, $high, $counter);
    }
}

// bubbleSort($array, $counter); // 50 итераций // 1344 действия
// shakerSort($array, $counter); // 25 итераций // 583 действия
quickSort($array, 1, 50, $counter); // 95 итерации // 641 действие

foreach ($array as $value) {
    echo $value . ', ';
}

echo '<br><br>' . $counter;
