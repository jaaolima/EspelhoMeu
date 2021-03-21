
$(document).ready(function() {
	    

	$("#salvarCliente").on("click", function(e){ 
		if(validar())
		{ 
			$.ajax({
		        url: 'appCliente/gravar_cliente.php'
				, data: $("#form_usuario").serialize()
		        , type: 'post'
		        , success: function(html) {
		        	/*swal.fire({
		                position: 'top-right',
		                type: 'success',
		                title: html,
		                showConfirmButton: true
		            });*/
		            
					redirectTo("./principal.php");
		        }
				, error: function (data) {
					//swal.fire("Erro", data.responseText, "error");
				}
		    });		
		}	
	});
});

function validar()
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