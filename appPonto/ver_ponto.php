<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);

	require_once("../Classes/Ponto.php");
    require_once("../Classes/Bisemana.php");
    require_once("../Classes/Cliente.php");

    $id_ponto = $_REQUEST["id_ponto"];
    $id_tipo = $_REQUEST["id_tipo"];

    $bisemana = new Bisemana();
    $cliente = new cliente();
    $ponto = new Ponto();

    $dadosPonto = $ponto->BuscarDadosPonto($id_ponto);
    $listarEmpresa = $cliente->listarOptionsEmpresa();
    $retorno = $bisemana->listarBisemana($id_ponto);
    $retornoData = $ponto->listarAlugado($id_ponto);
    $alugado = $ponto->listarAlugado($id_ponto);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="my-8 d-flex">
        <h1 class="text-dark font-weight-bolder mr-3">Ponto:  </h1>
        <h2 class="mt-5"><?php echo $dadosPonto["ds_localidade"] ?></h2>
    </div>
    <div class="row"> 
        <div class="col-8">
            <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                <div id="calendario"></div>
            </div>
        </div>
        <div class="col-4">
            <!--<div class="row">
                <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                    <div id="mapa" style="height:150px;"></div>
                </div>
            </div> -->
            <div class="row">   
                <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                    <h3 class="font-weight-bolder">Detalhes:</h3>
                    <div class="d-block mt-2">
                        <div class="d-flex">
                            <p>Local: </p>
                            <span class="ml-2 font-weight-bolder"><?php echo $dadosPonto["ds_localidade"] ?></span>
                        </div>
                        <div class="d-flex">
                            <p>Sentido: </p>
                            <span class="ml-2 font-weight-bolder"><?php echo $dadosPonto["ds_sentido"] ?></span>
                        </div>
                        <div class="d-flex">
                            <p>Latitude/longitude: </p>
                            <span class=" ml-2 font-weight-bolder"><?php  echo $dadosPonto["nu_localidade"] ?></span>
                        </div>
                        <div class="d-flex">
                            <p>Tipo: </p>
                            <span class=" ml-2 font-weight-bolder"><?php  echo $dadosPonto["ds_tipo"] ?></span>
                        </div>
                        <div class="d-flex">
                            <p>Valor: </p>
                            <span class=" ml-2 font-weight-bolder"><?php  echo $dadosPonto["nu_valor_ponto"] ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Editar</button>
                    </div>
                    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Cliente: <?php echo $dadosPonto["ds_localidade"] ?></h5>
                                </div>
                                <div class="modal-body">
                                    <form id="form_ponto">
                                        <div class="form-group col-md-3">
                                            <label>Local: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ds_localidade" name="ds_localidade" value="<?php echo $dadosPonto['ds_localidade']?>"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Sentido: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ds_sentido" name="ds_sentido" value="<?php echo $dadosPonto['ds_sentido']?>"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Latitude/longitude: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nu_localidade" name="nu_localidade" value="<?php echo $dadosPonto['nu_localidade']?>"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Valor: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nu_valor_ponto" name="nu_valor_ponto" value="<?php echo $dadosPonto['nu_valor_ponto']?>"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Tipo: <span class="text-danger">*</span></label>
                                            <select class="form-control" name="id_tipo" id="id_tipo">
                                                <option  value="">Selecione...</option>
                                                <option  value="1" <?php if ($dadosPonto['id_tipo'] == '1') echo "selected" ?>>Outdoor</option>
                                                <option  value="2" <?php if ($dadosPonto['id_tipo'] == '2') echo "selected" ?>>Front-light</option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="id_ponto" name="id_ponto" value="<?php echo $id_ponto?>">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                    <h3 class="font-weight-bolder">Aluguel:</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Data Inicial</th>
                                <th>Data Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($dadosAlugado = $alugado->fetch())
                                {
                                    $dt_inicial = date('d/m/Y', strtotime($dadosAlugado["dt_inicial"]));
                                    $dt_final = date('d/m/Y', strtotime($dadosAlugado["dt_final"]));

                                    echo "<tr>
                                            <td>".$dadosAlugado['ds_empresa']."</td>
                                            <td>".$dt_inicial."</td>
                                            <td>".$dt_final."</td>
                                        </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-right mt-2">
                       <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Adicionar Cliente</button>
                    </div>
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Adicionar Cliente</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="form_bisemana">
                                        <div class="row">
                                            <div class="col-4">
                                                <label>Cliente:<span class="text-danger">*</span></label>
                                                <select class="form-control" name="id_cliente" id="id_cliente">
                                                    <?php echo $listarEmpresa ?>
                                                </select>
                                            </div>
                                            <div class="col-4 ">
                                                <label >Valor total contratado:<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="nu_valor" id="nu_valor">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_tipo" id="id_tipo" value="1">
                                        <?php if($id_tipo == 1) : ?>
                                        <table  class="table table-hover" id="table_bisemana">
                                            <thead>
                                                <tr>
                                                    <th>ID bisemanas</th>
                                                    <th>Bisemanas Disponiveis</th>
                                                    <th>Data Inicial</th>
                                                    <th>Data Final</th>
                                                    <th>Selecione</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while ($dados = $retorno->fetch())
                                                    {

                                                        $dt_inicial = date('d/m/Y', strtotime($dados["dt_inicial"]));
                                                        $dt_final = date('d/m/Y', strtotime($dados["dt_final"]));


                                                        echo "<tr>
                                                                <td>".$dados['id_bisemana']."</td>
                                                                <td>".$dados['ds_bisemana']."</td>
                                                                <td>".$dt_inicial."</td>
                                                                <td>".$dt_inicial."</td>
                                                                <td><input name='bisemana[]' id='bisemana' value='".$dados['id_bisemana']."' type='checkbox'></td>
                                                            </tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php endif; ?>
                                        <?php if($id_tipo == 2) : ?>
                                        <input type="hidden" name="id_tipo" id="id_tipo" value="2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label >Data de Inicio:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="dt_inicial" id="dt_inicial">
                                            </div>
                                        </div>
                                        <table  class="table table-hover" id="table_mes">
                                            <thead>
                                                <tr>
                                                    <th>Meses</th>
                                                    <th>Selecione</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td >1 mês</td>
                                                    <td><input name="meses" id="meses" value="1" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>2 meses</td>
                                                    <td><input name="meses" id="meses" value="2" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>3 meses</td>
                                                    <td><input name="meses" id="meses" value="3" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>4 meses</td>
                                                    <td><input name="meses" id="meses" value="4" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>5 meses</td>
                                                    <td><input name="meses" id="meses" value="5" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>6 meses</td>
                                                    <td><input name="meses" id="meses" value="6" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>7 meses</td>
                                                    <td><input name="meses" id="meses" value="7" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>8 meses</td>
                                                    <td><input name="meses" id="meses" value="8" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>9 meses</td>
                                                    <td><input name="meses" id="meses" value="9" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>10 meses</td>
                                                    <td><input name="meses" id="meses" value="10" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>11 meses</td>
                                                    <td><input name="meses" id="meses" value="11" type="radio"/></td>
                                                </tr>
                                                <tr>
                                                    <td>12 meses</td>
                                                    <td><input name="meses" id="meses" value="12" type="radio"/></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php endif; ?>
                                        <div class="d-flex">
                                            <h4 class="mt-2 mr-4">Criar contrato padrão</h4>
                                            <span class="switch switch-icon">
                                                <label>
                                                <input type="checkbox" name="select"/>
                                                <span></span>
                                                </label>
                                            </span>
                                        </div>
                                        <input name="id_ponto" id="id_ponto" type="hidden" value="<?php echo $dadosPonto["id_ponto"] ?>">
                                        
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="button" id="adicionar" class="btn btn-primary">Adicionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appPonto/ver_ponto.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/leaflet/leaflet.bundle.js"></script>
	<script src="assets/js/pages/features/maps/leaflet.js"></script>
    <script type="text/javascript">
        var KTCalendarBackgroundEvents = function() {

            return {
                //main function to initiate the module
                init: function() {
                    var todayDate = moment().startOf('day');
                    var YM = todayDate.format('YYYY-MM');
                    var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                    var TODAY = todayDate.format('YYYY-MM-DD');
                    var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                    var calendarEl = document.getElementById('calendario');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: 'pt-br',
                        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                        isRTL: KTUtil.isRTL(),
                        header: {
                            left: '',
                            right: 'prev,next today',
                            center: 'title',
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                        nowIndicator: true,
                        now: TODAY + 'T09:25:00', // just for demo

                        views: {
                            dayGridMonth: { buttonText: 'month' },
                            timeGridWeek: { buttonText: 'week' },
                            timeGridDay: { buttonText: 'day' }
                        },

                        defaultView: 'dayGridMonth',
                        defaultDate: TODAY,
                        eventLimit: true, // allow "more" link when too many events
                        businessHours: true, // display business hours
                        events: [
                            <?php


                                while($dadosData = $retornoData->fetch()){
                                    
                                    $dt_final = date('Y-m-d', strtotime("+1 days",strtotime($dadosData["dt_final"]))); 
                                    $hoje = date('Y-m-d');
                                    
                                    /*if($hoje >= $dadosData["dt_inicial"] && $dadosData["dt_final"] >= $hoje){
                                        echo "
                                        {
                                            start: '".$dadosData["dt_inicial"]."',
                                            end: '".$dt_final."',
                                            color: '#7E8299' ,
                                            rendering: 'background'
                                            
                                        },";
                                    }
                                    else{
                                        echo "
                                        {

                                            start: '".$dadosData["dt_inicial"]."',
                                            end: '".$dt_final."',
                                            color: '#FFA800' ,
                                            rendering: 'background'
                                            
                                        },";
                                    }*/
                                    if($hoje >= $dadosData["dt_inicial"] && $dadosData["dt_final"] >= $hoje){
                                        echo "
                                        {
                                            title: '".$dadosData["ds_empresa"]."',
                                            start: '".$dadosData["dt_inicial"]."',
                                            description: '".$dadosData["dt_inicial"]."'/'".$dt_final."',
                                            className: 'fc-event-success fc-event-solid',
                                            end: '".$dt_final."',
                                            
                                        },";
                                    }
                                    else{
                                        echo "
                                        {
                                            title: '".$dadosData["ds_empresa"]."',
                                            start: '".$dadosData["dt_inicial"]."',
                                            description: '".$dadosData["dt_inicial"]."'/'".$dt_final."',
                                            end: '".$dt_final."',
                                            className: 'fc-event-warning fc-event-solid',

                                            
                                        },";
                                    }
                                    $hoje = date('Y-m-d');
                                    echo "
                                    {
                                        start: '".$hoje."',
                                        color: '#1e8fff8a' ,
                                        rendering: 'background'
                                        
                                    },";
                                    

                                };


                            ?>
                        ],
                        /*eventBackgroundColor: '#46454565' ,
                        eventTextColor: 'white' ,*/
                        eventBorderColor: 'black',
                        

                        eventRender: function(info) {
                            var element = $(info.el);
                            var elementV = info.el;

                           if (info.event.extendedProps && info.event.extendedProps.description) {
                                if (element.hasClass('fc-day-grid-event')) {
                                    element.data('content', info.event.extendedProps.description);
                                    element.data('placement', 'top');
                                    KTApp.initPopover(element);
                                } else if (element.hasClass('fc-time-grid-event')) {
                                    element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                    element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                                }
                            }
                            var event = info.event;
                            if (event.rendering == "background") {
                                elementV.append(event.title);
                            }
                        },
                    });

                    calendar.render();
                }
            };
            }();

            jQuery(document).ready(function() {
            KTCalendarBackgroundEvents.init();
            });

            // Class definition
            var KTLeaflet = function () {

                // Private functions
                /*var demo1 = function () {
                    // define leaflet
                    var leaflet = L.map('mapa', {
                        center: [-37.8179793, 144.9671293],
                        zoom: 11
                    });

                    // set leaflet tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(leaflet);

                    // set custom SVG icon marker
                    var leafletIcon = L.divIcon({
                        html: `<span class="svg-icon svg-icon-danger svg-icon-3x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
                        bgPos: [10, 10],
                        iconAnchor: [20, 37],
                        popupAnchor: [0, -37],
                        className: 'leaflet-marker'
                    });

                    // bind marker with popup
                    var marker = L.marker([-37.8179793, 144.9671293], { icon: leafletIcon }).addTo(leaflet);
                    marker.bindPopup("<b>Flinder's Station</b><br/>Melbourne, Victoria").openPopup();
                }

                return {
                    // public functions
                    init: function () {
                        // default charts
                        demo1();
                    }
                };*/
            }();

            jQuery(document).ready(function () {
                KTLeaflet.init();
            });
    </script>
</body>

</html>