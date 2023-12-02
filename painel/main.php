<?php
require_once ("../php/session_start.php");
if(!defined("CONFIG")) exit();

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
}
?>

<?php
$campid = addslashes($_GET['id']);
$session = $_SESSION['login'];
$id = $session->getUserdata()["id"];
require_once("../php/functions.php");

$query = "SELECT c.nome, c.img, c.camp_username from usuarios u
JOIN usuarios_campeonatos uc
ON uc.id_usuario = u.id
JOIN campeonatos c
ON c.id = uc.id_campeonato WHERE c.id=$campid and u.id='$id'";

$mysqli = mysqliconnect();
$result = $mysqli->query($query);

if(!$result) {
    echo 'MySQL Error: ' . mysqli_error($mysqli);
    return;
}

if($result->num_rows === 0){
    echo 'Etapa não existe';
    header("location: campeonatos");
    exit ();
}
$item = mysqli_fetch_array($result);

$mysqli->close();

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Table</strong>
            </div>
            <div class="card-body">
                <h1>Hello ;D</h1>
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
