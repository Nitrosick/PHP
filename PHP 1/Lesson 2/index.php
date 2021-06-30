<?php
    declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
</head>
<body>
    <header></header>
    <main>
        <?php
            # Task 1
            echo 'Task 1<br>';
            $a = rand(-10, 10);
            $b = rand(-10, 10);

            if ($a >= 0 && $b >= 0) {
                echo $a - $b;
            } elseif ($a < 0 && $b < 0) {
                echo $a * $b;
            } elseif (($a < 0 && $b >= 0) || ($a >= 0 && $b < 0)) {
                echo $a + $b;
            }

            # Task 2
            echo '<br><br>Task 2<br>';
            $a = rand(0, 15);

            switch($a) {
                case 0 : echo 0 . '<br>';
                case 1 : echo 1 . '<br>';
                case 2 : echo 2 . '<br>';
                case 3 : echo 3 . '<br>';
                case 4 : echo 4 . '<br>';
                case 5 : echo 5 . '<br>';
                case 6 : echo 6 . '<br>';
                case 7 : echo 7 . '<br>';
                case 8 : echo 8 . '<br>';
                case 9 : echo 9 . '<br>';
                case 10 : echo 10 . '<br>';
                case 11 : echo 11 . '<br>';
                case 12 : echo 12 . '<br>';
                case 13 : echo 13 . '<br>';
                case 14 : echo 14 . '<br>';
                case 15 : echo 15 . '<br>';
            }

            # Task 3
            echo '<br><br>Task 3<br>';
            function addition($a, $b) {
                return $a + $b;
            }
            function substract($a, $b) {
                return $a - $b;
            }
            function multiply($a, $b) {
                return $a * $b;
            }
            function division($a, $b) {
                return $a / $b;
            }

            echo addition(3, 4) . '<br>';
            echo substract(3, 4) . '<br>';
            echo multiply(3, 4) . '<br>';
            echo division(3, 4) . '<br>';

            # Task 4
            echo '<br><br>Task 4<br>';
            function mathOperation($arg1, $arg2, $operation) {
                switch($operation) {
                    case 'addition' :
                        return $arg1 + $arg2;
                        break;
                    case 'substract' :
                        return $arg1 - $arg2;
                        break;
                    case 'multiply' :
                        return $arg1 * $arg2;
                        break;
                    case 'division' :
                        return $arg1 / $arg2;
                        break;
                    default : return 'Переданы некорректные параметры';
                }

            }

            echo mathOperation(3, 4, 'substract');

            # Task 6
            echo '<br><br>Task 6<br>';
            function power($val, $pow) {
                if ($pow === 0) {
                    return 1;
                } elseif ($pow < 0) {
                    return 1 / ($val * power($val, -$pow-1));
                } else {
                    return $val * power($val, $pow-1);
                }
            }

            echo power(2, -3);

            # Task 7
            echo '<br><br>Task 7<br>';
            function curTime() {
                $hours = date('h');
                $minutes = date('i');
                $hoursStr;
                $minutesStr;

                if ($hours == 1 || $hours == 21) {
                    $hoursStr = $hours . ' час';
                } elseif (($hours >= 2 && $hours <= 4) || ($hours >= 22 && $hours <= 24)) {
                    $hoursStr = $hours . ' часа';
                } else {
                    $hoursStr = $hours . ' часов';
                }

                if (substr($minutes, -1) == 1 && $minutes != 11) {
                    $minutesStr = $minutes . ' минута';
                } elseif ((substr($minutes, -1) >= 2 && substr($minutes, -1) <= 4) && ($minutes < 12 && $minutes > 14)) {
                    $minutesStr = $minutes . ' минуты';
                } else {
                    $minutesStr = $minutes . ' минут';
                }

                return $hoursStr . ' ' . $minutesStr;
            }

            echo curTime();
        ?>
    </main>
    <footer>
        <!-- Task 5 -->
        <?= date('Y') ?>
    </footer>
</body>
</html>
