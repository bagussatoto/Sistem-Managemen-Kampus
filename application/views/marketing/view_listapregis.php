<div class="modal-body">
  <div class="table table-responsive">
  <table class="table  table-striped table-sm table-styling" id="mytableregis">
    <thead>
      <tr class="table-inverse">
        <th>#</th>
        <th>Nama Mahasiswa</th>
        <th>Jurusan</th>
        <th>Asal Sekolah</th>
        <th>Tgl Registrasi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        foreach($apregis as $d){

       ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->nama_jurusan; ?></td>
          <td><?php echo $d->asal_sekolah; ?></td>
          <td><?php echo $d->tgl_registrasi; ?></td>
        </tr>
      <?php $no++; } ?>
    </tbody>
  </table>
  </div>
</div>

<script type="text/javascript">
  $(function(){
    $("#mytableregis").DataTable();
  });
</script>
