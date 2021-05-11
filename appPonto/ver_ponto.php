<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("../Classes/Ponto.php");
    require_once("../Classes/Bisemana.php");

    $bisemana = new Bisemana();
    $retorno = $bisemana->listarBisemana($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="my-8">
        <h1 class="text-dark font-weight-bolder">Ponto: </h1>
    </div>
    <div class="row"> 
        <div class="col-8">
            <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                <div id="kt_calendar"></div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                    <h3>Detalhes:</h3>
                </div>
            </div>
            <div class="row">
                <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                    <h3>Aluguel:</h3>
                    <p>Alugado por:</p>
                    <div class="text-right">
                       <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Adicionar Cliente</button>
                    </div>
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Adicionar Cliente</h5>
                                </div>
                                <div class="modal-body">
                                    <table  class="table table-hover" id="table_bisemana">
                                        <thead>
                                            <tr>
                                                <th>ID bisemanas</th>
                                                <th>Bisemanas Disponiveis</th>
                                                <th>Data Inicial</th>
                                                <th>Data Final</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($dados = $retorno->fetch())
                                                {
                                                    echo "<tr>
                                                            <td>".$dados['id_bisemana']."</td>
                                                            <td>".$dados['ds_bisemana']."</td>
                                                            <td>".$dados['dt_inicial']."</td>
                                                            <td>".$dados['dt_final']."</td>
                                                            <td><input value='".$dados['id_bisemana']."' type='checkbox'></td>
                                                            <td nowrap></td>
                                                        </tr>";
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex">
                                        <h4 class="mt-2 mr-4">Criar contrato padrão</h4>
                                        <span class="switch switch-icon">
                                            <label>
                                            <input type="checkbox" checked="checked" name="select"/>
                                            <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary">Adicionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/pages/features/calendar/background-events.js"></script>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appPonto/ver_ponto.js" type="text/javascript"></script>

</body>

</html>