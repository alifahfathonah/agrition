<?= $this->session->flashdata('message');  ?>

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
					<th>Nama Toko</th>
					<th>Alamat</th>
					<th>No Telpon</th>
					<th>Nama Pemilik</th>
					<th>Email</th>
					<th>Foto</th>
					<th>Nama Rek</th>
					<th>Bank</th>
					<th>No. Rek</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($toko as $t) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $t->nama_toko ?></td>
						<td><?= $t->alamat ?></td>
						<td><?= $t->no_telp ?></td>
						<td><?= $t->nama_member ?></td>
						<td><?= $t->email ?></td>
						<td><img src="<?= base_url('assets/img/toko/').$t->foto ?>"height="55px" width="55px" class='img-square'></td>
						<td><?= $t->nm_rek ?></td>
						<td><?= $t->bank ?></td>
						<td><?= $t->no_rek ?></td>
						<td><div class="btn-group-vertical">
							<a class="btn btn-primary btn-xs" href="<?= base_url('admin/toko/edit/'.$t->id_toko ); ?>"><i class="fa fa-edit"> Edit</i></button>
								<a class="btn btn-danger btn-xs" href="<?= base_url('admin/toko/hapus/'.$t->id_toko); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
							</div>
						</ul>
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
			<th>Nama Toko</th>
			<th>Alamat</th>
			<th>No Telpon</th>
			<th>Nama Pemilik</th>
			<th>Email</th>
			<th>Foto</th>
			<th>Nama Rek</th>
			<th>Bank</th>
			<th>No. Rek</th>
			<th>Action</th>
		</tr>
	</tfoot>
</table>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
