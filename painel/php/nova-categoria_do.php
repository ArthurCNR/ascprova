<?php
require_once ("../../php/session_start.php");

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}

$mysqli = mysqliconnect();
$id = $_SESSION['login'];
$error = "";

$nome = $mysqli->real_escape_string($_POST["nome"]);
$campeonato = $mysqli->real_escape_string($_POST["campeonato"]);
$pontos = $mysqli->real_escape_string($_POST["pontos"]);
$tipo = $mysqli->real_escape_string($_POST["tipo"]);


$query2 = "SELECT id FROM categorias WHERE campeonato = '$campeonato' AND nome = '$nome' LIMIT 1";
$result2 = $mysqli->query($query2);

if(!$result2) {
    echo 'MySQL Error: ' . mysqli_error($mysqli);
    return;
} else {

    if($result2->num_rows > 0){
        echo 'Já existe uma categoria com o mesmo nome ou data.';
    } else {
        $query = "INSERT INTO categorias (campeonato,nome,tipo,data_criacao) VALUES ('$campeonato','$nome', '$tipo', NOW())";
        if($mysqli->query($query)){
            $query2 = "SELECT id FROM categorias WHERE campeonato = '$campeonato' AND nome = '$nome' LIMIT 1";
            $result2 = $mysqli->query($query2);
            $idcat = mysqli_fetch_array($result2)['id'];
            $query = "INSERT INTO categoria_regrapontos (id_categoria,id_pontos) VALUES ('$idcat','$pontos')";
            if($mysqli->query($query)){
                $query2 = "SELECT id FROM categorias WHERE campeonato = '$campeonato' AND nome = '$nome' LIMIT 1";
                $result2 = $mysqli->query($query2);
                echo 'Categoria Registrada';
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