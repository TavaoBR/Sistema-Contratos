<?php
session_start();

include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();

include_once("../../model/conection/conexao.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("../../model/src/Exception.php");
require_once("../../model/src/SMTP.php");
require_once("../../model/src/PHPMailer.php");

date_default_timezone_set("Brazil/East");

$id_usuario = $_SESSION['usuarioID'];
$select_usuario = mysqli_query($conectar, "SELECT * FROM usuario LIMIT 1");
$assoc_usuario = mysqli_fetch_assoc($select_usuario);
extract($assoc_usuario);

if(isset($_POST['Salvar'])){
    $id_fornecedor = $_POST['id_fornecedor'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d");
    $hora = date("H:i");
    $numero = mysqli_escape_string($conectar, $_POST['numero_contrato']);
    $tipo_contrato = mysqli_escape_string($conectar,$_POST['tipo_contrato']);
    $area_implode = $_POST['areas'];
    $valor_contrato = mysqli_escape_string($conectar, $_POST['valor_contrato']);
    $inicio = $_POST['data_inicio_contrato'];
    $fim = $_POST['data_fim_contrato'];
    $alerta = $_POST['data_alerta_vencimento_contrato'];
    $diferenca_dias = strtotime($fim) -  strtotime($inicio);
    $dias = floor($diferenca_dias/(60 * 60 * 24)); 
    $vigencia = $dias;
    $nota_fiscal = mysqli_escape_string($conectar, $_POST['nota_fiscal']);
    $valor = mysqli_escape_string($conectar, $_POST['valor']);
    $situacao = mysqli_escape_string($conectar, $_POST['situacao']);
    $resumo = mysqli_escape_string($conectar, $_POST['resumo_contrato']);
    $observacao = mysqli_escape_string($conectar,  $_POST['observacao']);
    $usuario_cadastro = mysqli_escape_string($conectar, $usuario);
   
    if($numero == "" AND $tipo_contrato == "" AND $area_implode == "" AND $inicio == "" AND $fim == "" AND $alerta == "" AND $situacao == "" AND $resumo == ""){
       
       $_SESSION['campos_obrigatorios'] = "<div class='alert alert-danger' id='tempo'>Preencha todos os campos obrigatórios</div>";
       header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");
       
    }elseif($numero == ""){

        $_SESSION['campo_numero'] = "<div class='alert alert-danger' id='tempo'>Preencha o campo número contrato</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($tipo_contrato == ""){
        $_SESSION['campo_tipo'] = "<div class='alert alert-danger' id='tempo'>Preencha o campo tipo de contrato</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($area_implode == ""){
        $_SESSION['areas'] = "<div class='alert alert-danger' id='tempo'>Escolha os setores</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($inicio == ""){
        $_SESSION['campo_data_inicio'] = "<div class='alert alert-danger' id='tempo'>Preencha campo Data inicio</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($fim == ""){
        $_SESSION['campo_data_fim'] = "<div class='alert alert-danger' id='tempo'>Preencha campo Data fim </div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($alerta == ""){
        $_SESSION['campo_data_alerta'] = "<div class='alert alert-danger' id='tempo'>Preencha campo Data alerta</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($situacao == ""){
        $_SESSION['campo_situacao'] = "<div class='alert alert-danger' id='tempo'>Preencha campo Situação</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");

    }elseif($resumo == ""){
        $_SESSION['campo_resumo'] = "<div class='alert alert-danger' id='tempo'>Preencha campo Objeto</div>";
        $_SESSION['numero'] = $numero;
        $_SESSION['tipo_contrato'] =  $tipo_contrato;
        $_SESSION['valor_contrato'] = $valor_contrato;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['fim'] = $fim;
        $_SESSION['alerta'] = $alerta;
        $_SESSION['nota'] = $nota_fiscal;
        $_SESSION['valor'] = $valor;
        $_SESSION['situacao'] = $situacao;
        $_SESSION['objeto'] = $resumo;
        $_SESSION['observacao'] = $observacao;
        header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");
    }else{

     
        $select_contrato = mysqli_query($conectar, "SELECT * FROM contratos WHERE numero_contrato = '$numero_contrato' LIMIT 1");
        $contrato_assoc = mysqli_fetch_assoc($select_contrato);

        if(isset($contrato_assoc)){
           $_SESSION['contrato_cadastrado'] = "<div class = 'alert alert-danger'>Número de contrato já cadastrado</div>";
           $_SESSION['numero'] = $numero;
           $_SESSION['tipo_contrato'] =  $tipo_contrato;
           $_SESSION['valor_contrato'] = $valor_contrato;
           $_SESSION['inicio'] = $inicio;
           $_SESSION['fim'] = $fim;
           $_SESSION['alerta'] = $alerta;
           $_SESSION['nota'] = $nota_fiscal;
           $_SESSION['valor'] = $valor;
           $_SESSION['situacao'] = $situacao;
           $_SESSION['objeto'] = $resumo;
           $_SESSION['observacao'] = $observacao;
           header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor"); 
        }else{

            $contrato = "INSERT INTO contratos (fk_fornecedor,valor,valor_contrato,nota_fiscal,observacao,situacao,estatus,areas,numero_contrato, tipo_contrato,data_inicio_contrato,data_fim_contrato, data_alerta_vencimento_contrato, resumo_contrato, data_cadastro, hora_cadastro, usuario_cadastrou ,ip, vigencia) 
            VALUES($id_fornecedor, '$valor', '$valor_contrato', '$nota_fiscal', '$observacao', '$situacao', 'Adicionado', '$area_implode', '$numero', '$tipo_contrato', '$inicio', '$fim', '$alerta', '$resumo', '$date', '$hora', '$usuario_cadastrou', '$ip', '$vigencia')";
            
    
            if(mysqli_query($conectar, $contrato)){
                $_SESSION['sucesso'] = "<div class='alert alert-success'>Contrato adicionado</div>"; 
                header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");     
            }else{

                $mail = new PHPMailer(true);

                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host = 'mail.hram.com.br';
                $mail->SMTPAuth = true;
                $mail->Username = 'helpnowti@hram.com.br';
                $mail->Password = 'Batman';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = '465';

                $mail->setFrom('helpnowti@hram.com.br');
                $mail->addAddress('dev@hram.com.br');
                
                $mail->isHTML(true);
                $mail->Subject = utf8_decode("Erro de query: Sistema Contract");
                $mail->Body = "<h3>Error de query<br>
                codigo:".$contrato."<br>".mysqli_error($conectar). "<br>
                </h3>";
                $mail-> AltBody = "Este é um email apenas de alerta";
                
                $mail->send();
                

                $_SESSION['erro_query'] = "<div class='alert alert-danger'>Erro. Estamos resolvendo aguarde</div>"; 
                $_SESSION['numero'] = $numero;
                $_SESSION['tipo_contrato'] =  $tipo_contrato;
                $_SESSION['valor_contrato'] = $valor_contrato;
                $_SESSION['inicio'] = $inicio;
                $_SESSION['fim'] = $fim;
                $_SESSION['alerta'] = $alerta;
                $_SESSION['nota'] = $nota_fiscal;
                $_SESSION['valor'] = $valor;
                $_SESSION['situacao'] = $situacao;
                $_SESSION['objeto'] = $resumo;
                $_SESSION['observacao'] = $observacao;
                header("Location: ../../view/contrato/cadastro.php?id=$id_fornecedor");
            }
        }

        

       
    }

}