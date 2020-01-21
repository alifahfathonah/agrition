<?= $this->session->flashdata('message');  ?>
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/img/profile/').$this->session->userdata('foto') ?>" alt="User profile picture">

				<h3 class="profile-username text-center"><?= $this->session->userdata('nama')?></h3>

				<p class="text-muted text-center"><?= $this->session->userdata('jabatan')?></p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Status</b> <a class="pull-right"><?= $this->session->userdata('status') ?></a>
					</li>
					<li class="list-group-item">
						<b>Nomor Telepon</b> <a class="pull-right"><?= $toko->no_telp ?></a>
					</li>
				</ul>

				<a href="<?= base_url('toko/dashboard/edittoko')?>" class="btn btn-primary btn-block"><b>Edit Toko</b></a>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	<!-- /.box -->
	<div class="col-md-7">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Profile Toko</h3>
			</div>
			<div class="box-body">
				<div class="thumbnail">
					<img src="<?= base_url('assets/img/toko/').$toko->foto ?>" width="200" height="200">
				</div>
				<table class="table">
					<tr>
						<td>Nama Toko</td>
						<td>:</td>
						<td><b><?= $toko->nama_toko ?></b></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><b><?= $toko->alamat ?></b></td>
					</tr>
					<tr>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td><b><?= $toko->no_telp ?></b></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><b><?= $toko->email ?></b></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>