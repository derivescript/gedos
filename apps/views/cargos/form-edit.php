<form action="cargo/update" class="form-horizontal" method="post">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" autocomplete="off" value="{nome}">
                </div>
                <div class="form-group">
                    <label for="data_criacao">Data_criacao</label>
                    <input type="date" name="data_criacao" id="data_criacao" class="form-control" value="{data_criacao}">
                </div>
                <div class="form-group">
                    <label for="ativo">Ativo</label>
                    <select name="ativo" class="form-control">	
                            {ativo}
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="{id}">
         <div class="col-6">
            <button type="submit" class="btn btn-success">Salvar</button>
            <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
        </div>
    </div>
</form>