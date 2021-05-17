<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);

	require_once("../Classes/Ponto.php");
    require_once("../Classes/Bisemana.php");
    require_once("../Classes/Cliente.php");

    $id_ponto = $_REQUEST["id_ponto"];

    $bisemana = new Bisemana();
    $cliente = new cliente();
    $ponto = new Ponto();

    $dadosPonto = $ponto->BuscarDadosPonto($id_ponto);
    $listarCliente = $cliente->listarOptionsCliente();
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
            <div class="row">
                <div class="card card-custom w-100 bgi-no-repeat bgi-size-cover gutter-b bg-white p-8" >
                    <h3 class="font-weight-bolder">Detalhes:</h3>
                    <div class="d-block mt-2">
                        <div class="d-flex">
                            <p>Local: </p>
                            <span class="ml-2 font-weight-bolder"><?php echo $dadosPonto["ds_localidade"] ?></span>
                        </div>
                        <div class="d-flex">
                            <p>Latitude/longitude: </p>
                            <span class=" ml-2 font-weight-bolder"><?php  echo $dadosPonto["nu_localidade"] ?></span>
                        </div>
                        <div class="d-flex">
                            <p>Tipo: </p>
                            <span class=" ml-2 font-weight-bolder"><?php  echo $dadosPonto["ds_tipo"] ?></span>
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
                                            <label>Latitude/longitude: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nu_localidade" name="nu_localidade" value="<?php echo $dadosPonto['nu_localidade']?>"/>
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
                                <th>Bisemanas</th>
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
                                            <td>".$dadosAlugado['ds_bisemana']."</td>
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
                                        <div class="col-4 mb-4">
                                            <label>Cliente:</label>
                                            <select class="form-control" name="id_cliente" id="id_cliente">
                                                <?php echo $listarCliente ?>
                                            </select>
                                        </div>
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
                        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                        isRTL: KTUtil.isRTL(),
                        header: {
                            left: 'prev,next today',
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

                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        navLinks: true,
                        businessHours: true, // display business hours
                        events: [
                            <?php


                                while($dadosData = $retornoData->fetch()){
                                    
                                    
                                    /*var_export($dadosData);*/
                                    echo "
                                        {
                                            title: '".$dadosData["ds_empresa"]."',
                                            start: '".$dadosData["dt_inicial"]."',
                                            end: '".$dadosData["dt_final"]."' + 'T17:30:00',
                                            backgroundColor: '#28a745',
                                            redering: 'background'
                                            
                                        },";
                                    /*if($dadosData[0]["dt_inicial"] == $dadosData["dt_inicial"]){
                                        echo "
                                        {
                                            start: '".$dadosData["dt_inicial"]."',
                                            end: '".$dadosData["dt_final"]."',
                                            color: '#28a745' ,
                                        },";
                                    }
                                    else{
                                        echo "
                                        {
                                            start: '".$dadosData["dt_inicial"]."',
                                            end: '".$dadosData["dt_final"]."',
                                            color: '#FFA800' ,
                                        },";
                                    }*/
                                    

                                };


                            ?>
                        ],

                        eventRender: function(info) {
                            var element = $(info.el);

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
                        }
                    });

                    calendar.render();
                }
            };
            }();

            jQuery(document).ready(function() {
            KTCalendarBackgroundEvents.init();
            });
    </script>
</body>

</html>