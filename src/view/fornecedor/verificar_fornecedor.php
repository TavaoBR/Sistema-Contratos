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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/css/cadastro.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <?php include_once("../menu/sidebar.php")?>
        <div id="content">
            <?php include_once("../menu/navbar.php")?>
            <div class="main-content">
                <div class="row">
                <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Pesquisar Fornecedor</h3>
                        <form class="requires-validation" id="pesquisa" method="POST">

                        <div class="col-md-12">
                            <input class="form-control" type="text" id="search" name="name" placeholder="Digite aqui">
                            </div>
                        </form>
                    </div>
                </div>

                <div id="resultado">
           
                 </div>
            </div>

        </div>
       
    </div>


                </div>
            </div>
        </div>
    </div>
  <script>
      $(function(){
        $("#search").keyup(function(){
            var pesquisa = $(this).val();

            if(pesquisa != ''){
                var dados = {
                    palavra : pesquisa
                }

                $.post('../../controller/fornecedor/pesquisa_fornecedor.php', dados, function(retorna){
                    $("#resultado").html(retorna);
                })
            } 
        });
      });
  </script>


    <script>
        $(document).ready(function(){
            $('#submit').hide();
            $('#submit2').hide();
            $('#select_feio').change(function(){
              if($('#select_feio').val() == 'Sim'){
                $('#submit2').show();
                $('#submit').hide();
              }else if($('#select_feio').val() == 'Não'){
                $('#submit').show();
                $('#submit2').hide();
              }
            });
        });
    </script>
</body>
</html>