<!DOCTYPE html>

<html lang = "pt_BR">
    <head>
        <meta charset = "UTF-8" />
        <title>Login</title>
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />

        <link rel = "stylesheet" href = "help_files/bootstrap/bootstrap.css" />
        <link rel = "stylesheet" href = "help_files/bootstrap/style.css" />

        <script src = "help_files/jquery/jquery.js"></script>
        <script src = "help_files/popper/popper.js"></script>
        <script src = "help_files/bootstrap/bootstrap.js"></script>

        <script defer src = "help_files/fontawesome/solid.js"></script>
        <script defer src = "help_files/fontawesome/fontawesome.js"></script>
    </head>

    <script>
        var tentativas_senha = 0;

        $(document).ready(function(){
            $("#btn_senha").click(function(){
                if($("#senha").attr("type") ==  "password"){
                    $("#btn_senha").html('<i class = "fa fa-eye" aria-hidden = "true"></i>');
                    $("#senha").attr("type", "text");
                }else{
                    $("#btn_senha").html('<i class = "fa fa-eye-slash" aria-hidden = "true"></i>');
                    $("#senha").attr("type", "password");
                }
            });
        });

        function logar(){
            if(($("#usuario").val() == "") && ($("#senha").val() == "")){
                $("#msg_login").html("*Preencha os campos obrigatórios!").css("color", "red");
            }else{
                $.ajax({
                    url: "validar_login.php",
                    type: "post",
                    data: {usuario: $("#usuario").val(), senha: $("#senha").val(), tentativas_senha},
                    success: function(data){
                        if(data == 1){
                            $("#senha").val("");
                            $("#usuario").val("");
                            window.location.href = "home.php";
                        }else{
                            if(data == "Senha incorreta!"){
                                tentativas_senha++;
                            }

                            $("#msg_login").html(data).css("color", "red");
                        }
                    }
                });
            }
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
                                    data: {nome: $("#nome").val(), profissao: $("#profissao").val(), email: $("#email_cadastro").val(), senha: $("#senha_cadastro").val(), frase_senha: $("#frase_senha").val(), data_nascimento: $("#data_nascimento").val()},
                                    success: function(data){
                                        if(data == 1){
                                            alert("Usuário cadastrado! Faça seu login!");
                                            window.location.href = "index.php";
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

    <body>
        <!-- ==== LOGIN ==== -->

        <div class = "container-fluid">
            <div class = "row">
                <div class = "col-md-4 col-sm-12 col-xs-12"></div>

                <div class = "col-md-4 col-sm-12 col-xs-12">
                    <div class = "card mt-5 border-primary">
                        <div class = "card-body">
                            <img src = "img_login.png" style = "display: block; margin: 0 auto;" />

                            <form>
                                <div class = "form-row">
                                    <div class = "form-group col-md-12">
                                        <div class = "input-group mt-3">
                                            <div class = "input-group-prepend">
                                                <span class = "input-group-text bg-transparent border-primary text-primary" id = "addon_email">@</span>
                                            </div>
                                            <input type = "email" class = "form-control" id = "usuario" placeholder = "E-mail" aria-label = "Usuário" aria-describedby = "addon_email" required />
                                        </div>
                                    </div>

                                    <div class = "form-group col-md-12">
                                        <div class = "input-group">
                                            <input class = "form-control" type = "password" id = "senha" placeholder = "Senha" aria-describedby = "btn_senha" required />
                                            <div class = "input-group-append">
                                                <button class = "btn btn-outline-primary" type = "button" id = "btn_senha"><i class = "fa fa-eye-slash" aria-hidden = "true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class = "form-group col-md-12" id = "msg_login"></div>

                                    <div class = "form-group col-md-12 mt-3">
                                        <button onclick = "logar()" class = "btn btn-primary btn-block btn-md" type = "button">Entrar</button>
                                    </div>

                                    <div class = "form-group col-md-12">
                                        <button type = "button" class = "btn btn-outline-primary btn-block btn-sm" data-toggle = "modal" data-target = "#cadastro_usuario">Cadastrar</button>
                                    </div>
                                    
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>

                <div class = "col-md-4 col-sm-12 col-xs-12"></div>
            </div>
        </div>

        <!-- ==== MODAL - CADASTRO DE USUÁRIO ==== -->

        <div class = "modal fade" id = "cadastro_usuario" tabindex = "-1" role = "dialog" aria-labelledby = "title_cadastro" aria-hidden = "true">
            <div class = "modal-dialog modal-lg" role = "document">
                <div class = "modal-content">
                    <div class = "modal-header border-primary">
                        <h4 class = "modal-title text-primary" id = "title_cadastro">
                            <i class = "fa fa-address-book" aria-hidden = "true"></i> Cadastro de Usuário
                        </h4>

                        <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Fechar">
                            <span aria-hidden = "true" class = "text-primary">&times;</span>
                        </button>
                    </div>

                    <div class = "modal-body">
                        <form class = "needs-validation" novalidate>
                            <div class = "form-group">
                                <label for = "nome" class = "col-form-label">Nome</label>
                                <input type = "text" class = "form-control" id = "nome" required />
                            </div>

                            <div class = "form-group">
                                <label for = "data_nascimento" class = "col-form-label">Data de Nascimento</label>
                                <input type = "date" class = "form-control" id = "data_nascimento" required />
                            </div>

                            <div class = "form-group">
                                <label for = "profissao" class = "col-form-label">Profissão</label>
                                <input type = "text" class = "form-control" id = "profissao" required />
                            </div>

                            <div class = "form-group">
                                <label for = "email_cadastro" class = "col-form-label">E-mail</label>
                                <input type = "email" class = "form-control" id = "email_cadastro" required />
                            </div>

                            <div class = "form-group">
                                <label for = "senha_cadastro" class = "col-form-label">Senha</label>
                                <input type = "password" class = "form-control" id = "senha_cadastro" required />
                            </div>

                            <div class = "form-group">
                                <label for = "confirmar_senha" class = "col-form-label">Confirmar Senha</label>
                                <input type = "password" class = "form-control" id = "confirmar_senha" required />
                            </div>

                            <div class = "form-group">
                                <label for = "frase_senha" class = "col-form-label">Uma frase que te faça lembrar da senha</label>
                                <input type = "text" class = "form-control" id = "frase_senha" required />
                            </div>

                            <div class = "form-group" id = "msg_cadastro"></div>

                            <input id = "cadastrar" class = "btn btn-primary btn-block btn-md" type = "submit" value = "Cadastrar" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>