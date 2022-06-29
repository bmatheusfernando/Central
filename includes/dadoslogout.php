<?php

include __DIR__.'/database.php';
include __DIR__.'/dadoslogin.php';


	if(!isset($_SESSION)) {
		session_start;
	}

	session_destroy();

	header("Location /../../index.php");

?>

<main>

	<p>
		<a href="..\..\index.php">Sair</a>
	</p>