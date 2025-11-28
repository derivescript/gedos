<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-DOC| painel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{baseurl}/assets/global/css/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{baseurl}/assets/adminlte/dist/css/adminlte.css">
  <!-- jQuery -->
<script src="{baseurl}/assets/adminlte/plugins/jquery/jquery.js"></script>
<script src="{baseurl}/assets/adminlte/plugins/bootstrap/js/bootstrap.js"></script>
<script src="{baseurl}/assets/global/js/jquery.form.js"></script>

<script>
  $(document).ready(function(){
  let pasta = '/gedos/' 
  let baseurl = document.location.protocol + '//' + document.location.host+pasta;
   
  var ajax_url = location.hash.replace(/^#/, '');  
    if(ajax_url.length>0){
      $('#url').val(ajax_url);
    }
    $('form').submit(function(){
        $(this).ajaxSubmit(function(resposta){
            $('#botao-entrar').text('Aguarde...');
            $('#resposta').html(resposta);
        var f = $('#resposta').find('.mensagem');
        console.log(f.text);
        if(f.text()=='Erro'){
            f.hide();
            $('.modal').modal();  
            $('.close').click(function(){
                $('#botao-entrar').text('Entrar');
            });
        }else{
            $('#resposta').hide();
            if($('#url').val()!=='')
            {
              document.location.href=baseurl+'/#'+$('#url').val();
            }else{
              document.location.href=baseurl;
            }
            
            console.log('/#'+$('#url').val());
        }      
        });
        
        return false;
    });
  }); 
  
</script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    E<b>-Doc</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Recuperar senha</p>

      <form action="{baseurl}login/retrieve" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuário" name="login" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
                Ou
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="E-mail" name="email" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="botao-entrar">Enviar link</button>
        </div>
        <div class="input-group mb-3">
            <a href="{baseurl}" class="btn btn-default btn-block btn-flat" id="botao-voltar">Voltar</a>
        </div>
         <input type="hidden" name="url" id="url" value="">
        <div id="resposta"></div>
      </form>
</div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


</body>
</html>
