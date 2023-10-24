<?php

$db = mysqli_connect('localhost', 'luisS', '123456789', 'coastalCoffee');
//$db = mysqli_connect('localhost', 'root', 'root', 'coastalCoffee');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}

