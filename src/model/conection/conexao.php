<?php

define('HOST','127.0.0.1:3306');
define('USUARIO','u637174467_James');
define('SENHA','Guga1234%!');
define('BANCO','u637174467_Ecosistema');

$conectar = mysqli_connect(HOST, USUARIO, SENHA, BANCO) or die("Nao conectou");

/*define('HOST','localhost');
define('USUARIO','James');
define('SENHA','Guga1234%!');
define('BANCO','original');

$conectar = mysqli_connect(HOST, USUARIO, SENHA, BANCO) or die("Nao conectou");*/

?>