<?php
    header("Content-Type: Application/json");

    include("conexao.php");

    $email = $_POST["email"];

    $select = "SELECT * FROM usuarios WHERE email = '$email'";

    $resultado = mysqli_query($conexao, $select);

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz["perfil"][] = $linha;
    }

    echo json_encode($matriz);
?>