<div class="table-responsive">
  <table class="table  table-striped table-sm table-styling" id="tabelstatus" style="width:100%">
    <thead>
      <tr class="table-inverse">
        <td>No</td>
        <th>Nama Siswa</th>
        <th>Asal Sekolah</th>
        <th>Keterangan</th>
        <th>Last Followup</th>
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
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->asal_sekolah; ?></td>
          <td><?php echo $d->keterangan; ?></td>
          <td><?php echo $d->tgl_act; ?></td>
        </tr>
      <?php
          $no++;
        }
      ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(function(){
    $("#tabelstatus").dataTable();
  });
</script>
