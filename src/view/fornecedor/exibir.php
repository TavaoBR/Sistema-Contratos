<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();
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
    <title>Fornecedores</title>
    <style>
        .fa-folder-plus{
            color: red;
            font-size: 20px;
        }
        .fa-folder-open{
            color: #2de343;
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
                    <div class="container mt-3">
                        <center><h2>Fornecedores</h2></center>
                        <table class="table" id="minhaTabela">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>CNPJ</th>
                                    <th>Estado</th>
                                    <th>Cidade</th>
                                    <th>Bairro</th>
                                    <th>Endereço</th>
                                    <th>Opção</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   $select_fornecedor = mysqli_query($conectar, "SELECT * FROM fornecedor");

                                   while($puxar = mysqli_fetch_assoc($select_fornecedor)){
                                       extract($puxar);
                                       echo "<tr>";
                                        echo "<td>$nome_fornecedor</td>
                                              <td>$cpnj_fornecedor</td>
                                              <td>$estado_fornecedor</td>
                                              <td>$cidade_fornecedor</td>
                                              <td>$bairro_fornecedor</td>
                                              <td>$endereco_fornecedor</td>
                                              <td><a href='../contrato/cadastro.php?id=$id_fornecedor' title = 'Cadastrar Contrato para $nome_fornecedor'><i class='fa-solid fa-folder-plus'></i></a>
                                              <a href='../contrato/exibir.php?id=$id_fornecedor' title='Visualizar contratos'><i class='fa-solid fa-folder-open'></i></a>
                                              <a href='../fornecedor/editar.php?id=$id_fornecedor' title='Editar dados de $nome_fornecedor' title='Editar dados $nome_fornecedor'><i class='fa-solid fa-pencil'></i></a>
                                              </td>
                                        ";
                                       echo "</tr>";
                                   }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function(){
      $('#minhaTabela').DataTable({
        	"language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior",
                    "first": "Primeiro",
                    "last": "Último"
                },
                "search": "Pesquisar",
            }
        });
  });
  </script>
</body>
</html>