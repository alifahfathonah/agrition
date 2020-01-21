<?= $this->session->flashdata('message');  ?>

<div class="row">
	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block margin-bottom" data-toggle="modal" data-target="#tambah">Tambah Data</button>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Member</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Tempat Lahir</th>
					<th>Tanggal Lahir</th>
					<th>Alamat</th>
					<th>Nomor Telepon</th>
					<th>Username</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($member as $i) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $i->nama_member ?></td>
						<td><?= $i->jns_kel ?></td>
						<td><?= $i->tmpt_lahir ?></td>
						<td><?= $i->tgl_lahir ?></td>
						<td><?= $i->alamat ?></td>
						<td><?= $i->no_telp ?></td>
						<td><?= $i->username ?></td>
						<td><?= $i->status ?></td>
						<td><div class="btn-group-vertical">
							<a class="btn btn-primary btn-xs" href="<?= base_url('admin/member/edit/'.$i->id_member); ?>"><i class="fa fa-edit"> Edit</i></a>
							<a class="btn btn-danger btn-xs" href="<?= base_url('admin/member/hapus/'.$i->id_member); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
						</div>
					</div>
				</td>
			</tr>
			<?php
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Alamat</th>
			<th>Nomor Telepon</th>
			<th>Username</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</tfoot>
</table>
</div>
<!-- /.box-body -->

<!-- /.box -->

<!-- /.col -->


<div class="modal fade" id="tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Member</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('admin/member/tambah')?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= set_value('nama') ?>">
						</div>
						<div class="form-group">
							<label for="nama">Jenis Kelamin</label><br>
							<select name="jns_kel" class="form-control" >
								<option value="Laki-Laki">Laki-Laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea class="form-control" name="alamat" name="alamat" required="" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
						</div>
						<div class="form-group">
							<label for="nama">Tempat Lahir</label>
							<input type="text" name="tmpt_lahir" required="" class="form-control" id="nama" placeholder="Tempat Lahir" value="<?= set_value('tmpt_lahir') ?>">
						</div>
						<div class="form-group">
							<label for="tgl">Tanggal Lahir</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input name="tgl_lahir" placeholder="Tanggal Lahir" type="text" required="" value="<?= set_value('tgl_lahir') ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
							</div>
						</div>
						<div class="form-group <?php echo form_error('no_telp') ? 'has-error' : null ?>">
							<label for="no_telp">Nomor Telepon</label>
							<input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Telepon" required="" value="<?= form_error('no_telp') ? '' : set_value("no_telp")?>">
							<span class="help-block"><?= form_error('no_telp'); ?></span>
						</div>
						<div class="form-group <?php echo form_error('username') ? 'has-error' : null ?>">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" required="" value="<?= form_error('username') ? '' : set_value("username")?>">
							<span class="help-block"><?= form_error('username'); ?></span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="Reset" class="btn btn-default pull-left">Reset</button>
						<button type="Submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->