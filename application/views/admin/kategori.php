<?= $this->session->flashdata('message');  ?>

<div class="row">
	<?php echo validation_errors(); ?>
	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block margin-bottom" data-toggle="modal" data-target="#tambah">Tambah Data</button>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Kategori</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Kategori</th>
					<th>Keterangan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($kategori as $k) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $k->nm_kategori ?></td>
						<td><?= $k->keterangan ?></td>
						<td>
							<a class="btn btn-primary btn-s" href="<?= base_url('admin/kategori/edit/'.$k->id_kategori ); ?>"><i class="fa fa-edit"> Edit</i></a>
								<a class="btn btn-danger btn-s" href="<?= base_url('admin/kategori/hapus/'.$k->id_kategori); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
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
					<th>Nama Kategori</th>
					<th>Keterangan</th>
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
					<h4 class="modal-title">Tambah Kategori</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('admin/kategori/tambah')?>" method="post">
						<div class="form-group">
							<label for="nama">Nama Kategori</label>
							<input type="text" name="nama" required="" class="form-control" placeholder="Nama Kategori" value="<?= set_value('nama') ?>">
						</div>
						<div class="form-group">
							<label for="kode">Keterangan</label>
							<textarea class="form-control" placeholder="Keterangan" name="keterangan"></textarea>
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