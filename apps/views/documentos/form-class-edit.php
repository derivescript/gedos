<div class="center">
<form action="classdoc/update" method="post">
    <div class="title">
        <h3>Nova classe de documento</h3>
    </div>
    <div class="row">
        <div class="description">Código da classe</div>
        <div class="campo">
            <input type="text" name="code" id="code" class="form-control" value="{code}">
        </div>
    </div>
    <div class="row">
        <div class="description">Nome da classe</div>
        <div class="campo">
            <input type="text" name="name" id="name" class="form-control" value="{name}">
        </div>
    </div>
    <div class="row">
        <div class="description">Publicado</div>
        <div class="campo">
           <select name="published" id="published" class="form-control">
            {options}
           </select>
        </div>
    </div>
    <input type="hidden" name="id" value="{id}">
    <div class="row">
        <button type="submit" class="btn btn-primary">Salvar</button>
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
	});
</script>