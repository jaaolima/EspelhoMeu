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
    <div class="row">
        <div class="col-8">
            <div id="kt_calendar"></div>
        </div>
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appPonto/ver_ponto.js" type="text/javascript"></script>
</body>

</html>