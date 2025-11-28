<div class="center">
    <form action="grupo/update" method="post">
        <div class="title">
            <h3>Criar usuário</h3>
        </div>
        <div class="row">
            <div class="description"><label for="name">Name</label></div>
            <div class="campo"><input type="text" name="name" id="name" placeholder="Nome do grupo. Ex: Operador de contrato, Servidor, Auditor" class="form-control" autocomplete="off" value="{name}"></div>
        </div>
        <div class="row">
            <div class="description"><label for="active">Ativo</label></div>
            <div class="campo">
                 <select name="active" class="form-control">	
                       {options}
                </select>
            </div>
        </div>
        <div class="row">
                <button type="submit" class="btn btn-success">Salvar</button>
                <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
            </div>
        </div>
    </form>
</div>
