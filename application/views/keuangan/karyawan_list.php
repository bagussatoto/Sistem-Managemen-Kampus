<div class="modal-body">
  <div class="table table-responsive">
  <table class="table  table-striped table-sm table-styling" id="mytableregis">
    <thead>
      <tr class="table-inverse">
        <th>#</th>
        <th>Nama Karyawan</th>
        <th>Divisi</th>
        <th>Jabatan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        foreach($karyawan as $d){

       ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d->nama_karyawan; ?></td>
          <td><?php echo $d->kode_divisi; ?></td>
          <td><?php echo $d->jabatan; ?></td>
          <td><a href="#" data-nik ="<?php echo $d->nik; ?>" data-nama="<?php echo $d->nama_karyawan; ?>" data-jabatan="<?php echo $d->jabatan; ?>"  data-divisi="<?php echo $d->kode_divisi; ?>"
          data-tglbergabung ="<?php echo $d->tgl_bergabung; ?>"
           class="btn btn-success btn-mini pilih">Pilih</a></td>
        </tr>
      <?php $no++; } ?>
    </tbody>
  </table>
  </div>
</div>

<script type="text/javascript">
  $(function(){
    //$("#mytableregis").DataTable();

    $(".pilih").click(function(){
      var nik = $(this).attr("data-nik");
      var nama = $(this).attr("data-nama");
      var jabatan = $(this).attr("data-jabatan");
      var divisi = $(this).attr("data-divisi");
      var tglbergabung = $(this).attr("data-tglbergabung");
      $("#nik").val(nik);
      $("#namakaryawan").val(nama);
      $("#jabatan").val(jabatan);
      $("#divisi").val(divisi);
      $("#tglbergabung").val(tglbergabung);
      $("#modalkaryawan").modal("hide");    
      
    });
  });
</script>
