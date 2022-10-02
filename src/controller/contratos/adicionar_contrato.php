<?php
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();

$id_pega_contrato = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);

$select_contrato = mysqli_query($conectar, "SELECT numero_contrato FROM contratos WHERE id_contratos = '$id_pega_contrato' LIMIT 1");
$puxar_dado = mysqli_fetch_assoc($select_contrato);
$numero = $puxar_dado['numero_contrato'];

if(isset($_FILES['arquivo_contrato_pdf']))
{
    $extensão = strtolower(substr($_FILES['arquivo_contrato_pdf']['name'], -30));
    $arquivo = "Contrato do"." "."$numero".$extensão;

    $update = mysqli_query($conectar, "UPDATE contratos SET arquivo_contrato_pdf = '$arquivo' WHERE id_contratos = '$id_pega_contrato'");

    move_uploaded_file($_FILES['arquivo_contrato_pdf']['tmp_name'], '../../view/asset/pdf/' . $arquivo);
    
}