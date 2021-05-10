<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("../Classes/Cliente.php");

    $cliente = new Cliente();
    $retorno = $cliente->listarCliente($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="w-100">
        <div class="container" id="conteudo">
            <div>
                <h1 class="text-dark">Meus Clientes</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 mt-5">
                    <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white"  >
                        <div class="card-body">
                            <table class="table table-hover" id="table_cliente">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Empresa</th>
                                        <th>Ações</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                        while ($dados = $retorno->fetch())
                                        {
                                            echo "<tr>
                                                    <td>".$dados['id_cliente']."</td>
                                                    <td>".$dados['ds_nome']."</td>
                                                    <td>".$dados['ds_empresa']."</td>
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
        </div>       
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/lista_cliente.js" type="text/javascript"></script>
</body>

</html>