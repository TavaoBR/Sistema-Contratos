<?php 
session_start();
include_once("../../model/verifica/verifica.php");
seguranca_adm();
verativo();

include_once("../../model/conection/conexao.php");

if(isset($_POST['Registrar'])){
  $nome = $_POST['nome_fornecedor'];
  $cnpj = $_POST['cpnj_fornecedor'];
  $estado = $_POST['estado_fornecedor'];
  $cidade = $_POST['cidade_fornecedor'];
  $endereco = $_POST['endereco_fornecedor'];
  $bairro = $_POST['bairro_fornecedor'];

   if($nome == "" AND $cnpj == "" AND $estado == "" AND $cidade == "" AND $endereco == "" AND $bairro == ""){
      $_SESSION['preencha_campos'] = "<div class='alert alert-warning' id='tempo'>
       Preencha Todos os campos
      </div>";
      header("Location: ../../view/fornecedor/cadastro.php");
   }elseif($nome == ""){
    $_SESSION['preencha_nome'] = "<div class='alert alert-warning' id='tempo'>
    Preencha o campo nome
   </div>";
   $_SESSION['cnpj'] = $cnpj;
   $_SESSION['estado'] = $estado;
   $_SESSION['cidade'] = $cidade;
   $_SESSION['endereco'] = $endereco;
   $_SESSION['bairro'] = $bairro;
   header("Location: ../../view/fornecedor/cadastro.php");
   }elseif($cnpj == ""){
    $_SESSION['preencha_cnpj'] = "<div class='alert alert-warning' id='tempo'>
    Preencha o campo cnpj
   </div>";
   $_SESSION['nome'] = $nome;
   $_SESSION['estado'] = $estado;
   $_SESSION['cidade'] = $cidade;
   $_SESSION['endereco'] = $endereco;
   $_SESSION['bairro'] = $bairro;
   header("Location: ../../view/fornecedor/cadastro.php");
   }elseif($estado == ""){
    $_SESSION['preencha_estado'] = "<div class='alert alert-warning' id='tempo'>
    Preencha o campo estado
   </div>";
   $_SESSION['nome'] = $nome;
   $_SESSION['cnpj'] = $cnpj;
   $_SESSION['cidade'] = $cidade;
   $_SESSION['endereco'] = $endereco;
   $_SESSION['bairro'] = $bairro;
   header("Location: ../../view/fornecedor/cadastro.php");
   }elseif($cidade == ""){
    $_SESSION['preencha_cidade'] = "<div class='alert alert-warning' id='tempo'>
    Preencha o campo cidade
   </div>";
   $_SESSION['nome'] = $nome;
   $_SESSION['cnpj'] = $cnpj;
   $_SESSION['estado'] = $estado;
   $_SESSION['endereco'] = $endereco;
   $_SESSION['bairro'] = $bairro;
   header("Location: ../../view/fornecedor/cadastro.php");
   }elseif($endereco == ""){
    $_SESSION['preencha_endereco'] = "<div class='alert alert-warning' id='tempo'>
    Preencha o campo endereço
   </div>";
   $_SESSION['nome'] = $nome;
   $_SESSION['cnpj'] = $cnpj;
   $_SESSION['estado'] = $estado;
   $_SESSION['cidade'] = $cidade;
   $_SESSION['bairro'] = $bairro;
   header("Location: ../../view/fornecedor/cadastro.php");
   }elseif($bairro == ""){
    $_SESSION['preencha_bairro'] = "<div class='alert alert-warning' id='tempo'>
    Preencha o campo bairro
   </div>";
   $_SESSION['nome'] = $nome;
   $_SESSION['cnpj'] = $cnpj;
   $_SESSION['estado'] = $estado;
   $_SESSION['cidade'] = $cidade;
   $_SESSION['endereco'] = $endereco;
   header("Location: ../../view/fornecedor/cadastro.php");
   }else{
     
     $select_fornecedor = mysqli_query($conectar, "SELECT * FROM fornecedor WHERE cpnj_fornecedor = '$cnpj' LIMIT 1");
     $assoc_batman = mysqli_fetch_assoc($select_fornecedor);

     if(isset($assoc_batman)){

      $_SESSION['fornecedor_cadastrado'] = "<div class ='alert alert-danger' id='tempo'>Fornecedor já cadastrado</div>";
      $_SESSION['nome'] = $nome;
      $_SESSION['estado'] = $estado;
      $_SESSION['cidade'] = $cidade;
      $_SESSION['endereco'] = $endereco;
      $_SESSION['bairro'] = $bairro;
      header("Location: ../../view/fornecedor/cadastro.php");

     }else{

      $insert_fornecedor = mysqli_query($conectar, "INSERT INTO fornecedor(nome_fornecedor, bairro_fornecedor, cidade_fornecedor, estado_fornecedor, cpnj_fornecedor, endereco_fornecedor) VALUES('$nome','$bairro','$cidade','$estado','$cnpj', '$endereco')");
      if(mysqli_affected_rows($conectar) > 0){
        $_SESSION['sucesso'] = "<div class ='alert alert-success' id='tempo'>Fornecedor cadastrado com sucesso</div>";
        header("Location: ../../view/fornecedor/cadastro.php");
      }else{
        $_SESSION['erro'] = "<div class ='alert alert-danger' id='tempo'>Erro ao cadastrar fornecedor. Entre em contato com o suporte</div>";
        $_SESSION['nome'] = $nome;
        $_SESSION['cnpj'] = $cnpj;
        $_SESSION['estado'] = $estado;
        $_SESSION['cidade'] = $cidade;
        $_SESSION['endereco'] = $endereco;
        $_SESSION['bairro'] = $bairro;
        header("Location: ../../view/fornecedor/cadastro.php");
      }

     }     

   }
}