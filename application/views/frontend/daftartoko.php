<div class="row">
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Form Toko Baru</h3>
			</div>
			<div class="box-body">
				<form method="post" enctype="multipart/form-data" action="<?= base_url('daftartoko/simpan')?>">
					<div class="form-group">
						<label for="nama">Nama Toko</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Toko" required="">
					</div>
					<div class="form-group">
						<label for="nama">Nomor Telepon</label>
						<input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" required="">
					</div>
					<div class="form-group">
						<label for="nama">Email</label>
						<input type="email" name="email" class="form-control" placeholder="Email" required="">
					</div>
					<div class="form-group">
						<label for="nama">Alamat</label>
						<textarea class="form-control" name="alamat" placeholder="Alamat" required=""></textarea>
					</div>
					<div class="form-group">
						<label for="nama">Nama Rekening</label>
						<input type="text" name="nm_rek" required="" class="form-control" placeholder="Nama Rekening">
					</div>
					<div class="form-group">
						<label for="nama">Nama Bank</label>
						<input type="text" name="bank" required="" class="form-control" placeholder="Nama Bank">
					</div>
					<div class="form-group">
						<label for="nama">Nomor Rekening</label>
						<input type="text" name="no_rek" required="" class="form-control" placeholder="Nomor Rekening">
					</div>
					<div class="form-group">
						<label for="nama">Foto</label>
						<input type="file" name="foto" required="">
					</div>
					<button type="submit" class="btn btn-primary margin-bottom">Daftar</button>
					<a href="<?= base_url('profile')?>" class="btn btn-default margin-bottom">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>