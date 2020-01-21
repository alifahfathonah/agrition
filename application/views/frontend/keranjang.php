<?= $this->session->flashdata('message');  ?>
<div class="row">
	<div class="col-md-7">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-shopping-cart"> Isi Keranjang</i></h3>
			</div>
			<div class="box-body">
				<?php if ($keranjang == null): ?>
					<span>Anda belum memiliki isi keranjang</span><br><br>
					<a href="<?= base_url('home')?>" class="btn btn-primary btn-block">Mulai Belanja</a>
					<?php else: ?>
						<table class="table">
							<th>Barang</th>
							<th>Toko</th>
							<th>Jumlah</th>
							<th>Harga Satuan</th>
							<th>Total</th>
							<th>Action</th>
							<?php foreach ($keranjang as $k): ?>
								<form action="<?= base_url('keranjang/action1')?>" method="post">
									<input type="hidden" name="id_keranjang" value="<?=$k->id_keranjang?>">
									<input type="hidden" name="id_toko" value="<?= $k->id_toko?>">
									<input type="hidden" name="id_barang" value="<?= $k->id_barang?>">
									<input type="hidden" name="harga" value="<?= $k->harga_barang?>">
									<tr>
										<td style="width: 80px"><?= $k->nama_barang?></td>
										<td><?= $k->nama_toko?></td>
										<td><input type="number" name="jumlah" min="1" max="<?=$k->jmlh_barang?>" style="width: 70px" class="form-control" value="<?= $k->jumlah?>"></td>
										<td>Rp <?= number_format($k->harga_barang)?></td>
										<td>Rp <?= number_format($k->jumlah*$k->harga_barang)?></td>
										<td><button type="submit" class="btn btn-primary" name="formsubmit" value="simpan"><i class="fa fa-save"></i></button>
											<button type="submit" class="btn btn-danger" name="formsubmit" value="hapus" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></button>
											<button type="submit" class="btn btn-success" name="formsubmit" value="checkout"><i class="fa fa-bolt"></i></button>
										</td>
									</tr>
								</form>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">Check Out berdasarkan Toko</h3>
				</div>
				<div class="box-body">
					<form method="post" action="<?= base_url('keranjang/pertoko')?>">
						<div class="form-group">
							<label>Daftar Toko</label>
							<select class="form-control" name="toko">
								<option selected="" disabled="">Pilih Toko</option>
								<?php foreach ($toko as $t): ?>
									<option value="<?= $t->id_toko?>"><?= $t->nama_toko?></option>
								<?php endforeach ?>
							</select>
						</div>
						<button type="submit" class="btn btn-success btn-block"><i class="fa fa-bolt"> Check Out</i></button>
					</form>
				</div>
			</div>
		</div>
	</div>