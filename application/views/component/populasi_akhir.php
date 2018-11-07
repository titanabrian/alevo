<div class="row">
	<div class="col-md-6">
		<h4 class="">Hasil Populasi Setelah 100 Generasi</h4>
<h5 class="">Jumlah kromosom pada populasi, yaitu 6</h5>
		<?php if($evaluasi!= false){ ?>
			<div class="table-responsive">
			  <table class="table table-striped text-center">
			    <thead>
			      <tr>
			        <th rowspan="2">No</th>
			        <th rowspan="2">Nama Kromosom</th>
			        <th rowspan="2">Jumlah Jarak</th>
			      </tr>
			    </thead>
			    <tbody>
			        <?php foreach ($populasi as $key => $value): ?>
			          <tr>
			            <td><?=$key+1?></td>
			            <td><?="Offspring".($key+1) ?></td>
			            <td><?= $evaluasi[$key] ?></td>
			          </tr>
			        <?php endforeach; ?>
			      </tbody>
			  </table>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger">
			  Maaf Data tidak ditemukan, pastikan anda memilih kota
			</div>

<?php } ?>

</div>
	<div class="col-md-6">
		<h4 class="">Fitness Populasi Terakhir</h4>
<h5 class="">Jumlah kromosom pada populasi, yaitu 6</h5>
		<?php if($fitness != false){ ?>
			<div class="table-responsive">
			  <table class="table table-striped text-center">
			    <thead>
			      <tr>
			        <th rowspan="2">No</th>
			        <th rowspan="2">Nama Kromosom</th>
			        <th rowspan="2">Nilai Fitness</th>
			      </tr>
			    </thead>
			    <tbody>
			        <?php foreach ($populasi as $key => $value): ?>
			          <tr>
			            <td><?=$key+1?></td>
			            <td><?="offspring".($key+1) ?></td>
			            <td><?= $fitness['fitness'][$key] ?></td>
			          </tr>
			        <?php endforeach; ?>
							<tr>
								<td colspan="2">Jumlah</td>
								<td><?=$fitness['jumlah']?></td>
							</tr>
			      </tbody>
			  </table>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger">
			  Maaf Data tidak ditemukan, pastikan anda memilih kota
			</div>

<?php } ?>

<?php
$i = 0;
$index = 0;
foreach ($this->session->userdata('fitness_akhir')['fitness'] as $key => $value) {
  // code...
  if ($value >= $i ) {
    // code...
    $index = $key;
    $i = $value;
  }
}
?>
	</div>
  <?php if($populasi!=false){ ?>
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th colspan="<?= sizeof($kota_terpilih) + 1 ?>">Jalur Solusi Berdasarkan Algoritma Genetika</th>
          </tr>
          <tr>
            <td rowspan="2">Offspring <?= $index+1 ?></th>
              <?php foreach ($populasi[$index] as $key => $value): ?>
                <td><?= $value ?></td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <?php foreach ($populasi[$index] as $key => $value): ?>
                <td><?= $data[$value]['nama'] ?></td>
              <?php endforeach; ?>
            </tr>
          </table>
      </div>
    </div>
  <?php } ?>
</div>
