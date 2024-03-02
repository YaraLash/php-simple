<?php
session_start();
include '../utils/db_connection.php';
include '../utils/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conn;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (login($email, $password, $conn)) {
        header("Location: hello.php");
        exit();
    } else {
        $error = "Неправильное имя пользователя или пароль";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Вход</title>
</head>
<body>
<form method="post" action="login.php">
    <label>
        Email
        <input type="text" name="email" required>
    </label>
    <label>
        Пароль
        <input type="password" name="password" required>
    </label>

    <button type="submit">Войти</button>
    <a href="register.php">Зарегестрироваться</a>
</form>

<?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</body>
</html>
