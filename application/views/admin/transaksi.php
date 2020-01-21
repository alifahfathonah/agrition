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
					<th>Pemesan/Member</th>
					<th>Toko</th>
					<th>Tanggal</th>
					<th>Total</th>
					<th>Status</th>
					<th>Tanggal Expired</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($transaksi as $i) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $i->nama_member ?></td>
						<td><?= $i->nama_toko ?></td>
						<td><?= $i->tgl_trans ?></td>
						<td>Rp <?= number_format($i->total_bayar) ?></td>
						<td><?php if ($i->status == null): ?>
							Menunggu Konfirmasi
							<?php else: ?>
								<?= $i->status ?>
						<?php endif ?></td>
						<td><?= $i->tgl_exp ?></td>
						<td><a href="<?= base_url('admin/transaksi/detail/'.$i->id_transaksi)?>" class="btn btn-info btn-s"><i class="fa fa-eye">Detail</i></a></td>
					</tr>
					<?php
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Pemesan/Member</th>
					<th>Toko</th>
					<th>Tanggal</th>
					<th>Total</th>
					<th>Status</th>
					<th>Tanggal Expired</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>