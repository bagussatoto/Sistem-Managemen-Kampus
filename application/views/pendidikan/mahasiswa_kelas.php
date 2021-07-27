<?php 
  $no = 1;
  foreach($mhs as $d){
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->nim; ?></td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td><?php echo $d->kelas; ?></td>
    <td><?php echo $d->no_hp; ?></td>
    <td>
      <a href="#" koderegis="<?php echo $d->kode_registrasi; ?>" class="btn btn-mini btn-info pindahkan">Pindahkan</a>
    </td>
  </tr>
<?php 
    $no++;
  }
?>


<script>
  $(function(){
    function loadmhs()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var tingkat = $("#tingkat").val();
      var kelaslama = $("#kelaslama").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadkelasmhs',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,tingkat:tingkat,kelaslama:kelaslama},
        cache : false,
        success : function(respond)
        {
          $("#loadmhs").html(respond);
        }
      });

    }

    $(".pindahkan").click(function(e){
      e.preventDefault();
      var koderegis = $(this).attr("koderegis");
      var kelasbaru = $("#kelasbaru").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/updatekelasbaru',
        data : {koderegis:koderegis,kelasbaru:kelasbaru},
        cache : false,
        success : function(respond)
        {
          loadmhs();  
        }
      });
    });
  });

</script>