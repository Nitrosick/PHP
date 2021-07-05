<?php
    declare(strict_types=1);

    ini_set('error_reporting', (string)E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    abstract class Product {
        protected $name;
        protected $image;
        protected $cost;
        protected $description;
        public static $income = 0;

        abstract public function getTotal();

        public function getName() {
            return $this->name;
        }

        public function getDescription() {
            return $this->description;
        }
    }

    class PieceProduct extends Product {
        // Штучный товар - продается кратно 1, цена за единицу
        private $quantity;

        public function __construct($name, $image, $cost, $quantity, $description) {
            $this->name = $name;
            $this->image = $image;
            $this->cost = $cost;
            $this->quantity = $quantity;
            $this->description = $description;

            Product::$income += $this->getTotal();
        }

        public function getTotal() {
            return $this->cost * $this->quantity;
        }
    }

    class WeightProduct extends Product {
        // Весовой товар - продается килограммами, может продаваться дробным количеством, цена за кг.
        private $weight; // Вес в граммах

        public function __construct($name, $image, $cost, $weight, $description) {
            $this->name = $name;
            $this->image = $image;
            $this->cost = $cost;
            $this->weight = $weight / 1000;
            $this->description = $description;

            Product::$income += $this->getTotal();
        }

        public function getTotal() {
            return $this->cost * $this->weight;
        }
    }

    class DigitalProduct extends Product {
        // Цифровой товар - стоимость в два раза меньше, чем у штучного
        private $quantity;

        public function __construct($name, $image, $cost, $quantity, $description) {
            $this->name = $name;
            $this->image = $image;
            $this->cost = $cost;
            $this->quantity = $quantity;
            $this->description = $description;

            Product::$income += $this->getTotal();
        }

        public function getTotal() {
            return ($this->cost * $this->quantity) / 2;
        }
    }

    trait TConnection {
        public function __construct() {
            // Код подключения к БД
        }

        public static function getInstance() {
            if (self::$db === null) {
                self::$db = new self();
            }
            return self::$db;
        }

        public function query() {
            // Код запроса
        }
    }

    class DBSingleton {
        private static $db = null;

        use TConnection;
    }
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
        $prod1 = new PieceProduct('Отвертка', 'screwdriver.jpg', '450', '2', 'Магнитная отвертка со сменной насадкой');
        echo 'Стоимость товаров типа ' . $prod1->getName() . ' ' . $prod1->getTotal() . ' руб.';
        echo '<br>' . $prod1->getDescription(). '<br>';

        $prod2 = new WeightProduct('Гвозди', 'nails.jpg', '300', '800', 'Обычные металлические гвозди');
        echo 'Стоимость товаров типа ' . $prod2->getName() . ' ' . $prod2->getTotal() . ' руб.';
        echo '<br>' . $prod2->getDescription() . '<br>';

        echo 'Суммарный доход - ' . Product::$income . ' руб.<br>';

        $connect = new DBSingleton();
        echo get_class($connect->getInstance());
    ?>

    </main>
    <footer>
        <?= date('Y') ?>
    </footer>
</body>
</html>
