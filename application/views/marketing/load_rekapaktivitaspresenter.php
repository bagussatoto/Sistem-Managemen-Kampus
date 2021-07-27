<table class="table  table-striped table-sm table-styling">
  <thead>
    <tr class="table-inverse">
      <th>#</th>
      <th>Nama Presenter</th>
      <th>Teleselling</th>
      <th>Hunting</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      foreach($result as $r){
     ?>
     <tr>
     <td><?php echo $no; ?></td>
     <td><?php echo $r->nama_presenter; ?></td>
     <td align="center">
       <a href="#" class="btn btn-mini btn-success teleselling" data-presenter="<?php echo $r->kode_presenter; ?>" data-status="1">
        <?php echo number_format($r->teleselling,'0','','.'); ?></a>
       <a/>
     </td>
     <td align="center">
       <a href="#" class="btn btn-mini btn-warning hunting" data-presenter="<?php echo $r->kode_presenter; ?>" data-status="2">
        <?php echo number_format($r->hunting,'0','','.'); ?></a>
       <a/>
     </td>
    </tr>
     <?php
      $no++;
      }
    ?>
  </tbody>
</table>

<script type="text/javascript">
  $(function(){
    $('.teleselling').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-presenter");
      var kodeact  = "K2002";
      var dari     = $("#dari").val();
      var sampai   = $("#sampai").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/detailrekapaktivitas',
        data    : {kode:kode,kodeact:kodeact,dari:dari,sampai:sampai},
        cache   : false,
        success : function(respond){
          $("#loadformedit").html(respond);
          $("#modaledit").modal("show");
          console.log(respond);
        }
      });

    });
  });
</script>
