<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();

$id_fornecedor = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$select_contrato = mysqli_query($conectar, "SELECT * FROM contratos WHERE fk_fornecedor = '$id_fornecedor'");
$select_fornecedor = mysqli_query($conectar, "SELECT * FROM fornecedor WHERE id_fornecedor = '$id_fornecedor'");
$assoc = mysqli_fetch_assoc($select_fornecedor);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cadastrar ou Visualizar</title>
    <style>
        .fa-file-pdf{
            color: red;
            font-size: 20px;
        }

        .fa-square-plus{
            color: red;
            font-size: 20px;
        }

        .fa-pencil{
            color: #2d7ae3;
            font-size: 20px;
        }

        i{
            padding: 2.2px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include_once("../menu/sidebar.php")?>
        <div id="content">
            <?php include_once("../menu/navbar.php")?>
            <div class="main-content">
                <div class="row">
                <div class='col-lg-4'>
                        <div class='card card-margin'>
                            <div class='card-header no-border'>
                                <h5 class='card-title'>Cadastrar Fornecedor</h5>
                            </div>
                            <div class='card-body pt-0'>
                                <div class='widget-49'>
                                    <ol class='widget-49-meeting-points'>
                                        <li class='widget-49-meeting-item'><span><h4></h4></span></li>
                                    </ol>
                                    
                            </ol>
                                
                                <br>
                                    <div class='widget-49-meeting-action'>  
                                        <a href='../fornecedor/cadastro.php' class='btn btn-sm btn-primary'>cadastrar</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class='col-lg-4'>
                        <div class='card card-margin'>
                            <div class='card-header no-border'>
                                <h5 class='card-title'>Fornecedor</h5>
                            </div>
                            <div class='card-body pt-0'>
                                <div class='widget-49'>
                                    <ol class='widget-49-meeting-points'>
                                        <li class='widget-49-meeting-item'><span><h4></h4></span></li>
                                    </ol>
                                    
                            </ol>
                                
                                <br>
                                    <div class='widget-49-meeting-action'>  
                                        <a href='../fornecedor/exibir.php' class='btn btn-sm btn-primary'>Visualizar</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

</body>
</html>