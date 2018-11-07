

<div class="row">
	<div class="col-md-6">
		<h4 class="">Evaluasi Inisialisasi</h4>
<h5 class="">Jumlah kromosom pada populasi, yaitu 6</h5>

		<?php if($evaluasi != false){ ?>
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
			            <td><?="kromosom".($key+1) ?></td>
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
		<h4 class="">Fitness Inisialisasi</h4>
<h5 class="">Jumlah kromosom pada populasi, yaitu 6</h5>

		<?php if($fitness != false){ ?>
			<div class="table-responsive">
			  <table class="table table-striped text-center">
			    <thead>
			      <tr>
			        <th rowspan="2">No</th>
			        <th rowspan="2">Nama Kromosom</th>
			        <th rowspan="2">Nilai Fitness</th>
			        <th rowspan="2">Probabilitas</th>
			        <th rowspan="2">Probabilitas Kumulatif</th>
			      </tr>
			    </thead>
			    <tbody>
			        <?php foreach ($populasi as $key => $value): ?>
			          <tr>
			            <td><?=$key+1?></td>
			            <td><?="kromosom".($key+1) ?></td>
			            <td><?= $fitness['fitness'][$key] ?></td>
			            <td><?= $data_wheel['probabilitas'][$key]	 ?></td>
			            <td><?= $data_wheel['probabilitas_kumulatif'][$key]	 ?>	</td>
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

	</div>
</div>
