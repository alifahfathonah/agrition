<?php echo validation_errors(); ?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Member</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-5">
				<form action="<?= base_url('admin/member/simpan')?>" method="post">
					<input type="hidden" name="id_member" value="<?= $member->id_member ?>">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= $member->nama_member ?>">
					</div>
					<div class="form-group">
						<label for="nama">Tempat Lahir</label>
						<input type="text" name="tmpt_lahir" required="" class="form-control" id="nama" placeholder="Tempat Lahir" value="<?= $member->tmpt_lahir ?>">
					</div>
					<div class="form-group">
						<label for="tgl">Tanggal Lahir</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input name="tgl_lahir" placeholder="Tanggal Lahir" type="text" required="" value="<?= $member->tgl_lahir ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
						</div>
					</div>
					<div class="form-group <?php echo form_error('no_telp') ? 'has-error' : null ?>">
						<label for="no_telp">Nomor Telepon</label>
						<input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Telepon" required="" value="<?= $member->no_telp ?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="nama">Jenis Kelamin</label><br>
						<select name="jns_kel" class="form-control" >
							<option <?= ($member->jns_kel == "Laki-Laki") ? "selected": "" ?>>Laki-Laki</option>
							<option <?= ($member->jns_kel == "Perempuan") ? "selected": "" ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group <?php echo form_error('username') ? 'has-error' : null ?>">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" placeholder="username" required="" value="<?= $member->username ?>">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" name="alamat" name="alamat" required="" placeholder="Alamat"><?= $member->alamat ?></textarea>
					</div>
				</div>
			</div>
			<button type="Submit" class="btn btn-primary" value="simpan" name="submitform">Simpan</button>
			<a href="<?= base_url('admin/member')?>" type="Reset" class="btn btn-default">Batal</a>
		</form>
	</div>
</div>