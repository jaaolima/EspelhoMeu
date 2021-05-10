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
                        
                         <a href="appCliente/alterar_cadastro.php?id_cliente=`+full[0]+`"" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Visualizar Cadastro">
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

		/*table.on('click', '#btn-frequencia', function() {
			
			var id_aula = $(this).data("aula");

			redirectTo("appDiario/cadastro_frequencia.php?id_aula="+id_aula);
			
		});*/

		table.on('click', '#btn-editar', function() {

			redirectTo("appPonto/alterar_cadastro");
			
		});

		/*table.on('click', '#btn-excluir', function() {
			var id_aula = $(this).data("aula");

			swal({
	            title: 'Tem certeza?',
	            text: "Desejar excluir a aula e todas as frequências associadas?",
	            type: 'warning',
	            showCancelButton: true,
	            confirmButtonText: 'Sim, posseguir!',
				cancelButtonText: 'Cancelar'
	        }).then(function(result) {
	            if (result.value) {
					$.ajax({
				        url: 'appDiario/excluir_aula.php'
				        , type: 'post'
				        , data: {id_aula : id_aula}
				        , success: function(html) {
							swal('Pronto!',html,'success');
							$.ajax({
						        url: 'appDiario/listar_aula.php'
						        , type: 'post'
						        , data: $("#busca_aula").serialize()
						        , success: function(html) {
						        	$("#lista").html(html);
						        }
						        , error: function(xhr, status, error) {
								  	swal("Erro", xhr.responseText, "error");
								}
						    });						
				        }
				    });
	                
	            }
	        });
			
		}); */
		
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