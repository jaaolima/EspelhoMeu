<?php
    require_once("conexao.php");
    class Bisemana{
        public function listarBisemana(array $dados)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT id_bisemana, ds_bisemana, dt_final, dt_inicial
							FROM tb_bisemana";
				
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