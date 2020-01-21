<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Toko</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-5">
				<form action="<?= base_url('toko/dashboard/simpan')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="foto_lama" value="<?= $toko->foto ?>">
					<div class="form-group">
						<label for="nama">Nama Toko</label>
						<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= $toko->nama_toko ?>">
					</div>
					<div class="form-group">
						<label for="kode">Alamat</label>
						<textarea class="form-control" name="alamat" required=""><?= $toko->alamat ?></textarea>
					</div>
					<div class="form-group">
						<label for="Pemilik">Nomor Telepon</label>
						<input type="text" class="form-control" name="no_telp" id="pekerjaan" required="" value="<?= $toko->no_telp ?>">
					</div>
					<div class="form-group">
						<label for="no_rek">Email</label>
						<input type="email" class="form-control" name="email" required="" value="<?= $toko->email ?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="thumbnail">
						<img src="<?= base_url('assets/img/toko/').$toko->foto ?>" width="200" height="200">
					</div>
					<p><b>Ubah Foto?</b></p>
					<div class="form-group">
						<input type="file" name="foto">
					</div>
				</div>
			</div>
			<button type="Submit" class="btn btn-primary">Simpan</button>
			<a href="<?= base_url('toko/dashboard')?>" type="Reset" class="btn btn-default">Batal</a>
		</form>
	</div>
</div>