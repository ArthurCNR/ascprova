<?php
require_once ("../php/session_start.php");
if(!defined("CONFIG")) exit();

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}
?>

<?php
$id = $_SESSION['login'];

require_once("../php/functions.php");
$mysqli = mysqliconnect();

$query = "SELECT
c.nome as 'c_nome',
c.tipo as 'c_tipo',
ca.nome as 'ca_nome',
ca.organizacao as 'ca_organizacao'
from categorias c 
JOIN campeonatos ca
ON ca.id = c.campeonato WHERE c.campeonato  = '$idc'";

$result = $mysqli->query($query);
if(!$result) {
    echo mysqli_error($mysqli);
    die();
}

$query = "SELECT COUNT(ec.id) as 'total'
from etapas_campeonatos ec
join categorias c
ON c.campeonato = ec.id_campeonato  WHERE ec.id_campeonato  = '$idc'";
$result2 = $mysqli->query($query);
if(!$result2) {
    echo mysqli_error($mysqli);
    die();
}
$qtd = mysqli_fetch_array($result2);

?>

<div class="row">
    <?php
    if ($result->num_rows === 0) {
        echo '<p>Ops! parece que voce não tem nenhuma etapa cadastrada <span><a href="campeonato?id='.$idc.'&page=nova-etapa" style="color: #1a3a95">Clique aqui</a> </span> para criar um</p>';
    } else {
        while($item = mysqli_fetch_array($result)){
            echo '
        <div class="col-sm-4">
        <section class="card my-card">
            <div class="twt-feed blue-bg">
                <div class="corner-ribon black-ribon">
                    <i class="fa fa-eye"></i>
                </div>
                <div class="fa fa-square wtt-mark"></div>

                <div class="media">
                    <div class="media-body">
                        <h2 class="text-white display-6">'.$item["c_nome"].'</h2>
                        <p class="text-light">'.$item["ca_organizacao"].'</p>
                    </div>
                </div>
            </div>
            <div class="weather-category twt-category">
                <ul>
                    <li class="active">
                        <h5>'.$qtd['total'].'</h5>
                        Etapas
                    </li>
                    <li>
                        <h5>865</h5>
                        Pilotos
                    </li>
                    <li>
                        <h5><i class="fa fa-check"></i></h5>
                    </li>
                </ul>
            </div>
            <footer class="twt-footer">
            </footer>
        </section>
    </div>';
        }
    }
    ?>
    <div class="col-sm-4">
        <section class="card my-card new" data-page="nova-categoria" style="height: 80%;background: #8080806b;">
            <div>
                <div class="media">
                    <div class="media-body">
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <h5 class="text-white display-6">Criar nova Categoria</h5>
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
