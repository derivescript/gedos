<div class="center">
<form action="classdoc/savesub" method="post">
    <div class="title">
        <h3>Nova classe de documento</h3>
    </div>
    <div class="row">
        <div class="description">Código da classe superior</div>
        <div class="campo">
            <select name="code_parent" id="" class="form-control">
                {superclasses}
            </select>
        </div>
    </div>
    <div class="row">
        <div class="description">Código da classe</div>
        <div class="campo">
            <input type="text" name="code" id="code" class="form-control">
            <div class="codexists"></div>
        </div>
    </div>
    <div class="row">
        <div class="description">Nome da classe</div>
        <div class="campo">
            <input type="text" name="name" id="name" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="description">Publicado</div>
        <div class="campo">
           <select name="published" id="published" class="form-control">
            <option value="0">----</option>
                <option value="0">Não</option>
                <option value="1">Sim</option>
           </select>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
</div>
<style>
    .codexists{
        color:#cc0000;
        background: #ffdddd;
        padding: 2px 4px;
        display: none;
    }
</style>
<script>
	$(document).ready(function(){
		//$('.select2').select2();
         $('#code').focus(function(){
            $(this).val('');
            $('.codexists').css('display','none');
        });
        $('#code').blur(function(){
             $.post('classdoc/check',{code:$('#code').val()},function(resposta){
                if(resposta.length>1){
                    $('.codexists').html(resposta);
                    $('.codexists').css('display','block');
                }
             },'html');             
        });
	});
</script>