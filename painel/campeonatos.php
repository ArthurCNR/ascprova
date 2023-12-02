<?php
require_once ("../php/session_start.php");
if(!defined("CONFIG")) exit();

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}
?>

<?php
$id = $_SESSION['login'];
$idc = $id->getUserdata()["id"];

$query = "SELECT u.id, c.id as 'caid', c.nome, c.img from usuarios u
                JOIN usuarios_campeonatos uc ON uc.id_usuario = u.id
                JOIN campeonatos c ON c.id = uc.id_campeonato WHERE u.id='$idc'";

require_once("../php/functions.php");
$mysqli = mysqliconnect();
$result = $mysqli->query($query);

if(!$result) {
    echo mysqli_error($mysqli);
    die();
}

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Campeonatos - MyKart</title>
    <meta name="description" content="MyKart">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><span>MyKart</span></a>
                <a class="navbar-brand hidden" href="./"><span>M</span></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="inicio"> <i class="menu-icon ti-home"></i>Inicio </a>
                    </li>
                    <h3 class="menu-title">Menu</h3><!-- /.menu-title -->
                    <li class="active">
                        <a href="campeonatos"> <i class="menu-icon ti-package"></i>Meus Campeonatos </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include ("header.php"); ?>
        <!-- /header -->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Meus Campeonatos</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Inicio</a></li>
                            <li class="active">Meus Campeonatos</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if ($result->num_rows === 0) {
                            echo '<p>Ops! parece que voce não tem nenhum campeonato cadastrado <span><a href="novo-campeonato" style="color: #1a3a95">Clique aqui</a> </span> para criar um</p>';
                        } else {
                            while($item = mysqli_fetch_array($result)) {
                                echo '
                                    <div class="col-sm-6 col-lg-3" style="/* max-width: 35%;">
                                    <div class="gridp">
                                    <figure class="effect-sadie">
                                    <img src="assets/uploads/images/'.$item["img"].'" alt="img11"/>
                                    <figcaption>
                                    <h2>'.$item["nome"].'</h2>
                                    <p style="color:white">Clique para Visualizar</p>
                                    <a href="campeonato?id='.$item["caid"].'">View more</a>
                                    </figcaption>
                                    </figure>
                                    </div>
                                    </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
