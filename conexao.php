<?php
    // XAMPP
	$local = "localhost";
	$bd = "desafio_gigapixel";
	$senha = "";
	$usuario = "root";

	$conexao = mysqli_connect($local,$usuario,$senha,$bd) or die("Erro ao conectar-se ao banco de dados!");
	
	mysqli_set_charset($conexao, 'utf8');
?>