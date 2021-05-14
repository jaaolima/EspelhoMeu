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
    $alugado = $ponto->listarAlugado($id_ponto);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="my-8 d-flex">
        <h1 class="text-dark font-weight-bolder">Ponto:  </h1>
        <h1><?php echo $dadosPonto["ds_localidade"] ?></h1>
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
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Bisemanas</th>
                                <th>Data Final</th>
                                <th>Data Inicial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($dadosAlugado = $alugado->fetch())
                                {
                                    echo "<tr>
                                            <td>".$dadosAlugado['ds_nome']."</td>
                                            <td>".$dadosAlugado['ds_bisemana']."</td>
                                            <td>".$dadosAlugado['dt_final']."</td>
                                            <td>".$dadosAlugado['dt_inicial']."</td>
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
                                                                <td><input name='bisemana' id='bisemana' value='".$dados['id_bisemana']."' type='checkbox'></td>
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
    <script src="assets/js/pages/features/calendar/background-events.js"></script>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appPonto/ver_ponto.js" type="text/javascript"></script>
    <script type="text/javascript">
        var KTCalendarBasic = function() {

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
                        right: ''
                    },

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    //defaultView: 'resourceTimeline',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    businessHours: true, // display business hours
                    events: [
                    <?php 
                        while($dadosData = $retorno->fetch()){
                            echo "
                                {
                                    start: '".$dadosData["dt_inicial"]."',
                                    end: '".$dadosData["dt_final"]."',
                                    rendering: 'background',
                                    color: '#28a745' ,
                                },";

                        };

                    ?>
                    ],
                    /*eventRender: function(info) {
                        var element = $(info.el);

                        if (info.event.extendedProps, info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('&lt;div class="fc-description"&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('&lt;div class="fc-description"&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                            }
                        }
                    }*/
                });

                calendar.render();
            }
        };
        }();
        jQuery(document).ready(function() {
        KTCalendarBasic.init();
        });
    </script>
</body>

</html>