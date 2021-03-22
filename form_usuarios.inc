 <form class = "needs-validation" novalidate>
    <div class = "form-row">
        <div class = "form-group col-md-6">
            <label for = "nome">Nome</label>
            <input type = "text" class = "form-control" id = "nome" required />
        </div>

        <div class = "form-group col-md-6">
            <label for = "profissao">Profissão</label>
            <input type = "text" class = "form-control" id = "profissao" required />
        </div>

        <div class = "form-group col-md-6">
            <label for = "email_cadastro">E-mail</label>
            <input type = "email" class = "form-control" id = "email_cadastro" required />
        </div>

        <div class = "form-group col-md-6">
            <label for = "data_nascimento">Data de Nascimento</label>
            <input type = "date" class = "form-control" id = "data_nascimento" required />
        </div>

        <div class = "form-group col-md-3">
            <label for = "senha_cadastro">Senha</label>
            <input type = "password" class = "form-control" id = "senha_cadastro" required />
        </div>

        <div class = "form-group col-md-3">
            <label for = "confirmar_senha">Confirmar Senha</label>
            <input type = "password" class = "form-control" id = "confirmar_senha" required />
        </div>

        <div class = "form-group col-md-6">
            <label for = "frase_senha">Uma frase que te faça lembrar da senha</label>
            <input type = "text" class = "form-control" id = "frase_senha" required />
        </div>

        <div class = "form-group col-md-9" id = "msg_cadastro"></div>

        <div class = "form-group col-md-3">
            <label class = "invisible">A</label>
            <input id = "salvar" class = "btn btn-primary btn-block btn-md" type = "submit" value = "Salvar" />
        </div>
    </div>
</form>