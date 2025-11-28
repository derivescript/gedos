<div class="center">
    <form action="documentos/salvarassinatura" method="post">
        <div class="row">
            <div class="description">Tipo de documento</div>
            <div class="campo">
                <input type="text" name="tipo" id="tipo" value="{tipo}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="description">Identificador</div>
            <div class="campo">
                <input type="text" name="identificador" id="identificador" value="{identificador}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="description">Senha</div>
            <div class="campo">
                <input type="password" name="senha" id="senha" class="form-control">
            </div>
        </div>
        <input type="hidden" name="id" value="{id}">
        <div class="row">
            <button type="submit" class="btn btn-success">Assinar</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('form').submit(function(){
            if($('#senha').val()==''){
                alert('Use sua senha para assinar o documento')
               return false;
            }
             
        })
    })
</script>