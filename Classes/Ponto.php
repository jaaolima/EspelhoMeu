<?php
    require_once("conexao.php");
    class Ponto{
		public function gravarPonto()
		{

			$ds_localidade	    = $_POST['ds_localidade'];
			$nu_localidade	    = $_POST['nu_localidade'];
			$id_tipo			= $_POST['id_tipo'];

			
			try{
				$con = Conecta::criarConexao();
				$insert = "INSERT into tb_ponto (ds_localidade, nu_localidade, id_tipo)
							VALUES (:ds_localidade, :nu_localidade, :id_tipo)";
				
				$stmt = $con->prepare($insert);
				
				$params = array(':ds_localidade' => $ds_localidade,
								':nu_localidade' => $nu_localidade,
								':id_tipo' => $id_tipo);
                                
				$stmt->execute($params);
				
				echo "Dados gravados com sucesso!"; 
				
			}
			catch(exception $e) 
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			} 
        }
		public function listarOutdoor(array $dados) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_tipo, min(b.dt_inicial) as dt_inicial, b.dt_final, b.id_bisemana
							FROM tb_ponto p
							left join tb_alugado a on p.id_ponto=a.id_ponto
							left join tb_bisemana b on a.id_bisemana=b.id_bisemana
							where (b.dt_final > :hoje or not exists(select a.id_ponto from tb_alugado a where a.id_ponto=p.id_ponto ) ) and id_tipo = 1 
							group by p.id_ponto
							";
							
				$stmt = $con->prepare($select); 
				$params = array(':hoje' => date('Y-m-d'));
				
				$stmt->execute($params);

				return $stmt;
				
					 
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
		public function listarFront(array $dados) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_tipo, min(b.dt_inicial) as dt_inicial, b.dt_final, b.id_bisemana
							FROM tb_ponto p
							left join tb_alugado a on p.id_ponto=a.id_ponto
							left join tb_bisemana b on a.id_bisemana=b.id_bisemana
							where (b.dt_final > :hoje or not exists(select a.id_ponto from tb_alugado a where a.id_ponto=p.id_ponto ) ) and id_tipo = 2
							group by p.id_ponto
							";
							
				$stmt = $con->prepare($select); 
				$params = array(':hoje' => date('Y-m-d'));
				
				$stmt->execute($params);

				return $stmt;
				
					 
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}


		public function listarMelhoresPonto(array $dados) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select =	"SELECT p.id_ponto, ds_localidade, nu_localidade, t.ds_tipo, min(b.dt_inicial) as dt_inicial, b.dt_final, b.id_bisemana
							FROM tb_ponto p
							inner join tb_tipo t on t.id_tipo=p.id_tipo 
							left join tb_alugado a on p.id_ponto=a.id_ponto
							left join tb_bisemana b on a.id_bisemana=b.id_bisemana
							where (b.dt_final > :hoje or not exists(select a.id_ponto from tb_alugado a where a.id_ponto=p.id_ponto ))
							group by p.id_ponto
							";
							
				$stmt = $con->prepare($select); 
				$params = array(':hoje' => date('Y-m-d'));
				
				$stmt->execute($params);

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
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, dt_inicial, dt_final, ds_tipo
							FROM tb_ponto p
							inner join tb_alugado a on p.id_ponto=a.id_ponto 
							inner join tb_tipo t on p.id_tipo=t.id_tipo 
							inner join tb_bisemana b on a.id_bisemana=b.id_bisemana
							where a.id_cliente = :id_cliente";
				
				$stmt = $con->prepare($select); 
				$params = array(':id_cliente' => $id_cliente);
				
				$stmt->execute($params);

				return $stmt;
				
					
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
		public function BuscarDadosPonto($id_ponto)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT id_ponto, ds_localidade, nu_localidade, t.ds_tipo, p.id_tipo
							FROM tb_ponto p
							inner join tb_tipo t on p.id_tipo=t.id_tipo
							where id_ponto = :id_ponto";
				
				$stmt = $con->prepare($select); 
				$params = array(':id_ponto' => $id_ponto);
				
				
				$stmt->execute($params);

				return $stmt->fetch();
				
					
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
		public function gravarAlterarPonto(array $dados)
		{
			
			$ds_localidade		= $dados['ds_localidade'];
			$nu_localidade    	= $dados['nu_localidade'];
			$id_tipo    		= $dados['id_tipo'];
			$id_ponto    		= $dados['id_ponto'];
			
			
			try{
				$con = Conecta::criarConexao();
				$update = "UPDATE tb_ponto set ds_localidade = :ds_localidade, nu_localidade = :nu_localidade, id_tipo = :id_tipo
						WHERE id_ponto = :id_ponto";
				
				$stmt = $con->prepare($update);
				
				$params = array(':ds_localidade' => $ds_localidade, 
								':nu_localidade' => $nu_localidade,
								':id_tipo' => $id_tipo,
								':id_ponto'=>$id_ponto);
				$stmt->execute($params);

				
				echo "Dados alterados com sucesso!";
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
		public function gravarAlugado()
		{

			$id_cliente	    = $_POST['id_cliente'];
			$id_ponto	    = $_POST['id_ponto'];
			if(isset($_POST['bisemana'])){
				$listaCheckbox = $_POST['bisemana'];

				$id_bisemana= '';

				for ($i=0; $i < count($listaCheckbox); $i++) { 
					
					$id_bisemana = $listaCheckbox[$i];

					try{
						$con = Conecta::criarConexao();
						$insert = "INSERT into tb_alugado (id_cliente, id_ponto,  id_bisemana)
									VALUES (:id_cliente, :id_ponto, :id_bisemana)";
						
						$stmt = $con->prepare($insert);
						
						$params = array(':id_cliente' => $id_cliente,
										':id_ponto' => $id_ponto,
										':id_bisemana' => $id_bisemana);
										
						$stmt->execute($params);
						
						 
						
					}
					catch(exception $e) 
					{
						header('HTTP/1.1 500 Internal Server Error');
						print "ERRO:".$e->getMessage();		
					} 	
				}
				echo "Dados gravados com sucesso!";
			}
			else{
				$id_bisemana = NULL;
				try{
					$con = Conecta::criarConexao();
					$insert = "INSERT into tb_alugado (id_cliente, id_ponto,  id_bisemana)
								VALUES (:id_cliente, :id_ponto, :id_bisemana)";
					
					$stmt = $con->prepare($insert);
					
					$params = array(':id_cliente' => $id_cliente,
									':id_ponto' => $id_ponto,
									':id_bisemana' => $id_bisemana);
									
					$stmt->execute($params);
					
					echo "Dados gravados com sucesso!"; 
					
				}
				catch(exception $e) 
				{
					header('HTTP/1.1 500 Internal Server Error');
					print "ERRO:".$e->getMessage();		
				} 
			};

        }
		public function listarAlugado($id_ponto) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT ds_empresa, ds_bisemana, b.dt_final, b.dt_inicial
							FROM tb_alugado a
							inner join tb_cliente c on a.id_cliente=c.id_cliente
							inner join tb_bisemana b on a.id_bisemana=b.id_bisemana
							where id_ponto=:id_ponto";
				
				$stmt = $con->prepare($select); 
				$params = array(':id_ponto' => $id_ponto);
				
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