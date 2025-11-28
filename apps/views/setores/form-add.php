<form action="setores/save" method="post">
	<div class="card-body">
		<div class="row">
	<!-- Colunas de 0 a 4 -->
<div class="col-6">

<div class="form-group">
<label class="control-label">Nome do setor</label>
<input type="text" name="name" id="name" class="form-control col-10"></div>
<div class="form-group">
<label class="control-label">Sigla</label>
<input type="text" name="sigla" id="sigla" class="form-control col-10"></div>
<div class="form-group">
<label class="control-label">Sobre o setor</label>
<textarea name="description" id="description" class="form-control col-10" rows="5">Descrição do setor</textarea></div>
<div class="form-group">
<label class="control-label">Data de criação</label>
<input type="date" name="created_at" id="created_at" class="form-control col-10"></div>
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