<?php 
  $no = 1;
  foreach($matkul as $d){
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->kode_matakuliah; ?></td>
    <td><?php echo $d->matakuliah; ?></td>
    <td><?php echo $d->semester; ?></td>
    <td>
      <a href="#" kodematkul="<?php echo $d->kode_matakuliah; ?>" class="btn btn-mini btn-success pilih">Pilih</a>
    </td>
  </tr>
<?php 
    $no++;
  }
?>


<script>
  $(function(e){

    function loadmatkul()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadmatkul',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester},
        cache : false,
        success : function(respond)
        {
          $("#loadmatkul").html(respond);
        }
      });

    }

    function loadmatkulaktif()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadmatkulaktif',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester},
        cache : false,
        success : function(respond)
        {
          $("#loadmatkulaktif").html(respond);
        }
      });

    }
    $(".pilih").click(function(e){
      e.preventDefault();
      var kodematkul = $(this).attr("kodematkul");
      var tahun_akademik = $("#tahun_akademik").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/insertkonfmatkul',
        data : {kodematkul:kodematkul,tahun_akademik:tahun_akademik},
        cache : false,
        success : function(respond)
        {
          loadmatkul();  
          loadmatkulaktif();
        }
      });
    });
  });


</script>