
$(document).ready(function() {
	    
	$("#adicionar").on("click", function(e){ 
		$.ajax({
			url: 'appPonto/gravar_alugado.php'
			, data: $("#form_bisemana").serialize()
			, type: 'post'
			, success: function(html) {
				swal.fire({
					position: 'top-right',
					type: 'success',
					title: html,
					showConfirmButton: true
				});
				$('#modal').modal('hide');

							
			}
			, error: function (data) {
				swal.fire("Erro", data.responseText, "error");
			}
		});		
	
	});
	
});
$(document).ready(function() {
	    
	$("#salvar").on("click", function(e){ 
		if(validarPonto())
		{ 
			$.ajax({
		        url: 'appPonto/gravar_alterar_ponto.php'
				, data: $("#form_ponto").serialize()
		        , type: 'post'
		        , success: function(html) {
		        	swal.fire({
		                position: 'top-right',
		                type: 'success',
		                title: html,
		                showConfirmButton: true
		            });
                    $('#modalCadastro').modal('hide');
					          
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
		var table = $('#table_bisemana');

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

			//== Order settings
			order: [[1, 'asc']],


			columnDefs: [

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
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	DatatablesBasicBasic.init();
});