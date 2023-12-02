<?php
require_once ("../php/session_start.php");
if(!defined("CONFIG")) exit();

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}

$page = isset($_GET['page']) ? $_GET['page'] : PAGE_DEFAULT;
if ($page == PAGE_ERROR) {
    $error = $_GET['error'];
}
if (!is_file($page . ".php") || (!is_readable($page . ".php"))) {
    $error = "Page '$page' does not exist or is not readable\n";
    $page = 'main';
}
if (!defined("CONFIG")) {
    $error = TITLE . " is not configured\n";
    $page = "error";
}
if ($page != "error") {
    if (defined("USE_LOGIN") & defined("USER_MUST_LOGIN")) {
        // Check if user is logged in else kick to login page
        if (!isset($login)) {
            $page = "login";
        }
    }
}
$title = ucfirst($page);
?>

<?php
$idc = addslashes($_GET['id']);
$session = $_SESSION['login'];
$id = $session->getUserdata()["id"];
require_once("../php/functions.php");

$query = "SELECT c.id, c.nome, c.img, c.camp_username, c.organizacao from usuarios u
JOIN usuarios_campeonatos uc
ON uc.id_usuario = u.id
JOIN campeonatos c
ON c.id = uc.id_campeonato WHERE c.id=$idc and u.id='$id'";

$mysqli = mysqliconnect();
$result = $mysqli->query($query);

if(!$result) {
    echo 'MySQL Error: ' . mysqli_error($mysqli);
    return;
}

if($result->num_rows === 0){
    echo 'Campeonato não existe';
    header("location: campeonatos");
    exit ();
}
$item = mysqli_fetch_array($result);
$camp_username = $item['camp_username'];
$mysqli->close();

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt-br">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> - MyKart</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
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
                    <li>
                        <a href="campeonatos"> <i class="menu-icon ti-package"></i>Meus Campeonatos </a>
                    </li>
                    <h3 class="menu-title"><?php echo $item['nome']; ?></h3><!-- /.menu-title -->
                    <li class="<?php if($page === 'main') echo 'active'; ?>">
                        <a href="campeonato?id=<?php echo $item['id']; ?>&page=main"> <i class="menu-icon ti-package"></i>Inicio </a>
                    </li>
                    <li class="<?php if($page === 'categorias') echo 'active'; ?>">
                        <a href="campeonato?id=<?php echo $item['id']; ?>&page=categorias"> <i class="menu-icon ti-package"></i>Categorias </a>
                    </li>
                    <li class="<?php if($page === 'etapas') echo 'active'; ?>">
                        <a href="campeonato?id=<?php echo $item['id']; ?>&page=etapas"> <i class="menu-icon ti-package"></i>Etapas </a>
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
                        <h1><?php echo $item['nome']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">
                                <a href="campeonatos"><span class="ti-angle-left"></span> Voltar a lista de campeonatos</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function funcao2(){
            $(".chavea").html("");
            setTimeout(function(){ window.location="logout.php"}, 3000);
            } setTimeout(function(){ redirect() }, 2000);
        </script>

        <div class="content mt-3">
            <div id="divLogout" class="warning"> </div>
        </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Informações</strong><small> <?php echo $item['camp_username']; ?></small></div>
                    <div class="card-body card-block">
                        <div class="col-md-2 gridp perfil">
                            <figure class="effect-sadie">
                                <img src="assets/uploads/images/<?php echo $item['img']; ?>" alt="img11"/>
                            </figure>
                        </div>
                        <div class="ol-md-2 infos">
                            <a><i class="menu-icon ti-stamp"></i> <?php echo $item['organizacao']; ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3 justify-content-center">
                <div class="row">
                    <div class="mr-auto ml-auto">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php if($page === 'main') echo 'active'; ?>" href="campeonato?id=<?php echo $item['id']; ?>&page=main" aria-selected="true">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($page === 'categorias') echo 'active'; ?>" href="campeonato?id=<?php echo $item['id']; ?>&page=categorias" aria-selected="true">Categorias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($page === 'etapas') echo 'active'; ?>" href="campeonato?id=<?php echo $item['id']; ?>&page=etapas" aria-selected="false">Etapas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($page === 'pilotos') echo 'active'; ?>" href="campeonato?id=<?php echo $item['id']; ?>&page=pilotos" aria-selected="false">Pilotos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="animated fadeIn">
                    <?php include ("$page.php"); ?>
                    <a href="#" class="cd-top text-replace js-cd-top">Voltar ao Topo</a>
                </div>
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
