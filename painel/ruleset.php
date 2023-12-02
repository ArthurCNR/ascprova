<?php
session_start();

include 'php/conexao.php';

setcookie("ck_authorized", "true", 0, "/");

if(!isset($_SESSION["id"])) {
    //header("location: /login");
    exit ();
}

$campid = addslashes($_GET["id"]);
$id = $_SESSION["id"];

$query = "SELECT u.nome, c.nome as 'canome', c.img, c.username from usuarios u
JOIN usuario_campeonato uc
ON u.id = uc.id_usuario
JOIN campeonatos c
ON uc.id_campeonato = u.id WHERE c.id=$campid and u.id='$id'";

$result = $conectar->query($query);

if ($result->num_rows ==1 ) {

    $linha = mysqli_fetch_object($result);
    $nome = $linha->nome;
    $canome = $linha->canome;
    $img = $linha->img;
    $username = $linha->username;

} else {
    header("location: campeonatos");
    exit ();
}

$conectar->close();
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
    <title><?php echo''."$canome".''; ?> - MyKart</title>
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
                    <li class="active">
                        <a href="campeonatos"> <i class="menu-icon ti-package"></i>Meus Campeonatos </a>
                    </li>
                    <h3 class="menu-title"><?php echo''."$canome".''; ?></h3><!-- /.menu-title -->
                    <li>
                        <a href="#"> <i class="menu-icon ti-package"></i>Etapas </a>
                    </li>
                    <li>
                        <a href="campeonatos"> <i class="menu-icon ti-package"></i>Categorias </a>
                    </li>
                    <li>
                        <a href="campeonatos"> <i class="menu-icon ti-package"></i>Pilotos </a>
                    </li>
                    <li>
                        <a href="campeonatos"> <i class="menu-icon ti-package"></i>Classificação </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <div>
                        <h4>Olá, <?php echo''."$nome".''; ?></h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> <?php echo''."$nome".''; ?></a>

                            <a class="nav-link" href="logout"><i class="fa fa-power-off"></i> Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo''."$canome".''; ?> - Ruleset</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">
                                <a href="./"><span class="ti-angle-left"></span> Voltar a lista de campeonatos</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="card mr-auto ml-auto">
                        <button type="button" class="btn btn-outline-primary"><a href="nova-etapa.php?id=<?php echo''."$campid".''; ?>"><i class="fa fa-star"></i>&nbsp; Nova Etapa</a></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-16">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>P1</th>
                                        <th>P2</th>
                                        <th>P3</th>
                                        <th>P4</th>
                                        <th>P5</th>
                                        <th>P6</th>
                                        <th>P7</th>
                                        <th>P8</th>
                                        <th>P9</th>
                                        <th>P10</th>
                                        <th>P11</th>
                                        <th>P12</th>
                                        <th>P13</th>
                                        <th>P14</th>
                                        <th>P15</th>
                                        <th>P16</th>
                                        <th>P17</th>
                                        <th>P18</th>
                                        <th>P19</th>
                                        <th>P20</th>
                                        <th>P21</th>
                                        <th>P22</th>
                                        <th>P23</th>
                                        <th>P24</th>
                                        <th>P25</th>
                                        <th>P26</th>
                                        <th>P27</th>
                                        <th>P28</th>
                                        <th>P29</th>
                                        <th>P30</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //Receber o número da página
                                    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);
                                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                                    //Setar a quantidade de itens por pagina
                                    $qnt_result_pg = 10;

                                    //calcular o inicio visualização
                                    include 'php/conexao.php';
                                    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
                                    $result_usuarios = "SELECT
                                    nome,
                                    categoria,
                                    DATE_FORMAT(data, '%d/%m/%Y') AS data,
                                    DATE_FORMAT(data, '%H:%i') AS hora,
                                    tipo,
                                    local,
                                    status
                                    from etapas e
                                    JOIN etapas_campeonato ec
                                    ON ec.id_etapa = e.id WHERE ec.id_campeonato = '$campid' LIMIT $inicio, $qnt_result_pg";
                                    $resultado_usuarios = mysqli_query($conectar, $result_usuarios);
                                    if (!mysqli_query($conectar, $result_usuarios)){
                                        echo '<p>Ops! parece que voce não tem nenhuma etapa cadastrado <span><a href="#" style="color: #1a3a95">Clique aqui</a> </span> para criar um</p>';
                                    } else {
                                        while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
                                        echo '
                                    <tr>
                                        <td>'.$row_usuario["nome"].'</td>
                                        <td>'.$row_usuario["categoria"].'</td>
                                        <td>'.$row_usuario["data"].'</td>
                                        <td>'.$row_usuario["hora"].'</td>
                                        <td>'.$row_usuario["tipo"].'</td>
                                        <td>'.$row_usuario["local"].'</td>
                                        <td>'.$row_usuario["status"].'</td>
                                        <td>0</td>
                                        <td><a href="#"><i class="fa fa-pencil"></i></a> <a href="#"><i class="fa fa-minus"></i></a></td>
                                    </tr>
                                        ';
                                    }
                                    };
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>

</body>

</html>
