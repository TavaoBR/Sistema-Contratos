<?php 
session_start();
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();
include_once("../../model/conection/conexao.php");
$id_contratos = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);
$select_contrato = mysqli_query($conectar, "SELECT * FROM contratos WHERE id_contratos = '$id_contratos'");
$puxar = mysqli_fetch_assoc($select_contrato);
extract($puxar);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../asset/css/cadastro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <title>Editar</title>
    <style>
        body{
    background:#eee;
}
.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de
}

.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 10px
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -3px
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0 !important;
    padding: 6px 12px;
    height: 40px !important
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 6px !important;
    right: 1px;
    width: 20px
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

                <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Editar contrato número: <?php echo $numero_contrato?></h3>
                        <form class="requires-validation" method="POST" action="../../controller/contratos/editar.php">
                          <input type="hidden" name="id" value="<?php echo $id_contratos?>">
                           <?php 
                              if(isset($_SESSION['numero_contrato'])){
                               echo $_SESSION['numero_contrato'];
                               unset($_SESSION['numero_contrato']);
                              }

                            

                              if(isset($_SESSION['todos'])){
                                  echo $_SESSION['todos'];
                                  unset($_SESSION['todos']);
                              } 

                              if(isset($_SESSION['nada'])){
                               echo $_SESSION['nada'];
                               unset($_SESSION['nada']);
                              }

                              if(isset($_SESSION['erro'])){
                                echo $_SESSION['erro'];
                                unset($_SESSION['erro']);
                              }
                           ?>
                          <div class="col-md-12">
                              
                                <label><span class="text-danger">*</span>&nbsp;&nbsp;Número contrato</label>
                               <input class="form-control" type="text" name="numero_contrato" value="<?php echo $numero_contrato?>">
                            </div>
<hr>
                            <div class="col-md-12">
                                <?php 
                                 
                                ?>
                                <label for=""><span class="text-danger">*</span>&nbsp;&nbsp;Tipo de contrato</label>
                                <input class="form-control" type="text" name="tipo_contrato" value="<?php echo $tipo_contrato?>">
                           </div>

<hr>
                          <div class="col-md-12">
                              <label for="">Valor contrato</label>
                              <input type="text" class="form-contact-input" name="valor_contrato" value="<?php echo $valor_contrato?>">
                          </div>
<hr>
                          <div class="col-md-12">
                              <?php 
                                 
                              ?>
                              <label for=""><span class="text-danger">*</span>&nbsp;&nbsp;Inicio</label>
                              <input type="date" class="form-contact-input" name="data_inicio_contrato" value="<?php echo $data_inicio_contrato?>">
                          </div>
<hr>
                          <div class="col-md-12">
                              <?php 

                              ?>
                              <label for=""><span class="text-danger">*</span>&nbsp;&nbsp;Fim</label>
                              <input type="date" class="form-contact-input" name="data_fim_contrato" value="<?php echo $data_fim_contrato?>">
                          </div>
<hr>
                          <div class="col-md-12">
                              <?php 

                              ?>
                              <label for=""><span class="text-danger">*</span>&nbsp;&nbsp;Alerta finalização</label>
                              <input type="date" class="form-contact-input" name="data_alerta_vencimento_contrato" value="<?php echo $data_alerta_vencimento_contrato?>">
                          </div>
<hr>
                          <div class="col-md-12">
                              <label for="">Número da ultima nota fiscal paga</label>
                              <input type="number" class="form-contact-input" name="nota_fiscal" value="<?php echo $nota_fiscal?>">
                          </div>
<hr>
                          <div class="col-md-12">
                              <label for="">Data do ultimo pagamento</label>
                              <input type="date" class="form-contact-input" name="valor" value="<?php echo $valor?>">
                          </div>

<hr>
                            <div class="col-md-12">
                                <label for=""><span class="text-danger">*</span>&nbsp;&nbsp;Situação</label>
                                <select name="situacao" class="form-select mt-3" >
                                      <option value="">Selecione uma opção</option>
                                      <option value="Ativo">Ativo</option>
                                      <option value="Inativo">Inativo</option>
                                      <?php 
                                         echo  "<option selected value=".$situacao.">".$situacao."</option>";          
                                      ?>
                               </select>
                           </div>

<hr>
                           <div class="col-md-12">
                               <?php 
                               
                               ?>
                               <label for=""><span class="text-danger">*</span>&nbsp;&nbsp;Objeto</label>
                               <textarea name="resumo_contrato" class="form-control"><?php echo $resumo_contrato?></textarea>
                           </div>                              
<hr>
                            <div class="col-md-12">
                               <label for="">Observação</label>
                               <textarea name="observacao" class="form-control"><?php echo $observacao?></textarea>
                            </div>                            

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" name="Editar" class="btn btn-primary">Register</button>
                                <a href="../contrato/adicionar_pdf.php?numero_contrato=<?php echo $id_contratos?>" class="btn btn-danger">Mudar arquivo pdf</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2({
    closeOnSelect: false
});
});

setTimeout(function(){
           $("#tempo").fadeOut("fast");
         }, 3000);
</script>
</body>
</html>