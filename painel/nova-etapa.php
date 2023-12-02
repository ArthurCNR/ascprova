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
                    action="php/nova-etapa_do.php"
                    id="registro-etapa"
            >
                <div class="has-success form-group"><label for="nome" class=" form-control-label">Nome da Etapa</label><input type="text" name="nome" id="nome" class="is-valid form-control-success form-control" required></div>
                <input type="text" name="idc" id="idc" value="<?php echo $idc?>" class="is-valid form-control-success form-control" hidden="hidden">
                <input type="text" name="camp_username" id="camp_username" value="<?php echo $camp_username?>" class="is-valid form-control-success form-control" hidden="hidden">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="categoria" class=" form-control-label">Categoria</label></div>
                    <div class="col-12 col-md-9">
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="">Selecione a Categoria</option>
                            <?php
                            if ($cat->num_rows > 0) {
                                while($item = mysqli_fetch_array($cat)){
                                    echo '<option value="'.$item['id'].'">'.$item['nome'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="data" class=" form-control-label">Data / Horário</label></div>
                    <div class="col-12 col-md-9">
                        <input type="date" id="data" name="data" required />
                        <input type="time" id="time" name="time" required />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="tipo" class=" form-control-label">Tipo</label></div>
                    <div class="col-12 col-md-9">
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Selecione o Tipo</option>
                            <option value="Endurance">Endurance</option>
                            <option value="Campeonato">Campeonato</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="local" class=" form-control-label">Local</label></div>
                    <div class="col-12 col-md-9">
                        <select name="local" id="local" class="form-control">
                            <option value="">Selecione o Local</option>
                            <option value="Kartodromo Granja Viana">Kartodromo Granja Viana</option>
                            <option value="Kartodromo Nova Odessa">Kartodromo Nova Odessa</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="status" class=" form-control-label">Status</label></div>
                    <div class="col-12 col-md-9">
                        <select name="status" id="status" class="form-control">
                            <option value="">Status da Etapa</option>
                            <option value="pendente">Pendente</option>
                            <option value="aberto">Aberto</option>
                            <option value="fechado">Fechado</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="classificacao" class=" form-control-label">Classificação</label></div>
                    <div class="col-12 col-md-9">
                        <select name="classificacao" id="classificacao" class="form-control">
                            <option value="">Tipo de Classificação</option>
                            <option value="Tomada de Tempo">Tomada de Tempo</option>
                            <option value="Super Pole">Super Pole</option>
                            <option value="Nenhuma">Nenhuma</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="pontuacao" class=" form-control-label">Pontuação</label></div>
                    <div class="col-12 col-md-9">
                        <select name="pontuacao" id="pontuacao" class="form-control">
                            <option value="">Adicionar Pontos a Classificação?</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
                <div class="has-success form-group" hidden="hidden"><input type="text" name="organizacao" id="organizacao" class="is-valid form-control-success form-control" value="<?php echo''."$organizacao".''; ?>"></div>
                <div style="margin: 30px">
                    <button type="submit" name="submit2" id="submit2" class="btn btn-primary btn-sm">Criar Etapa</button>
                </div>
                <div class="login-form-response" id="resposta"></div>
            </form>
        </div>
    </div>
</div>


</body>

</html>
