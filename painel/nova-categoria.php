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
nome
from campeonatos c WHERE id = '$idc'";

$result = $mysqli->query($query);

if(!$result) {
    echo mysqli_error($mysqli);
    die();
}
$item = mysqli_fetch_array($result);

$query = "SELECT
nome
from regra_pontos WHERE id_campeonato = '$idc'";
$result = $mysqli->query($query);
if(!$result) {
    echo mysqli_error($mysqli);
    die();
}

?>
<div class="row">
    <div class="col-md-6 offset-md-3 mr-auto ml-auto" style="margin-top:50px;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
        <div class="content mt-3">
            <form
                    action="php/nova-categoria_do.php"
                    id="registro-categoria"
            >
                <div class="has-success form-group"><label for="nome" class=" form-control-label">Nome da Categoria</label><input type="text" name="nome" id="nome" class="is-valid form-control-success form-control" required></div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="campeonato" class="form-control-label">Campeonato</label></div>
                    <div class="col-12 col-md-9">
                        <select name="campeonato" id="campeonato" class="form-control">
                            <option value="<?php echo $idc ?>"><?php echo $item['nome'] ?></option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="tipo" class="form-control-label">Tipo</label></div>
                    <div class="col-12 col-md-9">
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="Campeonato">Campeonato</option>
                            <option value="Endurance">Endurance</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="pontos" class=" form-control-label">Pontos</label></div>
                    <div class="col-12 col-md-9">
                        <select name="pontos" id="pontos" class="form-control">
                            <option>Seleciona a Regra de Pontos</option>
                            <?php
                            if ($result->num_rows === 0) {

                            } else {
                                while($item2 = mysqli_fetch_array($result)){
                                    echo '<option value="'.$item2['id'].'">'.$item2['nome'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="has-success form-group" hidden="hidden"><input type="text" name="organizacao" id="organizacao" class="is-valid form-control-success form-control" value="<?php echo''."$organizacao".''; ?>"></div>
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
