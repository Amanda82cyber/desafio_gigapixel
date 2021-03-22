<?php
    session_start();
    include("conexao.php");

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $tentativas_senha = $_POST["tentativas_senha"];

    $select = "SELECT * FROM usuarios WHERE email = '$usuario'";

    $resultado = mysqli_query($conexao, $select);

    if(mysqli_num_rows($resultado) == 1){
        $select .= " AND senha = '$senha'";

        $resultado2 = mysqli_query($conexao, $select);

        if(mysqli_num_rows($resultado2) == 1){
            while($linha = mysqli_fetch_assoc($resultado2)){
                $_SESSION["nome"][] = $linha["nome"];
                $_SESSION["email"][] = $linha["email"];
                echo "1";
            }
        }else{
            if($tentativas_senha > 0){
                $select1 = "SELECT frase_senha FROM usuarios WHERE email = '$usuario'";
        
                $resultado1 = mysqli_query($conexao, $select1);
        
                while($linha1 = mysqli_fetch_assoc($resultado1)){
                    echo("Sua dica de senha cadastrada: " . $linha1["frase_senha"]);
                }
            }else{
                echo "Senha incorreta!";
            }
        }
    }else{
        echo "Não existe usuário com este e-mail!";
    }
?>