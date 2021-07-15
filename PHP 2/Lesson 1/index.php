<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    // Задание №1
    class Product {
        // Задание №2
        private $product_name;
        private $image;
        private $cost;
        private $description;

        public function __construct($name, $image, $cost, $description) {
            $this->product_name = $name;
            $this->image = $image;
            $this->cost = $cost;
            $this->description = $description;
        }

        // Задание №3
        public function getCost() {
            return $this->cost;
        }

        public function setCost($new_cost) {
            $this->cost = $new_cost;
        }
    }

    // Задание №4
    class PieceProduct extends Product {
        // Штучный товар - продается кратно 1, цена за единицу
    }

    class WeightProduct extends Product {
        // Весовой товар - продается килограммами, может продаваться дробным количеством, цена за кг.
    }

    class DigitalProduct extends Product {
        // Цифровой товар - продается не сам товар, а лицензионный ключ к нему
    }

    /*
    Задание №5
    Код выведет 1234
    Статическая переменная относится к классу, поэтому неважно, какой экземпляр вызывает метод
    Каждый вызов функции foo() сначала увеличивает переменную $x на 1, а затем выводит ее
    Тем самым вывод начинается с 1 и увеличивается еще 3 раза.

    Задание №6
    Вывод: 1122
    В данном случае меняется то, что переменная $x теперь принадлежит отдельно классу A, и отдельно B
    Поэтому для каждого класса она инкрементируется отдельно
    По два раза вызывается метод для каждой статической переменной.

    Задание №7
    Вывод: 1122
    Суть кода не меняется от предыдущего задания, просто другой способ создания экземпляров класса без ().
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Pro</title>
</head>
<body>
    <header>
    </header>
    <main>

    <?php

    ?>

    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
