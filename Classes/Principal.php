<?php
    require_once("Classe/conexao.php");
    class Cliente{
        public function gravarCliente(array $dados)
		{

			$ds_nome	    = $dados['ds_nome'];
			$ds_empresa	    = $dados['ds_empresa'];
			$nu_telefone	= $dados['nu_telefone'];

			
			try{
				$con = Conecta::criarConexao();
				$insert = "INSERT into tb_cliente (ds_descricao, ds_empresa, nu_telefone)
							VALUES (:ds_descricao, :ds_empresa, :nu_telefone)";
				
				$stmt = $con->prepare($insert);
				
				$params = array(':ds_nome' => $ds_nome,
								':ds_empresa' => $ds_empresa,
								':nu_telefone' => $nu_telefone,);
                                
				$stmt->execute($params);
				
				echo "Dados gravados com sucesso!"; 
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			} 
        }
        
    }



?>