<div class="table-responsive">
  <table class="table  table-striped table-sm table-styling">
    <tr>
      <td><b>Nama Presenter</b></td>
      <td>:</td>
      <td>
        <input type="hidden" name="presenter" value="<?php echo $target['kode_presenter']; ?>">
        <?php echo $target['nama_presenter']; ?>
      </td>
    </tr>
    <tr>
      <td><b>Target</b></td>
      <td>:</td>
      <td>
        <input type="hidden" name="target" value="<?php echo $target['kode_target']; ?>">
        <?php echo $target['nama_target']; ?>
      </td>
    </tr>
    <tr>
      <td><b>Tahun Akademik</b></td>
      <td>:</td>
      <td>
        <?php echo $target['ta_mkt']; ?>
      </td>
    </tr>
  </table>
</div>
</div>
<div class="col-md-12">
<div class="table-responsive">
  <table class="table  table-striped table-sm table-styling">
    <thead>
      <tr class="table-inverse">
        <th>Bulan</th>
        <th style="width:200px">Target</th>
      </tr>
    </thead>
    <tbody>
      <?php $total = 0; $no = 1; foreach($detail as $d){  $total=$total+$d->jumlah; ?>
        <tr>
          <td>
            <input type="hidden" name="kode<?php echo $no; ?>" value="<?php echo $d->kode_targetpresenter; ?>">
            <input type="hidden" name="bulan<?php echo $no; ?>" value="<?php echo $d->id_bulan; ?>">
            <?php echo $d->nama_bulan; ?>
          </td>
          <td align="center">
              <?php echo $d->jumlah; ?>
          </td>
        </tr>
      <?php $no++; $jum = $no-1;  } ?>
    </tbody>
    <tfoot>
      <tr class="table-inverse">
        <th>TOTAL</th>
        <th style="text-align:center"><?php echo $total; ?></td>
      </tr>
    </tfoot>
  </table>
</div>
