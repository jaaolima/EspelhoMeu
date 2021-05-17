<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	require_once("../Classes/Cliente.php");

    $cliente = new Cliente();
    $retorno = $cliente->listarCliente($_POST);
?>
<!DOCTYPE html> 
<html lang="en">
<body>
    <div class="my-8">
        <h1 class="text-dark font-weight-bolder">Meus Clientes</h1>
    </div>
    <div class="row justify-content-center">
        <div class="text-right w-100 mb-5 mr-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Adicionar cliente</button>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Gravar Cliente</h5>
                    </div>
                    <div class="modal-body">
                        <form id="form_cliente">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Responsável: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ds_nome" name="ds_nome" />
                                </div>
                                <div class="col-md-3">
                                    <label>Empresa: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ds_empresa" name="ds_empresa" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>CNPJ: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nu_cnpj" name="nu_cnpj" />
                                </div>
                                <div class="col-md-3">
                                    <label>email: <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="ds_email" name="ds_email" />
                                </div>
                                <div class="col-md-3">
                                    <label>Contato: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nu_telefone" name="nu_telefone" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>CEP: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nu_cep" name="nu_cep" />
                                </div>
                                <div class="col-md-3">
                                    <label>Endereço: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ds_endereco" name="ds_endereco" />
                                </div>
                                <div class="col-md-3">
                                    <label>Complemento:</label>
                                    <input type="text" class="form-control" id="ds_complemento" name="ds_complemento" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12">
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white"  >
                <div class="card-body">
                    <table class="table table-hover" id="table_cliente">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Responsável</th>
                                <th>Empresa</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                                while ($dados = $retorno->fetch())
                                {
                                    echo "<tr>
                                            <td>".$dados['id_cliente']."</td>
                                            <td>".$dados['ds_nome']."</td>
                                            <td>".$dados['ds_empresa']."</td>
                                            <td>".$dados['ds_email']."</td>
                                            <td nowrap></td>
                                        </tr>";
                                }
                            ?>
                            
                        </tbody>

                    </table> 
                </div>
            </div>
            
        </div>
            
    </div>
    <script src="./assets/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="./assets/js/appCliente/lista_cliente.js" type="text/javascript"></script>
</body>

</html>