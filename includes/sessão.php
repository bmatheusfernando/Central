<?php

include __DIR__.'/database.php';
include __DIR__.'/dadoslogin.php';

	if(!isset($_SESSION)) {
	session_start();
	}	

	if(!isset($_SESSION['id'])) {
		die("Você não pode acesssar está página porque não está logado.<p><a href=\"..\..\index.php\">Entrar</a></p>");
	} else {
		echo "Bem vindo " . $_SESSION['nome'];
	}

?>