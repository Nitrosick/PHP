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
            $a = 0;
            while ($a++ <= 100) {
                if ($a % 3 === 0) echo $a . ' ';
            }

            # Task 2
            echo '<br><br>Task 2<br>';
            $b = 0;
            do {
                if ($b === 0) {
                    echo $b . ' - Ноль<br>';
                } elseif ($b % 2 === 0) {
                    echo $b . ' - Четное число<br>';
                } else {
                    echo $b . ' - Нечетное число<br>';
                }
                $b++;
            } while ($b <= 10);

            # Task 3
            echo '<br>Task 3<br>';
            $regions = [
                'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
                'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
                'Калининградская область' => ['Калининград', 'Светлогорск', 'Гусев', 'Зеленоградск'],
            ];

            foreach ($regions as $key => $value) {
                echo $key . ':<br>';
                echo implode(', ', $value) . '<br>';
            }

            # Task 4
            echo '<br>Task 4<br>';
            $translitArr = [
                'а' => 'a',
                'б' => 'b',
                'в' => 'v',
                'г' => 'g',
                'д' => 'd',
                'е' => 'e',
                'ж' => 'j',
                'з' => 'z',
                'и' => 'i',
                'й' => 'yi',
                'к' => 'k',
                'л' => 'l',
                'м' => 'm',
                'н' => 'n',
                'о' => 'o',
                'п' => 'p',
                'р' => 'r',
                'с' => 's',
                'т' => 't',
                'у' => 'u',
                'ф' => 'f',
                'х' => 'h',
                'ц' => 'c',
                'ч' => 'ch',
                'ш' => 'sh',
                'щ' => 'sh',
                'ъ' => '',
                'ы' => 'y',
                'ь' => '',
                'э' => 'e',
                'ю' => 'yu',
                'я' => 'ya',
            ];

            function translit($string, $arr) {
                $array = preg_split('~~u', strtolower($string), -1, PREG_SPLIT_NO_EMPTY);
                for ($i=0; $i < count($array); $i++) {

                    if (array_key_exists($array[$i], $arr)) {
                        $array[$i] = $arr[$array[$i]];
                    } else {
                        continue;
                    }
                }
                return implode($array);
            }

            echo translit('покушали, можно и поспать', $translitArr);

            # Task 5
            echo '<br><br>Task 5<br>';
            function spaceReplace($string) {
                return str_replace(' ', '_', $string);
            }

            echo spaceReplace('покушали, можно и поспать');

            # Task 6
            echo '<br><br>Task 6<br>';
            $ulMenu = [
                ['label' => 'Первый пункт', 'link' => 'first.php'],
                ['label' => 'Второй пункт', 'link' => 'second.php'],
                ['label' => 'Третий пункт', 'link' => [
                    ['sublabel' => 'Первый подпункт', 'sublink' => 'subfirst.php'],
                    ['sublabel' => 'Второй подпункт', 'sublink' => 'subsecond.php'],
                    ['sublabel' => 'Третий подпункт', 'sublink' => 'subthird.php'],
                ]],
                ['label' => 'Четвертый пункт', 'link' => 'fourth.php'],
            ];
        ?>
        <ul>
            <?php
                foreach ($ulMenu as $value) {
                    if (is_array($value['link'])) {
                        echo "<li> {$value['label']} <ul>";
                        foreach ($value['link'] as $val) {
                            echo "<li> <a class='sublink' href='{$val['sublink']}'>{$val['sublabel']}</a> </li>";
                        }
                        echo "</ul> </li>";
                    } else {
                        echo "<li> <a href='{$value['link']}'>{$value['label']}</a> </li>";
                    }
                }
            ?>
        </ul>
        <?php
            # Task 7
            echo '<br>Task 7<br>';
            for ($i=0; $i < 10; printf($i . ' '), $i++) {}

            # Task 8
            echo '<br><br>Task 8<br>';
            foreach ($regions as $key => $value) {
                echo $key . ':<br>';
                foreach ($value as $val) {
                    echo mb_substr($val, 0, 1) == 'К' ? $val . ' ' : '';
                }
                echo '<br>';
            }

            # Task 9
            echo '<br>Task 9<br>';
            echo spaceReplace(translit('покушали, можно и поспать', $translitArr));
        ?>
    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
