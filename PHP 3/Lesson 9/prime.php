<?php

function getPrimes($finish)
{
    $number = 2;
    $range = range($number,$finish);
    $primes = array_combine($range,$range);

    while($number*$number < $finish) {
        for($i=$number; $i<=$finish; $i+=$number) {
            if($i==$number) {
                continue;
            }
            unset($primes[$i]);
        } $number = next($primes);
    }
    return $primes;
}

$primeNums = [];

foreach (getPrimes(150000) as $value) {
    array_push($primeNums, $value);
}

echo $primeNums[10000];
