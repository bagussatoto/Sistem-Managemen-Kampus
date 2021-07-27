<div class="table-responsive">
  <table class="table  table-striped table-sm table-styling" id="tabelsiswa">
    <thead>
      <tr class="table-inverse">
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>No HP</th>
        <th>Asal sekolah</th>
        <th>Omset</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $totalomset = 0;
        foreach($list as $d){
          $totalomset += $d->harga_deal;
      ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->no_hp; ?></td>
          <td><?php echo $d->no_hp; ?></td>
          <td align="right"><?php echo number_format($d->harga_deal,'0','','.'); ?></td>
        </tr>
      <?php
          $no++;
        }
      ?>
    </tbody>
    <thead>
      <tr class="table-inverse">
        <th colspan="4">TOTAL</th>
        <th class="text-right"><?php echo number_format($totalomset,'0','','.'); ?></th>
      </tr>
    </thead>
  </table>
</div>
