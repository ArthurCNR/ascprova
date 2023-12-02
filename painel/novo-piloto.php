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
nome,
 categoria,
DATE_FORMAT(data, '%d/%m/%Y') AS data,
DATE_FORMAT(data, '%H:%i') AS hora,
tipo,
local,
status
from etapas e
JOIN etapas_campeonatos ec
ON ec.id_etapa = e.id WHERE ec.id_campeonato = '$idc'";

require_once("../php/functions.php");
$mysqli = mysqliconnect();
$result = $mysqli->query($query);

if(!$result) {
    echo mysqli_error($mysqli);
    die();
}

$query = "SELECT
id,
nome
from categorias WHERE campeonato = '$idc'";
$cat = $mysqli->query($query);
if(!$cat) {
    echo mysqli_error($mysqli);
    die();
}

?>
<div class="row">
    <div class="col-md-6 offset-md-3 mr-auto ml-auto" style="margin-top:50px;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
        <div class="content mt-3">
            <form
                    action="php/novo-piloto_do.php"
                    id="registro"
            >
                <div class="has-success form-group"><label for="nomecompleto" class=" form-control-label">Nome Completo</label><input type="text" name="nomecompleto" id="nomecompleto" class="is-valid form-control-success form-control" required></div>
                <input type="text" name="campeonato" id="campeonato" value="<?php echo $idc ?>" class="is-valid form-control-success form-control" hidden="hidden"></div>
                <div class="has-success form-group"><label for="nome" class=" form-control-label">Nome do Piloto</label><input type="text" name="nome" id="nome" class="is-valid form-control-success form-control" required></div>
                <div class="has-success form-group"><label for="cpf" class=" form-control-label">CPF</label><input type="text" name="cpf" id="cpf" class="is-valid form-control-success form-control" ></div>
                <div class="has-success form-group"><label for="celular" class=" form-control-label">Celular</label><input type="text" name="celular" id="celular" class="is-valid form-control-success form-control" ></div>

                <div style="margin: 30px">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Criar Etapa</button>
                </div>
                <div class="login-form-response" id="resposta"></div>
            </form>
        </div>
    </div>
</div>


</body>

</html>
