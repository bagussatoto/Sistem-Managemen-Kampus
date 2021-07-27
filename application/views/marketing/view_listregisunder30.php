<div class="modal-body">
  <div class="table table-responsive">
  <table class="table  table-striped table-sm table-styling" id="mytable">
    <thead>
      <tr class="table-inverse">
        <th>#</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Jurusan</th>
        <th>Kelas</th>
        <th>Harga Deal</th>
        <th>30%</th>
        <th>Terbayar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        foreach($under30 as $d){

       ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d->nim; ?></td>
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->nama_jurusan; ?></td>
          <td><?php echo $d->kelas; ?></td>
          <td><?php echo number_format($d->harga_deal,'0','','.'); ?></td>
          <td><?php echo number_format($d->tigapuluhpersen,'0','','.'); ?></td>
          <td><?php echo number_format($d->realisasi,'0','','.'); ?></td>
        </tr>
      <?php $no++; } ?>
    </tbody>
  </tr>
  </div>
</div>

<script type="text/javascript">
  $(function(){
    $("#mytable").DataTable();
  });
</script>
