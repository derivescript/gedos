<form action="lotacao/save" method="post">
	<div class="card-body">
		<div class="row">
	<!-- Colunas de 0 a 4 -->
<div class="col-6">
	<div class="form-group">
		<label class="control-label">Setor</label>
		{setor}
	</div>
	<div class="form-group">
		<label class="control-label">Nome do funcionário</label>
		{colaborador}
	</div>
	<div class="form-group">
		<label class="control-label">Data de início</label>
		<input type="date" name="data_inicio" id="data_inicio" class="form-control col-10" value="">
	</div>

</div>
<!-- Demais colunas -->
<div class="col-6">
</div>
<div class="col-6">
  <button type="submit" class="btn btn-success">Salvar</button>
</div><!-- Fim col-6 -->
</div><!-- Fim row -->
</div><!-- Fim card-body -->
</form>