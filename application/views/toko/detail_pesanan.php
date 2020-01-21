<?= $this->session->flashdata('message');  ?>
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
												<?php if ($detail->status_trans == 'Pengemasan' || $detail->status_trans == 'Memproses Pembayaran'): ?>	
													<h5>Harus diproses sebelum tanggal : <span class="badge badge-secondary bg-red"> <?= $detail->tgl_exp?></span></h5>
													<?php else :?>

													<?php endif ?>
													<?php if ($detail->status_trans == 'Dikirim' || $detail->status_trans == 'Diterima' || $detail->status_trans == 'Selesai'): ?>
														<h5>Nomor Resi : <span class="badge badge-secondary bg-green"> <strong><?= $detail->no_resi?></strong></span></h5>
													<?php endif ?>
													<table class="table">
														<th>Barang</th>
														<th>Harga</th>
														<th>Jumlah</th>
														<th>Subtotal</th>
														<?php foreach ($detail2 as $t): ?>
															<strong><tr>
																<td><?= $t->nama_barang ?></td>
																<td>Rp <?= number_format($t->harga_barang) ?></td>
																<td><?= $t->qty ?></td>
																<td>Rp <?= number_format($t->subtotal) ?></td>
															</tr></strong>
														<?php endforeach ?>
														<tr>
															<td></td>
															<td></td>
															<td>Total</td>
															<td>Rp <?= number_format($detail->total_bayar)?></td>
														</tr>
													</table>
													<span class="pull-right"><i>Catatan: Termasuk Biaya Kurir, Admin, dan Kode Unik</i></span><br><br>
													<p><strong>Detail Pembayaran Dan Kurir</strong></p>
													<table class="table">
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
										<?php if ($detail != null): ?>
											<?php if ($detail->status_trans == 'Pengemasan'): ?>
												<button class="btn btn-success margin-bottom" style="width: 200px" data-toggle="modal" data-target="#tambah">Barang Telah Dikirim</button><br>
												<a href="<?= base_url('toko/pesanan/batal/'.$detail->id_transaksi)?>" onclick="return confirm('Anda yakin ingin membatalkan transaksi ini?');" class="btn btn-danger margin-bottom" style="width: 200px">Batalkan Pesanan</a><br>
											<?php endif ?>
										<?php endif ?>
										<a href="<?= base_url('toko/pesanan')?>" class="btn btn-primary" style="width: 200px">Kembali Ke Transaksi</a>
									</div>
								</div>


								<div class="modal fade" id="tambah">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Nomor Resi</h4>
												</div>
												<div class="modal-body">
													<form action="<?= base_url('toko/pesanan/nores')?>" method="post">
														<input type="hidden" name="id_transaksi" value="<?= $detail->id_transaksi ?>">
														<div class="form-group">
															<label for="nama">Nomor Resi</label>
															<input type="text" name="no_res" required="" class="form-control" id="nama" placeholder="Masukan Nomor Resi Pengiriman">
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

