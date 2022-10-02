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
$date = date("Y-m-d");
$hora = date("H:i");

if(isset($_POST['Editar'])){
    
    $id_contratos = $_POST['id'];

    $select_contrato_ = mysqli_query($conectar, "SELECT * FROM contratos WHERE id_contratos = '$id_contratos' LIMIT 1");
    $contrato_assoc_ = mysqli_fetch_assoc($select_contrato_);

    $numero = mysqli_escape_string($conectar, $_POST['numero_contrato']);
    $tipo_contrato_ = mysqli_escape_string($conectar,$_POST['tipo_contrato']);
    $valor_contrato_ = mysqli_escape_string($conectar, $_POST['valor_contrato']);
    $inicio = $_POST['data_inicio_contrato'];
    $fim = $_POST['data_fim_contrato'];
    $alerta = $_POST['data_alerta_vencimento_contrato'];
    $diferenca_dias = strtotime($fim) -  strtotime($inicio);
    $dias = floor($diferenca_dias/(60 * 60 * 24)); 
    $vigencia_ = $dias;
    $nota_fiscal_ = mysqli_escape_string($conectar, $_POST['nota_fiscal']);
    $valor_ = mysqli_escape_string($conectar, $_POST['valor']);
    $situacao_ = mysqli_escape_string($conectar, $_POST['situacao']);
    $resumo = mysqli_escape_string($conectar, $_POST['resumo_contrato']);
    $observacao_ = mysqli_escape_string($conectar,  $_POST['observacao']);

    
            $select_contrato = mysqli_query($conectar, "SELECT * FROM contratos WHERE numero_contrato = '$numero' AND id_contratos != '$id_contratos' LIMIT 1");
            $contrato_assoc = mysqli_fetch_assoc($select_contrato);

            if($contrato_assoc['numero_contrato'] == $numero){
                $_SESSION['numero_contrato'] = "<div class='alert alert-danger' id='tempo'>O número de contrato digitado está vinculado a outro contrato!</div>";
                header("Location: ../../view/contrato/editar.php?id=$id_contratos");
            }else{                
            

                $update = "UPDATE contratos SET numero_contrato = '$numero', vigencia ='$vigencia_', tipo_contrato ='$tipo_contrato_',  valor_contrato ='$valor_contrato_', data_inicio_contrato ='$inicio', data_fim_contrato ='$fim', data_alerta_vencimento_contrato ='$alerta',  nota_fiscal ='$nota_fiscal_', valor ='$valor_', situacao ='$situacao_', resumo_contrato ='$resumo', observacao ='$observacao_' WHERE id_contratos = '$id_contratos'";
                    
                    if(mysqli_query($conectar, $update)){
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
                        $mail->Subject = utf8_decode("Realizada alteração de dados: Sistema Contract");
                        $mail->Body = "<h3>Update realizada no contrato número: $numero<br>
                        codigo:".$update."<br> Dia: $date Às $hora horas
                        </h3>";
                        $mail-> AltBody = "Este é um email apenas de alerta";
                    
                        $mail->send();

                        $_SESSION['todos'] = "<div class='alert alert-success' id='tempo'>Item(s) alterado(s) com sucesso</div>";
                        header("Location: ../../view/contrato/editar.php?id=$id_contratos");
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
                            $mail->Body = "<h3>Erro de query no contrato número: $numero<br>
                            codigo:".$update."<br>".mysqli_error($conectar). "<br>
                            </h3>";
                            $mail-> AltBody = "Este é um email apenas de alerta";
                            
                            $mail->send();


                        $_SESSION['erro'] = "<div class='alert alert-danger' id='tempo'>Erro. Iremos verificar</div>";
                        header("Location: ../../view/contrato/editar.php?id=$id_contratos");
                    }



                /*switch($numero AND $tipo_contrato_ AND $valor_contrato_ AND $inicio AND $fim AND $alerta AND $nota_fiscal_ AND $valor_ AND $situacao_ AND $resumo AND $observacao_) {
                    
                   case $numero !=$contrato_assoc_['numero_contrato'] AND $tipo_contrato_ !=$contrato_assoc_['tipo_contrato'] AND $valor_contrato_ != $contrato_assoc_['valor_contrato'] AND $inicio !=$contrato_assoc_['data_inicio_contrato'] AND $fim !=$contrato_assoc_['data_fim_contrato'] AND $alerta !=$contrato_assoc_['data_alerta_vencimento_contrato'] AND $nota_fiscal_ !=$contrato_assoc_['nota_fiscal']  AND $valor_ != $contrato_assoc_['valor'] AND $situacao_ !=$contrato_assoc_['situacao'] AND $resumo !=$contrato_assoc_['resumo_contrato'] AND $observacao_ != $contrato_assoc_['observacao']:
                    
                    $update = mysqli_query($conectar, "UPDATE contratos SET numero_contrato = '$numero', tipo_contrato ='$tipo_contrato_',  valor_contrato ='$valor_contrato_', data_inicio_contrato ='$inicio', data_fim_contrato ='$fim', data_alerta_vencimento_contrato ='$alerta',  nota_fiscal ='$nota_fiscal_', valor ='$valor_', situacao ='$situacao_', resumo_contrato ='$resumo', observacao ='$observacao_' WHERE id_contratos = '$id_contratos'");
                    
                    if(mysqli_affected_rows($conectar) > 0){
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
                        $mail->Subject = utf8_decode("Realizada alteração de dados: Sistema Contract");
                        $mail->Body = "<h3>Update realizada no contrato número: $numero<br>
                        codigo:".$update."<br> Dia: $date Às $hora horas
                        </h3>";
                        $mail-> AltBody = "Este é um email apenas de alerta";
                    
                        $mail->send();

                        $_SESSION['todos'] = "<div class='alert alert-success'>Todos os dados foram alterados com sucesso</div>";
                        header("Location: ../../view/contrato/editar.php?id=$id_contratos");
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
                        $mail->Body = "<h3>Error de query update<br>
                        codigo:".$update."<br>".mysqli_error($conectar). "<br>
                        </h3>";
                        $mail-> AltBody = "Este é um email apenas de alerta";
                        
                        $mail->send();


                        $_SESSION['erro'] = "<div class='alert alert-danger'>Erro. Iremos verificar</div>";
                        header("Location: ../../view/contrato/editar.php?id=$id_contratos");
                    }

                    break;

                    case $numero !=$contrato_assoc_['numero_contrato'] AND $tipo_contrato_ !=$contrato_assoc_['tipo_contrato'] AND $valor_contrato_ != $contrato_assoc_['valor_contrato']:
                        $update = mysqli_query($conectar, "UPDATE contratos SET numero_contrato = '$numero', tipo_contrato ='$tipo_contrato_',  valor_contrato ='$valor_contrato_', data_inicio_contrato ='$inicio', data_fim_contrato ='$fim', data_alerta_vencimento_contrato ='$alerta',  nota_fiscal ='$nota_fiscal_', valor ='$valor_', situacao ='$situacao_', resumo_contrato ='$resumo', observacao ='$observacao_' WHERE id_contratos = '$id_contratos'");
                        if(mysqli_affected_rows($conectar) > 0){
                            $_SESSION['todos'] = "<div class='alert alert-success'>Número de contrato, tipo de contrato e valor contrato alterados</div>";
                            header("Location: ../../view/contrato/editar.php?id=$id_contratos");
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
                            $mail->Body = "<h3>Error de query update<br>
                            codigo:".$update."<br>".mysqli_error($conectar). "<br>
                            </h3>";
                            $mail-> AltBody = "Este é um email apenas de alerta";
                            
                            $mail->send();
    
    
                            $_SESSION['erro'] = "<div class='alert alert-danger'>Erro. Iremos verificar</div>";
                            header("Location: ../../view/contrato/editar.php?id=$id_contratos");
                        }
                        
                    break;

                    case $numero !=$contrato_assoc_['numero_contrato'] AND $tipo_contrato_ !=$contrato_assoc_['tipo_contrato'] AND $valor_contrato_ != $contrato_assoc_['valor_contrato'] AND $inicio !=$contrato_assoc_['data_inicio_contrato']:
                        $_SESSION['todos'] = "<div class='alert alert-success'>Número de contrato, tipo de contrato e valor contrato alterados</div>";
                        header("Location: ../../view/contrato/editar.php?id=$id_contratos");
                    break;

                    default:
                    $_SESSION['nada'] = "<div class='alert alert-info'>Digite algum dado para ser alterado</div>";
                    header("Location: ../../view/contrato/editar.php?id=$id_contratos");
                    break;
                }*/        
        }
}
