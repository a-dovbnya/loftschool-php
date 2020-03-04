<?php

/**
 * Подключение к БД
 */
const HOST = '127.0.0.1';
const DB_USER = 'burger_user';
const DB_PASSWORD = 'burger123';
const DB_NAME = 'burger';
const DB_PORT = 3306;

$mysql = new mysqli(HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

if (mysqli_connect_errno()) {
    echo 'Connection error: ' . mysqli_connect_error();
    die();
}

function getAllUsers($mysql)
{
    $query = $mysql->query("SELECT * FROM users");

    if ($query) {
        $user = $query->fetch_all();
        return $user;
    }

    return false;
}

function getAllOrders($mysql)
{
    $query = $mysql->query("SELECT * FROM orders");

    if ($query) {
        $user = $query->fetch_all();
        return $user;
    }

    return false;
}

function getUserByEmail($email, $mysql)
{
    $query = $mysql->query("SELECT * FROM users WHERE email = '$email'");

    if ($query) {
        $user = $query->fetch_assoc();
        return $user;
    }

    return false;
}

function getLastOrder($user_id, $mysql)
{
    $query = $mysql->query("SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");

    if ($query) {
        $user = $query->fetch_assoc();
        return $user;
    }

    return false;
}

function getAllOrdersOfUser($user_id, $mysql)
{
    $query = $mysql->query("SELECT * FROM orders WHERE user_id = '$user_id'");

    if ($query) {
        $user = $query->fetch_all();
        return $user;
    }

    return false;
}

function createUser($name, $email, $phone, $mysql)
{
    return $mysql->query("INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')");
}

function createOrder($user_id, $address, $comment, $payment, $callback, $date, $mysql)
{
    return $mysql->query("INSERT INTO orders (user_id, address, comment, payment, not_call, date) VALUES ('$user_id', '$address', '$comment', '$payment', '$callback', '$date')");
}