<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("Classes/Principal.php");
	require_once("Classes/Ponto.php");

    $ponto = new Ponto(); 
    $Principal = new Principal();
    $retornoPonto = $ponto->listarMelhoresPonto($_POST);
    $listarCliente = $Principal->listarOptionsCliente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universo</title>
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />	
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

</head>
<body>
    <div class="w-100">
        <div class="row m-0 bg-dark h-auto p-0">
            <div>
                <ul class="nav nav-pills float-end mt-4" id="myTab" role="tablist">
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
            <div class="my-8">
                <h1 class="text-dark font-weight-bolder">Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <div id="chart_1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white " >
                        <div class="card-body">
                            <h3 class="font-weight-bolder">
                                Meus pontos
                            </h3>
                            <table class="table table-hover" id="table_ponto">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Local</th>
                                        <th>Lat/long</th>
                                        <th>Tipo</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                        while ($dados = $retornoPonto->fetch())
                                        {
                                            /*$id_status = $dados['id_status'];
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
                                            };*/
                                            $hoje = date('Y-m-d');
                                            
                                            if($hoje >= $dados["dt_inicial"] && $dados["dt_final"] >= $hoje){
                                                $status = "<span class='label label-xl label-dot label-danger'>";
                                            }
                                            if($hoje < $dados["dt_inicial"]){
                                                $status = "<span class='label label-xl label-dot label-warning'>";
                                            }
                                            if(empty($dados["dt_final"]) && empty($dados["dt_inicial"])){
                                                $status = "<span class='label label-xl label-dot label-success'>";
                                            }
                                            
                                            echo "<tr>
                                                    <td>".$dados['id_ponto']."</td>
                                                    <td>".$dados['ds_localidade']."</td>
                                                    <td>".$dados['nu_localidade']."</td>
                                                    <td>".$dados['ds_tipo']."</td>
                                                    <td class='d-flex'>".$status."</td>
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
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#8950FC", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#EEE5FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="assets/js/scripts.bundle2.min.js"></script>
    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/crud/datatables/basic/basic.js"></script>
    <!--end::Page Scripts-->
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/widgets.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/principal.js"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM&callback=initialize"></script>
    <script src="assets/plugins/custom/gmaps/gmaps.js"></script>
    <script src="./assets/js/appPonto/lista_ponto.js" type="text/javascript"></script>
    <!--end::Page Scripts-->
</body>

</html>