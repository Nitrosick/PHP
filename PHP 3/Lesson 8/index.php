<?php

$dir = new DirectoryIterator('.');

foreach ($dir as $value) {
    if (!$dir->isDot() && !strpos($value, '.php')) {
        echo "<a href='{$value}/{$value}.php'>{$value}</a><br>";
    }
}
