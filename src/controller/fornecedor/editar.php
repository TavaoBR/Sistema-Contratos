<?php
session_start();
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();
include_once("../../model/conection/conexao.php");

if(isset($_POST['Editar'])){
$id = $_POST['id'];
$nome = $_POST['nome_fornecedor'];
$cnpj = $_POST['cpnj_fornecedor'];
$estado = $_POST['estado_fornecedor'];
$cidade = $_POST['cidade_fornecedor'];
$endereco = $_POST['endereco_fornecedor'];
$bairro = $_POST['bairro_fornecedor'];

$comparado_select = mysqli_query($conectar, "SELECT * FROM fornecedor WHERE id_fornecedor != '$id'");
$comparado_assoc = mysqli_fetch_assoc($comparado_select);
    
    if($comparado_assoc['cpnj_fornecedor'] == $cnpj){
        $_SESSION['cnpj'] = "<div class ='alert alert-danger' id='tempo'>O cnpj digitado já está vinculado a outro fornecedor</div>";
        header("Location: ../../view/fornecedor/editar.php?id=$id");
    }else{
          $update = mysqli_query($conectar, "UPDATE fornecedor SET nome_fornecedor ='$nome', cpnj_fornecedor ='$cnpj', estado_fornecedor ='$estado', cidade_fornecedor ='$cidade', endereco_fornecedor ='$endereco', bairro_fornecedor ='$bairro' WHERE id_fornecedor ='$id'");
          if(mysqli_affected_rows($conectar) > 0){
            $_SESSION['sucesso'] = "<div class ='alert alert-success' id='tempo'>Alterado com sucesso</div>";
            header("Location: ../../view/fornecedor/editar.php?id=$id");
          }else{
            $_SESSION['erro'] = "<div class ='alert alert-danger' id='tempo'>Erro. Entre em contato com suporte</div>";
            header("Location: ../../view/fornecedor/editar.php?id=$id");
          }
    }
}