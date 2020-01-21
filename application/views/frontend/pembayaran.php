<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Pembayaran</h3>
			</div>
			<div class="box-body">
				<?php if ($detail == null): ?>
					<p>Transaksi tidak ditemukan</p>
					<a href="<?= base_url('transaksi')?>" class="btn btn-default btn-block">Kembali Ke Transaksi</a>
					<?php else: ?>
						<p><strong>Lakukan pembayaran sesuai nominal yang tertera!</strong></p>
						<table class="table">
							<tr>
								<td>Kode Unik</td>
								<td>:</td>
								<td><?= $pembayaran->kode_unik?></td>
							</tr>
							<tr>
								<td>Nominal</td>
								<td>:</td>
								<td>Rp <?= number_format($pembayaran->nominal)?></td>
							</tr>
							<tr>
								<td>Nama Rekening</td>
								<td>:</td>
								<td><?= $pembayaran->pemilik ?></td>
							</tr>
							<tr>
								<td>Nomor Rekening</td>
								<td>:</td>
								<td><?= $pembayaran->no_rek?></td>
							</tr>
							<tr>
								<td>Bank</td>
								<td>:</td>
								<td><?= $pembayaran->nm_bank?></td>
							</tr>
							<tr>
								<td>Kode Bank</td>
								<td>:</td>
								<td><?= $pembayaran->kode_bank?></td>
							</tr>
						</table>
						<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#upload">Upload Bukti Pembayaran</button>
						<a href="<?= base_url('transaksi/cancel/'.$detail->id_transaksi)?>" class="btn btn-danger btn-block" onclick="return confirm('Anda yakin ingin membatalkan transaksi ini?')">Batalkan Pesanan</a>
						<a href="<?= base_url('transaksi')?>" class="btn btn-default btn-block">Kembali Ke Transaksi</a>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Detail Transaksi</h3>
				</div>
				<div class="box-body">
					<?php if ($detail == null): ?>
						<p>Detail Transaksi tidak ditemukan</p>
						<?php else: ?>
							<h5>Lakukan pembayaran sebelum tanggal: </h5><span class="badge badge-secondary bg-red"><strong><?= $detail->tgl_exp?></strong></span><br><br>
							<p><strong>Nama Toko: <span class="badge badge-secondary bg-green"><?= $detail->nama_toko?></span></strong></p>
							<table class="table">
								<th>Barang</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Subtotal</th>
								<?php foreach ($detail2 as $t): ?>
									<tr>
										<td><?= $t->nama_barang ?></td>
										<td>Rp <?= number_format($t->harga_barang) ?></td>
										<td><?= $t->qty ?></td>
										<td>Rp <?= number_format($t->subtotal) ?></td>
									</tr>
								<?php endforeach ?>
								<tr>
									<td></td>
									<td></td>
									<td><strong>Total</strong></td>
									<td><strong>Rp <?= number_format($detail->total_bayar)?></strong></td>
								</tr>
							</table>
							<span class="pull-right"><i>Catatan: Termasuk Biaya Kurir, Admin, dan Kode Unik</i></span><br><br>
							<p><strong>Detail Pembayaran Dan Kurir</strong></p>
							<table class="table">
								<tr>
									<td>Rekening</td>
									<td>:</td>
									<td><?= $pembayaran->nm_bank?></td>
								</tr>
								<tr>
									<td>Kurir</td>
									<td>:</td>
									<td><?= $t->nama_kurir ?></td>
								</tr>
								<tr>
									<td>Durasi</td>
									<td>:</td>
									<td><?= $t->durasi_kirim ?></td>
								</tr>
							</table>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="upload">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Tambah Kategori</h4>
						</div>
						<div class="modal-body">
							<form enctype="multipart/form-data" action="<?= base_url('transaksi/upload')?>" method="post">
								<input type="hidden" name="id_pembayaran" value="<?= $pembayaran->id_pembayaran?>">
								<input type="hidden" name="id_transaksi" value="<?= $detail->id_transaksi ?>">
								<div class="form-group">
									<label for="nama">Nomor Rekening</label>
									<input type="text" name="no_rek" required="" class="form-control" placeholder="Nomor rekening yang digunakan untuk membayar">
								</div>
								<div class="form-group">
									<label for="nama">Nama Pemilik Rekening</label>
									<input type="text" name="pemilik" required="" class="form-control" placeholder="Nama pemilik rekening yang digunakan untuk membayar">
								</div>
								<div class="form-group">
									<label for="nama">Nama Bank</label>
									<input type="text" name="bank" required="" class="form-control" placeholder="Nama bank yang digunakan untuk membayar">
								</div>
								<div class="form-group">
									<label for="nama">Jumlah</label>
									<input type="text" name="jumlah" required="" class="form-control" placeholder="Jumlah uang yang dibayarkan">
								</div>
								<div class="form-group">
									<label for="nama">Bukti Pembayaran</label>
									<input type="file" name="foto" required="">
								</div>
							</div>
							<div class="modal-footer">
								<button type="Reset" class="btn btn-default pull-left">Reset</button>
								<button type="Submit" class="btn btn-primary">Simpan</button>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<div class="modal fade" id="fail">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Pemberitahuan</h4>
							</div>
							<div class="modal-body">
								<p>Pembayaran Anda Tidak Valid, Lakukan Pembayaran atau Upload Ulang Bukti.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>
	<!-- /.modal -->