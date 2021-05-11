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
        <div class="col-9 ">
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
                                    $id_status = $dados['id_status'];
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
                                    };
                                    echo "<tr>
                                            <td>".$dados['id_ponto']."</td>
                                            <td>".$dados['ds_localidade']."</td>
                                            <td>".$dados['nu_localidade']."</td>
                                            <td>".$status."</td>
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
    <script src="./assets/js/appPonto/lista_ponto.js" type="text/javascript"></script>
</body>

</html>