<?php

use function core\pre;
use function core\redirect;

if(empty($_SESSION)){
  
  redirect('login');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GEDOS | IFMT</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Toolbar -->
  <link rel="stylesheet" href="{baseurl}assets/painel/css/toolbar.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{baseurl}assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{baseurl}assets/painel/css/gedos.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{baseurl}assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{baseurl}assets/adminlte/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{baseurl}assets/adminlte/dist/css/adminlte.css">
  <link rel="stylesheet" href="{baseurl}assets/adminlte/plugins/select2/css/select2.css">
  <link rel="stylesheet" href="{baseurl}assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="{baseurl}vendor/ckeditor4/ckeditor.js"></script>
  <script src="{baseurl}vendor/ckfinder/ckfinder.js"></script>
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link">Início</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home/out" class=" btn btn-danger">Sair</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notificações</span>
          <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item">
            <i class="fas fa-file-alt mr-2"></i> <span class="assinaturas">4</span> Solicitações de assinatura
            <span class="float-right text-muted text-sm">3 min</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-folder mr-2"></i> <span class="processes">4</span> Processos a receber
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todas as notificações</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        <img src="{baseurl}assets/painel/img/gedos-logo.png" alt="Logo" class="elevation-3" style="opacity: .8;width:100%;" />               
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{baseurl}assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{nome}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {menu}
        </ul>
        <!--Fim do menu-->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="ajax-content"></div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.1-pre
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
     <div class="sidebar">
                <h4 class="control-sidebar-heading">Configurações</h4>
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                            <a href="#" class="nav-link" style="color:white">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Funções
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="funcoes/add" class="nav-link ajax-link" style="color:white">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nova função</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="funcoes/listar" class="nav-link ajax-link" style="color:white">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lista de funções</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="construtor" class="nav-link ajax-link" style="color:white">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Construtor de arquivos</p>
                                    </a>
                                </li>                                
                            </ul>
                        </li>
                    </ul><!-- Fim do menu-->
                </nav>                
            </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{baseurl}assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{baseurl}assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="{baseurl}assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="{baseurl}assets/adminlte/plugins/select2/js/select2.js"></script>
<!-- Toastr -->
<script src="{baseurl}assets/adminlte/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="{baseurl}assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{baseurl}assets/painel/js/admin.js"></script>
<script src="{baseurl}assets/painel/js/datagrid.js"></script>
<script src="{baseurl}assets/painel/js/jquery.form.js"></script>
<script src="{baseurl}assets/painel/js/toolbar.js"></script>
<script type="text/javascript">
  $(function() {
    $.get('/gedos/documentos/solicitacoesparamim',function(resposta){
      $('.assinaturas').text(resposta);
    })
  });
</script>
</body>
</html>
