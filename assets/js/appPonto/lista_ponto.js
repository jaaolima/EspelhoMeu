$(document).ready(function() {
	    
	$("#salvarPonto").on("click", function(e){ 
		if(validarPonto())
		{ 
			$.ajax({
		        url: 'appPonto/gravar_ponto.php'
				, data: $("#form_ponto").serialize()
		        , type: 'post'
		        , success: function sucesso(html) {

					function fecharmodal(){
						$('#modal').modal('hide');  
						swal.fire({
							position: 'top-right',
							type: 'success',
							title: html,
							showConfirmButton: true
		            	});
						return true;
					}
		        	if(fecharmodal()){
						/*redirectTo("appPonto/listar_ponto.php")*/
					}
		        }
				
				, error: function (data) {
					swal.fire("Erro", data.responseText, "error");
				}
		    });		
		}	
	});
	
});

$("#nu_localidade").inputmask({
	"mask": "99.9999/99.9999",
	autoUnmask: false,
});


function validarPonto()
{
	if($("#ds_localidade").val() == "")
	{
		$("#ds_localidade").focus();
		swal.fire("Erro", "Preencha a descrição", "error");
		$("#ds_localidade").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#ds_localidade").removeClass("is-invalid");	
		$("#ds_localidade").addClass("is-valid");
	}
	if($("#nu_localidade").val() == "")
	{
		$("#nu_localidade").focus();
		swal.fire("Erro", "Preencha a descrição", "error");
		$("#nu_localidade").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#nu_localidade").removeClass("is-invalid");	
		$("#nu_localidade").addClass("is-valid");
	}
	if($("#id_tipo option:selected").val() == "")
	{
		$("#id_tipo").focus();
		swal.fire("Erro", "Preencha a descrição", "error");
		$("#id_tipo").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#id_tipo").removeClass("is-invalid");	
		$("#id_tipo").addClass("is-valid");
	}

	return true;
}
var DatatablesBasicBasic = function() {

	var initTable1 = function() {
		var table = $('#table_outdoor');

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
                        
                         <a href="appPonto/ver_ponto.php?id_ponto=`+full[0]+`&id_tipo=1"" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Visualizar Cadastro">
                          <i class="la la-edit"></i>
                        </a>
                        `;
					},
				},
				{
					targets: 0,
					visible: false
				},
				
				
			],
		});
	

		table.on('change', 'tbody tr .m-checkbox', function() {
			$(this).parents('tr').toggleClass('active');
		});	
		
	};

	var initTable2 = function() {
		var table = $('#table_front');

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
                        
                         <a href="appPonto/ver_ponto.php?id_ponto=`+full[0]+`&id_tipo=2"" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Visualizar Cadastro">
                          <i class="la la-edit"></i>
                        </a>
                        `;
					},
				},
				{
					targets: 0,
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
			initTable1(),
			initTable2();
		},

	};

}();

jQuery(document).ready(function() {
	DatatablesBasicBasic.init();
});