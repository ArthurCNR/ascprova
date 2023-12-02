<?php
require_once("session_start.php");

if(empty($_POST["email"]) && empty($_POST["senha"]))
{
    echo 'Both Fields are required';
}

else
{
    $mysqli = mysqliconnect();


    $nome = $mysqli->real_escape_string($_POST["nome"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $telefone =$mysqli->real_escape_string($_POST["telefone"]);
    $organizacao = $mysqli->real_escape_string($_POST["organizacao"]);
    $senha = $mysqli->real_escape_string($_POST["senha"]);
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $query = "SELECT id, email, telefone FROM usuarios WHERE email = '$email' OR telefone = '$telefone'";
    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows === 0) {
            $query = "INSERT INTO usuarios (nome, email, telefone, organizacao, senha) VALUES('$nome', '$email', '$telefone', '$organizacao', '$senhaHash')";
            $result = $mysqli->query($query);

            if($result) {
                echo 'Registrado com sucesso! Redirecionando em 3 segundos';
                echo "<script>
                  var timer = setTimeout(function() {
                  window.location='../painel/inicio'
                  }, 3000);
                  </script>";
                exit();
            }
        } else {

            echo "Não é possível usar esse email. Use outro ou cadastre-se com um número de celular.";
        }
    } else {
        // Tratamento de erro na consulta.
        echo "Ocorreu algum erro.";
    }
}