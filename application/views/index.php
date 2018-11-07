<!DOCTYPE html>
<html>
<head>
	<title>Project Algoritma Evolusioner</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('css/bootstrap.min.css') ?>">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css') ?>">
</head>
<body>
<!-- Tabs -->
<section id="tabs">
	<div class="container">
		<h6 class="section-title h1">Alevo Project</h6>
		<div class="row">
			<div class="col-xs-12 ">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-data-tab" data-toggle="tab" href="#nav-data" role="tab" aria-controls="nav-data" aria-selected="true">Data</a>
						<a class="nav-item nav-link" id="nav-input-tab" data-toggle="tab" href="#nav-input" role="tab" aria-controls="nav-input" aria-selected="false">Input</a>
						<a class="nav-item nav-link" id="nav-populasi-tab" data-toggle="tab" href="#nav-populasi" role="tab" aria-controls="nav-populasi" aria-selected="false" onclick="load_component('#nav-populasi','<?=base_url('ComponentController/load_populasi')?>')">Inisiasi Populasi</a>
						<a class="nav-item nav-link" id="nav-evaluasi-tab" data-toggle="tab" href="#nav-evaluasi" role="tab" aria-controls="nav-evaluasi" aria-selected="false" onclick="load_component('#nav-evaluasi','<?=base_url('ComponentController/load_evaluasi_fitness')?>')">Evaluasi Populasi Awal</a>
						<a class="nav-item nav-link" id="nav-seleksi-tab" data-toggle="tab" href="#nav-seleksi" role="tab" aria-controls="nav-seleksi" aria-selected="false" onclick="load_component('#nav-seleksi','<?=base_url('ComponentController/load_selected_parent_awal') ?>')">Seleksi Awal</a>
						<a class="nav-item nav-link" id="nav-populasi-akhir-tab" data-toggle="tab" href="#nav-populasi-akhir" role="tab" aria-controls="nav-populasi-akhir" aria-selected="false" onclick="load_component('#nav-populasi-akhir','<?=base_url('ComponentController/load_populasi_akhir') ?>')">Populasi Setelah 100 Generasi</a>
						<a class="nav-item nav-link" id="nav-grafik-tab" data-toggle="tab" href="#nav-grafik" role="tab" aria-controls="nav-grafik" aria-selected="false" onclick="load_component('#nav-grafik','<?=base_url('ComponentController/load_grafik') ?>')">Grafik</a>
						<!-- <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Tahapan</a> -->
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active tab-width" id="nav-data" role="tabpanel" aria-labelledby="nav-home-tab">

					</div>
					<div class="tab-pane fade tab-width" id="nav-input" role="tabpanel" aria-labelledby="nav-profile-tab">


					</div>
					<div class="tab-pane fade tab-width" id="nav-populasi" role="tabpanel" aria-labelledby="nav-contact-tab">

					</div>
					<div class="tab-pane fade tab-width" id="nav-evaluasi" role="tabpanel" aria-labelledby="nav-evaluasi-tab">

					</div>
					<div class="tab-pane fade tab-width" id="nav-seleksi" role="tabpanel" aria-labelledby="nav-seleksi-tab">

					</div>
					<div class="tab-pane fade tab-width" id="nav-populasi-akhir" role="tabpanel" aria-labelledby="nav-populasi-akhir-tab">
						<h6>I love You </h6>
					</div>
					<div class="tab-pane fade tab-width" id="nav-grafik" role="tabpanel" aria-labelledby="nav-grafik-tab">

					</div>
				</div>

			</div>
		</div>
	</div>
</section>
  <script type="text/javascript" src="<?= base_url('js/jquery-3.3.1.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('js/popper.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('js/chart.min.js') ?>"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
	<script type="text/javascript" src="<?=base_url('js/function.js')?>"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		load_component('#nav-data','<?=base_url('ComponentController/load_data')?>')
		load_component('#nav-input','<?=base_url('ComponentController/load_input')?>')
	});
	</script>
</body>
</html>
