<?php
    require_once("conexao.php");
    class Principal{
		public function listarOptionsCliente()
		{
			try{
				$con = Conecta::criarConexao();

				
				$select = "SELECT id_cliente, ds_nome
							FROM tb_cliente";
				
				$stmt = $con->prepare($select);
				$stmt->execute();

				$options = "<option value=''>Selecione..</option>";

				while($dados = $stmt->fetch())
				{
					$options.= "<option value='".$dados['id_cliente']."'>".$dados['ds_nome']."</option>";
				}
				return $options;

			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print $e->getMessage();
			}
		}
		public function listarPonto(array $dados)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade
							FROM tb_ponto p";
				
				$stmt = $con->prepare($select); 
				
				
				$stmt->execute();

				return $stmt;
				
					
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
        
    }



?>