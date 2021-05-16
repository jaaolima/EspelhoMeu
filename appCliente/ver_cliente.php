<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);

	require_once("../Classes/Cliente.php");
	require_once("../Classes/Ponto.php");

    $id_cliente = $_REQUEST["id_cliente"];

    $cliente = new Cliente();
    $ponto = new Ponto();

    $dados = $cliente->BuscarDadosCliente($id_cliente);
    $retorno = $ponto->listarPontoCliente($id_cliente);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="my-8">
        <h1 class="text-dark font-weight-bolder">Cliente: </h1>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                <h3 class="font-weight-bolder">Detalhes:</h3>
                <div class="d-block mt-2">
                    <div class="d-flex">
                        <p>Nome: </p>
                        <span class="ml-2 font-weight-bolder"><?php echo $dados["ds_nome"] ?></span>
                    </div>
                    <div class="d-flex">
                        <p>Empresa: </p>
                        <span class=" ml-2 font-weight-bolder"><?php  echo $dados["ds_empresa"] ?></span>
                    </div>
                    <div class="d-flex">
                        <p>Contato: </p>
                        <span class=" ml-2 font-weight-bolder"><?php  echo $dados["nu_telefone"] ?></span>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Editar</button>
                </div>
                <div class="modal fade" id="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Cliente: <?php echo $dados["ds_nome"] ?></h5>
                            </div>
                            <div class="modal-body">
                                <form id="form_cliente">
                                    <div class="form-group col-md-3">
                                        <label>Nome: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ds_nome" name="ds_nome" value="<?php echo $dados['ds_nome']?>"/>
                                   </div>
                                    <div class="form-group col-md-3">
                                        <label>Empresa: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ds_empresa" name="ds_empresa" value="<?php echo $dados['ds_empresa']?>"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Contato: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nu_telefone" name="nu_telefone" value="<?php echo $dados['nu_telefone']?>"/>
                                    </div>
                                    <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente?>">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-6">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                <h3></h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white"  >
                <div class="card-body">
                    <table class="table table-hover" id="table_ponto">
                        <h3 class="font-weight-bolder">Seus Pontos:</h3>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Local</th>
                                <th>Data Inicial</th>
                                <th>Data Final</th>
                                <th>Lat/long</th>
                                <th>Ações</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                                while ($dados = $retorno->fetch())
                                {
                                    $dt_inicial = date('d/m/Y', strtotime($dados["dt_inicial"]));
                                    $dt_final = date('d/m/Y', strtotime($dados["dt_final"]));

                                    echo "<tr>
                                            <td>".$dados['id_ponto']."</td>
                                            <td>".$dados['ds_localidade']."</td>
                                            <td>".$dt_inicial."</td>
                                            <td>".$dt_final."</td>
                                            <td>".$dados['nu_localidade']."</td>
                                            <td nowrap></td>
                                        </tr>";
                                }
                            ?>
                            
                        </tbody>

                    </table>
                </div>
            </div>
            
        </div>
            
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appCliente/ver_cliente.js" type="text/javascript"></script>
</body>

</html>