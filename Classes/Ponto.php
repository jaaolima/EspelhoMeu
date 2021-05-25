<?php
    require_once("conexao.php");
	
    class Ponto{
		public function gravarPonto()
		{

			$ds_localidade	    = $_POST['ds_localidade'];
			$nu_localidade	    = $_POST['nu_localidade'];
			$id_tipo			= $_POST['id_tipo'];
			$nu_valor_ponto		= $_POST['nu_valor_ponto'];
			$ds_sentido			= $_POST['ds_sentido'];
			$ds_foto			= $_FILES['ds_foto'];

			$tamanho = 20000000;

			$error = array();
			$tamanho_mb = $tamanho/1024/1024;
			
			if($ds_foto["size"] > $tamanho) {
				$error[1] = "O arquivo deve ter no máximo ".number_format($tamanho_mb)." mb";
			}

			

			if (count($error) == 0) {
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg|doc|docx|pdf){1}$/i", $ds_foto["name"], $ext);
				// Gera um nome único para o arquivo
				$nome_arquivo = md5(uniqid(time())) . "arquivo." . $ext[1];
				// Caminho de onde ficará o arquivo
				$caminho_arquivo = "www\Trabalho\Universo\documentos" . $nome_arquivo;

				$gravar_caminho_arquivo = "docs_pontos/" . $nome_arquivo;

			
				
				// Faz o upload da imagem para seu respectivo caminho
				$moved = move_uploaded_file($ds_foto["tmp_name"],  $caminho_arquivo);
			
				try{
					$con = Conecta::criarConexao();
					$insert = "INSERT into tb_ponto (ds_localidade, nu_localidade, id_tipo, ds_foto, nu_valor_ponto, ds_sentido)
								VALUES (:ds_localidade, :nu_localidade, :id_tipo, :ds_foto, :nu_valor_ponto, :ds_sentido)";
					
					$stmt = $con->prepare($insert);
					
					$params = array(':ds_localidade' => $ds_localidade,
									':nu_localidade' => $nu_localidade,
									':id_tipo' => $id_tipo,
									':nu_valor_ponto' => $nu_valor_ponto,
									':ds_sentido' => $ds_sentido,
									':ds_foto' => $$gravar_caminho_arquivo);
									
					$stmt->execute($params);
					
					echo "Dados gravados com sucesso!"; 
					
				}
				catch(exception $e) 
				{
					header('HTTP/1.1 500 Internal Server Error');
					print "ERRO:".$e->getMessage();		
				} 
			}
			else
			{
				echo "Aconteceu um erro".$error[1];
			}	
        }
		public function listarOutdoor(array $dados) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_tipo, min(dt_inicial) as dt_inicial, dt_final, ds_sentido, nu_valor_ponto
							FROM tb_ponto p
							left join tb_alugado a on p.id_ponto=a.id_ponto
							where (dt_final > :hoje or not exists(select a.id_ponto from tb_alugado a where a.id_ponto=p.id_ponto ) ) and id_tipo = 1 
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
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_tipo, min(dt_inicial) as dt_inicial, dt_final, ds_sentido, nu_valor_ponto
							FROM tb_ponto p
							left join tb_alugado a on p.id_ponto=a.id_ponto
							where (dt_final > :hoje or not exists(select a.id_ponto from tb_alugado a where a.id_ponto=p.id_ponto ) ) and id_tipo = 2
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
		public function listartodosFront(array $dados) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_tipo, min(dt_inicial) as dt_inicial, dt_final, ds_sentido, nu_valor_ponto
							FROM tb_ponto p
							left join tb_alugado a on p.id_ponto=a.id_ponto
							where id_tipo = 2
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
		public function listartodosOutdoor(array $dados) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, id_tipo, min(dt_inicial) as dt_inicial, dt_final, ds_sentido, nu_valor_ponto
							FROM tb_ponto p
							left join tb_alugado a on p.id_ponto=a.id_ponto
							where id_tipo = 1
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
				
				$select =	"SELECT p.id_ponto, ds_localidade, nu_localidade, t.ds_tipo, min(dt_inicial) as dt_inicial, dt_final, p.id_tipo
							FROM tb_ponto p
							inner join tb_tipo t on t.id_tipo=p.id_tipo 
							left join tb_alugado a on p.id_ponto=a.id_ponto
							where (dt_final > :hoje or not exists(select a.id_ponto from tb_alugado a where a.id_ponto=p.id_ponto ))
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
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade, dt_inicial, dt_final, ds_tipo, a.nu_valor, p.id_tipo
							FROM tb_ponto p
							inner join tb_alugado a on p.id_ponto=a.id_ponto 
							inner join tb_tipo t on p.id_tipo=t.id_tipo 
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
		public function listarTotalCliente($id_cliente)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT nu_valor
							from tb_alugado
							where id_cliente = :id_cliente";
				
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
				
				$select = "SELECT id_ponto, ds_localidade, nu_localidade, t.ds_tipo, p.id_tipo, ds_sentido, nu_valor_ponto
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
			$nu_valor_ponto    	= $dados['nu_valor_ponto'];
			$ds_sentido    		= $dados['ds_sentido'];
			
			
			try{
				$con = Conecta::criarConexao();
				$update = "UPDATE tb_ponto set ds_localidade = :ds_localidade, nu_localidade = :nu_localidade, id_tipo = :id_tipo, nu_valor_ = :nu_valor_, ds_sentido = :ds_sentido
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
			$id_tipo		= $_POST["id_tipo"];
			
			if($id_tipo == 1){
				if(isset($_POST['bisemana'])){
					$listaCheckbox = $_POST['bisemana'];
	
					$id_bisemana= '';
					$nu_valor		= ($_POST["nu_valor"]/count($listaCheckbox));
					for ($i=0; $i < count($listaCheckbox); $i++) { 
						
							$id_bisemana = $listaCheckbox[$i];
							$con = Conecta::criarConexao();
							$select = "SELECT dt_inicial, dt_final 
										from tb_bisemana 
										where id_bisemana = :id_bisemana";
							
							$stmt = $con->prepare($select);
							
							$params = array(':id_bisemana' => $id_bisemana);
											
							$stmt->execute($params);
							$dados = $stmt->fetch();
							$dt_inicial = $dados["dt_inicial"];
							$dt_final = $dados["dt_final"];


						try{
							$con = Conecta::criarConexao();
							$insert = "INSERT into tb_alugado (id_cliente, id_ponto, nu_valor, dt_inicial, dt_final)
										VALUES (:id_cliente, :id_ponto, :nu_valor, :dt_inicial, :dt_final)";
							
							$stmt = $con->prepare($insert);
							
							$params = array(':id_cliente' => $id_cliente,
											':id_ponto' => $id_ponto,
											':nu_valor' => $nu_valor,
											':dt_inicial' => $dt_inicial,
											':dt_final' => $dt_final);
											
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


			}
			if($id_tipo == 2){
				
				$meses	= $_POST["meses"];
				$nu_valor	= $_POST["nu_valor"];
				$dt_inicial	= date('Y-m-d',strtotime($_POST["dt_inicial"]));
				$date = new DateTime(date('Y-m-d',strtotime($_POST["dt_inicial"])));
				$date->modify('+'.$meses.'months');
				$dt_final = $date->format('Y-m-d');
				
				try{
					$con = Conecta::criarConexao();
					$insert = "INSERT into tb_alugado (id_cliente, id_ponto,  nu_valor, dt_inicial, dt_final)
								VALUES (:id_cliente, :id_ponto, :nu_valor, :dt_inicial, :dt_final)";
					
					$stmt = $con->prepare($insert);
					
					$params = array(':id_cliente' => $id_cliente,
									':id_ponto' => $id_ponto,
									':nu_valor' => $nu_valor,
									':dt_inicial' => $dt_inicial,
									':dt_final' => $dt_final);
									
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
		public function listarAlugado($id_ponto) 
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT ds_empresa, dt_final, dt_inicial
							FROM tb_alugado a
							inner join tb_cliente c on a.id_cliente=c.id_cliente
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