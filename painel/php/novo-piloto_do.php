<?php
require_once ("../../php/session_start.php");

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}

$mysqli = mysqliconnect();
$id = $_SESSION['login'];
$error = "";

$nomecompleto = $mysqli->real_escape_string($_POST["nomecompleto"]);
$idc = $mysqli->real_escape_string($_POST["campeonato"]);
$nome = $mysqli->real_escape_string($_POST["nome"]);
$cpf = $mysqli->real_escape_string($_POST["cpf"]);
$celular = $mysqli->real_escape_string($_POST["celular"]);

$query2 = "SELECT id FROM piloto WHERE nomecompleto = '$nomecompleto' AND cpf = '$cpf' AND id_campeonato = '$idc' LIMIT 1";
$result2 = $mysqli->query($query2);

if(!$result2) {
    echo 'MySQL Error: ' . mysqli_error($mysqli);
    return;
} else {

    if($result2->num_rows > 0){
        echo 'Já existe um piloto com o mesmo nome completo ou cpf.';
    } else {
        $query = "INSERT INTO piloto (id_campeonato,nomecompleto,nome,cpf,celular,data_criacao) VALUES ('$idc','$nomecompleto','$nome', '$cpf', '$celular', NOW())";
        if($mysqli->query($query)){
            $query2 = "SELECT id FROM piloto WHERE nomecompleto = '$nomecompleto' AND cpf = '$cpf' AND id_campeonato = '$idc' LIMIT 1";
            $result2 = $mysqli->query($query2);
            $ideta = mysqli_fetch_array($result2)['id'];

            if($mysqli->query($query)){
                echo 'Piloto Registrado';
                echo '<script>setTimeout(function() {
                      window.history.back();
                      }, 2000);
    
                      setTimeout(function() {
                        location.reload();
                      }, 4000);
                      </script>
                     ';
            }
        } else {
            echo 'Ocorreu um error';
        }
    }
}
$mysqli->close();

?>