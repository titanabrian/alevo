<div class="table-responsive">
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th rowspan="2">Id</th>
        <th rowspan="2">Nama Kota</th>
        <th colspan="10">Jarak Kota</th>
      </tr>
      <tr>
        <?php foreach($id_kota as $idk){ ?>
          <th><?=$idk?></th>
        <?php } ?>
      </tr>
    </thead>
      <tbody>
        <?php $i=1; foreach ($data as $key => $value): ?>
          <tr>
            <td><?=$key?></td>
            <td><?=$value['nama']?></td>
            <?php foreach ($id_kota as $idk): ?>
              <td><?= $value['jarak'][$idk] ?></td>
            <?php endforeach; ?>
          </tr>
        <?php $i++;; endforeach; ?>
      </tbody>
  </table>
</div>
