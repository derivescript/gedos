<div class="row">
  <div class="col-md-12">
    <div class="card">
      <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        action="/funcoes/atualizar" method="post">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">
                Menu pai<span class="required">
                *</span>
              </label>
               <div class="col-md-12 col-sm-12 col-xs-12">
             {selectpai}
            </div>
            </div>
            <div class="col-sm-6">
               <label class="control-label col-md-10 col-sm-10 col-xs-12" for="nome">
                Nome<span class="required" value="{nome}">
                *</span>
            </label>
            <div class="col-sm-12">
              <input type="text" name="nome" id="nome" required="required" class="form-control col-md-7 col-xs-12" value="{nome}">
            </div>
            </div>
          </div>          
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="control-label">Tipo</label>
                <select class="form-control" id="tipo-icone">
                  <option selected>Escolha o tipo do ícone</option>
                  <option value="solid">Solid</option>
                  <option value="regular">Regular</option>
                  <option value="brand">Marcas</option>
                </select>
                </div>
            </div> <!-- ./col-sm-6-->
            <div class="col-sm-6">
              <label class="control-label">Nível do menu</label>
               {nivel}
            </div>
          </div>
        </div>
        <!-- Ordem e nivel --> 
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <label class="control-label">Ordem do menu</label>
              {ordem}
            </div>
            <div class="col-sm-6">
              <label class="control-label">Escolha um link</label>
                <span class="required">*</span>
              <div class="col-md-12">
                  {listafuncoes}
              </div>
            </div>
          </div>          
        </div> <!-- ./form-group -->
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <label>
                  Este menu vai abrir uma p&aacute;gina?
                </label> 
              <label>
                  <input type="radio" name="radiolink" id="radiolink" value="1" checked>
                  Sim
                </label>
                <label>
                  <input type="radio" name="radiolink" id="radiolink" value="0">
                  N&atilde;o
                </label>
            </div>
          </div>
        </div>
        <!-- Botoes -->
        <div class="form-group">
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Salvar</button>
              <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
            </div>
          </div>
        </div>
      </form>
    </div> 
  </div>
</div>

<script>
$(document).ready(function()
  {
    // Run Select2 plugin on elements  
    $('select').select2();
    //$('#href').select2();
    $('#tipo-icone').change(function(){
		$.post('/eventos/admin/funcoes/icones/',{tipo:$(this).val()},function(resposta){
			$('#choose-icon').html(resposta);
		},'html');
	});

  /**
   * Ao mudar o campo id_parent, verificar a posicao de seus filhos
   */
  $('#id_parent').change(function()
  {
    if($('#id_parent').val()!=0)
    {
      $.get('/eventos/admin/itemmenu/checklevel/'+$(this).val(),function(resposta){
        $('#nivel').val(resposta);
      },'html');
      $.get('/eventos/admin/itemmenu/checkposition/'+$(this).val(),function(resposta){
        $('#ordem').val(resposta);
      },'html');
    }
  });
  
    $('input[name=radiolink]').change(function(){
        if($(this).val()==1){
          $.get('/eventos/admin/funcoes/buscafuncoes',function(resposta){
            $('#href').html(resposta);
          },'html');
        }else{
            $('#href').empty();
            $('#href').html('<option value="#">#</option>');
        }
    }); //end input
    //end document
  }
);
</script>
<style>
	select{
		font-family: 'Font Awesome 5 Free';
	}
</style>