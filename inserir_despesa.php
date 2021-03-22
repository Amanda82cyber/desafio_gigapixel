<?php
    session_start();
    include("conexao.php");

    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];
    $data = $_POST["data"];
    $id = $_POST["ident"];

    $email = $_SESSION["email"][0];

    if($id == 0){
        $comando = "INSERT INTO despesas(descricao, valor, data, email_usuario) VALUES('$descricao', '$valor', '$data', '$email')";
    }else{
        $comando = "UPDATE despesas SET
                        descricao = '$descricao',
                        valor = '$valor',
                        data = '$data'
                    WHERE id_despesa = $id";
    }

    mysqli_query($conexao, $comando) or die("Erro no banco de dados: " . mysqli_error($conexao));

    echo "1";
?>