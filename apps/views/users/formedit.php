<div class="center">
<form action="user/update" method="post">
    <div class="title">
        <h3>Editar usuário</h3>
    </div>
    <div class="row">
        <div class="description">Nome do usuário</div>
        <div class="campo">
           <input type="text" name="username" placeholder="Nome de usuário (minúsculas)" class="form-control" autocomplete="off" value="{username}">
        </div>
    </div>
    <div class="row">
        <div class="description">Senha</div>
        <div class="campo">
           <input type="password" name="password" placeholder="Senha para o novo usuário" class="form-control" autocomplete="off" value="{password}">
        </div>
    </div>
    <div class="row">
        <div class="description">Nome completo</div>
        <div class="campo">
            <input type="text" name="name" placeholder="Nome completo" class="form-control" value="{name}">
        </div>            
    </div>
    <div class="row">
        <div class="description">E-mail</div>
        <div class="campo">
            <input type="text" name="email" placeholder="@provedor" class="form-control" value="{email}">
        </div>            
    </div>  
    <div class="col-6">
        <button type="submit" class="btn btn-success">Salvar</button>
        <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
    </div>
    <input type="hidden" name="id" value="{id}">
</form>
</div>
<style>
  
    .row{
        border-bottom: 1px solid #ccc;
        padding-bottom: 6px;
        padding: 2%;
    }
    .center {
        width: 99%;
        margin: 0 auto;
        background: #f1f1f1;
        padding: 1%;
        
    }
    .description{
        float: left;
        width: 30%;
    }

    .campo{
        float: right;
        width: 69%;
    }
</style>