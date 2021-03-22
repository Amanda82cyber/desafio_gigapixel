<?php
    session_start();
    include("conexao.php");

    $indentificador = $_POST["indentificador"];
    $tabela = $_POST["tabela"];

    if($tabela == "usuarios"){
        $email = $_SESSION["email"][0];

        $delete = "DELETE FROM $tabela WHERE $indentificador = '$email'";
    }else{
        $id = $_POST["id"];

        $delete = "DELETE FROM $tabela WHERE $indentificador = '$id'";
    }
    
    mysqli_query($conexao, $delete) or die("Erro no banco de dados: " . mysqli_error($conexao));

    echo "Remoção efetuada com sucesso!";
?>