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
    <div class="w-100">
        <div class="container" id="conteudo">
            <div>
                <h1 class="text-dark">Meus pontos</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 mt-5">
                    <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white"  >
                        <div class="card-body">
                            <table class="table table-hover" id="table_ponto">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Local</th>
                                        <th>Lat/long</th>
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
    <script src="./assets/js/lista_ponto.js" type="text/javascript"></script>
</body>

</html>