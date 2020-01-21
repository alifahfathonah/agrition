<?= $this->session->flashdata('message');  ?>

<div class="row">
	<?php echo validation_errors(); ?>
	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block margin-bottom" data-toggle="modal" data-target="#tambah">Tambah Data</button>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Kurir</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Kurir</th>
					<th>Durasi Kirim</th>
					<th>Biaya Kirim</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($kurir as $k) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $k->nama_kurir ?></td>
						<td><?= $k->durasi_kirim ?></td>
						<td>Rp <?= number_format($k->biaya_kirim) ?></td>
						<td>
							<a class="btn btn-primary" href="<?= base_url('admin/kurir/edit/'.$k->id_kurir ); ?>"><i class="fa fa-edit"> Edit</i></a>
								<a class="btn btn-danger" href="<?= base_url('admin/kurir/hapus/'.$k->id_kurir); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
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
			<th>Nama Kurir</th>
			<th>Durasi Kirim</th>
			<th>Biaya Kirim</th>
			<th>Action</th>
		</tr>
	</tfoot>
</table>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->


<div class="modal fade" id="tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Kurir</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('admin/kurir/tambah')?>" method="post">
						<div class="form-group">
							<label for="nama">Nama Kurir</label>
							<input type="text" name="nama" required="" class="form-control" placeholder="Nama Kurir">
						</div>
						<div class="form-group">
							<label for="durasi">Durasi</label>
							<input type="text" name="durasi" required="" class="form-control" placeholder="Durasi Contoh (1-2 Jam)">
						</div>
						<div class="form-group">
							<label for="biaya">Biaya</label>
							<input type="text" name="biaya" required="" class="form-control" placeholder="Biaya Kirim Contoh (10.000)">
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
	<!-- /.modal -->