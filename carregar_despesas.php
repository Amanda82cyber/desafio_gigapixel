<?php
    session_start();

    header("Content-Type: Application/json");

    include("conexao.php");

    $email = $_SESSION["email"][0];

    $select = "SELECT * FROM  WHERE email_usuario = '$email' ORDER BY data";

    $resultado = mysqli_query($conexao, $select);

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz["recebimentos"][] = $linha;
    }

    echo json_encode($matriz);
?>