<?php
	require_once("Conecta.php");

	class Usuario{
		function validaLogin($ds_usuario, $ds_senha)
		{
			try{
				$con = Conecta::criarConexao();
				//*$ds_senha = hash("SHA512", $ds_senha);
				
				$select = "SELECT 
							id_usuario, ds_usuario, ds_nome, id_perfil
						FROM tb_usuario  
						WHERE ds_usuario = :ds_usuario and ds_senha = :ds_senha";

				$stmt = $con->prepare($select);
			   	$params = array(':ds_usuario' => $ds_usuario,
			   					':ds_senha' => $ds_senha);
			   
			    $stmt->execute($params);
 
			    return  $stmt->fetch();
				
			}	
			catch(Exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();	
			} 
		}


	}

?>