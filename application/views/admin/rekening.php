<?= $this->session->flashdata('message');  ?>

<div class="row">
	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block margin-bottom" data-toggle="modal" data-target="#tambah">Tambah Data</button>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data rekening</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Kode Bank</th>
					<th>Atas Nama</th>
					<th>Nomor Rekening</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($rekening as $r) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $r->nm_bank ?></td>
						<td><?= $r->kode_bank ?></td>
						<td><?= $r->pemilik ?></td>
						<td><?= $r->no_rek ?></td>
						<td>
							<a class="btn btn-info" href="<?= base_url('admin/rekening/edit/'.$r->id_rekening); ?>"><i class="fa fa-edit"> Edit</i></a>
							<a class="btn btn-danger" href="<?= base_url('admin/rekening/hapus/'.$r->id_rekening); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
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
				<th>Nama Bank</th>
				<th>Kode Bank</th>
				<th>Atas Nama</th>
				<th>Nomor Rekening</th>
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
					<h4 class="modal-title">Tambah rekening</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('admin/rekening/tambah')?>" method="post">
						<div class="form-group">
							<label for="nama">Nama Bank</label>
							<input type="text" name="nama" required="" class="form-control" id="nama" placeholder="Nama">
						</div>
						<div class="form-group">
							<label for="kode">Kode Bank</label>
							<input type="text" class="form-control" name="kode" id="kode" placeholder="Kode Bank" required="">
						</div>

						<div class="form-group">
							<label for="Pemilik">Atas Nama</label>
							<input type="text" class="form-control" name="pemilik" id="pekerjaan" placeholder="Atas Nama" required="">
						</div>
						<div class="form-group">
							<label for="no_rek">Nomor Rekening</label>
							<input type="text" class="form-control" name="no_rek" id="no_rek" placeholder="Nomor Rekening" required="" value="">
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