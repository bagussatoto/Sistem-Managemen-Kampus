<?php
  $no = 1;

  foreach($cetak0 as $d){
?>
  <tr>
    <td><?php echo $d->nim; ?></td>
    <td><?php echo $d->va; ?></td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td><?php echo $d->no_hp; ?></td>
    <td><?php echo $d->expiredate; ?></td>
    <td align="right"><?php echo number_format($d->tagihan,'0','','.'); ?></td>
    <td>
      <a href="#" data-va="<?php echo $d->va; ?>" class="btn btn-mini btn-info inquiry">Inquiry</a>
      <a href="#" data-kodereg="<?php echo $d->kode_registrasi; ?>" class="btn btn-mini btn-success edit"><i class="fa fa-edit"></i></a>
      <a href="<?php echo base_url(); ?>keuangan/hapusva/<?php echo $d->va; ?>" class="btn btn-mini btn-danger hapus"><i class="fa fa-trash-o"></i></a>
    </td>
  </tr>
<?php
  $no++;
}
?>


<script type="text/javascript">
  $(function(){
    $(".inquiry").click(function(e){
      e.preventDefault();
      var va = $(this).attr("data-va");
      $.ajax({
        type   : 'POST',
        url    : '<?php echo base_url(); ?>keuangan/inqva',
        data   : {va:va},
        cache  : false,
        success: function(respond)
        {
          $("#loadinquiry").html(respond);
          $("#modalinquiry").modal("show");
        }

      });
    });

    $(".edit").click(function(e){
      e.preventDefault();
      var kodereg = $(this).attr("data-kodereg");
      $.ajax({
        type   : 'POST',
        url    : '<?php echo base_url(); ?>keuangan/editva',
        data   : {kodereg:kodereg},
        cache  : false,
        success: function(respond)
        {
          $("#loadeditva").html(respond);
          $("#modaleditva").modal("show");
        }

      });
    });

    $('.hapus').on('click',function(){
        var getLink = $(this).attr('href');
        swal({
              title             : 'Alert',
              text              : 'Hapus Data?',
              html              : true,
              confirmButtonColor: '#d43737',
              showCancelButton  : true,
              },function(){
              window.location.href = getLink
            });
        return false;
    });
  });
</script>
