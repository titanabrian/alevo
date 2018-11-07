<h4 class="">Populasi Inisialisasi</h4>
<h5 class="">Jumlah kromosom pada populasi, yaitu 6</h5>

<?php if($populasi != false){ ?>
<div class="table-responsive">
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama Kromosom</th>
        <th colspan="<?= sizeof($kota_terpilih) ?>">Index Gen</th>
      </tr>
      <tr>
        <?php foreach ($kota_terpilih as $key => $value) { ?>
          <th><?=$key?></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($populasi as $key => $value): ?>
          <tr>
            <td><?=$key+1?></td>
            <td><?="kromosom".($key+1) ?></td>
            <?php foreach ($value as $kota): ?>
              <td><?=$kota?></td>
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
