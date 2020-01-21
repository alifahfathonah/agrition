<?php 

$kat = $this->db->get('kategori')->result();
$id = $this->session->userdata('id');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>agrition</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <img class="lg-mini pull-left" src="<?= base_url('assets/img/agrition_logo.png')?>"width="40px">
            <a href="<?php echo base_url('home') ?>" class="navbar-brand"><b>agrition</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li <?=$this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('home') ?>"><i class="fa fa-home"> Home</i></a></li>
              <li <?=$this->uri->segment(1) == 'cari' ? 'class="active"' : '' ?>>
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span><i class="fa fa-search"> Cari</i></span>
                </a>
                <form class="dropdown-menu" style=" padding: 10px; " method="GET" action="<?= base_url('cari')?>">
                  <div class="form-group">
                    <input type="text" required="" class="form-control" placeholder="Kata Kunci" name="keyword">
                  </div>
                  <button type="submit" class="btn btn-primary pull-right btn-s">Cari</button>
                </form>
              </li>
              <li>
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span><i class="fa fa-list"> Kategori</i></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <?php foreach ($kat as $k): ?>
                    <li><a href="<?= base_url('cari?kategori=').$k->id_kategori?>"><?= $k->nm_kategori?></a></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <?php if ($this->session->userdata('aktif')==true): ?>
                <li <?=$this->uri->segment(1) == 'profile' ? 'class="active"' : '' ?>><a href="<?php echo base_url('profile') ?>"><i class="fa fa-user"> Profile</i></a></li>
                <li <?=$this->uri->segment(1) == 'keranjang' ? 'class="active"' : '' ?>><a href="<?php echo base_url('keranjang') ?>"><i class="fa fa-shopping-cart"> Keranjang</i></a></li>
                <li <?=$this->uri->segment(1) == 'transaksi' ? 'class="active"' : '' ?>><a href="<?php echo base_url('transaksi') ?>"><i class="fa fa-money"> Transaksi</i></a></li>
                <?php else: ?>
                  <li>
                    <a href="#" data-toggle="modal" data-target="#regis">
                      <!-- The user image in the navbar-->
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span>Registrasi</span>
                    </a>
                  </li>
                <?php endif ?>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <?php if ($this->session->userdata('aktif') == true): ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?= base_url('assets/img/profile/').$this->session->userdata('foto')?>" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?= $this->session->userdata('nama')?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?= base_url('assets/img/profile/').$this->session->userdata('foto')?>" class="img-circle" alt="User Image">

                        <p>
                          <?= $this->session->userdata('nama')?>
                          <small><?= $this->session->userdata('jabatan')?></small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="<?= base_url('profile')?>" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="<?= base_url('login/logout')?>" class="btn btn-default btn-flat">Log Out</a>
                        </div>
                      </li>
                    </ul>
                    <?php else: ?>
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><i class="fa fa-sign-in"> Login</i></span>
                      </a>
                      <form class="dropdown-menu p-4" style="margin: 2px; padding: 15px; " action="<?php echo base_url() ?>login/auth" method="post">
                        <div class="form-group">
                          <label for="exampleDropdownFormEmail2">Username</label>
                          <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                          <label for="exampleDropdownFormPassword2">Password</label>
                          <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <p>Belum punya akun? <a href="#" data-toggle="modal" data-target="#regis">Daftar</a></p>
                        <button type="submit" class="btn btn-primary pull-right">Login</button>
                      </form>
                    <?php endif ?>
                    <!-- Menu Toggle Button -->

                  </li>
                </ul>
              </div>  
              <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
          </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
          <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                <?= $title?>
                <small><?= $small?></small>
              </h1>
            </section>

            <!-- Main content -->
            <section class="content"> 
              <?php if ($this->session->userdata('aktif') == TRUE): ?>
              <?php if ($this->db->get_where('member', "id_member= '$id'")->row('is_active') == 0): ?>
              <div class="alert alert-warning fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Warning!</h4>Anda Belum Menverifikasi Email Anda. Belum mendapatkan email? <a href="<?= base_url('home/sendemail')?>">Klik Disini</a></div>
            <?php endif ?>
            <?php endif ?>
            <?= $contents; ?>
            <!-- /.box -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.container -->
      </div>

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
          </div>
          <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
          reserved.
        </div>
        <!-- /.container -->
      </footer>
    </div>
    <!-- ./wrapper -->

    <div class="modal modal fade" id="regis">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Registrasi User</h4>
            </div>
            <div class="modal-body">
              <form method="post" action="<?= base_url('home/reg')?>">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= set_value('nama') ?>">
                </div>
                <div class="form-group">
                  <label for="jns_kel">Jenis Kelamin</label><br>
                  <select name="jns_kel" class="form-control" required="">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tmpt_lahir">Tempat Lahir</label>
                  <input type="text" class="form-control" name="tmpt_lahir" id="tmpt_lahir" placeholder="Tempat Lahir" required="" value="<?= set_value("tmpt_lahir")?>">
                </div>
                <div class="form-group">
                  <label for="tgl_lahir">Tanggal Lahir</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input name="tgl_lahir" placeholder="Tanggal Lahir" type="text" required="" value="<?= set_value('tgl_lahir') ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" name="alamat" required="" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
                </div>
                <div class="form-group <?php echo form_error('no_telp') ? 'has-error' : null ?>">
                  <label>Nomor Telepon</label>
                  <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" required="" value="<?= form_error('no_telp') ? '' : set_value("no_telp")?>">
                  <span class="help-block"><?php echo form_error('no_telp') ?></span>
                </div>
                <div class="form-group <?php echo form_error('email') ? 'has-error' : null ?>">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required="" value="<?= form_error('email') ? '' : set_value("email")?>">
                  <span class="help-block"><?php echo form_error('email') ?></span>
                </div>
                <div class="form-group <?php echo form_error('username') ? 'has-error' : null ?>">
                  <label for="username">Username</label>
                  <input type="username" class="form-control" name="username" id="username" placeholder="Username" required="" value="<?= form_error('username') ? '' : set_value("username")?>">
                  <span class="help-block"><?php echo form_error('username') ?></span>
                </div>
                <div class="form-group <?php echo form_error('password') ? 'has-error' : null ?>">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required="" placeholder="Password">
                  <span class="help-block"><?php echo form_error('password') ?></span>
                </div>
                <div class="form-group <?php echo form_error('passconf') ? 'has-error' : null ?>">
                  <label>Tulis Ulang Password</label>
                  <input type="password" name="passconf" class="form-control" required="" placeholder="Tulis Ulang Password">
                  <span class="help-block"><?php echo form_error('passconf') ?></span>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Daftar</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- jQuery 3 -->
      <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- SlimScroll -->
      <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
      <script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
      <script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
      <script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
      <?= $this->session->flashdata('message1');  ?>
      <script>
        $(function(){
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          $('[data-mask]').inputmask()
        })
      </script>
    </body>
    </html>
