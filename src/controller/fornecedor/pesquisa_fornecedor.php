<?php 
include_once("../../model/conection/conexao.php");

$fornecedor = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$select = mysqli_query($conectar, "SELECT * FROM fornecedor WHERE nome_fornecedor LIke '%$fornecedor%'");
if((isset($select)) AND ($select->num_rows != 0)){
    echo "<div class='container mt-3'>
    <h2>Fornecedores</h2>           
    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Nome</th>
          <th>CNPJ</th>
          <th>Opção</th>
        </tr>
      </thead>
      <tbody>";


   
    while($row = mysqli_fetch_assoc($select)){
        extract($row);
        echo "
        <tr>
          <td>$nome_fornecedor</td>
          <td>$cpnj_fornecedor</td>
          <td><a href='../contrato/cadastro.php?id=$id_fornecedor' class='text-success'><i class='fa-solid fa-folder-plus'></i></a></td>
        </tr>
        ";
    }

   echo "
    </tbody>
    </table>
  </div>
    ";
}else{
      echo "NADA ECONTRADO...<br>";
      echo "<a href='#' class ='btn btn-success'>Cadastrar</a>";

}