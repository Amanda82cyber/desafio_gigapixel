<?php include("verifica_login.php"); ?>

<!DOCTYPE html>

<html lang = "pt_BR">
    <head>
        <meta charset = "UTF-8" />
        <title>Desafio GigaPixel</title>
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />

        <link rel = "stylesheet" href = "help_files/bootstrap/bootstrap.css" />
        <link rel = "stylesheet" href = "help_files/bootstrap/style.css" />

        <script src = "help_files/jquery/jquery.js"></script>
        <script src = "help_files/popper/popper.js"></script>
        <script src = "help_files/bootstrap/bootstrap.js"></script>

        <script defer src = "help_files/fontawesome/solid.js"></script>
        <script defer src = "help_files/fontawesome/fontawesome.js"></script>

        <script>
            function excluir_conta(){
                var confirmacao = confirm("Deseja realmente excluir sua conta?");

                if(confirmacao == true){
                    $.ajax({
                        url: "excluir.php",
                        type: "post",
                        data: {identificador: "email", tabela: "usuarios"}
                        success: function(data){
                            alert(data);
                            window.location.href = "index.php";
                        }
                    });
                }else{
                    alert("Ótima escolha!");
                }
            }
        </script>
    </head>

    <body>
        <nav class = "navbar navbar-expand-lg navbar-light bg-light">
            <img src = "icone.png" class = "d-inline-block align-top mr-1" /> 
            <span class = "navbar-brand">Desafio GigaPixel</span> 

            <button class = "navbar-toggler" type="button" data-toggle = "collapse" data-target = "#menu" aria-controls = "navbarNavAltMarkup" aria-expanded = "false" aria-label = "Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class = "collapse navbar-collapse" id = "menu">
                <ul class = "navbar-nav">
                    <li class = "nav-item active">
                        <a class = "nav-link" href = "home.php"><i class = "fa fa-home" aria-hidden = "true"></i> Home</a>
                    </li>

                    <li class = "nav-item">
                        <a class = "nav-link" href = "recebimentos.php"><i class = "fa fa fa-credit-card" aria-hidden = "true"></i> Recebimentos</a>
                    </li>

                    <li class = "nav-item">
                        <a class = "nav-link" href = "despesas.php"><i class = "fa fa-shopping-cart" aria-hidden = "true"></i> Despesas</a>
                    </li>

                    <li class = "nav-item dropdown">
                        <a class = "nav-link dropdown-toggle" href = "#" id = "menu_dropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
                            <?php
                                $nome = explode(" ", $_SESSION["nome"][0]);

                                echo "<i class = 'fa fa-user-circle' aria-hidden = 'true'></i> $nome[0]";
                            ?>
                        </a>

                        <div class = "dropdown-menu" aria-labelledby = "menu_dropdown">
                            <a class = "dropdown-item" href = "editar_perfil.php">
                                <i class = "fa fa-wrench" aria-hidden = "true"></i> Editar Perfil
                            </a>

                            <a class = "dropdown-item" onclick = "excluir_conta()">
                                <i class = "fa fa-trash" aria-hidden = "true"></i> Excluir Conta
                            </a>

                            <a class = "dropdown-item" href = "logout.php">
                                <i class = "fa fa-share" aria-hidden = "true"></i> Sair
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>