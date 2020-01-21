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
						<b>Username</b> <a class="pull-right"><?= $this->session->userdata('username') ?></a>
					</li>
					<?php if ($this->session->userdata('level') == 1): ?>
						<li class="list-group-item">
							<b>Level</b> <a class="pull-right">Super Administrator</a>
						</li>
						<?php else: ?>
							<li class="list-group-item">
								<b>Level</b> <a class="pull-right">Administrator</a>
							</li>
						<?php endif ?>
					</ul>

					<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit"><b>Edit Profile</b></button>
					<button type="button" class="btn btn-warning btn-block" data-toggle="modal" <?= $this->session->userdata('level') == '1' ? "data-target='#new'" : null ?>><b>Tambah Admin</b></button>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<div class="col-md-9">
			<div class="box box-warning box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Konfirmasi Pembayaran</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
					<!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th style="width: 10px">#</th>
								<th>Pemesan/Member</th>
								<th>Toko</th>
								<th>Konfimasi Sebelum</th>
								<th>Status</th>
								<th style="width: 40px">Action</th>
							</tr>
							<?php 
							$no = 1;
							foreach ($pembayaran as $p) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $p->nama_member ?></td>
									<td><?= $p->nama_toko?></td>
									<td><?= $p->tgl_exp?></td>
									<td><?= $p->status ?></td>
									<td><a href="<?= base_url('admin/transaksi/detail/'.$p->id_transaksi); ?>" ><span class="badge bg-blue">Detail</span></a></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.box-body -->
		</div>
		<div class="col-md-9">
			<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Pembelian Refund</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
					<!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th style="width: 10px">#</th>
								<th>Pemesan/Member</th>
								<th>Toko</th>
								<th>Tanggal Transaksi</th>
								<th>Status</th>
								<th style="width: 40px">Action</th>
							</tr>
							<?php 
							$no = 1;
							foreach ($refund as $r) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $r->nama_member ?></td>
									<td><?= $r->nama_toko?></td>
									<td><?= $r->tgl_trans?></td>
									<td><?= $r->status ?></td>
									<td><a href="<?= base_url('admin/transaksi/detail/'.$r->id_transaksi); ?>" ><span class="badge bg-blue">Detail</span></a></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.box-body -->
		</div>
		<div class="col-md-9">
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Konfirmasi Penyelesaian Transaksi</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
					<!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th style="width: 10px">#</th>
								<th>Pemesan/Member</th>
								<th>Toko</th>
								<th>Tanggal Transaksi</th>
								<th>Status</th>
								<th style="width: 40px">Action</th>
							</tr>
							<?php 
							$no = 1;
							foreach ($diterima as $d) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $d->nama_member ?></td>
									<td><?= $d->nama_toko?></td>
									<td><?= $d->tgl_trans?></td>
									<td><?= $d->status ?></td>
									<td><a href="<?= base_url('admin/transaksi/detail/'.$d->id_transaksi); ?>" ><span class="badge bg-blue">Detail</span></a></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.box-body -->
		</div>
	</div>

	<div class="modal fade" id="edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Profile</h4>
					</div>
					<div class="modal-body">
						<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/dashboard/editdata')?>">
							<div class="form-group">
								<input type="hidden" name="foto_lama" value="<?= $admin->foto ?>">
								<label for="nama">Nama</label>
								<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= $admin->nama_admin ?>">
							</div>
							<div class="form-group">
								<label for="nama">Jenis Kelamin</label><br>
								<select name="jns_kel" class="form-control" >
									<option <?= ($admin->jns_kel == "Laki-Laki") ? "selected": "" ?>>Laki-Laki</option>
									<option <?= ($admin->jns_kel == "Perempuan") ? "selected": "" ?>>Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label for="tgl">Tanggal Lahir</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input name="tgl_lahir" placeholder="Tanggal Lahir" type="text" required="" value="<?= $admin->tgl_lahir ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
							</div>
							<div class="form-group ">
								<label for="no_telp">Tempat Lahir</label>
								<input type="text" class="form-control" name="tmpt_lahir" id="no_telp" placeholder="Tempat Lahir" required="" value="<?= $admin->tmpt_lahir ?>">
							</div>
							<div class="form-group ">
								<label for="no_telp">Username</label>
								<input type="text" class="form-control" name="username" id="no_telp" placeholder="Tempat Lahir" readonly="" value="<?= $admin->username ?>">
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" name="alamat" name="alamat" required="" placeholder="Alamat"><?= $admin->alamat ?></textarea>
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<input type="file" name="foto" id="foto" value="">
							</div>
							<span>Ubah Password? <a href="#" data-toggle="modal" data-target="#password" data-dismiss="modal">Klik disini</a></span>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal fade" id="password">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Ubah Password</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="<?= base_url('admin/dashboard/password')?>">
								<input type="hidden" name="passasli" value="<?= $admin->password ?>">
								<div class="form-group">
									<label for="nama">Password Lama</label>
									<input type="password" name="passlama" required="" class="form-control"  placeholder="Password Lama" value="<?= set_value("passlama")?>" required="">
								</div>
								<div class="form-group <?php echo form_error('passbaru') ? 'has-error' : null ?>">
									<label for="kode">Password Baru</label>
									<input type="password" class="form-control" name="passbaru" placeholder="Password Baru" required="" value="">
									<span class="help-block"><?php echo form_error('passbaru'); ?></span>
								</div>
								<div class="form-group <?php echo form_error('passconf') ? 'has-error' : null ?>">
									<label for="Pemilik">Tulis Ulang</label>
									<input type="password" class="form-control" name="passconf" placeholder="Tulis Ulang Password Baru" required="" value="">
									<span class="help-block"><?php echo form_error('passconf'); ?></span>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->

			<div class="modal fade" id="new">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Tambah Admin</h4>
							</div>
							<div class="modal-body">
								<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/dashboard/tambah')?>">
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
										<label for="tgl">Tanggal Lahir</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input name="tgl_lahir" placeholder="Tanggal Lahir" type="text" value="<?= set_value('tgl_lahir') ?>" required=""  class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
										</div>
									</div>
									<div class="form-group">
										<label for="no_telp">Tempat Lahir</label>
										<input type="text" class="form-control" name="tmpt_lahir" id="no_telp" placeholder="Tempat Lahir" required="" value="<?= set_value('tmpt_lahir') ?>">
									</div>
									<div class="form-group">
										<label for="alamat">Alamat</label>
										<textarea class="form-control" name="alamat" name="alamat" required="" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
									</div>
									<div class="form-group <?php echo form_error('username') ? 'has-error' : null ?>">
										<label for="email">Username</label>
										<input type="text" class="form-control" name="username" placeholder="Username" value="" required="" >
										<span class="help-block"><?php echo form_error('username') ? 'Username sudah digunakan' : null ?></span>
									</div>
									<div class="form-group">
										<label>Level</label>
										<div class="radio">
											<label for="level">
												<input type="radio" name="level" value="0" checked="">0
											</label>
											<label for="level">
												<input type="radio" name="level" value="1">1
											</label>
										</div>
									</div>
									<div class="form-group">
										<label for="foto">Foto</label>
										<input type="file" name="foto" required="">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</form>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

