<?php
session_start();
include '../utils/db_connection.php';
include '../utils/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conn;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (register($username, $email, $password, $conn)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Ошибка при регистрации";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Регистрация</title>
</head>
<body>
<form method="post" action="">
    <label>
        Ваше имя
        <input type="text" name="username" required>
    </label>
    <label>
        Ваш email
        <input type="email" name="email" required>
    </label>
    <label>
        Ваш пароль
        <input type="password" name="password" required>
    </label>

    <button type="submit">Зарегистрироваться</button>
</form>

<?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</body>
</html>