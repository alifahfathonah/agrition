<style type="text/css">
	.kotak img {
		-webkit-transition: 0.4s ease;
		transition: 0.4s ease;
	}

	.zoom-effect:hover .kotak img {
		-webkit-transform: scale(1.75);
		transform: scale(1.75);
	}
</style>

<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Pembayaran</h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<td>Nama Pemesan</td>
						<td>:</td>
						<td><?= $transaksi->nama_member?></td>
					</tr>
					<tr>
						<td>Nama Toko</td>
						<td>:</td>
						<td><?= $transaksi->nama_toko?></td>
					</tr>
					<tr>
						<td>Konfirmasi Sebelum</td>
						<td>:</td>
						<td><span class="badge badge-secondary"><?= $transaksi->tgl_exp?></span></td>
					</tr>
				</table><br>
				<p><strong>Yang Harus Dibayarkan :</strong></p>
				<table class="table">
					<tr>
						<td>Kode Unik</td>
						<td>:</td>
						<td><?= $transaksi->kode_unik?></td>
					</tr>
					<tr>
						<td>Nominal</td>
						<td>:</td>
						<td>Rp <?= number_format($transaksi->nominal)?></td>
					</tr>
					<tr>
						<td>Nama Rekening</td>
						<td>:</td>
						<td><?= $transaksi->pemilik ?></td>
					</tr>
					<tr>
						<td>Nomor Rekening</td>
						<td>:</td>
						<td><?= $transaksi->no_rek?></td>
					</tr>
					<tr>
						<td>Bank</td>
						<td>:</td>
						<td><?= $transaksi->nm_bank?></td>
					</tr>
					<tr>
						<td>Kode Bank</td>
						<td>:</td>
						<td><?= $transaksi->kode_bank?></td>
					</tr>
				</table>
				<hr>
				<form method="post" action="<?= base_url('admin/transaksi/action')?>">
					<input type="hidden" name="id_transaksi" value="<?= $transaksi->id_transaksi?>">
					<input type="hidden" name="id_pembayaran" value="<?= $transaksi->id_pembayaran?>">
					<button class="btn btn-success btn-block" value="terima" name="formsubmit" type="submit"><i class="fa fa-check"> Terima</i></button>
					<button class="btn btn-danger btn-block" value="tolak" name="formsubmit" type="submit"><i class="fa fa-close"> Tolak</i></button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="box box-danger">
			<div class="box-header">
				<h3 class="box-title">Pembayaran Masuk</h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<td>Nama Rekening</td>
						<td>:</td>
						<td><?= $transaksi->nama_rek?></td>
					</tr>
					<tr>
						<td>Nomor Rekening</td>
						<td>:</td>
						<td><?= $transaksi->no_rek_bayar?></td>
					</tr>
					<tr>
						<td>Bank</td>
						<td>:</td>
						<td><?= $transaksi->bank?></td>
					</tr>
					<tr>
						<td>Jumlah Bayar</td>
						<td>:</td>
						<td>Rp <?= number_format($transaksi->jmlh_bayar)?></td>
					</tr>
					<tr>
						<td>Tanggal Bayar</td>
						<td>:</td>
						<td><?= $transaksi->tgl_bayar?></td>
					</tr>
				</table><br>
				<p><strong>Bukti Pembayaran</strong></p>
				<div class="zoom-effect">
					<div class="kotak">
						<div class="thumbnail">
							<img src="<?= base_url('assets/img/bukti/').$transaksi->bukti_bayar ?>" width="200" height="200">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>