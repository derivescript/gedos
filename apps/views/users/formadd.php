<div class="center">
<form action="user/save" method="post">
    <div class="title">
        <h3>Criar usuário</h3>
    </div>
    <div class="row">
        <div class="description">Nome do usuário</div>
        <div class="campo">
           <input type="text" name="username" placeholder="Nome de usuário (minúsculas)" class="form-control" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="description">Senha</div>
        <div class="campo">
           <input type="password" name="password" placeholder="Senha para o novo usuário" class="form-control" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="description">Nome completo</div>
        <div class="campo">
            <input type="text" name="name" placeholder="Nome completo" class="form-control">
        </div>            
    </div>
    <div class="row">
        <div class="description">E-mail</div>
        <div class="campo">
            <input type="text" name="email" placeholder="@provedor" class="form-control">
        </div>            
    </div>  
    <div class="row">
        <button type="submit" class="btn btn-success">Salvar</button>
        <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
    </div>
    <input type="hidden" name="id" value="{id}">
</form>
</div>