<div class="row">
	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Profile Toko</h3>
			</div>
			<div class="box-body">
				<div class="thumbnail">
					<img src="<?= base_url('assets/img/toko/').$toko->foto ?>" width="200" height="200">
				</div>
				<table class="table">
					<tr>
						<td>Nama Toko</td>
						<td>:</td>
						<td><b><?= $toko->nama_toko ?></b></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><b><?= $toko->alamat ?></b></td>
					</tr>
					<tr>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td><b><?= $toko->no_telp ?></b></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><b><?= $toko->email ?></b></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">Daftar Barang</h3>
			</div>
			<div class="box-body">
				<?php foreach ($barang as $b) : ?>
					<div class="col-md-4">
						<div class="thumbnail" style="width: 210px; height: 370px">
							<img src="<?= base_url('assets/img/barang/').$b->gambar ?>" width="150" height="150">
							<p align="center"><strong><?= $b->nama_barang ?></strong></p>
							<p align="center"><?= number_format($b->harga_barang) ?></p>
							<p align="center"><?= $b->nm_kategori ?></p>
							<p align="center"><a href="<?= base_url('home/addcart/').$b->id_barang?>" class="btn btn-success"><i class="fa fa-cart-plus"></i></a></p>
							<p align="center"><a href="<?= base_url('home/detail/').$b->id_barang?>" class="btn btn-primary"><i class="fa fa-eye"> Detail</i></a></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div align="center"><?= $this->pagination->create_links();?></div>
		</div>
	</div>
</div>