<? if(!defined("CONFIG")) exit(); ?>
<?php
require_once ("../php/session_start.php");

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
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
                        <h1>Novo Campeonatos</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Inicio</a></li>
                            <li class="active">Novo Campeonato</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3 mr-auto ml-auto" style="margin-top:50px;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <div class="content mt-3">
                    <form
                    action="php/novo-campeonato_do.php"
                    id="registro-campeonato"
                    enctype="multipart/form-data">
                    >
                        <div class="has-success form-group"><label for="nome" class=" form-control-label">Nome do Campeonato</label><input type="text" name="nome" id="nome" class="is-valid form-control-success form-control" required></div>
                        <div class="has-success form-group"><label for="descricao" class=" form-control-label">Descrição</label><textarea name="descricao" id="descricao" rows="9" placeholder="Descreva aqui..." class="form-control"></textarea></div>
                        <div class="form-group">
                            <label for="username" class=" form-control-label">URL de Acesso</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" id="username" name="username" class="form-control" placeholder="exemplo" disabled>
                                <div class="input-group-addon">@mykart.com.br</div>
                            </div>
                        </div>
                        <hr>
                        <div class="has-success form-group">
                            <label for="inputIsValid" class=" form-control-label">Foto</label>
                            <input type="file" id="img" name="img" accept="image/*" class="form-control-file">
                        </div>
                        <div style="margin-top: 20px" class="has-success form-group">
                            <label for="inputIsValid" class=" form-control-label">Arquivo Regulamento (.pdf)</label>
                            <input type="file" id="regulamento" name="regulamento" class="form-control-file">
                        </div>
                        <div style="margin: 30px">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Criar Campeonato</button>
                        </div>
                        <div class="login-form-response" id="resposta"></div>
                    </form>
                </div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
