<?php
    session_start();

    header("Content-Type: Application/json");

    include("conexao.php");

    $email = $_SESSION["email"][0];
    $tabela = $_POST["tabela"];

    $select = "SELECT * FROM $tabela WHERE email_usuario = '$email' ORDER BY data DESC";

    $resultado = mysqli_query($conexao, $select);

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz["carregamentos"][] = $linha;
    }

    echo json_encode($matriz);
?>