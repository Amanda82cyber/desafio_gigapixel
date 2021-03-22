<?php include("verifica_login.php"); include("menu.php"); ?>

        <script>
            var ident = 0;
            var saldo = 0;

            $(document).ready(function(){
                carregar_despesas();

                $('#cadastro_despesa').on('shown.bs.modal', function (e) {
                    if($("#title").html() == 'Cadastro de Despesas'){
                        $("#descricao").val("");
                        $("#valor").val("");
                        $("#data").val("");

                        $("#msg_cadastro").html("");
                    }else{
                        $("#msg_cadastro").html("");
                    }
                });

                $("#fechar").click(function(){
                    if($("#title").html() == 'Alterar Recebimento'){
                        $("#title_cadastro").html('<i class = "fa fa-shopping-basket" aria-hidden = "true"></i>  <span id = "title">Cadastro de Despesas</span>');
                    }
                });
            });

            (function() {
                'use strict';
                window.addEventListener('load', function() {

                    var forms = document.getElementsByClassName('needs-validation');

                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity()) {
                                $.ajax({
                                    url: "inserir_despesa.php",
                                    type: "post",
                                    data: {descricao: $("#descricao").val(), valor: $("#valor").val(), data: $("#data").val(), ident},
                                    success: function(data){
                                        if(data == 1){
                                            carregar_despesas();
                                            $("#msg_cadastro").html("Despesa salva!").css("color", "green");
                                        }else{
                                            $("#msg_cadastro").html(data).css("color", "red");
                                        }
                                    }
                                });
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

            function carregar_despesas(){
                $.ajax({
                    url: "carregar.php",
                    type: "post",
                    data: {tabela: "despesas"},
                    success: function(matriz){
                        var soma = 0;

                        $("#tb_despesas").html("");

                        for(i = 0; i < matriz["carregamentos"].length; i++){
                            list = `<tr>
                                        <th scope = "row">${matriz["carregamentos"][i].descricao}</th>
                                        <td>${matriz["carregamentos"][i].data}</td>
                                        <td>${matriz["carregamentos"][i].valor}</td>
                                        <td class = "text-left">
                                            <button class = "btn btn-outline-success btn-sm popover-test" title = "Editar" onclick = "alterar('${matriz["carregamentos"][i].descricao}', '${matriz["carregamentos"][i].valor}', '${matriz["carregamentos"][i].data}', ${matriz["carregamentos"][i].id_despesa})">
                                                <i class = "fa fa-wrench" aria-hidden = "true"></i>
                                            </button>

                                            <button class = "btn btn-outline-danger btn-sm popover-test" title = "Excluir" onclick = "excluir('${matriz["carregamentos"][i].id_despesa}')">
                                                <i class = "fa fa-trash" aria-hidden = "true"></i>
                                            </button>
                                        </td>
                                    </tr>`;

                            soma += parseFloat(matriz["carregamentos"][i].valor);
   
                            $("#tb_despesas").append(list);
                        }

                        calcular_saldo(soma);
                    }
                });
            }

            function calcular_saldo(soma){
                var dados_recebimentos = JSON.parse(localStorage.getItem("soma_recebimentos"));

                if(dados_recebimentos == null){
                    saldo = "-" + soma;
                }else if(soma == 0){
                    saldo = "+" + dados_recebimentos[0].soma_final;
                }else{
                    saldo = dados_recebimentos[0].soma_final - soma;
                }

                $("#saldo").html("Saldo: R$" + saldo);
            }

            function alterar(descricao, valor, data, id){
                ident = id;

                $("#descricao").val(descricao);
                $("#valor").val(valor);
                $("#data").val(data);
                $("#title_cadastro").html('<i class = "fa fa-wrench" aria-hidden = "true"></i> <span id = "title">Alterar Recebimento</span>');

                $("#cadastro_despesa").modal("show");
            }

            function excluir(id){
                var confirmacao = confirm("Deseja realmente excluir esta despesa?");

                if(confirmacao == true){
                    $.ajax({
                        url: "excluir.php",
                        type: "post",
                        data: {indentificador: "id_despesa", tabela: "despesas", id},
                        success: function(data){
                            carregar_despesas();
                            alert(data);
                        }
                    });
                }else{
                    alert("Ótima escolha!");
                }
            }
        </script>

        <!-- ==== DESPESAS ==== -->

        <div class = "container-fluid">
            <div class = "row">
                <div class = "col-md-2 col-sm-12 col-xs-12"></div>

                <div class = "col-md-8 col-sm-12 col-xs-12">
                    <div class = "card mt-2">
                        <div class = "card-header">
                            <h5 style = "display: inline;"><i class = "fa fa-shopping-cart" aria-hidden = "true"></i> Despesas</h5>

                            <button type = "button" class = "btn btn-outline-primary btn-sm float-right popover-test" title = "Cadastrar Mais" data-toggle = "modal" data-target = "#cadastro_despesa">
                                <i class = "fa fa-plus-square" aria-hidden = "true"></i>
                            </button>

                            <button class = "btn btn-primary float-right btn-sm mr-2" disabled id = "saldo"></button>
                        </div>
                        
                        <div class = "card-body">
                            <div class = "table-responsive">
                                <table class = "table rounded">
                                    <thead class = "thead-dark">
                                        <tr>
                                            <th scope = "col">Descrição</th>
                                            <th scope = "col">Valor</th>
                                            <th scope = "col">Data</th>
                                            <th scope = "col">Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody id = "tb_despesas">
                                        <div id = "saldo2"></div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col-md-2 col-sm-12 col-xs-12"></div>
            </div>
        </div>

        <!-- ==== MODAL - CADASTRO DE DESPESAS ==== -->

        <div class = "modal fade" id = "cadastro_despesa" tabindex = "-1" role = "dialog" aria-labelledby = "title_cadastro" aria-hidden = "true">
            <div class = "modal-dialog modal-lg" role = "document">
                <div class = "modal-content">
                    <div class = "modal-header border-primary">
                        <h4 class = "modal-title text-primary" id = "title_cadastro">
                            <i class = "fa fa-shopping-basket" aria-hidden = "true"></i> 
                            <span id = "title">Cadastro de Despesas</span>
                        </h4>

                        <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Fechar">
                            <span aria-hidden = "true" class = "text-primary">&times;</span>
                        </button>
                    </div>

                    <div class = "modal-body">
                        <form class = "needs-validation" novalidate>
                            <div class = "form-row">
                                <div class = "form-group col-md-12">
                                    <label for = "descricao">Descrição</label>
                                    <textarea class = "form-control" id = "descricao" required></textarea>
                                </div>

                                <div class = "form-group col-md-6">
                                    <label for = "valor">Valor</label>
                                    <input type = "number" class = "form-control" id = "valor" step = "0.01" min = "1" required />
                                </div>

                                <div class = "form-group col-md-6">
                                    <label for = "data">Data</label>
                                    <input type = "date" class = "form-control" id = "data" required />
                                </div>

                                <div class = "form-group col-md-9" id = "msg_cadastro"></div>

                                <div class = "form-group col-md-3">
                                    <label class = "invisible">A</label>
                                    <input id = "salvar" class = "btn btn-primary btn-block btn-md" type = "submit" value = "Salvar" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>