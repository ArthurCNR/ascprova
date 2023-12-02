<?php
require_once("session_start.php");

if (empty($_POST["email"]) || empty($_POST["senha"])) {
    echo 'Both email and password are required';
} else {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $mysqli = mysqliconnect();

    // Abra a conexão com o banco de dados.
    $auth = new Auth($mysqli);
    $result = $auth->login($email, $senha);

    switch($result) {
        case 0:
            // success
            $_SESSION['login'] = $auth;
            echo "<script>window.location = '../painel/inicio';</script>";
            break;
        case Auth::ERR_USER_LOGIN_INCORRECT:
            echo '<p>O email ou a senha estão incorretos.</p>';
            break;
        case Auth::ERR_USER_INACTIVE:
            echo '<p>Sua conta está bloqueada.</p>';
            break;
        case Auth::ERR_PASSWORD_INCORRECT:
            echo '<p>A senha inserida está incorreta.</p>';
            break;
        default:
            echo '<p>Erro desconhecido.</p>';
            break;
    }
    exit();
}