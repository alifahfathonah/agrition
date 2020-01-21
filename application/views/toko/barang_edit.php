<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Edit barang</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-5">
				<form action="<?= base_url('toko/barang/simpan')?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="hidden" name="id_barang" value="<?= $barang->id_barang?>">
						<input type="hidden" name="foto_lama" value="<?= $barang->gambar?>">
						<label for="nama">Nama Barang</label>
						<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama" value="<?= $barang->nama_barang?>">
					</div>
					<div class="form-group">
						<label for="nama">Berat Barang</label>
						<input type="number" min="1" name="berat" required="" class="form-control" id="nama" placeholder="Per gram" value="<?= $barang->berat_barang?>">
					</div>
					<div class="form-group">
						<label for="nama">Harga Barang</label>
						<input type="text" name="harga" required="" class="form-control" id="nama" placeholder="Harga Barang" value="<?= $barang->harga_barang?>">
					</div>
					<div class="form-group">
						<label for="foto">Foto</label>
						<input type="file" name="foto" id="foto">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="nama">Jumlah Barang</label>
						<input type="number" name="jumlah" required="" class="form-control" id="nama" placeholder="Jumlah Barang Tersedia" value="<?= $barang->jmlh_barang?>">
					</div>
					<div class="form-group">
						<label for="nama">Status</label><br>
						<select name="status" class="form-control" >
							<option <?= ($barang->status_barang == "Tersedia") ? "selected": "" ?>>Tersedia</option>
							<option <?= ($barang->status_barang == "Habis") ? "selected": "" ?>>Habis</option>
						</select>
					</div>
					<div class="form-group">
						<label for="nama">Status</label>
						<select name="kategori" required="" class="form-control">
							<option value="<?= $barang->id_kategori ?>" selected=""><?= $barang->nm_kategori?></option>
							<?php foreach ($kategori as $k) { 
								echo "<option value='$k->id_kategori'>$k->nm_kategori</option>";
							} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama">Keterangan</label>
						<textarea type="text" name="keterangan" required="" class="form-control" placeholder="Keterangan Barang"><?= $barang->keterangan?></textarea>
					</div>
				</div>
			</div>
			<button type="Submit" class="btn btn-primary" value="simpan" name="submitform">Simpan</button>
			<a href="<?= base_url('toko/barang')?>" type="Reset" class="btn btn-default">Batal</a>
		</form>
	</div>
</div>