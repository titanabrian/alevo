<div class="row">
  <div class="col-md-6">
    <div>
      <div class="table-responsive">
        <table class="table text-center">
          <tr>
            <td>Crossover Rate</td>
            <td>Mutation Rate</td>
          </tr>
          <tr>
            <td>
              <input type="number" id="crossover-rate" name="crossover-rate" value="<?php if($this->session->userdata('crossover_rate')){echo $this->session->userdata('crossover_rate');} ?>" placeholder="Crossover Rate">
            </td>
            <td>
              <input type="number" id="mutation-rate" name="mutation-rate" value="<?php if($this->session->userdata('mutation_rate')){echo $this->session->userdata('mutation_rate');} ?>" placeholder="Mutation Rate">
            </td>
          </tr>
          <tr>
            <th colspan="2"><h6 class="section-body">Pilih Kota Yang Ingin Anda Tuju</h6></th>
          </tr>
          <tr>
            <th>Pilih</th>
            <th>Nama Kota</th>
          </tr>
          <?php foreach ($id_kota as $value): ?>
            <tr>
              <td>
                <input type="checkbox" class="checkbox-inline" name="kota[]"
                value="<?= $value ?>"
                <?php if($checked!=false){echo $checked[$value];} ?>>
              </td>
              <td style="text-align :left !important"><?= $data[$value]['nama']?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="2">
              <button type="button" id="btn-pilih" class="btn btn-success btn-block" name="pilih" onclick="ajax_send_input()">Pilih</button>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6" id="kota-terpilih">

  </div>
</div>
<script type="text/javascript">
  load_component('#kota-terpilih',"<?=base_url('ComponentController/load_kota_terpilih')?>");
  // <?php if($this->session->userdata('kota_terpilih')): ?>
  // <?php endif; ?>
</script>
