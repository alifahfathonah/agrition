
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>agrition</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/morris.js/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?= base_url() ?>assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?= base_url() ?>assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="<?= base_url() ?>assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->

      <a href="#" class="logo">
        <img class="lg-mini pull-left" src="<?= base_url('assets/img/agrition_logo.png')?>"width="40px">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>a</b>t</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>agrition</span>

      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="<?= base_url() ?>assets/#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="<?= base_url() ?>assets/#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('assets/img/profile/'.$this->session->userdata('foto')); ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $this->session->userdata('nama')?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url('assets/img/profile/'.$this->session->userdata('foto')); ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= $this->session->userdata('nama')?>
                    <small><?= $this->session->userdata('jabatan')?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url('assets/img/profile/'.$this->session->userdata('foto')); ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= $this->session->userdata('nama')?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <?php if ($this->session->userdata('jabatan') == "Admin"): ?>
            <li <?=$this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
              <a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
              <li <?=$this->uri->segment(2) == 'toko' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                <a href="<?= base_url('admin/toko') ?>"><i class="fa fa-bank"></i> <span>Toko</span></a></li>
                <li <?=$this->uri->segment(2) == 'kategori' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                  <a href="<?= base_url('admin/kategori') ?>"><i class="fa fa-tags"></i> <span>Kategori</span></a></li>
                  <li <?=$this->uri->segment(2) == 'member' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                    <a href="<?= base_url('admin/member') ?>"><i class="fa fa-users"></i> <span>Member</span></a></li>
                    <li <?=$this->uri->segment(2) == 'transaksi' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                      <a href="<?= base_url('admin/transaksi') ?>"><i class="fa fa-money"></i> <span>Transaksi</span></a></li>
                      <li <?=$this->uri->segment(2) == 'kurir' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                        <a href="<?= base_url('admin/kurir') ?>"><i class="fa fa-motorcycle"></i> <span>Kurir</span></a></li>
                        <li <?=$this->uri->segment(2) == 'barang' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                          <a href="<?= base_url('admin/barang') ?>"><i class="fa fa-tasks"></i> <span>Barang</span></a></li>
                          <li <?=$this->uri->segment(2) == 'rekening' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('admin/rekening') ?>"><i class="fa fa-credit-card"></i> <span>Rekening</span></a></li>
                            <?php else: ?>
                              <li <?=$this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('toko/dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li <?=$this->uri->segment(2) == 'barang' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                                  <a href="<?= base_url('toko/barang') ?>"><i class="fa fa-tasks"></i> <span>Barang</span></a></li>
                                  <li <?=$this->uri->segment(2) == 'pesanan' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
                                    <a href="<?= base_url('toko/pesanan') ?>"><i class="fa fa-cart-arrow-down"></i> <span>Pesanan</span></a></li>
                                  <?php endif ?>
                                </ul>
                              </section>
                              <!-- /.sidebar -->
                            </aside>

                            <!-- Content Wrapper. Contains page content -->
                            <div class="content-wrapper">
                              <!-- Content Header (Page header) -->
                              <section class="content-header">
                                <h1>
                                  <i class="fa <?= $title_icon; ?>"></i> <?= $title; ?>
                                  <small>Control Panel</small>
                                </h1>
                                <ol class="breadcrumb">
                                  <li><a href="<?= base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>"><i class="fa <?= $breadcrumb_icon; ?>"></i><?= ucwords($this->uri->segment(2))?></a></li>
                                  <li class="active"><?= $title; ?></li>
                                </ol>
                              </section>

                              <!-- Main content -->
                              <section class="content">
                                <?= $contents; ?>
                              </section>
                              <!-- right col -->
                            </div>
                            <!-- /.row (main row) -->

                          </section>
                          <!-- /.content -->
                          <!-- /.content-wrapper -->
                          <footer class="main-footer">
                            <div class="pull-right hidden-xs">
                              <b>Version</b> 2.4.0
                            </div>
                            <strong>Copyright &copy; 2014-2016 <a href="<?= base_url() ?>assets/https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
                            reserved.
                          </footer>

                          <!-- Control Sidebar -->
                          <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="<?= base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?= base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<?= $this->session->flashdata('message1');  ?>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    $('[data-mask]').inputmask()
  })
</script>
</body>
</html>
