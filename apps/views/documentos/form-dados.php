<div class="center">
<form action="documentos/save" method="post">
    <div class="title">
        <h3>Dados do documento</h3>
    </div>
    <div class="row">
        <div class="description">Tipo do documento</div>
        <div class="campo">
            {tipodocumento}
        </div>
    </div>
    <div class="row">
        <div class="description">Modelo</div>
        <div class="campo" id="modelodocumento">
            {modelodocumento}
        </div>
    </div>
    <div class="row">
        <div class="description">Assunto</div>
        <div class="campo">
            <textarea name="subject" rows="5" id="subject" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="description">Setor dono</div>
        <div class="campo">
           <select name="sector" id="sector" class="form-control">
            <option value="0">----</option>
            {setores}
           </select>
        </div>
    </div>
    <div class="row">
        <div class="description">Classificação do documento</div>
        <div class="campo" id="docclasse">
          <select name="class_id" id="" class="form-control">
            <option value="0">----</option>
          </select>
        </div>
    </div>
    <div class="title">
        <h3>Nível de acesso do documento</h3>
    </div>
    <div class="row">
        <div class="description">Nível de acesso</div>
        <div class="campo">
          <select name="access_level" id="access_level" class="form-control">
            <option selected>----</option>
            <option value="1">Público</option>
            <option value="2">Restrito</option>
          </select>
        </div>
    </div>
    <div class="row">
        <div class="description">Hipótese legal</div>
        <div class="campo" id="hipoteselegal">
          <select name="hipotese" id="" class="form-control">
            <option value="0">---</option>
          </select>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>
</div>
<script>
	$(document).ready(function(){
		//$('.select2').select2();
        $('#tipo').change(function()
        {
            sendPostAjax('docmodels/filtrarTipo',{tipo:$('#tipo').val()},'#modelodocumento');
        });
        
        $('#modelodocumento').on('change',$('#modelo'),function()
        {
            sendPostAjax('docmodels/buscarClasse',{modelo:$('#modelo').val()},'#docclasse');
        });

        $('#access_level').on('change',$('#modelo'),function()
        {
            sendPostAjax('documentos/buscarHipotese',{acesso:$('#access_level').val()},'#hipoteselegal');
        });
    });
</script>