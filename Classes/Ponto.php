<?php
    require_once("conexao.php");
    class Ponto{
		public function gravarPonto()
		{

			$ds_localidade	    = $_POST['ds_localidade'];
			$nu_localidade	    = $_POST['nu_localidade'];
			$id_cliente			= $_POST['id_cliente'];

			
			try{
				$con = Conecta::criarConexao();
				$insert = "INSERT into tb_ponto (ds_localidade, nu_localidade, id_cliente)
							VALUES (:ds_localidade, :nu_localidade, :id_cliente)";
				
				$stmt = $con->prepare($insert);
				
				$params = array(':ds_localidade' => $ds_localidade,
								':nu_localidade' => $nu_localidade,
								':id_cliente' => $id_cliente);
                                
				$stmt->execute($params);
				
				echo "Dados gravados com sucesso!"; 
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			} 
        }
		public function listarPonto(array $dados)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_status
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
		public function listarPontoCliente($id_cliente)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT id_ponto, ds_localidade, nu_localidade, id_status
							FROM tb_ponto ";
				
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