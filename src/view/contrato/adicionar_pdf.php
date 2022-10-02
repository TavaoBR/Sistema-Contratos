<?php 
session_start();
include_once("../../model/verifica/verifica.php");
include_once("../../model/conection/conexao.php");
seguranca_adm();
verativo();

$id_contratos = filter_input(INPUT_GET, 'numero_contrato', FILTER_SANITIZE_NUMBER_INT);
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
    <title>Adicionar pdf</title>
    <style>
.bar 
    { 
    background-color: #B4F5B4; 
    width:0%; 
    height:20px; 
    border-radius: 3px; 
    }
.percent 
    { 
    position:absolute; 
    display:inline-block; 
    left:48%; 
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
                        <h3>Adicionar pdf</h3>
                        <form class="requires-validation" method="POST" action="../../controller/contratos/adicionar_contrato.php">
                         <input type="hidden" name="id_contratos" id="id_contratos" value="<?php echo $id_contratos?>">
                        <?php 
                        
                        ?>
                    
                            <div class="col-md-12">
                                <label for="">Arquivo</label>
                               <input class="form-control" type="file" name="arquivo_contrato_pdf" id="select_file" accept="application/pdf">
                            </div>
                             <hr>

                   <div class="col-md-12">         
                        <div class="progress" id="progress_bar" tyle="display:none;">
                            <div class="progress-bar" id="progress_bar_process" role="progressbar" style="width:0%">0%</div>
                        </div>
                    </div>
                    <div id="uploaded_image" class="row mt-5"></div>
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
function _(element)
{
    return document.getElementById(element);
}

_('select_file').onchange = function(event){

    var form_data = new FormData();

    var image_number = 1;

    var fk_album = _('id_contratos').value;

    var error = '';

    for(var count = 0; count < _('select_file').files.length; count++)  
    {
        if(!['application/pdf'].includes(_('select_file').files[count].type))
        {
            error += '<div class="alert alert-danger"><b>'+image_number+'</b> Selecione apenas pdf</div>';
        }
        else
        {
            form_data.append("arquivo_contrato_pdf", _('select_file').files[count]);
        }

        image_number++;
    }

    if(error != '')
    {
        _('uploaded_image').innerHTML = error;

        _('select_file').value = '';
    }
    else
    {
        _('progress_bar').style.display = 'block';

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("POST", "../../controller/contratos/adicionar_contrato.php?id=" + fk_album);

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            _('progress_bar_process').style.width = percent_completed + '%';

            _('progress_bar_process').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){

            _('uploaded_image').innerHTML = '<div class="alert alert-success">Adicionado com sucesso</div>';

            _('select_file').value = '';

        });

        ajax_request.send(form_data);
    }

};

         //Desaparecer a mensagem
         setTimeout(function(){
           $("#tempo").fadeOut("fast");
         }, 3000);

    </script>
</body>
</html>