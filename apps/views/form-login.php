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
    var ajax_url = location.hash.replace(/^#/, '');
    if(ajax_url.length>0){
        $('#url').val(ajax_url);
    }

    $('form').submit(function(){
        $(this).ajaxSubmit(function(resposta)
        {
          $('#botao-entrar').text('Aguarde...');
          $('#resposta').html(resposta);
          console.log(resposta);
          var f = $('#resposta').find('.mensagem');
          if(f.text()=='Erro'){
            f.hide();
            $('.modal').modal();  
            $('.close').click(function(){
              $('#botao-entrar').text('Entrar');
            });
          }else{
            $('#resposta').hide();
            document.location.href='home#'+$('#url').val();
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
   <img src="{baseurl}assets/painel/img/gedos-logo.png" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar sessão</p>

      <form action="{baseurl}login/autenticate" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuário" name="login" value="daniel">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Senha" name="password" value="derive">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="botao-entrar">Entrar</button>
        </div>
         <input type="hidden" name="url" id="url" value="">
        <div class="input-group mb-3">
            <a href="login/recuperarsenha" class="btn btn-warning btn-block btn-flat">Esqueci a senha</a><br>
        </div>
        <div id="resposta"></div>
      </form>
</div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


</body>
</html>
