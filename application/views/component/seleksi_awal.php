<h4 class="">Parent Inisialisasi</h4>
<h5 class="">Jumlah Parent pada populasi, yaitu 6</h5>

<?php if($parent != false){ ?>
<div class="table-responsive">
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama Parent</th>
        <th colspan="<?= sizeof($kota_terpilih) ?>">Index Gen</th>
      </tr>
      <tr>
        <?php foreach ($kota_terpilih as $key => $value) { ?>
          <th><?=$key?></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php   $i =1 ;  ?>
        <?php foreach ($parent as $key => $isi): ?>
          <?php  foreach ($isi as $key_isi => $value): ?>
          <tr>
            <td><?=$i?></td>
            <td><?="kromosom".($value+1) ?></td>
            <?php foreach ($populasi[$value] as $kota): ?>
              <td><?=$kota?></td>
            <?php endforeach; ?>
          </tr>
          <?php   $i++; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>

        <?php foreach ($crossover as $key => $value): ?>
          <tr>
            <td><?= $key+1 ?></td>
            <td><?= "c".($key+1)  ?></td>
            <?php foreach ($value as $key_value => $value_value): ?>
              <td><?= $value_value  ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>

        <?php foreach ($mutation as $key => $value): ?>
          <tr>
            <td><?= $key+1 ?></td>
            <td><?= "m".($key+1)  ?></td>
            <?php foreach ($value as $key_value => $value_value): ?>
              <td><?= $value_value  ?></td>
            <?php endforeach; ?>
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
