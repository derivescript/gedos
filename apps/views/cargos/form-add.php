<form action="/cargo/save" method="post">
	<div class="card-body">
		<div class="row">
	<!-- Colunas de 0 a 4 -->
<div class="col-6">
<div class="form-group">
<label class="control-label">Nome</label>
<input type="text" name="nome" id="nome" class="form-control col-10" value=""></div>
<div class="form-group">
<label class="control-label">Data de criação do cargo</label>
<input type="date" name="data_criacao" id="data_criacao" class="form-control col-10" value=""></div>
<div class="form-group">
<label class="control-label">Ativo</label>
<input type="text" name="ativo" id="ativo" class="form-control col-10" value=""></div>
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