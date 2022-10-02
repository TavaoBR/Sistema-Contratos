<?php 
include_once("../../model/conection/conexao.php");
$select_contrato = mysqli_query($conectar, "SELECT * from contratos WHERE situacao = 'Ativo' ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
        a{
            cursor: pointer;
            text-decoration: none;
        }
        
        .fa-file-pdf{
            color: red;
            font-size: 20px;
        }
        
        body{
            background: #e1e3e4;
        }
    </style>
</head>
<body>
    <!--<iframe src="http://localhost/Contract/src/view/fornecedor/mudar.php" frameborder="0" width="100%" height="1200"></iframe>-->


<div class="wrapper">
    <div id="content">
      <div class="main-content">   
    <div class="container">
    <div class="row">
        <h2>Prestadores Serviços</h2>
        <div class="container mt-3">
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
                                              ";
                                              
                                              if(isset($arquivo_contrato_pdf)){
                                                echo "<a href='../asset/pdf/$arquivo_contrato_pdf' target='_blank' ttile='Visualizar arquivo contrato'><i class='fa-solid fa-file-pdf'></i></a>";
                                              }else{
                                                echo "sem arquivo";
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
</div>

<script src="../../model/scripts/jquery-3.3.1.slim.min.js"></script>
<script src="../../model/scripts/popper.min.js"></script>
<script src="../../model/scripts/bootstrap.min.js"></script>
<script src="../../model/scripts/jquery-3.3.1.min.js"></script>
<script src="../../model/scripts/jquery.mask.js"></script>


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