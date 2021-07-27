<?php
  $no = 1;
  foreach($kelas as $d){
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->namakelas; ?></td>
    <td><?php echo $d->nama_jurusan; ?></td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td>
      <a href="#" data-kodekelas = "<?php echo $d->kodekelas; ?>"  class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
      <a href="#" data-kodekelas = "<?php echo $d->kodekelas; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
    </td>
  </tr>
<?php
    $no++;
  }
?>

<script>
  $(function(){
    function loadkelas()
    {
      var tahun_angkatan = $(".tahun_angkatan").val();
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>pendidikan/getkelas',
        data  : {tahun_angkatan:tahun_angkatan},
        cache : false,
        success : function(respond)
        {
          $("#loadkelas").html(respond);
        }
      });
    }
    $(".hapus").click(function(e){
      e.preventDefault();
      var kodekelas = $(this).attr("data-kodekelas");
      $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/hapuskelas',
          data  : {kodekelas:kodekelas},
          cache : false,
          success : function(respond)
          {
            loadkelas();
          }
        });
    });

    $(".edit").click(function(e){
      e.preventDefault();
      var kodekelas = $(this).attr("data-kodekelas");
      $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/editkelas',
          data  : {kodekelas:kodekelas},
          cache : false,
          success : function(respond)
          {
            $("#modalkelas").modal("show");
            $("#modal-body").html(respond);
          }
        });
    });
  });

</script>