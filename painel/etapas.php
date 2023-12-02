<?php
require_once ("../php/session_start.php");
if(!defined("CONFIG")) exit();

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}
?>

<?php
$id = $_SESSION['login'];

$query = "SELECT
e.nome,
cc.nome as 'categoria_nome',
DATE_FORMAT(data, '%d/%m/%Y') AS data,
DATE_FORMAT(data, '%H:%i') AS hora,
e.tipo,
local,
status,
classificacao
from etapas e
JOIN etapas_campeonatos ec
ON ec.id_etapa = e.id
JOIN categorias cc
on cc.id = e.categoria

WHERE ec.id_campeonato = '$idc'";

require_once("../php/functions.php");
$mysqli = mysqliconnect();
$result = $mysqli->query($query);

if(!$result) {
    echo mysqli_error($mysqli);
    die();
}

?>

<div class="row">
    <?php
    if ($result->num_rows === 0) {
        echo '<p>Ops! parece que voce não tem nenhuma etapa cadastrada <span><a href="campeonato?id='.$idc.'&page=nova-etapa" style="color: #1a3a95">Clique aqui</a> </span> para criar um</p>';
    } else {
        while($item = mysqli_fetch_array($result)){
            echo '<div class="col-sm-4">
        <section class="card my-card">
            <div class="twt-feed blue-bg">
                <div class="corner-ribon black-ribon">
                    <i class="fa fa-eye"></i>
                </div>
                <div class="fa fa-calendar wtt-mark"></div>

                <div class="media">
                    <div class="media-body">
                        <h2 class="text-white display-6">'.$item["nome"].'</h2>
                        <p class="text-light">'.$item["categoria_nome"].'</p>
                        <p class="text-light"><i class="fa fa-calendar"></i> '.$item["data"].' - '.$item["hora"].'</p>
                    </div>
                </div>
            </div>
            <div class="weather-category twt-category">
                <ul>
                    <li class="active">
                        <h5>750</h5>
                        Pilotos Inscritos
                    </li>
                    <li class="active">
                        <h5>750</h5>
                        Pilotos Confirmados
                    </li>
                </ul>
            </div>
            <footer class="twt-footer">
            <span>'.$item["tipo"].'</span><br>
            <span>'.$item["classificacao"].'</span><br>
                <a href="#"><i class="fa fa-map-marker"></i></a>
                '.$item["local"].'
                <span class="pull-right">
                            32
                        </span>
            </footer>
        </section>
    </div>';
        }
    }
    ?>
    <div class="col-sm-4">
        <section class="card my-card new" data-page="nova-etapa" style="height: 80%;background: #8080806b;">
            <div>
                <div class="media">
                    <div class="media-body">
                    <br>
                    <br>
                    <br>
                    </div>
                </div>
                <h5 class="text-white display-6">Criar uma Etapa</h5>
                <div class="corner-ribon black-ribon">
                    <i class="fa fa-plus"></i>
                </div>
            </div>
        </section>
    </div>
</div>

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
