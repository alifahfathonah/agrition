<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Toko</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-5">
				<form action="<?= base_url('admin/toko/simpan')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="foto_lama" value="<?= $toko->foto ?>">
					<input type="hidden" name="id_toko" value="<?=$toko->id_toko?>">
					<div class="form-group">
						<label for="nama">Nama Toko</label>
						<input type="text" name="nama" required="" class="form-control" placeholder="Nama toko" value="<?= $toko->nama_toko?>">
					</div>
					<div class="form-group">
						<label for="kode">Alamat</label>
						<textarea class="form-control" placeholder="Alamat" name="alamat"><?= $toko->alamat?></textarea>
					</div>
					<div class="form-group">
						<label for="nama">No Telepon</label>
						<input type="text" name="no_telp" required="" class="form-control" placeholder="Nama toko" value="<?= $toko->no_telp?>">
					</div>
					<div class="form-group">
						<label for="nama">Email</label>
						<input type="email" name="email" required="" class="form-control" placeholder="Nama toko" value="<?= $toko->email?>">
					</div>
					<div class="form-group">
						<label for="foto">Foto</label>
						<input type="file" name="foto" id="foto" value="<?= set_value('foto') ?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="nama">Nama Rekening</label>
						<input type="text" name="nm_rek" required="" class="form-control" placeholder="Nama rekening" value="<?= $toko->nm_rek?>">
					</div>
					<div class="form-group">
						<label for="nama">Nama Bank</label>
						<input type="text" name="bank" required="" class="form-control" placeholder="Nama bank" value="<?= $toko->bank?>">
					</div>
					<div class="form-group">
						<label for="nama">Nomor Rekening</label>
						<input type="text" name="no_rek" required="" class="form-control" placeholder="nomor Rekening" value="<?= $toko->no_rek?>">
					</div>
				</div>
			</div>
			<button type="Submit" class="btn btn-primary">Simpan</button>
			<a href="<?= base_url('admin/toko')?>" type="Reset" class="btn btn-default">Batal</a>
		</form>
	</div>
</div>