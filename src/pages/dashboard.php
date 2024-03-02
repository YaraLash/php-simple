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
$user_role = get_user_role($user_id, $conn);

if ($user_role != UserRole::ADMIN) {
    exit("Вы не можете видеть эту страницу");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Панель управления</title>
</head>
<body>
<h2>Добро пожаловать, <?php echo $username; ?>! Только Админ может видеть эту страницу</h2>
<a href="../logout.php">Выйти</a>
</body>
</html>
