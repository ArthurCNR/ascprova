<?php
require_once ("../../php/session_start.php");

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}

$mysqli = mysqliconnect();
$id = $_SESSION['login'];
$error = "";

$nome = $mysqli->real_escape_string($_POST["nome"]);
$idc = $mysqli->real_escape_string($_POST["idc"]);
$username = $mysqli->real_escape_string($_POST["camp_username"]);
$categoria = $mysqli->real_escape_string($_POST["categoria"]);
$pontuacao = $mysqli->real_escape_string($_POST["pontuacao"]);
$classificacao = $mysqli->real_escape_string($_POST["classificacao"]);
$data = $mysqli->real_escape_string($_POST["data"]);
$time = $mysqli->real_escape_string($_POST["time"]);
$tipo = $mysqli->real_escape_string($_POST["tipo"]);
$local = $mysqli->real_escape_string($_POST["local"]);
$status = $mysqli->real_escape_string($_POST["status"]);

$dataformatada = $data.' '.$time;
$dateTime = DateTime::createFromFormat('Y-m-d H:i', $dataformatada);
$dataetapa = $dateTime->format('Y-m-d H:i:s');


$query2 = "SELECT id FROM etapas WHERE nome = '$nome' OR data = '$dataetapa' LIMIT 1";
$result2 = $mysqli->query($query2);

if(!$result2) {
    echo 'MySQL Error: ' . mysqli_error($mysqli);
    return;
} else {

    if($result2->num_rows > 0){
        echo 'Já existe uma corrida com o mesmo nome ou data.';
    } else {
        $query = "INSERT INTO etapas (nome,categoria,tipo,classificacao,pontuacao,status,data,local,data_criacao) VALUES ('$nome','$categoria', '$tipo', '$classificacao', '$pontuacao', '$status', '$dataetapa', '$local', NOW())";
        if($mysqli->query($query)){
            $query2 = "SELECT id FROM etapas WHERE nome = '$nome' OR data = '$dataetapa' LIMIT 1";
            $result2 = $mysqli->query($query2);
            $ideta = mysqli_fetch_array($result2)['id'];

            $query = "INSERT INTO etapas_campeonatos (id_campeonato,id_etapa) VALUES ('$idc', '$ideta')";
            if($mysqli->query($query)){
                $query2 = "SELECT id FROM etapas WHERE nome = '$nome' OR data = '$dataetapa' LIMIT 1";
                $result2 = $mysqli->query($query2);
                echo 'Etapa Registrada';
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