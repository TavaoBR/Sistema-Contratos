<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/css/login.css">
    <title>Login</title>
</head>
<body>
<div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Tela de login</h3>
                        <form action="../../controller/usuario/validacao.php" method="POST" class="requires-validation">
                        <?php 

                         if(isset($_SESSION["nao_autenticado"])){
                              echo "<div class='alert alert-danger'>
                                      Dados invalidos
                                    </div>";
                            unset($_SESSION["nao_autenticado"]);        
                         }

                         if(isset($_SESSION['logindeslogado'])){
                            echo "<div class = 'alert alert-success'>
                             Deslogado com sucesso
                            </div>";
                            unset($_SESSION['logindeslogado']);
                         }

                         if(isset($_SESSION['loginErro'])){
                             echo "<div class = 'alert alert-warning'>
                              Área restrita
                             </div>";
                             unset($_SESSION['loginErro']);
                         }
                        
                        ?>
                            <div class="col-md-12">
                               <input class="form-control" type="text" name="usuario" placeholder="Nome de usuario. Exemplo: nome+matricula" required>
                            </div>

                           <div class="col-md-12">
                              <input class="form-control" type="password" name="senha" placeholder="Senha" required>
                           </div>

                            <div class="form-button mt-3">
                                <button type="submit" class="btn btn-primary">Logar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>