<?php 
session_start();
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();
include_once("../../model/conection/conexao.php");

$tipo = $_GET['tipo'];
//$fornecedor = $_GET['batman'];

date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d');

   if($tipo == "" ){
    $central_aberta = "SELECT count(situacao) FROM  `contratos` WHERE situacao = 'Ativo' ";
    $central_query_aberta = mysqli_query($conectar, $central_aberta);
    $to_central_central = mysqli_fetch_assoc($central_query_aberta);
    $count_central_aberta = $to_central_central["count(situacao)"];


    //Pega o total de contratos inativos
    $central_andamento = "SELECT count(situacao) FROM  `contratos` WHERE situacao = 'Inativo'";
    $central_query_andamento = mysqli_query($conectar, $central_andamento);
    $to_central_andamento = mysqli_fetch_assoc($central_query_andamento);
    $count_central_andamento = $to_central_andamento["count(situacao)"];
       
    //Pega o total de valor dos contratos
    $select_valor = mysqli_query($conectar, "SELECT sum(valor_contrato) FROM contratos WHERE valor_contrato");
    $select_valor_assoc = mysqli_fetch_assoc($select_valor);
    $count_valor = $select_valor_assoc["sum(valor_contrato)"];

   }else{
    $central_aberta = "SELECT count(situacao) FROM  `contratos` WHERE situacao = 'Ativo' AND tipo_contrato = '$tipo'";
    $central_query_aberta = mysqli_query($conectar, $central_aberta);
    $to_central_central = mysqli_fetch_assoc($central_query_aberta);
    $count_central_aberta = $to_central_central["count(situacao)"];


    //Pega o total de contratos inativos
    $central_andamento = "SELECT count(situacao) FROM  `contratos` WHERE situacao = 'Inativo' AND tipo_contrato = '$tipo'";
    $central_query_andamento = mysqli_query($conectar, $central_andamento);
    $to_central_andamento = mysqli_fetch_assoc($central_query_andamento);
    $count_central_andamento = $to_central_andamento["count(situacao)"];
       
    //Pega o total de valor dos contratos
    $select_valor = mysqli_query($conectar, "SELECT sum(valor_contrato) FROM contratos WHERE valor_contrato AND tipo_contrato = '$tipo'");
    $select_valor_assoc = mysqli_fetch_assoc($select_valor);
    $count_valor = $select_valor_assoc["sum(valor_contrato)"];
   }

    //Pega o total de contratos ativos
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/painel.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <title>Relatorio</title>
    <style>
.card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;
}
.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
}
.card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}
.card-box p {
    font-size: 15px;
}
.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 72px;
    color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}
