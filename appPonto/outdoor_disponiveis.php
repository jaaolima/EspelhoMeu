<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once("../Classes/Ponto.php");

    $ponto = new Ponto(); 
    $retornoOutdoor = $ponto->listarOutdoor($_POST);

    $mpdf = new \Mpdf\Mpdf();
    $pagina = "";
    while($dados = $retornoOutdoor->fetch())
    {    
        $pagina .= "<html><h1 style='text-align: center;'>"
                            .$dados["ds_localidade"].
                        "</h1><div><img src='' alt=''></div><div style='text-align: end;'><p>Latitude/longitude:"
                            .$dados["nu_localidade"].
                        "</p><p>Sentido:"
                            .$dados["ds_sentido"].
                        "</p><p>Valor:"
                            .$dados["nu_valor_ponto"].
                        "</p></div></html><div style=' height: 0;margin: 0.5rem 0;overflow: hidden;border-top: 1px solid #000000;'></div>";
    }
    $mpdf->WriteHTML($pagina);
    return $mpdf->Output($pagina, 'I');
?> 