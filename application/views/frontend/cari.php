<?php if ($hasil == null || $_GET == null ): ?>
	<h1 align="center">Tidak Ada Hasil...</h1>
	<div class="col-md-6">
		<form method="get" action="<?= base_url('cari')?>">
			<div class="form-group">
				<input type="text" required="" class="form-control" placeholder="Kata Kunci" name="keyword">
			</div>
			<button type="submit" class="btn btn-primary pull-right btn-s">Cari</button>
		</form>
	</div>
	<div class="col-md-6">
		<form method="get" action="<?= base_url('cari')?>">
			<div class="form-group">
				<select name="kategori" class="form-control">
					<option value="" disabled="" selected="">Pilih Kategori</option>
					<?php foreach ($kategori as $k) { 
						echo "<option value='$k->id_kategori'>$k->nm_kategori</option>";
					} ?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary pull-right btn-s">Pilih</button>
		</form>
	</div>
	<?php else: ?>
		<div class="box box-default">
			<div class="box-header with-border"><h3 class="box-title">List Product, Hasil dari: <?=$kata?></h3>
			</div>
			<!-- /.box-body blank box-->
			<div class="box-body">
				<?php foreach ($hasil as $b) : ?>
					<div class="col-md-3">
						<div class="thumbnail" style="width: 250px; height: 370px">
							<img src="<?= base_url('assets/img/barang/').$b->gambar ?>" width="150" height="150">
							<p align="center"><strong><?= $b->nama_barang ?></strong></p>
							<p align="center"><?= number_format($b->harga_barang) ?></p>
							<p align="center"><?= $b->nm_kategori ?></p>
							<p align="center"><b><a href="<?= base_url('home/toko/').$b->id_toko?>" style="color: inherit;"><?= $b->nama_toko ?></a></b></p>
							<p align="center"><a href="<?= base_url('home/addcart/').$b->id_barang?>" class="btn btn-success"><i class="fa fa-cart-plus"></i></a></p>
							<p align="center"><a href="<?= base_url('home/detail/').$b->id_barang?>" class="btn btn-primary"><i class="fa fa-eye"> Detail</i></a></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif ?>