<?php 
session_start();
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
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
                        <h3>Cadastro fornecedor</h3>
                        <form class="requires-validation" method="POST" action="../../controller/fornecedor/cadastro.php">

                        <?php 
                        if(isset($_SESSION['preencha_campos'])){
                            echo $_SESSION['preencha_campos'];
                            unset($_SESSION['preencha_campos']) ;
                        }
                        
                        if(isset($_SESSION['fornecedor_cadastrado'])){
                             echo $_SESSION['fornecedor_cadastrado'];
                             unset($_SESSION['fornecedor_cadastrado']);
                        }

                        if(isset($_SESSION['erro'])){
                             echo $_SESSION['erro'];
                             unset($_SESSION['erro']);
                        }

                        if(isset($_SESSION['sucesso'])){
                             echo $_SESSION['sucesso'];
                             unset($_SESSION['sucesso']);
                        }
                        ?>
                            <?php 
                                if(isset($_SESSION['preencha_nome'])){
                                echo $_SESSION['preencha_nome'];
                                unset($_SESSION['preencha_nome']);
                                }
                           ?>

                            <div class="col-md-12">
                                <label for="">Nome</label>
                               <input class="form-control" type="text" name="nome_fornecedor" value="<?php if(isset($_SESSION['nome'])){echo $_SESSION['nome']; unset($_SESSION['nome']);}?>">
                            </div>
                             <hr>

                             <?php 
                                if(isset($_SESSION['preencha_cnpj'] )){
                                echo $_SESSION['preencha_cnpj'] ;
                                unset($_SESSION['preencha_cnpj'] );
                                }
                           
                           ?>

                            <div class="col-md-12">
                                <label for="">CNPJ</label>
                                <input class="form-control" id="cnpj" type="text" name="cpnj_fornecedor" value="<?php if(isset($_SESSION['cnpj'])){echo $_SESSION['cnpj']; unset($_SESSION['cnpj']);}?>">
                            </div>

                            <hr>
                            
                           <?php 
                            if(isset($_SESSION['preencha_estado'])){
                              echo $_SESSION['preencha_estado'];
                              unset($_SESSION['preencha_estado']);
                            }
                           
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
                             
                            if(isset($_SESSION['estado'])){
                               echo "<option value=".$_SESSION['estado']." selected>".$_SESSION['estado']."<option>";
                               unset($_SESSION['estado']);
                            }
                            echo "</select>";

                            ?>
                           </div>
 
                           <hr>
                           <?php 
                                if(isset($_SESSION['preencha_cidade'])){
                                echo $_SESSION['preencha_cidade'];
                                unset($_SESSION['preencha_cidade']);
                                }
                           
                           ?>

                           <div class="col-md-12">
                               <label for="">Cidade</label>
                              <input class="form-control" type="text" name="cidade_fornecedor" value="<?php if(isset($_SESSION['cidade'])){ echo $_SESSION['cidade']; unset($_SESSION['cidade']);}?>">
                           </div>

                           <hr>

                           <?php 
                                if(isset($_SESSION['preencha_endereco'])){
                                echo $_SESSION['preencha_endereco'];
                                unset($_SESSION['preencha_endereco']);
                                }
                           
                           ?>

                           <div class="col-md-12">
                               <label for="">Endereço</label>
                              <input class="form-control" type="text" name="endereco_fornecedor" value="<?php if(isset($_SESSION['endereco'])){ echo  $_SESSION['endereco']; unset($_SESSION['endereco']);}?>">
                           </div>
 
                           <hr>

                           <?php 
                                if(isset($_SESSION['preencha_bairro'])){
                                echo $_SESSION['preencha_bairro'];
                                unset($_SESSION['preencha_bairro']);
                                }
                           
                           ?>

                           <div class="col-md-12">
                               <label for="">Bairro</label>
                              <input class="form-control" type="text" name="bairro_fornecedor" value="<?php if(isset($_SESSION['bairro'])){echo $_SESSION['bairro']; unset($_SESSION['bairro']);}?>">
                           </div>
                           
                           <hr>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" name="Registrar" class="btn btn-primary">Registrar</button>
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