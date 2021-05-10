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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universo</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script scr="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="js/sweetalert.js"></script>


</head>
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
    <script src="../assets/js/lista_ponto.js" type="text/javascript"></script>
</body>

</html>