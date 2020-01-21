<div class="row">
	<div class="col-md-7">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">Detail Transaksi</h3>
			</div>
			<div class="box-body">
				<?php if ($detail == null): ?>
					<p>Detail Transaksi tidak ditemukan</p>
					<?php else: ?>
						<?php if ($detail->status_trans == 'Refund'): ?>
							<p><strong>Toko tidak merespon pembelian anda, pengembalian dana akan dikirimkan kembali ke Rekening sebelumnya dan akan dihubungi oleh admin.</strong></p><br>
						<?php endif ?>
						<p><strong>Nama Toko : <span class="badge badge-secondary bg-green"><?= $detail->nama_toko?></span></strong></p>	
						<p><strong>Status : </strong><?php if($detail->status_trans == 'Menunggu Pembayaran'): ?>
						<span class="badge badge-secondary bg-red"><?= $detail->status_trans?></span></p>
						<?php elseif($detail->status_trans == 'Memproses Pembayaran'): ?>
							<span class="badge badge-secondary bg-orange"><?= $detail->status_trans?></span></p>
							<?php elseif($detail->status_trans == 'Pengemasan'): ?>
								<span class="badge badge-secondary bg-yellow"><?= $detail->status_trans?></span></p>
								<?php elseif($detail->status_trans == 'Dikirim'): ?>
									<span class="badge badge-secondary bg-green"><?= $detail->status_trans?></span></p>
									<?php elseif($detail->status_trans == 'Diterima'): ?>
										<span class="badge badge-secondary bg-blue"><?= $detail->status_trans?></span></p>
										<?php elseif($detail->status_trans == 'Refund'): ?>
											<span class="badge badge-secondary bg-red"><?= $detail->status_trans?></span></p>
											<?php elseif($detail->status_trans == 'Selesai'): ?>
											<span class="badge badge-secondary bg-green"><?= $detail->status_trans?></span></p>
											<?php endif ?></p>
											<?php if ($detail->status_trans == 'Pengemasan' || $detail->status_trans == 'Memproses Pembayaran' || $detail->status_trans == 'Dikirim'): ?>
												<h5>Tanggal Expired : <span class="badge badge-secondary bg-red"> <?= $detail->tgl_exp?></span></h5>
												<?php else :?>

												<?php endif ?>
												<?php if ($detail->status_trans == 'Dikirim' || $detail->status_trans == 'Diterima' || $detail->status_trans == 'Selesai'): ?>
													<h5>Nomor Resi : <span class="badge badge-secondary bg-red"> <strong><?= $detail->no_resi?></strong></span></h5>
												<?php endif ?>				
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
								<div class="col-md-5">
									<?php if ($detail->status == 'Dikirim'): ?>
										<form method="post" action="<?= base_url('transaksi/diterima')?>">
											<input type="hidden" name="id_transaksi" value="<?= $detail->id_transaksi?>">
										<button type="submit" class="btn btn-success margin-bottom" style="width: 150px">Telah Diterima</button><br>
										</form>
									<?php endif ?>
									<a href="<?= base_url('transaksi')?>" class="btn btn-primary" style="width: 150px">Kembali Ke Transaksi</a>
								</div>
							</div>