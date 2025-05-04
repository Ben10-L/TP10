<?php
session_start();
require 'config.php';

$action = $_GET['afaire'] ?? null;

if ($action === 'deconnexion') {
    session_destroy();
    header('Location: login.php?error=3');
    exit;
}

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($login) || empty($password)) {
    header('Location: login.php?error=1');
    exit;
}

if ($login !== USERLOGIN || $password !== USERPASS) {
    header('Location: login.php?error=2');
    exit;
}

$_SESSION['CONNECT'] = 'OK';
$_SESSION['login'] = $login;
$_SESSION['password'] = $password;

header('Location: accueil.php');
exit;
?>