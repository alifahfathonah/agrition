<?= $this->session->flashdata('message');  ?>
<div class="row">
	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Profile Member</h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><?= $profile->nama_member?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td><?= $profile->jns_kel?></td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td>:</td>
						<td><?= $profile->tmpt_lahir?></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>:</td>
						<td><?= $profile->tgl_lahir?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td style="max-width: 210px"><?= $profile->alamat?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td style="max-width: 210px"><?= $profile->email?><br><?php if ($profile->is_active == 0): ?>
							<b>Belum Verifikasi Email</b>
						<?php endif ?></td>
					</tr>
					<tr>
						<td>Username</td>
						<td>:</td>
						<td><?= $profile->username?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><?= $profile->status?></td>
					</tr>
				</table><br>
				<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit">Edit Profile</button>
				<button class="btn btn-danger btn-block" data-toggle="modal" data-target="#pass">Ubah Password</button>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="box-title">Keranjang</h3>
			</div>
			<div class="box-body">
				<?php if ($jumlah == null): ?>
					<span>Anda belum memiliki isi keranjang</span><br><br>
					<a href="<?= base_url('home')?>" class="btn btn-primary btn-block">Mulai Belanja</a>
					<?php else: ?>
						<span>Anda memiliki <?= $jumlah?> barang di kerajang</span><br><br>
						<table class="table">
							<th>Item</th>
							<th>Jumlah</th>
							<th>Action</th>
							<?php foreach ($keranjang as $k): ?>
								<tr>
									<td><?= $k->nama_barang?></td>
									<td><?= $k->jumlah?> Unit</td>
									<td><a href="<?= base_url('keranjang')?>">Check Out</a></td>
								</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Profile Toko</h3>
				</div>
				<div class="box-body">
					<?php if ($profile->status == 'Pembeli'): ?>
						<span>Anda Belum Memiliki Toko, Mulai jualan?</span><br><br>
						<a href="<?= base_url('daftartoko')?>" class="btn btn-primary btn-block">Buat Toko</a>
						<?php else: ?>
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
							</table><br>
							<a href="<?= base_url('toko/dashboard')?>" class="btn btn-primary margin-bottom btn-block">Dashboard</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Edit Data</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="<?= base_url('profile/update')?>">
								<div class="form-group">
									<label for="nama">Nama</label>
									<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= $profile->nama_member ?>">
								</div>
								<div class="form-group">
									<label for="jns_kel">Jenis Kelamin</label><br>
									<select name="jns_kel" class="form-control" >
										<option <?= ($profile->jns_kel == "Laki-Laki") ? "selected" : "" ?>>Laki-Laki</option>
										<option <?= ($profile->jns_kel == "Perempuan") ? "selected" : "" ?>>Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="tmpt_lahir">Tempat Lahir</label>
									<input type="text" class="form-control" name="tmpt_lahir" id="tmpt_lahir" placeholder="Tempat Lahir" required="" value="<?= $profile->tmpt_lahir ?>">
								</div>
								<div class="form-group">
									<label for="tgl_lahir">Tanggal Lahir</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="tgl_lahir" placeholder="Tanggal Lahir" type="text" required="" value="<?= $profile->tgl_lahir ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
									</div>
								</div>
								<div class="form-group">
									<label for="alamat">Alamat</label>
									<textarea class="form-control" name="alamat" required="" placeholder="Alamat"><?= $profile->alamat ?></textarea>
								</div>
								<div class="form-group">
									<label for="no_telp">Nomor Telepon</label>
									<input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Telepon" required="" value="<?= $profile->no_telp ?>">
								</div>
								<div class="form-group">
									<label for="username">Username</label>
									<input type="username" class="form-control" name="username" id="username" placeholder="Username" required="" value="<?= $profile->username ?>" readonly="">
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

			<div class="modal fade" id="pass">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Ubah Password</h4>
							</div>
							<div class="modal-body">
								<form action="<?= base_url('profile/pass')?>" method="post">
									<input type="hidden" name="passasli" value="<?= $profile->password ?>">
									<div class="form-group">
										<label for="nama">Password Lama</label>
										<input type="password" name="passlama" required="" class="form-control"  placeholder="Password Lama" value="<?= set_value("passlama")?>" required="">
									</div>
									<div class="form-group <?php echo form_error('passbaru') ? 'has-error' : null ?>">
										<label for="kode">Password Baru</label>
										<input type="password" class="form-control" name="passbaru" placeholder="Password Baru" required="" value="">
										<span class="help-block"><?php echo form_error('passbaru'); ?></span>
									</div>
									<div class="form-group has-error">
										<label for="Pemilik">Tulis Ulang</label>
										<input type="password" class="form-control" name="passconf" placeholder="Tulis Ulang Password Baru" required="" value="">
										<span style="color: red; font-size: 10px;"><?php echo form_error('passconf'); ?></span>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
									<button type="Submit" class="btn btn-primary">Simpan</button>
								</div>
							</form>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			<!-- /.modal -->