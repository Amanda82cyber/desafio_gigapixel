<?php
    session_start();
    include("conexao.php");

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $tentativas_senha = $_POST["tentativas_senha"];

    if($tentativas_senha > 0){
        $select = "SELECT frase_senha FROM usuarios WHERE email = '$usuario'";

        $resultado = mysqli_query($conexao, $select);

        while($linha = mysqli_fetch_assoc($resultado)){
            die("Sua dica de senha cadastrada: " .$linha["frase_senha"]);
        }
    }

    $select = "SELECT * FROM usuarios WHERE email = '$usuario'";

    $resultado = mysqli_query($conexao, $select);

    if(mysqli_num_rows($resultado) == 1){
        $select .= " AND senha = '$senha'";

        $resultado2 = mysqli_query($conexao, $select);

        if(mysqli_num_rows($resultado2) == 1){
            while($linha = mysqli_fetch_assoc($resultado2)){
                $_SESSION["nome"][] = $linha["nome"];
                echo "1";
            }
        }else{
            echo "Senha incorreta!";
        }
    }else{
        echo "Não existe usuário com este e-mail!";
    }
?>