.bg-blue {
    background-color: #00c0ef !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-red {
    background-color: #d9534f !important;
}


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

        .pdfff{
            font-size: 35px;
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

    <section class="container pt-3 mb-3">
    <center><h1>Relatorio 
    <?php if($tipo != ""){?> 
    <form action="../relatorio/relatorio_pdf.php" method="GET">
        <input type="hidden" name="tipo" value="<?php echo $tipo?>">
        <button><i class="fa-solid fa-file-pdf pdfff"></i></button></h1></center>
    </form>
    <?php }else{?>
        <a href="../relatorio/relatorio_pdf.php"><i class="fa-solid fa-file-pdf pdfff"></i></a></h1></center>
        <?php }?>
    <hr>
    <h2>Filtros</h2>
    <div class="container">
    <form method="GET" action="../relatorio/filtro.php">
    <div class="row">

    <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <h6>Contrato</h6>
                        <p class="m-0"><select name="tipo" id="">
                            <option value="">Tipo de contrato</option>
                            <?php 
                              $mes_select = mysqli_query($conectar, "SELECT DISTINCT tipo_contrato FROM contratos ");
                              while($puxar_mes = mysqli_fetch_assoc($mes_select)){
                                extract($puxar_mes);
                            ?>
                            <option value="<?php echo $tipo_contrato?>"><?php echo $tipo_contrato?></option>
                            <?php }?>
                        </select></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <p class="m-0"><button class="btn btn-success">Filtrar</button></p>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>
</section>
<hr>
<div class="container">
    <center><h2>Analise e Graficos</h2></center>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3> <?php echo $count_central_aberta?> </h3>
                    <p> Contratos Ativos </p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                </div>
                <!--<a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>-->            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3> <?php echo $count_central_andamento?> </h3>
                    <p> Contratos inativos </p>
                </div>
                <div class="icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <!--<a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>-->
            </div>
        </div>

<!--Inicio dos graficos-->
<div class="row ">
                        <div class="col-lg-7 col-md-12">
                            <div class="card" style="min-height: 485px">
                                <div class="card-header card-header-text">
                                    <h4 class="card-title">Ativos x Inativos</h4>
                                </div>
                                <div class="card-content">
                                   <canvas id="myChart"></canvas>

                                   
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-5 col-md-12">
                            <div class="card" style="min-height: 485px">
                                <div class="card-header card-header-text">
                                    <h4 class="card-title">Ativos x Inativos</h4>
                                </div>
                                <div class="card-content">
                                    <div class="streamline">
                                        <div class="sl-item">
                                            <div style="height: 400px; width: 400px;" class="sl-content">
                                            <canvas id="mano"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    
                           
                            
                        </div>
                    </div>


  

<!--Fim graficos-->


<?php 
if($tipo != ""){

?>
<div class="table-responsive">
<table class="table" id="minhaTabela">
                            <thead class="table-dark">
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>Número</th>
                                    <th>Tipo Contrato</th>
                                    <th>Inicio</th>
                                    <th>Fim</th>
                                    <th>Valor contrato</th>
                                    <th>Nota fiscal</th>
                                    <th>Ultimo pagamento</th>
                                    <th>Vigencia</th>
                                    <th>Situação</th>
                                    <th>Opção</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $select_contrato = mysqli_query($conectar, "SELECT * from contratos WHERE tipo_contrato = '$tipo'");
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
                                              <td>R$$valor_contrato</td>
                                              <td>$nota_fiscal</td>
                                              <td>$valor</td>
                                              <td>$vigencia</td>
                                              <td>$situacao</td>
                                              <td>";
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
    </div>
<?php }else{?>
    <div class="table-responsive">
<table class="table" id="minhaTabela">
                            <thead class="table-dark">
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>Número</th>
                                    <th>Tipo Contrato</th>
                                    <th>Inicio</th>
                                    <th>Fim</th>
                                    <th>Valor contrato</th>
                                    <th>Nota fiscal</th>
                                    <th>Ultimo pagamento</th>
                                    <th>Vigencia</th>
                                    <th>Situação</th>
                                    <th>Opção</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $select_contrato = mysqli_query($conectar, "SELECT * from contratos");
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
                                              <td>R$$valor_contrato</td>
                                              <td>$nota_fiscal</td>
                                              <td>$valor</td>
                                              <td>$vigencia</td>
                                              <td>$situacao</td>
                                              <td>";
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
    </div>
<?php }?>    


<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Ativo','Inativo'],
        datasets: [{
            label: 'Quantidade',
            data: [<?php echo $count_central_aberta?>,<?php echo $count_central_andamento?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctxx = document.getElementById('mano');
const mano = new Chart(ctxx, {
    type: 'pie',
    data: {
        labels: [
    'Ativo',
    'Inativo'

  ],
  datasets: [{
    label: 'My First Dataset',
    data: [<?php echo $count_central_aberta?>,<?php echo $count_central_andamento?>],
    backgroundColor: [
      'rgb(54, 162, 235)',
      'rgb(241, 144, 20)',
      'rgb(167, 7, 7)',
      'rgb(7, 167, 34)'
    ],
    hoverOffset: 4
  }]
}
});


const line = document.getElementById('line_graf');
const line_grafico = new Chart(line, {
    type: 'line',
    data: {
        labels: ['Ativo','Inativo'],
  datasets: [{
    label: 'Quantidade',
    data: [<?php echo $count_central_aberta?>,<?php echo $count_central_andamento?>],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
}
});
</script>
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