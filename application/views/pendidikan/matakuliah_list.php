<?php
  $no = 1;
  foreach($matkul as $d){
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->kode_matakuliah; ?></td>
    <td><?php echo $d->matakuliah; ?></td>
    <td><?php echo $d->semester; ?></td>
    <td><?php echo $d->nama_jurusan; ?></td>
    <td>
      <a href="#" data-kodematkul = "<?php echo $d->kode_matakuliah; ?>"  class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
      <a href="#" data-kodematkul = "<?php echo $d->kode_matakuliah; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
    </td>
  </tr>
<?php
    $no++;
  }
?>

<script>
  $(function(){
    function loadmatkul()
    {
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>pendidikan/getmatakuliah',
        data  : {jurusan:jurusan,semester:semester},
        cache : false,
        success : function(respond)
        {
          $("#loadmatkul").html(respond);
        }
      });
    }

    $(".hapus").click(function(e){
      e.preventDefault();
      var kodematkul = $(this).attr("data-kodematkul");
      $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/hapusmatakuliah',
          data  : {kodematkul:kodematkul},
          cache : false,
          success : function(respond)
          {
            loadmatkul();
          }
        });
    });

    $(".edit").click(function(e){
      e.preventDefault();
      var kodematkul = $(this).attr("data-kodematkul");

      //alert(kodematkul);
      $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/editmatkul',
          data  : {kodematkul:kodematkul},
          cache : false,
          success : function(respond)
          {
            $("#modalmatakuliah").modal("show");
            $("#modal-body").html(respond);
          }
        });
    });
  });

</script>