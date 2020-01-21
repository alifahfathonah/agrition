<?= $this->session->flashdata('message');  ?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Selamat Datang</h3>
	</div>
	<div class="box-body">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="box-body">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
					</ol>
					<div class="carousel-inner">
						<div class="item active">
							<img src="<?= base_url('assets/img/agrition.png'); ?>" alt="First slide">

							<div class="carousel-caption">
								
							</div>
						</div>
						<div class="item">
							<img src="<?= base_url('assets/img/gambar1.jpg'); ?>" alt="Second slide">

							<div class="carousel-caption">
								
							</div>
						</div>
						<div class="item">
							<img src="<?= base_url('assets/img/gambar2.jpg'); ?>" alt="Third slide">

							<div class="carousel-caption">
								
							</div>
						</div>
						<div class="item">
							<img src="<?= base_url('assets/img/gambar3.jpg'); ?>" alt="Third slide">

							<div class="carousel-caption">
								
							</div>
						</div>
					</div>
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="fa fa-angle-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="fa fa-angle-right"></span>
					</a>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	<!-- /.box-body blank box-->
	<br>
	<div class="row">
		<div class="col-md-5">
			<hr>
		</div>
		<div class="col-md-2 text-center">
			<strong> List Product </strong>
		</div>
		<div class="col-md-5">
			<hr>
		</div>
	</div>
	<div class="box-body">
		<?php foreach ($barang as $b) : ?>
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
	<div align="center"><?= $this->pagination->create_links();?></div>
</div>