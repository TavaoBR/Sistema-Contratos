<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();


$select_contrato = mysqli_query($conectar, "SELECT * from contratos ");

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
    <title>Contratos</title>
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
                    <div class="container mt-3">
                        <center><h2>Contratos</h2></center>
                        <table class="table" id="minhaTabela">
                            <thead class="table-dark">
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>Número</th>
                                    <th>Tipo Contrato</th>
                                    <th>Inicio Contrato</th>
                                    <th>Fim Contrato</th>
                                    <th>Alerta Fim Contrato</th>
                                    <th>Vigencia</th>
                                    <th>Situação</th>
                                    <th>Opção</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   while($puxar = mysqli_fetch_assoc($select_contrato)){
                                       extract($puxar);
                                       $select_fornecedor = mysqli_query($conectar, "SELECT nome_fornecedor FROM fornecedor WHERE id_fornecedor = '$fk_fornecedor'");
                                       $assoc_fornecedor = mysqli_fetch_assoc($select_fornecedor);
                                       extract($assoc_fornecedor);
                                       echo "<tr>";
                                        echo "<td>$nome_fornecedor</td>
                                              <td>$numero_contrato</td>
                                              <td>$tipo_contrato</td>
                                              <td>$data_inicio_contrato</td>
                                              <td>$data_fim_contrato</td>
                                              <td>$data_alerta_vencimento_contrato</td>
                                              <td>$vigencia</td>
                                              <td>$situacao</td>
                                              <td>
                                                <a href='../contrato/editar.php?id=$id_contratos' title='Editar contrato número: $numero_contrato'><i class='fa-solid fa-pencil'></i></a>
                                              ";
                                              
                                              if(isset($arquivo_contrato_pdf)){
                                                echo "<a href='../asset/pdf/$arquivo_contrato_pdf' target='_blank' ttile='Visualizar arquivo contrato'><i class='fa-solid fa-file-pdf'></i></a>";
                                              }else{
                                                echo "<a href='../contrato/adicionar_pdf.php?numero_contrato=$id_contratos' title='Adicionar arquivo pdf numero: $numero_contrato'><i class='fa-solid fa-square-plus'></i></a>";
                                              };

                                              "</td>";
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