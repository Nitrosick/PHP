<?php
declare(strict_types=1);

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$db = mysqli_connect("localhost", "root", "root", "php2");

$startFrom = $_POST['startFrom'];

$select = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` LIMIT {$startFrom}, 25");

$products = array();
while($row = mysqli_fetch_assoc($select))
{
    $products[] = $row;
}

echo json_encode($products);
