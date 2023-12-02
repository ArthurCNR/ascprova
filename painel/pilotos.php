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
*
FROM piloto p
WHERE p.id_campeonato = '$idc'";

require_once("../php/functions.php");
$mysqli = mysqliconnect();
$result = $mysqli->query($query);

if(!$result) {
    echo mysqli_error($mysqli);
    die();
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Lista de Pilotos</strong>
                <a class="card-title" href="campeonato?id=<?php echo $idc ?>&page=novo-piloto">Cadastrar novo Piloto</a>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categorias</th>
                        <th>Pontos</th>
                        <th>Etapas</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($item = mysqli_fetch_array($result)){
                            echo '<tr>
                        <td>'.$item['nome'].'</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td><i class="fa fa-pencil"></i> / <i class="fa fa-trash"></i></td>
                    </tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
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
