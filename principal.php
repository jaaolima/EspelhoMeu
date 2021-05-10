<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("Classes/Principal.php");

    $Principal = new Principal();
    $listarCliente = $Principal->listarOptionsCliente();
    $retorno = $Principal->listarPonto($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universo</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script scr="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="assets/js/sweetalert.js"></script>


</head>
<body>
    <div class="w-100">
        <div class="row m-0 bg-dark h-auto p-0">
            <div>
                <ul class="nav nav-tabs float-end mt-4">
                <li class="nav-item mr-2">
                        <a href="principal.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="appPonto/listar_ponto.php" class="nav-link">Meus Pontos</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="appCliente/listar_cliente.php" class="nav-link">Meus Clientes</a>
                    </li>
                </ul>
            </div>   
        </div>
        <div class="container" id="conteudo">
            <div>
                <h1 class="text-dark">Dashboard</h1>
            </div>
        </div>       
    </div>
    <!-- Importando o jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Importando o Datatable-->
    <link href="./assets/css/datatables.min.css" rel="stylesheet" type="text/css" />
    <script scr="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/principal.js" type="text/javascript"></script>

    <!-- Importando o js do bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
</body>

</html>