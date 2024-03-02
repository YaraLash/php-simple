<?php

class UserRole
{
    const USER = "USER";
    const ADMIN = "ADMIN";
}

/**
 * Функция аутентификации
 * @param string $email
 * @param string $password
 * @param mysqli $conn
 * @return bool
 */
function login(string $email, string $password, mysqli $conn): bool
{
    $sql = "SELECT id, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password, $user_role);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $user_role;

        return true;
    } else {
        return false;
    }
}


/**
 * Функция регистрации пользователя с ролью
 * @param string $username
 * @param string $email
 * @param $password
 * @param mysqli $conn
 * @return bool
 */
function register(string $username, string $email, $password, mysqli $conn): bool
{
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $userRole = UserRole::USER;
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $userRole);

    return $stmt->execute();
}

function get_username(int $user_id, mysqli $conn): string
{
    $sql = "SELECT username FROM users WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();

    return $username;
}

function get_user_role(int $user_id, mysqli $conn): string
{
    $sql = "SELECT role FROM users WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();

    return $role;
}