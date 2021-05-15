<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("../Classes/Ponto.php");

    $ponto = new Ponto(); 
    $retorno = $ponto->listarPonto($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="my-8">
        <h1 class="text-dark font-weight-bolder">Meus Pontos</h1>
    </div>
    <div class="row justify-content-center">
    <div class="text-right w-100 mb-5 mr-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Adicionar Ponto</button>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Gravar Ponto</h5>
                    </div>
                    <div class="modal-body">
                        <form id="form_ponto">
                            <div class="form-group col-4">
                                <label>Localidade: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ds_localidade" name="ds_localidade" />
                            </div>
                            <div class="form-group col-4">
                                <label>Latitude/Longitude: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nu_localidade" name="nu_localidade" />
                            </div>
                            <div class="form-group col-4">
                                <label>Tipo: <span class="text-danger">*</span></label>
                                <select class="form-control" name="id_tipo" id="id_tipo">
                                    <option  value="">Selecione...</option>
                                    <option  value="1" >Outdoor</option>
                                    <option  value="2">Front-light</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-9 ">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white"  >
                <div class="card-body">
                    <table class="table table-hover" id="table_ponto">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Local</th>
                                <th>Lat/long</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                                while ($dados = $retorno->fetch())
                                {
                                    /*$id_status = $dados['id_status'];
                                    switch($id_status){
                                        case 1:
                                            $status = "<span class='label label-xl label-dot label-success'>";
                                            break;
                                        case 2:
                                            $status = "<span class='label label-xl label-dot label-warning'>";
                                            break;
                                        case 3:
                                            $status = "<span class='label label-xl label-dot label-danger'>";
                                            break;
                                    };*/
                                    $hoje = date('Y-m-d');
                                    
                                    if($hoje >= $dados["dt_inicial"] && $dados["dt_final"] >= $hoje){
                                        $status = "<span class='label label-xl label-dot label-danger'></span><p>Indisponível</p>";
                                    }
                                    if($hoje < $dados["dt_inicial"]){
                                        $status = "<span class='label label-xl label-dot label-warning'></span><p>Disponível no momento</p>";
                                    }
                                    if(empty($dados["dt_final"]) && empty($dados["dt_inicial"])){
                                        $status = "<span class='label label-xl label-dot label-success'></span><p>Disponível</p>";
                                    }
                                    
                                    echo "<tr>
                                            <td>".$dados['id_ponto']."</td>
                                            <td>".$dados['ds_localidade']."</td>
                                            <td>".$dados['nu_localidade']."</td>
                                            <td>".$dados['ds_tipo']."</td>
                                            <td class='d-flex'>".$status."</td>
                                            <td nowrap></td>
                                        </tr>";
                                }
                            ?>
                            
                        </tbody>

                    </table>
                </div>
            </div>
            
        </div>
        <div class="col-3">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                <h3>Status</h3>
                <div>
                    <div class="my-2">
                        <p style="display:contents;">Alugado no momento:</p>
                        <span class="label label-xl label-dot label-danger"></span>
                    </div>
                    <div class="my-2">
                        <p style="display:contents;">Alugado para depois:</p>
                        <span class="label label-xl label-dot label-warning"></span>
                    </div>
                    <div class="my-2">
                        <p style="display:contents;">Disponível:</p>
                        <span class="label label-xl label-dot label-success"></span>
                    </div>
                    
                </div>
            </div>
        </div>
            
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appPonto/lista_ponto.js" type="text/javascript"></script>
</body>

</html>