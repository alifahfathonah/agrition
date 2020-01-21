<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Kategori</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-5">
				<form action="<?= base_url('admin/kategori/simpan')?>" method="post">
					<input type="hidden" name="id_kategori" value="<?= $kategori->id_kategori?>">
					<div class="form-group">
						<label for="nama">Nama Kategori</label>
						<input type="text" name="nama" required="" class="form-control" placeholder="Nama Kategori" value="<?= $kategori->nm_kategori?>">
					</div>
					<div class="form-group">
						<label for="kode">Keterangan</label>
						<textarea class="form-control" placeholder="Keterangan" name="keterangan"><?= $kategori->keterangan?></textarea>
					</div>
				</div>
			</div>
			<button type="Submit" class="btn btn-primary">Simpan</button>
			<a href="<?= base_url('/rekening')?>" type="Reset" class="btn btn-default">Batal</a>
		</form>
	</div>
</div>