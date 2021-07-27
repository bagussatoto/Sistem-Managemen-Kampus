<?php 
  $no = 1;
  foreach($jadwal as $d){
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->hari; ?></td>
    <td><?php echo $d->waktu; ?></td>
    <td><?php echo $d->matakuliah; ?></td>
    <td><?php echo $d->sks; ?></td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td><?php echo $d->ruangan; ?></td>
    <td>
      <a href="#" kodematkul="<?php echo $d->kode_matakuliah; ?>"  class="btn btn-mini btn-danger hapus">Hapus</a>
    </td>
  </tr>
<?php 
    $no++;
  }
?>


<script>
 
 $(function(){
    function loadjadwal()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      var kelas = $("#kelas").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadjadwal',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester,kelas:kelas},
        cache : false,
        success : function(respond)
        {
          $("#loadjadwal").html(respond);
        }
      });

    }
    $(".hapus").click(function(e){
      e.preventDefault();
      var kodematkul = $(this).attr("kodematkul");
      var tahun_akademik = $("#tahun_akademik").val();
      var kelas = $("#kelas").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/hapusjadwal',
        data : {kodematkul:kodematkul,tahun_akademik:tahun_akademik,kelas:kelas},
        cache : false,
        success : function(respond)
        {
          loadjadwal();
        }
      });
    });
 });

</script>