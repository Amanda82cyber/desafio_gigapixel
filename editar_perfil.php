<?php 
    include("verifica_login.php");
    
    include("menu.php");

    $email = $_SESSION["email"][0];
    
    echo "<script>$(document).ready(function(){carregar_perfil('$email')});</script>";
?>

        <script>
            var email_update = ""; 

            function carregar_perfil(email){
                email_update = email;

                $.ajax({
                    url: "carregar_perfil.php",
                    type: "post",
                    data: {email},
                    success: function(matriz){
                        $("#nome").val(matriz["perfil"][0].nome);
                        $("#profissao").val(matriz["perfil"][0].profissao);
                        $("#email_cadastro").val(matriz["perfil"][0].email);
                        $("#data_nascimento").val(matriz["perfil"][0].data_nascimento);
                        $("#senha_cadastro").val(matriz["perfil"][0].senha);
                        $("#confirmar_senha").val(matriz["perfil"][0].senha);
                        $("#frase_senha").val(matriz["perfil"][0].frase_senha);
                    }
                });            
            }

            (function() {
                'use strict';
                window.addEventListener('load', function() {

                    var forms = document.getElementsByClassName('needs-validation');

                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity()) {
                                if($("#senha_cadastro").val() == $("#confirmar_senha").val()){
                                    $.ajax({
                                        url: "inserir_usuario.php",
                                        type: "post",
                                        data: {nome: $("#nome").val(), profissao: $("#profissao").val(), email: $("#email_cadastro").val(), senha: $("#senha_cadastro").val(), frase_senha: $("#frase_senha").val(), data_nascimento: $("#data_nascimento").val(), email_update},
                                        success: function(data){
                                            if(data == 1){
                                                $("#msg_cadastro").html("Dados alterados com sucesso!").css("color", "green");
                                            }else{
                                                $("#msg_cadastro").html(data).css("color", "red");
                                            }
                                        }
                                    });
                                }else{
                                    $("#msg_cadastro").html("Os campos 'Senha' e 'Confirmar Senha' devem ser iguais!!").css("color", "red");
                                }
                            }else{
                                $("#msg_cadastro").html("*Preencha os campos obrigatórios!").css("color", "red");
                            }    

                            event.preventDefault();
                            event.stopPropagation();
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>

        <div class = "container-fluid">
            <div class = "row">
                <div class = "col-md-2 col-sm-12 col-xs-12"></div>

                <div class = "col-md-8 col-sm-12 col-xs-12">
                    <div class = "card mt-2">
                        <h5 class = "card-header"><i class = "fa fa-wrench" aria-hidden = "true"></i> Editar Perfil</h5>
                        
                        <div class = "card-body">
                           <?php include("form_usuarios.inc"); ?>
                        </div>
                    </div>
                </div>

                <div class = "col-md-2 col-sm-12 col-xs-12"></div>
            </div>
        </div>

    </body>
</html>