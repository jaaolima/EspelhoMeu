<?php
    require_once("conexao.php");
    class Bisemana{
        public function listarBisemana($id_ponto)
		{
			$hoje = date('Y/m/d');
			try{
				$con = Conecta::criarConexao();
				
				/*$selectBisemana = "SELECT id_bisemana from tb_alugado where id_ponto=:id_ponto";
				$stmtBisemana = $con->prepare($selectBisemana); 
				$paramsBisemana = array(':id_ponto' => $id_ponto);

				$stmtBisemana->execute($paramsBisemana);

				/*$array = explode(',', $stmtBisemana);

				echo $array;*/
				
				$select = "SELECT id_bisemana, ds_bisemana, dt_final, dt_inicial
							FROM tb_bisemana
							where dt_final > :hoje
							and id_bisemana not in (select id_bisemana from tb_alugado where id_ponto=:id_ponto)";
				
				$stmt = $con->prepare($select); 
				$params = array(':hoje' => $hoje,
								':id_ponto' => $id_ponto);
				
				$stmt->execute($params);

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