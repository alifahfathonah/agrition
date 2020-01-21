<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Edit kurir</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-5">
				<form action="<?= base_url('admin/kurir/simpan')?>" method="post">
					<input type="hidden" name="id_kurir" value="<?= $kurir->id_kurir?>">
					<div class="form-group">
							<label for="nama">Nama kurir</label>
							<input type="text" name="nama" required="" class="form-control" placeholder="Nama Kurir" value="<?= $kurir->nama_kurir ?>">
						</div>
						<div class="form-group">
							<label for="durasi">Durasi</label>
							<input type="text" name="durasi" required="" class="form-control" placeholder="Durasi Contoh (1-2 Jam)" value="<?= $kurir->durasi_kirim?>">
						</div>
						<div class="form-group">
							<label for="biaya">Biaya</label>
							<input type="text" name="biaya" required="" class="form-control" placeholder="Biaya Kirim Contoh (10.000)" value="<?= $kurir->biaya_kirim?>">
						</div>
				</div>
			</div>
			<button type="Submit" class="btn btn-primary">Simpan</button>
			<a href="<?= base_url('admin/kurir')?>" type="Reset" class="btn btn-default">Batal</a>
		</form>
	</div>
</div>