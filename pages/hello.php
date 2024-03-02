<?php
session_start();
include '../utils/db_connection.php';
include '../utils/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
global $conn;

$user_id = $_SESSION['user_id'];
$username = get_username($user_id, $conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Cтраница пользователя</title>
</head>
<body>
<h2>Добро пожаловать, <?php echo $username; ?>!</h2>
<a href="dashboard.php">Вы админ?</a>
<a href="../logout.php">Выйти</a>
</body>
</html>