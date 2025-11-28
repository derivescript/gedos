<form action="/save" method="post">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="id_area">Id_area</label>
                    <select name="id_area" class="form-control">	
                            <option selected="selected">---</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" autocomplete="off" value="{nome}">
                </div>
                <div class="form-group">
                    <label for="ativo">Ativo</label>
                    <select name="ativo" class="form-control">	
                            <option selected="selected">---</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                </div>		
            </div>
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-success">Salvar</button>
            <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
        </div>
    </div>
</form>