<?php
    include("conexao.php");

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $profissao = $_POST["profissao"];
    $senha = $_POST["senha"];
    $frase_senha = $_POST["frase_senha"];
    $data_nascimento = $_POST["data_nascimento"];

    $select = "SELECT * FROM usuarios WHERE email = '$email'";

    $resultado = mysqli_query($conexao, $select);

    if(mysqli_num_rows($resultado) > 0){
        die("E-mail já cadastrado!");
    }

    $inserir = "INSERT INTO usuarios(nome, email, profissao, senha, frase_senha, data_nascimento) VALUES('$nome', '$email', '$profissao', '$senha', '$frase_senha', '$data_nascimento')";

    mysqli_query($conexao, $inserir) or die("Erro do banco: " . mysqli_error($conexao));

    echo "1";
?>