<?php
	function seguranca_adm(){
		if(!$_SESSION['usuarioID'] || !$_SESSION['usuarioUser'] || !$_SESSION['usuarioNivel4']){
			$_SESSION['loginErro'] = true;		
			header("Location: ../../view/login/login.php");
			exit();
		}
		
	}
	
	function verativo(){
		if($_SESSION['usuarioNivel4'] != "1" ){
			$_SESSION['loginErro'] = true;		
			header("Location: ../../view/login/login.php");
			exit();
		}
	}
?>