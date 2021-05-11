<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("../Classes/Cliente.php");
	require_once("../Classes/Ponto.php");

    $ponto = new Ponto();
    $retorno = $ponto->listarPonto($_POST);
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
                <h3>Detalhes:</h3>
                <div class="d-block mt-2">
                    <p>Nome:</p>
                    <p>Empresa:</p>
                    <p>Contato:</p>
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
        <div class="col-9">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white"  >
                <div class="card-body">
                    <table class="table table-hover" id="table_ponto">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Local</th>
                                <th>Lat/long</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                                while ($dados = $retorno->fetch())
                                {
                                    echo "<tr>
                                            <td>".$dados['id_ponto']."</td>
                                            <td>".$dados['ds_localidade']."</td>
                                            <td>".$dados['nu_localidade']."</td>
                                            <td><span class='label label-xl label-dot label-success'></span></td>
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
                        <span class="label label-xl label-dot label-success"></span>
                    </div>
                    <div class="my-2">
                        <p style="display:contents;">Alugado para depois:</p>
                        <span class="label label-xl label-dot label-warning"></span>
                    </div>
                    <div class="my-2">
                        <p style="display:contents;">Não alugado:</p>
                        <span class="label label-xl label-dot label-danger"></span>
                    </div>
                    
                </div>
            </div>
        </div>
            
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appCliente/ver_cliente.js" type="text/javascript"></script>
</body>

</html>