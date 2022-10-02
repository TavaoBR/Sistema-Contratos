<?php 
include_once("../../model/conection/conexao.php");

session_start();

//O campo usuario e senha para podemos validar usando if
if((isset($_POST['usuario'])) && (isset($_POST['senha']))){
    $usuario = mysqli_real_escape_string($conectar, $_POST['usuario']);//comando real_escape_string é para prevenção contra sql injection
    $senha = mysqli_real_escape_string($conectar, $_POST['senha']);
    $Senha = md5($senha);//medida de segurança usando a criptografia em senhas usando hash5 ou md5

    //declarando variavel que recebe o select direto do banco. Utilizando linguagem de sql para selecionamos o usuario que está tetando acessar o sistema
    $resultado = "SELECT * FROM `usuario` WHERE (usuario = '{$usuario}' or email = '{$usuario}') and senha = '{$Senha}' LIMIT 1";
    //declarando variavel para fazer a query de conexão
    $query = mysqli_query($conectar, $resultado);
    $user = mysqli_fetch_assoc($query);


   

    //encontrando o usuario na tabela com os valores digitados nos campos atraves do if
    //variaveis globais recebendo as linhas da tabela no banco de dados
    if(isset($user)){
        $_SESSION['usuarioID'] = $user['id_usuario']; 
        $_SESSION['usuarioUser'] = $user['usuario'];
        $_SESSION['usuarioNome'] = $user['nome'];
        $_SESSION['usuarioEmail'] = $user['email'];
        $_SESSION['usuarioSenha'] = $user['senha'];
        $_SESSION['usuarioNivel4'] = $user['contract'];
     
        if($_SESSION['usuarioNivel4'] == "1"){
            header("Location: ../../view/fornecedor/cadastro.php");
        }else{
            //variavel global recebendo mensagem de erro 
            $_SESSION["nao_autenticado"] = true;
            header("Location: ../../view/login/login.php");
            exit();
        }
    //caso nao encontre o usuario na tabela, será redirecionado de volta para a tela de login    
    }else{
        //variavel global recebendo mensagem de erro 
        $_SESSION["nao_autenticado"] = true;
        header("Location: ../../view/login/login.php");
        exit();
}

}else{
    //campos nao preenchidos dá a mensagem de erro e volta para o login
    $_SESSION["nao_autenticado"] = true;
    header("Location: ../../view/login/login.php");
    exit();
  }



?>