

$(document).ready(function() {
	$("#entrar").on("click", function(e){
		e.preventDefault();
		if (validar())
		{
			var ds_usuario 	= $('#ds_usuario').val();
			var ds_senha    = $('#ds_senha').val();
			
			$.ajax({
				url: 'appUsuario/login.php'
				, type:'post'
				, data:{ ds_usuario : ds_usuario, ds_senha : ds_senha}
				, success: function(xhr) {
					$(location).attr('href', 'principal.php');  
				},
				error: function(data){
					swal.fire("Erro", data.responseText, "error");	
				}
			});
		}
	});	

	/*$("#cancelar").on("click", function(){
		$('#form_esqueci_senha').trigger("reset");
        redirectTo("index.php");
	});*/


	
	$("#resetar").on("click", function(e){
		e.preventDefault();
		if ($("#ds_email_resetar").val() == "")
		{
			$("#ds_email_resetar").focus();
			//swal("Erro", "Preencha o Email", "error");
			alert('preencha o email');
		}
		else
		{
			$.ajax({
		        url: 'appUsuario/gravar_resetar_senha_inicial.php'
		        , type: 'post'
		        , data: $("#form_esqueci_senha").serialize()
		        , success: function(html) {
		        	/*swal({
		                position: 'top-right',
		                type: 'success',
		                title: html,
		                showConfirmButton: true
					});*/
					alert(html);
					$('#form_esqueci_senha').trigger("reset");
					
					/*var login = $('#m_login');
					login.removeClass('m-login--forget-password');
					login.removeClass('m-login--signup');

					login.addClass('m-login--signin');
					mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');*/
		            
		        }
		        , error: function(xhr, status, error) {
				  	swal("Erro", xhr.responseText, "error");
				}
		    });
			
		}

	});
});

function validar()
{
	
	if ($("#ds_usuario").val() == "")
	{
		$("#ds_usuario").focus();
		swal.fire("Erro", "Preencha o Usuário", "error");
		return false;	
	}
	
	if ($("#ds_senha").val() == "")
	{
		$("#ds_senha").focus();
		swal.fire("Erro", "Preencha a senha", "error");
		return false;	
	}
	
	return true;
	
}