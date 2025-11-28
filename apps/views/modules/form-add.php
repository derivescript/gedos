<form action="modulo/save" method="post">
	<div class="card-body">
		<div class="row">
	<!-- Colunas de 0 a 4 -->
<div class="col-12">
	<div class="form-group">
		<label class="control-label">Nome do módulo</label>
		<input type="text" name="nome" id="nome" class="form-control col-10" value="" autocomplete="off">
	</div>
	<div class="form-group">
		<label class="control-label">Área do módulo</label>
		{selectareas}
	</div>
	<div class="form-group">
		<label class="control-label">Ativo</label>
		<select name="ativo" id="" class="form-control">
			<option value="selected">----</option>
			<option value="1">Sim</Option>
			<Option value="0">Não</Option>
		</select>
	</div>
	</div>
	<!-- Demais colunas -->
	<div class="col-6">
	</div>
	<div class="col-6">
	<button type="submit" class="btn btn-success">Salvar</button>
	<button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
</div><!-- Fim col-6 -->
</div><!-- Fim row -->
</div><!-- Fim card-body -->
</form>