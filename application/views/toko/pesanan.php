<?= $this->session->flashdata('message');  ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Pesanan</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Tanggal Trans</th>
					<th>Pembelian</th>
					<th>Tanggal Expired</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($pesanan as $i) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $i->nama_member ?></td>
						<td><?= $i->tgl_trans ?> Kg</td>
						<td>Rp <?= number_format($i->total_bayar) ?></td>
						<td><?= $i->tgl_exp ?></td>
						<td><?= $i->status_trans ?></td>
						<td>
							<a class="btn btn-info btn-s" href="<?= base_url('toko/pesanan/detail/'.$i->id_transaksi); ?>"><i class="fa fa-edit"> Detail</i></a>
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
					<th>Tanggal Trans</th>
					<th>Pembelian</th>
					<th>Tanggal Expired</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->

