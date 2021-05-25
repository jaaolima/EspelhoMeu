<?php
    require_once("conexao.php");
    class Cliente{
        public function gravarCliente()
		{

			$ds_nome	    = $_POST['ds_nome'];
			$ds_empresa	    = $_POST['ds_empresa'];
			$nu_telefone	= $_POST['nu_telefone'];
			$ds_endereco	= $_POST['ds_endereco'];
			$nu_cnpj		= $_POST['nu_cnpj'];
			$nu_cep			= $_POST['nu_cep'];
			$ds_email		= $_POST['ds_email'];
			$ds_complemento	= $_POST['ds_complemento'];

			
			try{
				$con = Conecta::criarConexao();
				$insert = "INSERT into tb_cliente (ds_nome, ds_empresa, nu_telefone, ds_endereco, nu_cnpj, nu_cep, ds_email, ds_complemento)
							VALUES (:ds_nome, :ds_empresa, :nu_telefone, :ds_endereco, :nu_cnpj, :nu_cep, :ds_email, :ds_complemento)";
				
				$stmt = $con->prepare($insert);
				
				$params = array(':ds_nome' => $ds_nome,
								':ds_empresa' => $ds_empresa,
								':nu_telefone' => $nu_telefone,
								':ds_endereco' => $ds_endereco,
								':nu_cnpj' => $nu_cnpj,
								':nu_cep' => $nu_cep,
								':ds_email' => $ds_email,
								':ds_complemento' => $ds_complemento);
                                
				$stmt->execute($params);
				
				echo "Dados gravados com sucesso!"; 
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			} 
        }
		public function listarOptionsEmpresa()
		{
			try{
				$con = Conecta::criarConexao();

				
				$select = "SELECT id_cliente, ds_empresa
							FROM tb_cliente"; 
				
				$stmt = $con->prepare($select);
				$stmt->execute();

				$options = "<option value=''>Selecione..</option>";

				while($dados = $stmt->fetch())
				{
					$options.= "<option value='".$dados['id_cliente']."'>".$dados['ds_empresa']."</option>";
				}
				return $options;

			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print $e->getMessage();
			}
		}
        public function listarCliente(array $dados)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT id_cliente, ds_nome, ds_empresa, nu_telefone, ds_email
							FROM tb_cliente";
				
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
		public function BuscarDadosCliente($id_cliente)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT id_cliente, ds_nome, ds_empresa, nu_telefone, ds_email, nu_cnpj, nu_cep, ds_complemento, nu_cep, ds_endereco
							FROM tb_cliente 
							where id_cliente = :id_cliente";
				
				$stmt = $con->prepare($select); 
				$params = array(':id_cliente' => $id_cliente);
				
				
				$stmt->execute($params);

				return $stmt->fetch();
				
					
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
		public function gravarAlterarCliente(array $dados)
		{
			
			$ds_nome		= $dados['ds_nome'];
			$ds_empresa    	= $dados['ds_empresa'];
			$nu_telefone    = $dados['nu_telefone'];
			$ds_endereco    = $dados['ds_endereco'];
			$nu_cnpj    	= $dados['nu_cnpj'];
			$nu_cep    		= $dados['nu_cep'];
			$ds_email    	= $dados['ds_email'];
			$ds_complemento = $dados['ds_complemento'];
			$id_cliente    	= $dados['id_cliente'];
			
			
			try{
				$con = Conecta::criarConexao();
				$update = "UPDATE tb_cliente set ds_nome = :ds_nome, ds_empresa = :ds_empresa, nu_telefone = :nu_telefone, ds_endereco = :ds_endereco, nu_cnpj = :nu_cnpj, nu_cep = :nu_cep, ds_email = :ds_email, ds_complemento = :ds_complemento
						WHERE id_cliente = :id_cliente";
				
				$stmt = $con->prepare($update);
				
				$params = array(':ds_nome' => $ds_nome, 
								':ds_empresa' => $ds_empresa,
								':nu_telefone' => $nu_telefone,
								':ds_endereco' => $ds_endereco,
								':nu_cnpj' => $nu_cnpj,
								':nu_cep' => $nu_cep,
								':ds_email' => $ds_email,
								':ds_complemento' => $ds_complemento,
								':id_cliente'=>$id_cliente);
				$stmt->execute($params);

				
				echo "Dados alterados com sucesso!";
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
        
    }



?>