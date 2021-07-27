<table class="table table-striped table-sm table-styling">
  <thead>
    <tr class="table-inverse">
      <th>#</th>
      <th>Nama Presenter</th>
      <th>Database</th>
      <th>Hot Prospek</th>
      <th>Prospek</th>
      <th>Belum Prospek</th>
      <th>Batal</th>
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
         <a href="#" class="btn btn-mini btn-primary database" data-presenter="<?php echo $r->kode_presenter; ?>">
          <?php echo number_format($r->jmldata,'0','','.'); ?></a>
         <a/>
       </td>
       <td align="center">
         <a href="#" class="btn btn-mini btn-success hotprospek" data-presenter="<?php echo $r->kode_presenter; ?>" data-status="1">
          <?php echo number_format($r->hotprospek,'0','','.'); ?></a>
         <a/>
       </td>
       <td align="center">
         <a href="#" class="btn btn-mini btn-warning prospek" data-presenter="<?php echo $r->kode_presenter; ?>" data-status="2">
          <?php echo number_format($r->prospek,'0','','.'); ?></a>
         <a/>
       </td>
       <td align="center">
         <a href="#" class="btn btn-mini btn-inverse belumprospek" data-presenter="<?php echo $r->kode_presenter; ?>" data-status="3">
          <?php echo number_format($r->belumprospek,'0','','.'); ?></a>
         <a/>
       </td>
       <td align="center">
         <a href="#" class="btn btn-mini btn-danger batal" data-presenter="<?php echo $r->kode_presenter; ?>" data-status="4">
          <?php echo number_format($r->batal,'0','','.'); ?></a>
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
    $('.hotprospek').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-presenter");
      var status   = $(this).attr("data-status");
      var ta       = $(".tahunakademik").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/rekapdetailstatusaktivitas',
        data    : {kode:kode,status:status,ta:ta},
        cache   : false,
        success : function(respond){
          $("#loadformedit").html(respond);
          $("#modaledit").modal("show");
          console.log(respond);
        }
      });
    });

    $('.prospek').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-presenter");
      var status   = $(this).attr("data-status");
      var ta       = $(".tahunakademik").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/rekapdetailstatusaktivitas',
        data    : {kode:kode,status:status,ta:ta},
        cache   : false,
        success : function(respond){
          $("#loadformedit").html(respond);
          $("#modaledit").modal("show");
          console.log(respond);
        }
      });
    });

    $('.belumprospek').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-presenter");
      var status   = $(this).attr("data-status");
      var ta       = $(".tahunakademik").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/rekapdetailstatusaktivitas',
        data    : {kode:kode,status:status,ta:ta},
        cache   : false,
        success : function(respond){
          $("#loadformedit").html(respond);
          $("#modaledit").modal("show");
          console.log(respond);
        }
      });
    });

    $('.batal').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-presenter");
      var status   = $(this).attr("data-status");
      var ta       = $(".tahunakademik").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/rekapdetailstatusaktivitas',
        data    : {kode:kode,status:status,ta:ta},
        cache   : false,
        success : function(respond){
          $("#loadformedit").html(respond);
          $("#modaledit").modal("show");
          console.log(respond);
        }
      });
    });

    $("#tabelrekapstatus").dataTable();



  });
</script>
