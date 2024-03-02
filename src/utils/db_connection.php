<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "auth_simple";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Потеряно соединение с базой данных. Ошибка: " . $conn->connect_error);
}