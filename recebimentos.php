<?php include("verifica_login.php"); include("menu.php");?>

        <script>
            var ident = 0;

            $(document).ready(function(){
                $('#cadastro_recebimento').on('shown.bs.modal', function (e) {
                    if($("#title").html() == 'Cadastro de Recebimento'){
                        $("#proveniencia").val("");
                        $("#valor").val("");
                        $("#data").val("");

                        $("#msg_cadastro").html("");
                    }else{
                        $("#msg_cadastro").html("");
                    }
                });

                $("#fechar").click(function(){
                    if($("#title").html() == 'Alterar Recebimento'){
                        $("#title_cadastro").html('<i class = "fa fa-university" aria-hidden = "true"></i>  <span id = "title">Cadastro de Recebimento</span>');
                    }
                });
            });

            (function() {
                carregar_recebimentos();

                'use strict';
                window.addEventListener('load', function() {

                    var forms = document.getElementsByClassName('needs-validation');

                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity()) {
                                $.ajax({
                                    url: "inserir_recebimento.php",
                                    type: "post",
                                    data: {proveniencia: $("#proveniencia").val(), valor: $("#valor").val(), data: $("#data").val(), ident},
                                    success: function(data){
                                        if(data == 1){
                                            carregar_recebimentos();
                                            
                                            $("#msg_cadastro").html("Recebimento salvo!").css("color", "green");
                                        }else{
                                            $("#msg_cadastro").html(data).css("color", "red");
                                        }
                                    }
                                });
                            }else{
                                $("#msg_cadastro").html("*Preencha os campos obrigat??rios!").css("color", "red");
                            }    

                            event.preventDefault();
                            event.stopPropagation();
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();

            function carregar_recebimentos(){
                $.ajax({
                    url: "carregar.php",
                    type: "post",
                    data: {tabela: "recebimentos"},
                    success: function(matriz){
                        var soma = 0;

                        $("#tb_recebimentos").html("");

                        for(i = 0; i < matriz["carregamentos"].length; i++){
                            list = `<tr>
                                        <th scope = "row">${matriz["carregamentos"][i].proveniencia}</th>
                                        <td>${matriz["carregamentos"][i].data}</td>
                                        <td>${matriz["carregamentos"][i].valor}</td>
                                        <td class = "text-left">
                                            <button class = "btn btn-outline-success btn-sm popover-test" title = "Editar" onclick = "alterar('${matriz["carregamentos"][i].proveniencia}', '${matriz["carregamentos"][i].valor}', '${matriz["carregamentos"][i].data}', ${matriz["carregamentos"][i].id_recebimento})">
                                                <i class = "fa fa-wrench" aria-hidden = "true"></i>
                                            </button>

                                            <button class = "btn btn-outline-danger btn-sm popover-test" title = "Excluir" onclick = "excluir(${matriz["carregamentos"][i].id_recebimento})">
                                                <i class = "fa fa-trash" aria-hidden = "true"></i>
                                            </button>
                                        </td>
                                    </tr>`;
                            
                            soma += parseFloat(matriz["carregamentos"][i].valor);
   
                            $("#tb_recebimentos").append(list)
                        }

                        localStorage.removeItem("soma_recebimentos");

                        let dados = JSON.parse(localStorage.getItem("soma_recebimentos") || "[]");
    
                        var aux_somatoria = {
                            soma_final: soma
                        }
        
                        dados.push(aux_somatoria);

                        console.log(aux_somatoria);
        
                        localStorage.setItem("soma_recebimentos", JSON.stringify(dados));
                    }
                });
            }

            function alterar(proveniencia, valor, data, id){
                ident = id;

                $("#proveniencia").val(proveniencia);
                $("#valor").val(valor);
                $("#data").val(data);
                $("#title_cadastro").html('<i class = "fa fa-wrench" aria-hidden = "true"></i> <span id = "title">Alterar Recebimento</span>');

                $("#cadastro_recebimento").modal("show");
            }

            function excluir(id){
                var confirmacao = confirm("Deseja realmente excluir este recebimento?");

                if(confirmacao == true){
                    $.ajax({
                        url: "excluir.php",
                        type: "post",
                        data: {indentificador: "id_recebimento", tabela: "recebimentos", id},
                        success: function(data){
                            carregar_recebimentos();
                            alert(data);
                        }
                    });
                }else{
                    alert("??tima escolha!");
                }
            }
        </script>

        <!-- ==== RECEBIMENTOS ==== -->

        <div class = "container-fluid">
            <div class = "row">
                <div class = "col-md-2 col-sm-12 col-xs-12"></div>

                <div class = "col-md-8 col-sm-12 col-xs-12">
                    <div class = "card mt-2">
                        <div class = "card-header">
                            <h5 style = "display: inline;"><i class = "fa fa fa-credit-card" aria-hidden = "true"></i> Recebimentos</h5>

                            <button type = "button" class = "btn btn-outline-primary btn-sm float-right popover-test" title = "Cadastrar Mais" data-toggle = "modal" data-target = "#cadastro_recebimento">
                                <i class = "fa fa-plus-square" aria-hidden = "true"></i>
                            </button>
                        </div>
                        
                        <div class = "card-body">
                            <div class = "table-responsive">
                                <table class = "table rounded">
                                    <thead class = "thead-dark">
                                        <tr>
                                            <th scope = "col">Proveni??ncia</th>
                                            <th scope = "col">Data</th>
                                            <th scope = "col">Valor</th>
                                            <th scope = "col">A????es</th>
                                        </tr>
                                    </thead>

                                    <tbody id = "tb_recebimentos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col-md-2 col-sm-12 col-xs-12"></div>
            </div>
        </div>

        <!-- ==== MODAL - CADASTRO DE RECEBIMENTO ==== -->

        <div class = "modal fade" id = "cadastro_recebimento" tabindex = "-1" role = "dialog" aria-labelledby = "title_cadastro" aria-hidden = "true">
            <div class = "modal-dialog modal-lg" role = "document">
                <div class = "modal-content">
                    <div class = "modal-header border-primary">
                        <h4 class = "modal-title text-primary" id = "title_cadastro">
                            <i class = "fa fa-university" aria-hidden = "true"></i> 
                            <span id = "title">Cadastro de Recebimento</span>
                        </h4>

                        <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Fechar" id = "fechar">
                            <span aria-hidden = "true" class = "text-primary">&times;</span>
                        </button>
                    </div>

                    <div class = "modal-body">
                        <form class = "needs-validation" novalidate>
                            <div class = "form-row">
                                <div class = "form-group col-md-6">
                                    <label for = "proveniencia">Proveni??ncia</label>
                                    <input type = "text" class = "form-control" id = "proveniencia" placeholder = "De onde veio esse dinheiro?" required />
                                </div>

                                <div class = "form-group col-md-6">
                                    <label for = "valor">Valor</label>
                                    <input type = "number" class = "form-control" id = "valor" step = "0.01" min = "1" required />
                                </div>

                                <div class = "form-group col-md-6">
                                    <label for = "data">Data</label>
                                    <input type = "date" class = "form-control" id = "data" required />
                                </div>

                                <div class = "form-group col-md-3"></div>

                                <div class = "form-group col-md-3">
                                    <label class = "invisible">A</label>
                                    <input id = "salvar" class = "btn btn-primary btn-block btn-md" type = "submit" value = "Salvar" />
                                </div>

                                <div class = "form-group col-md-12" id = "msg_cadastro"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>