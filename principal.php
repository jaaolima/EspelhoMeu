<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script scr="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/sweetalert.js"></script>


</head>
<body>
    <div class="w-100">
        <div class="row m-0">
            <div class="col-12 bg-dark h-auto p-0">
                <div>
                    <ul class="nav nav-tabs float-end mt-4">
                        <li class="nav-item mr-2">
                            <a type="button" data-toggle="modal" data-target="#modalPonto" class="nav-link">Adicionar ponto</a>
                        </li>
                        <li class="nav-item mr-2">
                            <a type="button" data-toggle="modal" data-target="#modalCliente" class="nav-link">Adicionar cliente</a>
                        </li>
                    </ul>
                </div>   
                <div class="modal fade" id="modalCliente">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: -webkit-fill-available">
                                    <h3 class="modal-title">Cadastro de cliente</h3>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form_cliente">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="form-group col-md-6">
                                                <label>Nome <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ds_nome" name="ds_nome" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Empresa <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ds_empresa" name="ds_empresa" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Contato <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nu_telefone" name="nu_telefone" />
                                            </div>
                                        </div>       
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="salvarCliente"class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="modal fade" id="modalPonto">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: -webkit-fill-available">
                                    <h3 class="modal-title">Cadastro de ponto</h3>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form_ponto">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="form-group col-md-6">
                                                <label>Local <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ds_localidade" name="ds_localidade" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Latitude/Longitude <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nu_localidade" name="nu_localidade" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Cliente <span class="text-danger">*</span></label>
                                                <select name="id_cliente" class="form-control" >
                                                    <option value="">Selecione..</option>
                                                    <option value="1">Teste</option>
                                                </select>
                                            </div>
                                        </div>       
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 mt-5">
                    <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-white text-center"  >
                        <div class="card-body d-flex">
                            <table class="table table-hover display" id="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Nome</th>
                                        <th>Nome</th>
                                        <th>Nome</th>
                                        <th>Nome</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>teste</td>
                                        <td>teste</td>
                                        <td>teste</td>
                                        <td>teste</td>
                                        <td>teste</td>
                                    </tr>
                                    
                                </tbody>

                            </table>
                        </div>
                    </div>
                    
                </div>
                    
            </div>
        </div>       
    </div>
    <!-- Importando o jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <!-- Importando o js do bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="./js/principal.js" type="text/javascript"></script>
</body>

</html>