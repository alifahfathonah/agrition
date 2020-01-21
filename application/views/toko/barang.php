<?= $this->session->flashdata('message');  ?>

<div class="row">
	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block margin-bottom" data-toggle="modal" data-target="#tambah">Tambah Data</button>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Barang</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Berat</th>
					<th>Harga</th>
					<th>Gambar</th>
					<th>Jumlah</th>
					<th>Status</th>
					<th>Kategori</th>
					<th>Keterangan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($barang as $i) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $i->nama_barang ?></td>
						<td><?= $i->berat_barang ?> gr</td>
						<td>Rp <?= number_format($i->harga_barang) ?></td>
						<td><img src="<?= base_url('assets/img/barang/').$i->gambar ?>"height="55px" width="55px" class='img-square'></td>
						<td><?= $i->jmlh_barang ?> Unit</td>
						<td><?= $i->status_barang ?></td>
						<td><?= $i->nm_kategori ?></td>
						<td><?= $i->keterangan ?></td>
						<td>
							<a class="btn btn-info btn-s" href="<?= base_url('toko/barang/edit/'.$i->id_barang); ?>"><i class="fa fa-edit"> Edit</i></a>
							<a class="btn btn-danger btn-s"  href="<?= base_url('toko/barang/hapus/'.$i->id_barang); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
						</div>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Berat</th>
				<th>Harga</th>
				<th>Gambar</th>
				<th>Jumlah</th>
				<th>Status</th>
				<th>Kategori</th>
				<th>Keterangan</th>
				<th>Action</th>
			</tr>
		</tfoot>
	</table>
</div>
<!-- /.box-body -->

<!-- /.box -->

<!-- /.col -->


<div class="modal fade" id="tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Barang</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('toko/barang/tambah')?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="nama">Nama Barang</label>
							<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama">
						</div>
						<div class="form-group">
							<label for="nama">Berat Barang</label>
							<input type="number" min="1" name="berat" required="" class="form-control" id="nama" placeholder="Per gram">
						</div>
						<div class="form-group">
							<label for="nama">Harga Barang</label>
							<input type="text" name="harga" required="" class="form-control" id="nama" placeholder="Harga Barang">
						</div>
						<div class="form-group">
							<label for="nama">Jumlah Barang</label>
							<input type="number" min="1" name="jumlah" required="" class="form-control" id="nama" placeholder="Jumlah Barang Tersedia">
						</div>
						<div class="form-group">
							<label for="nama">Kategori</label>
							<select name="kategori" required="" class="form-control">
								<option value="" disabled="" selected="">Pilih Kategori</option>
								<?php foreach ($kategori as $k) { 
									echo "<option value='$k->id_kategori'>$k->nm_kategori</option>";
								} ?>
							</select>
						</div>
						<div class="form-group">
							<label for="nama">Keterangan</label>
							<textarea type="text" name="keterangan" required="" class="form-control" placeholder="Keterangan Barang"></textarea>
						</div>
						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" name="foto" id="foto" required="">
						</div>
					</div>
					<div class="modal-footer">
						<button type="Reset" class="btn btn-default pull-left">Reset</button>
						<button type="Submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->