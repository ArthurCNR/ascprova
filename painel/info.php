<?php
session_start();
	
$campid = $_GET["id"];
 
//adiciona barras para evitar SQL injection
$itemSeguro = addslashes($campid);
$id = $_SESSION['id'];
	
//testa para saber se os campos estão vazios
if (empty($itemSeguro)):
    header ("Location: inicio");
    exit;    
endif;
	
//inclui a conexao	
include 'php/conexao.php';
	
//consulta ao banco de dados
$dados = mysqli_query($conectar, "SELECT u.nome, c.nome as 'canome' from usuarios u
JOIN usuario_campeonato uc
ON u.id = uc.id_usuario
JOIN campeonatos c
ON uc.id_campeonato = u.id WHERE c.id=$itemSeguro and u.id='$id'") or die (mysqli_error(header ("Location: inicio") and exit));

//armazena na variável o número de linhas encontradas
$num = mysqli_num_rows($dados);
	
//se zero, é porque ele errou a senha ou o login
if ($num == 0):
	header ("Location: campeonatos");
	exit;
else :
    
    //armazena a função fetch_object onde é tratado como objeto
	$linha = mysqli_fetch_object($dados);

    //armazena na variável o número ID do usuário
	$id = $linha->id;
	$img = $linha->img;
	$canome = $linha->canome;

	$_SESSION["id"] = $id;
	$_SESSION["canome"] = $canome;
	$_SESSION["img"] = $img;

	//manda o usuário para a páginas depois de logado		
	header ("Location: campeonato");
endif;


?>