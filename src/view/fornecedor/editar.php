<?php 
session_start();
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();
include_once("../../model/conection/conexao.php");
$id_fornecedor = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$select_fornecedor = mysqli_query($conectar,"SELECT * FROM fornecedor WHERE id_fornecedor = '$id_fornecedor'");
$fornecedor_assoc = mysqli_fetch_assoc($select_fornecedor);
extract($fornecedor_assoc);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <link rel="stylesheet" href="../asset/css/cadastro.css">
    <title>Editar</title>
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
                        <h3>Editar informações fornecedor: <?php echo $nome_fornecedor?></h3>
                        <form class="requires-validation" method="POST" action="../../controller/fornecedor/editar.php">
                         <input type="hidden" name="id" value="<?php echo $id_fornecedor ?>">
                        <?php 
                        if(isset($_SESSION['cnpj'])){
                            echo $_SESSION['cnpj'];
                            unset($_SESSION['cnpj']);
                        }

                        if(isset($_SESSION['sucesso'])){
                           echo $_SESSION['sucesso'];
                           unset($_SESSION['sucesso']);
                        }

                        if(isset($_SESSION['erro'])){
                            echo $_SESSION['erro'];
                            unset($_SESSION['erro']);
                         }
                        
                        ?>
                            <?php 
                           ?>

                            <div class="col-md-12">
                                <label for="">Nome</label>
                               <input class="form-control" type="text" name="nome_fornecedor" value="<?php echo $nome_fornecedor?>">
                            </div>
                             <hr>

                             <?php 
                                
                           ?>

                            <div class="col-md-12">
                                <label for="">CNPJ</label>
                                <input class="form-control" id="cnpj" type="text" name="cpnj_fornecedor" value="<?php echo $cpnj_fornecedor?>">
                            </div>

                            <hr>
                            
                           <?php 
                           
                           ?>

                           <div class="col-md-12">
                           <label>Estado do fornecedor</label>

                            <?php 
                            $url_estado = "https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome";
                            $estado_api = curl_init($url_estado);
                            curl_setopt($estado_api, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($estado_api, CURLOPT_SSL_VERIFYPEER, false);
                            $resultado = json_decode(curl_exec($estado_api));

                            echo "<select name = 'estado_fornecedor' class='form-select'>
                            <option value =''>Selecione uma opção</option>";
                            foreach($resultado as $api){
                            echo "<option value = '$api->nome'>$api->nome</option>";
                            }
                            
                               echo "<option value=".$estado_fornecedor." selected>".$estado_fornecedor."<option>";  
                            
                            echo "</select>";

                            ?>
                           </div>
 
                           <hr>
                           <?php 
                           
                           ?>

                           <div class="col-md-12">
                               <label for="">Cidade</label>
                              <input class="form-control" type="text" name="cidade_fornecedor" value="<?php echo $cidade_fornecedor?>">
                           </div>

                           <hr>

                           <?php 
                           
                           ?>

                           <div class="col-md-12">
                               <label for="">Endereço</label>
                              <input class="form-control" type="text" name="endereco_fornecedor" value="<?php echo $endereco_fornecedor?>">
                           </div>
 
                           <hr>

                           <?php 
                           
                           ?>

                           <div class="col-md-12">
                               <label for="">Bairro</label>
                              <input class="form-control" type="text" name="bairro_fornecedor" value="<?php echo $bairro_fornecedor?>">
                           </div>
                           
                           <hr>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" name="Editar" class="btn btn-primary">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
         $('#cnpj').mask("99.999.999/9999-99");

         //Desaparecer a mensagem
         setTimeout(function(){
           $("#tempo").fadeOut("fast");
         }, 3000);

    </script>
</body>
</html>