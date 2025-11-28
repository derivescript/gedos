<div class="center">
    <form action="documentos/updatetext" method="post">
        <div class="title">
            <h3>Corpo do documento</h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <textarea name="content" id="content" class="form-control" style="width: 100%;">
                    {content}
                </textarea>
            </div>        
        </div>
        <input type="hidden" name="id" id="id" value="{id}">
        <div class="row">
            <button type="submit" class="btn btn-success">Salvar</button> &nbsp;
            <button type="button" class="btn btn-success" id="saveAndView">Salvar e visualizar</button>
        </div>
    </form>
</div>
<style>
  
    .row{
        border-bottom: 1px solid #ccc;
        padding-bottom: 6px;
        padding: 2%;
    }

</style>
<script>
	$(document).ready(function(){
		CKEDITOR.replace('content');        
        $('#saveAndView').click(function(){
            let url = "http://localhost/gedos/home#documentos/visualizar/"+$('#id').val();
            let action = 'documentos/visualizar/'+$('#id').val();
            window.location.href=url;
            sendAjax(action,'#ajax-content');
        })      
    });
</script>