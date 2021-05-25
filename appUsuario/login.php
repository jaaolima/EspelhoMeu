<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("../Classes/Usuario.php");
	
	session_start();
	$usuario 		= new Usuario();
	$ds_usuario  	= $_REQUEST['ds_usuario'];
	$ds_senha  		= $_REQUEST['ds_senha'];
 
	$login 			= $usuario->validaLogin($ds_usuario, $ds_senha);
	
	if (empty($login))
	{
	    header('HTTP/1.1 401 Unauthorized', true, 401);
	    print "Usuário ou senha inválidos";
	}
	else 
	{
		$_SESSION['autenticado']    	= 'validado';
		$_SESSION['ds_nome']        	= $login['ds_nome'];
		$_SESSION['id_usuario']			= $login['id_usuario'];
		$_SESSION['ds_usuario']			= $login['ds_usuario'];
		$_SESSION['id_perfil']			= $login['id_perfil'];
		echo "Usuário autenticado";	
	}
	
?>