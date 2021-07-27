<div class="table-responsive">
  <table class="table  table-striped table-sm table-styling" id="tabelstatus" style="width:100%">
    <thead>
      <tr class="table-inverse">
        <td>No</td>
        <th>Tanggal</th>
        <th>Nama Siswa</th>
        <th>Aktivitas</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        foreach($detail as $d)
        {
      ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d->tgl_act; ?></td>
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->nama_aktivitas; ?></td>
          <td><?php echo $d->keterangan; ?></td>
        </tr>
      <?php
          $no++;
        }
      ?>
    </tbody>
  </table>
</div>
