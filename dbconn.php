<?php



// dbcon.php

$host = 'localhost';
$dbname = 'attendance';
$username = 'root';
$password = '';

$connect = new mysqli($host, $username, $password, $dbname);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

?>