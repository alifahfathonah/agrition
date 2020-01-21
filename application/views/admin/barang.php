<?= $this->session->flashdata('message');  ?>
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
					<th>Kategori</th>
					<th>Toko</th>
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
						<td><?= $i->nm_kategori ?></td>
						<td><?= $i->nama_toko ?></td>
						<td>
							<a class="btn btn-danger btn-s"  href="<?= base_url('admin/barang/hapus/'.$i->id_barang); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
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
				<th>Kategori</th>
				<th>Toko</th>
				<th>Action</th>
			</tr>
		</tfoot>
	</table>
</div>
<!-- /.box-body -->
</div>