$(document).ready(function() {
	    

	$("#salvar").on("click", function(e){ 
		if(validarCliente())
		{ 
			$.ajax({
		        url: 'appCliente/gravar_alterar_cliente.php'
				, data: $("#form_cliente").serialize()
		        , type: 'post'
		        , success: function(html) {
		        	swal.fire({
		                position: 'top-right',
		                type: 'success', 
		                title: html,
		                showConfirmButton: true
		            });		
					$('#modal').modal('hide'); 
					//redirectTo("appCliente/listar_cliente.php");   
		        }
				, error: function (data) {
					swal.fire("Erro", data.responseText, "error");
				}
		    });		
		}	
	});
});

$("#nu_telefone").inputmask({
	"mask": "(99)99999-9999",
	autoUnmask: false,
});
$("#nu_cnpj").inputmask({
	"mask": "99.999.999/9999-99",
	autoUnmask: false,
});
$("#nu_cep").inputmask({
	"mask": "99.999-999",
	autoUnmask: false,
});

function validarCliente()
{
	if($("#ds_nome").val() == "")
	{
		$("#ds_nome").focus();
		/*swal.fire("Erro", "Preencha a descrição", "error");*/
		$("#ds_nome").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#ds_nome").removeClass("is-invalid");	
		$("#ds_nome").addClass("is-valid");
	}
	if($("#ds_empresa").val() == "")
	{
		$("#ds_empresa").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#ds_empresa").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#ds_empresa").removeClass("is-invalid");	
		$("#ds_empresa").addClass("is-valid");
	}
	if($("#nu_telefone").val() == "")
	{
		$("#nu_telefone").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#nu_telefone").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#nu_telefone").removeClass("is-invalid");	
		$("#nu_telefone").addClass("is-valid");
	}
	if($("#ds_endereco").val() == "")
	{
		$("#ds_endereco").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#ds_endereco").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#ds_endereco").removeClass("is-invalid");	
		$("#ds_endereco").addClass("is-valid");
	}
	if($("#nu_cnpj").val() == "")
	{
		$("#nu_cnpj").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#nu_cnpj").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#nu_cnpj").removeClass("is-invalid");	
		$("#nu_cnpj").addClass("is-valid");
	}
	if($("#nu_cep").val() == "")
	{
		$("#nu_cep").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#nu_cep").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#nu_cep").removeClass("is-invalid");	
		$("#nu_cep").addClass("is-valid");
	}
	if($("#ds_email").val() == "")
	{
		$("#ds_email").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#ds_email").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#ds_email").removeClass("is-invalid");	
		$("#ds_email").addClass("is-valid");
	}

	return true;
}
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