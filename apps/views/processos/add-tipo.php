<form action="procesoss/savetipo" method="post">
    <div class="card-body">
        <div class="col-6">
            <div class="row">
            <div class="form-group">
            <label for="descricao">Descricao</label>
            <input type="text" name="descricao" id="descricao" class="form-control" autocomplete="off">
        </div>
		<div class="form-group">
            <label for="publicado">Publicado</label>
            <select name="publicado" class="form-control">	
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