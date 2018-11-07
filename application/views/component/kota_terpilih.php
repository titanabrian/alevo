<div class="table-responsive">
  <table class="table text-center">
      <?php if($kota_terpilih != false){ ?>
          <tr>
            <td>Anda memilih kota sebagai berikut</td>
            <td>
              <ol>
                <?php foreach ( $kota_terpilih as $value ): ?>
                  <li><?=$data[$value]['nama']?></li>
                <?php endforeach; ?>
              </ol>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <button type="button" id="btn-reset" class="btn btn-danger" name="button" onclick="ajax_reset_input()">Reset</button>
            </td>
          </tr>
        <?php }else{ ?>
          <tr>
            <td>
              <div class="alert alert-danger">
                Maaf Data tidak ditemukan, pastikan anda memilih kota
              </div>
            </td>
          </tr>
        <?php } ?>
  </table>
</div>
