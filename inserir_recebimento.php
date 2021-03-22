<?php
    session_start();
    include("conexao.php");

    $proveniencia = $_POST["proveniencia"];
    $valor = $_POST["valor"];
    $data = $_POST["data"];
    $id = $_POST["ident"];

    $email = $_SESSION["email"][0];

    if($id == 0){
        $comando = "INSERT INTO recebimentos(proveniencia, valor, data, email_usuario) VALUES('$proveniencia', '$valor', '$data', '$email')";
    }else{
        $comando = "UPDATE recebimentos SET
                        proveniencia = '$proveniencia',
                        valor = '$valor',
                        data = '$data'
                    WHERE id_recebimento = $id";
    }

    mysqli_query($conexao, $comando) or die("Erro no banco de dados: " . mysqli_error($conexao));

    echo "1";
?>