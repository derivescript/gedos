<div class="center">
<form action="" method="post">
    <!-- <div class="title">
        <h3>Dados do documento</h3>
    </div> -->
    <div class="row">
        <div class="description">Tipo do documento</div>
        <div class="campo">
            <input type="text" name="type" id="type" class="form-control" value="{type}">
        </div>
    </div>
    <div class="row">
        <div class="description">Descrição</div>
        <div class="campo">
            <input type="text" name="description" id="description" class="form-control" value="{description}">
        </div>
    </div>
    <div class="row">
        <div class="description">Publicado</div>
        <div class="campo">
           <select name="published" id="" class="form-control">
				{published}
			</select>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-success">Salvar</button>
		<button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
    </div>
</form>
</div>
<style>
  
    .row{
        border-bottom: 1px solid #ccc;
        padding-bottom: 6px;
        padding: 2%;
    }
    .center {
        width: 90%;
        margin: 0 auto;
        background: #f1f1f1;
        padding: 1%;
        
    }
    .description{
        float: left;
        width: 30%;
    }

    .campo{
        float: right;
        width: 69%;
    }
</style>
<script>
	$(document).ready(function(){
		//$('.select2').select2();
        $('#tipo').change(function()
        {
            sendPostAjax('/docmodels/filtrarTipo',{tipo:$('#tipo').val()},'#modelodocumento');
        }
        );
    });
</script>