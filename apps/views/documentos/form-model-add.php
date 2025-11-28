<div class="center">
<form action="docmodels/save" method="post">
    <div class="title">
        <h3>Criar modelo de documento</h3>
    </div>
    <div class="row">
        <div class="description">Nome do modelo</div>
        <div class="campo">
           <input type="text" name="model" id="modelo" value="" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="description">Tipo do documento</div>
        <div class="campo">
           {tipodocumento}
        </div>
    </div>
    <div class="row">

        <div class="description col-sm-6">Conteúdo</div>
        <div class="col-sm-12">
            <textarea name="content" id="content" class="form-control" style="width: 100%;"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
        <button type="submit" class="btn btn-success">Salvar</button>
        <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
    </div>
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
		CKEDITOR.replace('content');
      
    });
</script>