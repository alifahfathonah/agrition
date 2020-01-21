<?= $this->session->flashdata('message');  ?>
<div class="row">
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">Transaksi</h3>
			</div>
			<div class="box-body">
				<?php if ($transaksi != null): ?>
					<h5>Lakukan pemilihan kurir dan pembayaran sebelum tanggal: </h5><span class="badge badge-secondary bg-red"><strong><?= $trans->tgl_exp?></strong></span><br><br>
					<p><strong>Nama Toko: <span class="badge badge-secondary bg-green"><?= $trans->nama_toko?></span></strong></p>
					<table class="table">
						<th>Barang</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subtotal</th>
						<?php foreach ($transaksi as $t): ?>
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
							<td><strong>Rp <?= number_format($total)?></strong></td>
						</tr>
					</table>
					<span class="pull-right"><i>Catatan: Belum Termasuk Biaya Kurir & Admin</i></span><br>
					<form method="post" action="<?= base_url('transaksi/action')?>">
						<input type="hidden" name="id_transaksi" value="<?= $trans->id_transaksi?>">
						<input type="hidden" name="total" value="<?= $total ?>">
						<label>Kurir </label>
						<select class="form-control" name="kurir">
							<option value="" selected="" disabled="">Pilih Kurir</option>
							<?php foreach ($kurir as $k): ?>
								<option value="<?= $k->id_kurir ?>"><?= $k->nama_kurir?> > Rp <?= number_format($k->biaya_kirim)?> > <?=$k->durasi_kirim?></option>
							<?php endforeach ?>
						</select>
						<br>
						<label>Rekening </label>
						<select class="form-control" name="rekening">
							<option value="" selected="" disabled="">Pilih Rekening Pembayaran</option>
							<?php foreach ($rekening as $k): ?>
								<option value="<?= $k->id_rekening ?>"><?= $k->nm_bank?> > Rp 2,500</option>
							<?php endforeach ?>
						</select><br>
						<button class="btn btn-primary" type="submit" name="formsubmit" value="simpan">Simpan</button>
						<button class="btn btn-danger" onclick="return confirm('Anda yakin ingin membatalkan transaksi ini?')" type="submit" name="formsubmit" value="batal">Batal</button>
					</form>
					<?php else: ?>
						<span>Tidak ada transaksi yang harus diselesaikan</span>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Transaksi Terakhir</h3>
				</div>
				<div class="box-body">
					<?php if ($recenttrans == null): ?>
						<span>Belum ada transaksi tercatat, yuk mulai belanja.</span><br><br>
						<a href="<?= base_url('home')?>" class="btn btn-primary btn-block">Klik Disini</a>
						<?php else: ?>
							<table class="table">
								<th>Nama Toko</th>
								<th>Tanggal</th>
								<th>Status</th>
								<th>Action</th>
								<?php foreach ($recenttrans as $r): ?>
									<tr>
										<td><?= $r->nama_toko?></td>
										<td><?= $r->tgl_trans?></td>
										<?php if ($r->status == null): ?>
											<td><span class="badge badge-secondary">Menunggu Konfirmasi</span></td>
											<?php elseif($r->status == 'Menunggu Pembayaran'): ?>
												<td><span class="badge badge-secondary bg-red"><?= $r->status?></span></td>
												<?php elseif($r->status == 'Refund'): ?>
													<td><span class="badge badge-secondary bg-red"><?= $r->status?></span></td>
													<?php elseif($r->status == 'Memproses Pembayaran'): ?>
														<td><span class="badge badge-secondary bg-orange"><?= $r->status?></span></td>
														<?php elseif($r->status == 'Pengemasan'): ?>
															<td><span class="badge badge-secondary bg-yellow"><?= $r->status?></span></td>
															<?php elseif($r->status == 'Dikirim'): ?>
																<td><span class="badge badge-secondary bg-green"><?= $r->status?></span></td>
																<?php elseif($r->status == 'Diterima'): ?>
																	<td><span class="badge badge-secondary bg-blue"><?= $r->status?></span></td>
																	<?php elseif($r->status == 'Selesai'): ?>
																		<td><span class="badge badge-secondary bg-green"><?= $r->status?></span></p></td>
																	<?php endif ?>
																	<td><a href="<?= base_url('transaksi/detail/'.$r->id_transaksi)?>"><span class="badge badge-secondary bg-blue">Detail</span></a></td>
																</tr>
															<?php endforeach ?>
														</table>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>