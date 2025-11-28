<form action="tipodocumento/save" method="post">
	<div class="card-body">
		<div class="row">
			<!-- Colunas de 0 a 4 -->
		<div class="col-6">
			<div class="form-group">
				<label class="control-label">Tipo de documento</label>
				<input type="text" name="type" id="type" class="form-control col-10" value="">
			</div>
			<div class="form-group">
				<label class="control-label">Descrição</label>
				<input type="text" name="description" id="description" class="form-control col-10" value="">
			</div>
			<div class="form-group">
				<label class="control-label">Publicado</label>
				
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