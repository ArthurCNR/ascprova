<? if(!defined("CONFIG")) exit(); ?>
<?php
require_once ("../../php/session_start.php");

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}

$mysqli = mysqliconnect();
$id = $_SESSION['login'];
$error = "";

$nome = $mysqli->real_escape_string($_POST["nome"]);
$descricao = $mysqli->real_escape_string($_POST["descricao"]);
$organizador = $id->getUserdata()["nome"];
if(isset($id->getUserdata()["organizacao"])) {
    $organizacao = $id->getUserdata()["organizacao"];
} else {
    $organizacao = null;
}

$username = str_replace(' ', '', trim(strtolower($nome))) . '-' .  $id->getUserdata()["id"];
$final_img = $username.$_FILES['img']['name'];
$final_pdf = $username.$_FILES['regulamento']['name'];

$pathimg = "../assets/uploads/images/";
$allowedExtensionsimg = ['jpg', 'jpeg', 'png'];
$fileExtensionimg = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
if (!in_array($fileExtensionimg, $allowedExtensionsimg)) {
    $error .= 'Tipo de arquivo não permitido. Apenas jpg, jpeg, png';
}
$maxFileSizeimg = 2 * 1024 * 1024; // 2 MB
if ($_FILES['img']['size'] > $maxFileSizeimg) {
    $error .= 'Arquivo muito grande.';
}
if(!empty($error)) echo $error;

$pathpdf = "../assets/uploads/pdfs/";
$allowedExtensionspdf = ['pdf'];
$fileExtensionpdf = pathinfo($_FILES['regulamento']['name'], PATHINFO_EXTENSION);
if (!in_array($fileExtensionpdf, $allowedExtensionspdf)) {
    $error .= 'Tipo de arquivo não permitido. Apenas .PDF';
}
$maxFileSizepdf = 50 * 1024 * 1024; // 50 MB
if ($_FILES['regulamento']['size'] > $maxFileSizepdf) {
    $error .= 'Arquivo muito grande.';
}
if(!empty($error)) echo $error;

if(!empty($error)) exit();

$final_img = strtolower(str_replace(' ', '', trim(strtolower($final_img))));
$targetimg = $pathimg . $final_img;
$final_pdf = strtolower(str_replace(' ', '', trim(strtolower($final_pdf))));
$targetpdf = $pathpdf . $final_pdf;

$acesso_publico = true;


if(empty($nome)) $error .= "You must fill in a name\n";
if(empty($descricao)) $error .= "You must fill in a description\n";

if(!empty($error)) echo $error;
if(!empty($error)) exit();


$query = "SELECT id FROM campeonatos WHERE nome = '$nome' OR camp_username = '$username'";
$result = $mysqli->query($query);
if(mysqli_num_rows($result) > 0)
{
    echo 'Campeonato já cadastrado!';
    die();
}
else
{

    $query = "INSERT INTO campeonatos (nome,camp_username,descricao,img,data_criacao,acesso_publico,organizador,organizacao,regulamento) VALUES ( '$nome','$username', '$descricao', '$final_img', NOW(), '$acesso_publico', '$organizador', '$organizacao', '$final_pdf')";

    if ($mysqli->query($query) === TRUE) {

        $query = "SELECT id FROM campeonatos WHERE nome = '$nome' OR camp_username = '$username'";
        $result = $mysqli->query($query);
        $idc = mysqli_fetch_array($result)['id'];
        $idu = $id->getUserdata()["id"];

        $query2 = "INSERT INTO usuarios_campeonatos (id_usuario, id_campeonato) VALUES ( '$idu', '$idc')";
        if ($mysqli->query($query2) === TRUE) {
            echo 'Registrado com sucesso! Redirecionando em 3 segundos';
            echo "<script>
                  var timer = setTimeout(function() {
                  window.location='../painel/campeonatos'
                  }, 3000);
                  </script>";
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetimg)) {
                echo 'Arquivo enviado com sucesso.';
            } else {
                die('Falha ao mover o arquivo.');
            }
            if (move_uploaded_file($_FILES['regulamento']['tmp_name'], $targetpdf)) {
                echo 'Arquivo enviado com sucesso.';
            } else {
                die('Falha ao mover o arquivo.');
            }
            exit();
        } else {
            echo 'Ocorreu algum erro ao registrar';
            echo $mysqli->error;
            exit();
        }
    } else {
        echo 'Ocorreu algum erro ao registrar';
        echo $mysqli->error;
        exit();
    }
}
exit();
?>