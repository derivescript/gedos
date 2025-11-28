<!-- form start -->
<form role="form" action="documentos/enviarsolicitacaoassinatura" method="post">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Solicitação principal</h3>
		</div>
		<!-- /.card-header -->	
		<div class="card-body">
			<div class="form-group">
			<label for="exampleInputEmail1">Pessoa</label>
				<div class="col-sm-6">
					{pessoa}
				</div>
			</div>    
		</div>
		<!-- /.card-body -->	
	</div>
	
	<div class="card-footer">
			<button type="submit" class="btn btn-primary">Enviar solicitação</button>
	</div>
	<input type="hidden" name="iddocumento" value="{id}">
</form>
<script>
	$(document).ready(function(){
		$('.select2').select2();
	});
</script>
	