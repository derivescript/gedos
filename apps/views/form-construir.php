<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <br>
        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        action="/painel/construtor/gerar" method="post">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">
                Pasta<span class="required">
                *</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="pasta" id="pasta" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">
                Banco de dados
                <span class="required">
                *</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {bancos}
            </div>
        </div>
        
          <div class="form-group">
              <h3>Tabelas</h3>
              <div id="list-tables">
                
              </div> 
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" id="gerar" class="btn btn-primary">Gerar</button>
            </div>
          </div>
          
        
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#database').change(function(){
      if($(this).val()!=0){
        sendPostAjax('/construtor/exibir',{pasta:$('#pasta').val(),nomebanco:$(this).val()},'#list-tables');
      }
    });
  });
</script>