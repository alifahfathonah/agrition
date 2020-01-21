<div class="row">
	<div class="col-md-7">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Detail Barang</h3>
			</div>
			<div class="box-body">
				<?php if ($barang == null): ?>
					<p>Barang Tidak Ditemukan.</p>
				<?php else: ?>
				<div class="thumbnail">
					<img src="<?= base_url('assets/img/barang/').$barang->gambar ?>" width="300" height="300">
				</div>
				<table class="table">
					<tr>
						<td>Nama Barang</td>
						<td>:</td>
						<td><?= $barang->nama_barang ?></td>
					</tr>
					<tr>
						<td>Kategori</td>
						<td>:</td>
						<td><?= $barang->nm_kategori ?></td>
					</tr>
					<tr>
						<td>Nama Toko</td>
						<td>:</td>
						<td><?= $barang->nama_toko ?></td>
					</tr>
					<tr>
						<td>Berat</td>
						<td>:</td>
						<td><?= $barang->berat_barang ?> gr</td>
					</tr>
					<tr>
						<td>Jumlah Tersedia</td>
						<td>:</td>
						<td><?= $barang->jmlh_barang ?> Unit</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><?= $barang->status_barang ?></td>
					</tr>
					<tr>
						<td>Harga Barang</td>
						<td>:</td>
						<td>Rp <?= number_format($barang->harga_barang) ?></td>
					</tr>
					<tr>
						<td>Keterangan</td>
						<td>:</td>
						<td><?= $barang->keterangan?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-body">
				<form action="<?= base_url('home/addcart/').$barang->id_barang?>" method="post">
					<div class="form-group">
						<label for="nama">Jumlah</label>
						<input type="number" name="jumlah" min="1" max="<?= $barang->jmlh_barang ?>" class="form-control" placeholder="jumlah" required="" value="1">
					</div>
					<button type="submit" class="btn btn-success btn-lg btn-block margin-bottom">Tambah Ke Keranjang</button>
				</form>
			</div>
		</div>
	</div>
	<?php endif ?>
</div>