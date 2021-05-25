$("body").on('click', 'a', function(event){

	if($(this).attr('href') == '#' || $(this).attr('target') == '_blank' || $(this).data('ajax') == false){
		return true;
	}
	if ($(this).attr('href') == 'appUsuario/logout.php')
	{
		location.href='appUsuario/logout.php';
		return false;
	}
	if ($(this).attr('href') == 'principal.php')
	{ 
		location.href='principal.php';
		return false;
	}

	if ($(this).attr('href').startsWith('paciente.php'))
	{
		var url = new URL($(this).attr('href').val());
		var id_paciente = url.searchParams.get("id_paciente");
		var ds_nome = url.searchParams.get("id_paciente");
		location.href='paciente.php?id_paciente='+id_paciente+'&ds_nome='+ds_nome;
		return false;
	}

	if ($(this).attr('href').startsWith('#kt_portlet_base_demo') )
	{
		return true;
	}


event.preventDefault();
redirectTo($(this).attr('href'));
});



function redirectTo(url, successCallback){
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'html',
	})
	.done(function(data) {
		$('#conteudo').html(data);
		/*if(!$("#kt_subheader").length)
		{
		$('#conteudo').css("margin-top", "-55px");  
		}
		$('#conteudo').css("margin-top", "-55px");*/


		
		if (typeof(successCallback) === "function") {
			successCallback();
		}
	})
	.fail(function(data) {
		
		if (data.status ==401)
		{
		window.location.href = "/index.php"; 
		}

		if (data.status ==500)
		{
		swal.fire("Erro", data.responseText, "error");
		}       
		
	});

}
const primary = '#6993FF';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';
var KTApexChartsDemo = function () {
	// Private functions 
	var _demo1 = function () {
		const apexChart = "#chart_1";
		var options = {
			series: [{
				name: "Desktops",
				data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
			}],
			chart: {
				height: 350,
				type: 'line',
				zoom: {
					enabled: false
				}
			},
			dataLabels: { 	
				enabled: false
			},
			stroke: {
				curve: 'straight'
			},
			grid: {
				row: {
					colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
					opacity: 0.5
				},
			},
			xaxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
			},
			colors: [primary]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}


	return {
		// public functions
		init: function () {
			_demo1();
		}
	};
}();

jQuery(document).ready(function () {
	KTApexChartsDemo.init();
});

var DatatablesBasicBasic = function() {

	var initTable1 = function() {
		var table = $('#table_ponto');

		// begin first table
		table.DataTable({
			responsive: true,
			retrieve: true, 
			

			//== DOM Layout settings
			dom: `f<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

			lengthMenu: [5, 10, 25, 50],

			pageLength: 10,

			language: {
				'lengthMenu': 'Mostrar _MENU_',
			},
			"oLanguage": {
			    "sSearch": "<span>Pesquisar:</span> _INPUT_",
			    "sLengthMenu": "<span>Mostrar:</span> _MENU_",
			    "sInfo": "<span>Mostrando </span>_START_ até _END_ de _TOTAL_",
			    "sZeroRecords": "Não existem dados cadastrados",
			    "sInfoEmpty": "<span>Mostrando </span>0 até 0 de 0",
			    "oPaginate": { "sFirst": "Primeira", "sLast": "Última", "sNext": ">", "sPrevious": "<" }
		    },

			//== Order settings
			order: [[1, 'asc']],


			columnDefs: [

				{ 
					targets: -1,
					title: 'Ações',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        
                         <a href="appPonto/ver_ponto.php?id_ponto=`+full[0]+`&id_tipo=`+full[1]+`"" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Visualizar Cadastro">
                          <i class="la la-edit"></i>
                        </a>
                        `;
					},
				},
				{
					targets: 0,
					visible: false
				},
				{
					targets: 1,
					visible: false
				},
				
				
			],
		});
	

		table.on('change', 'tbody tr .m-checkbox', function() {
			$(this).parents('tr').toggleClass('active');
		});	
		
	};


	return {

		//main function to initiate the module
		init: function() {
			initTable1();

		},

	};

}();

jQuery(document).ready(function() {
	DatatablesBasicBasic.init();
});


