
$(document).ready(function() {
	    

	$("#salvarCliente").on("click", function(e){ 
		if(validarCliente())
		{ 
			$.ajax({
		        url: 'appCliente/gravar_cliente.php'
				, data: $("#form_cliente").serialize()
		        , type: 'post'
		        , success: function(html) {
		        	swal.fire({
		                position: 'top-right',
		                type: 'success',
		                title: html,
		                showConfirmButton: true
		            });		
					$('#modalCliente').modal('hide');            
		        }
				, error: function (data) {
					swal.fire("Erro", data.responseText, "error");
				}
		    });		
		}	
	});
	$("#salvarPonto").on("click", function(e){ 
		if(validarPonto())
		{ 
			$.ajax({
		        url: 'appPonto/gravar_ponto.php'
				, data: $("#form_ponto").serialize()
		        , type: 'post'
		        , success: function(html) {
		        	swal.fire({
		                position: 'top-right',
		                type: 'success',
		                title: html,
		                showConfirmButton: true
		            });		
					$('#modalPonto').modal('hide');            
		        }
				, error: function (data) {
					swal.fire("Erro", data.responseText, "error");
				}
		    });		
		}	
	});
	
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

	
	
	

	return true;
}
function validarPonto()
{
	if($("#ds_localidade").val() == "")
	{
		$("#ds_localidade").focus();
		/*swal.fire("Erro", "Preencha a descrição", "error");*/
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
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#nu_localidade").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#nu_localidade").removeClass("is-invalid");	
		$("#nu_localidade").addClass("is-valid");
	}
	if($("#id_cliente").val() == "")
	{
		$("#id_cliente").focus();
		//swal.fire("Erro", "Preencha a descrição", "error");
		$("#id_cliente").addClass("is-invalid");
		return false;	
	}
	else
	{
		$("#id_cliente").removeClass("is-invalid");	
		$("#id_cliente").addClass("is-valid");
	}

	
	
	

	return true;
}

$(document).ready(function() {
    $('#table').DataTable();
} );