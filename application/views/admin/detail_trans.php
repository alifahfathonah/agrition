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
							<p><strong>Toko tidak merespon pembelian anda, pengebalian dana akan dikirimkan kembali ke Rekening sebelumnya</strong></p><br>
						<?php endif ?>
						<p><strong>Nama Toko : <span class="badge badge-secondary bg-green"><?= $detail->nama_toko?></span></strong></p>
						<p><strong>Admin Penerima Pembayaran: <span class="badge badge-secondary bg-blue"><?= $detail->nama_admin?></span></strong></p>	
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
											<?php if ($detail->status_trans == 'Pengemasan' || $detail->status_trans == 'Memproses Pembayaran' || $detail->status_trans == 'Diterima'): ?>	
												<h5>Harus diproses sebelum tanggal : <span class="badge badge-secondary bg-red"> <?= $detail->tgl_exp?></span></h5>
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
												<?php if ($detail->status_trans == 'Refund'): ?>
													<p><strong>Refund Pembayaran Kepada</strong></p>
													<table class="table">
														<tr>
															<td>Nama Rekening</td>
															<td>:</td>
															<td><?= $detail->nama_rek?></td>
														</tr>
														<tr>
															<td>Nomor Rekening</td>
															<td>:</td>
															<td><?= $detail->no_rek_bayar ?></td>
														</tr>
														<tr>
															<td>Bank</td>
															<td>:</td>
															<td><?= $detail->bank ?></td>
														</tr>
														<tr>
															<td>Jumlah Pengembalian</td>
															<td>:</td>
															<td>Rp <?= number_format($detail->total_bayar) ?></td>
														</tr>
													</table>
													<?php else :?>
														<p><strong>Detail Pembayaran Dan Kurir</strong></p>
														<table class="table">
															<tr>
																<td>Rekening</td>
																<td>:</td>
																<td><?= $t->bank?></td>
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
												<?php endif ?>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<?php if ($detail == null): ?>

										<?php elseif($detail->status_trans == 'Diterima'): ?>
											<div class="box box-primary">
												<div class="box-header">
													<h3 class="box-title">Melanjutkan Pembayaran</h3>
												</div>
												<div class="box-body">
													<table class="table">
														<tr>
															<td>Nama Rekening</td>
															<td>:</td>
															<td><?= $detail->nm_rek?></td>
														</tr>
														<tr>
															<td>Nomor Rekening</td>
															<td>:</td>
															<td><?= $detail->no_rek?></td>
														</tr>
														<tr>
															<td>Bank</td>
															<td>:</td>
															<td><?= $detail->bank_toko?></td>
														</tr>
														<tr>
															<td>Jumlah</td>
															<td>:</td>
															<td>Rp <?= number_format($detail->total_bayar)?></td>
														</tr>
													</table>
												</div>
											</div>
											<form method="post" action="<?= base_url('admin/transaksi/melanjutkan')?>">
												<input type="hidden" name="id_transaksi" value="<?= $detail->id_transaksi?>">
												<button type="submit" class="btn btn-success margin-bottom" style="width: 180px" onclick="return confirm('Anda yakin Transaksi sudah dilakukan?');">Transaksi Selesai</button>
											</form>
										<?php endif ?>
										<a href="<?= base_url('admin/transaksi')?>" class="btn btn-primary"style="width: 180px">Kembali Ke Transaksi</a>
									</div>
								</div>