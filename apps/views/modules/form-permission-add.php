<form action="permissoes/save" method="post">
    <div class="card-body">
        <div class="row">
            <div class="col-6">                
                <div class="form-group">
                    <label for="nome">Nome da permissão</label>
                    <input type="text" name="nome" id="nome" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="descricao">Descricção da permissão</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="id_modulo">Módulo</label>
                    {modulo}
                </div>            
            </div>
        </div>
            <div class="col-6">
                <button type="submit" class="btn btn-success">Salvar</button>
                <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
            </div>
    </div>
</form>