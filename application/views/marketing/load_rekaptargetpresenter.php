<table class="table  table-striped table-sm table-styling">
  <thead>
    <tr class="table-inverse">
      <th>Bulan</th>
      <th class="text-center">Target</th>
      <th class="text-center">Realisasi</th>
      <th class="text-center">%</th>
      <th class="text-right">Omset</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      $sisatarget     = 0;
      $totaltarget    = 0;
      $totalrealisasi = 0;
      $totalomset     = 0;
      foreach($rekap as $r){
        $totaltarget= $totaltarget + $r->jumlah;
        $totalrealisasi = $totalrealisasi + $r->totalregis;
        $persentase = $r->totalregis / $r->jumlah * 100;
        $totpresent = $totalrealisasi / $totaltarget * 100;
        $totalomset = $totalomset + $r->omset;
        $ta         = $r->ta_mkt;
        $bulannow   = date('m');
        $tahunnow   = date('Y');
        if($r->order<=3)
        {
          $tahun = substr($ta,0,4)-1;
        }else{
          $tahun = substr($ta,5,4)-1;
        }

        $blntgt       = date_create($tahun."-".$r->bulan);
        $bulantarget  = date_format($blntgt,"Y-m");

        $blnnow       = date_create($tahunnow."-".$bulannow);
        $bulanskrg    = date_format($blnnow,"Y-m");

        if($sisatarget !=0)
        {
          if($sisatarget < 0)
          {
            $operator = "";
          }else{
            $operator = "+";
          }
          $target = $r->jumlah + $sisatarget;
          $ket    = "(".$r->jumlah .$operator.$sisatarget.")";
        }else{
          $target = $r->jumlah;
          $ket    = "";
        }


     ?>
     <tr>
     <td><?php echo $r->nama_bulan." ".$tahun ?></td>
     <td align="center"><?php echo $target." ".$ket; ?></td>
     <td align="center"><?php echo $r->totalregis; ?></td>
     <td align="center"><?php if(!empty($persentase)){ echo round($persentase); } ?></td>
     <td align="right"><?php if(!empty($r->omset)){echo number_format($r->omset,'0','','.');  }?></td>
     <td><a href="#" class="btn btn-success btn-mini detail" data-bulan="<?php echo $r->bulan; ?>" data-ta="<?php echo $r->ta_mkt;  ?>"
       data-presenter="<?php echo $r->kode_presenter; ?>">Detail</a>
     </td>
    </tr>
     <?php
       if($bulanskrg > $bulantarget){
         // $cek = "LEWAT";
         $sisatarget = $target-$r->totalregis;
       }else{
         // $cek ="BELUM LEWAT";
         $sisatarget = 0;
       }
      $no++;
      }
    ?>
  </tbody>
  <thead>
    <tr class="table-inverse">
      <th>TOTAL</th>
      <th class="text-center"><?php if(!empty($totaltarget)){echo number_format($totaltarget,'0','','.');  }?></th>
      <th class="text-center"><?php if(!empty($totalrealisasi)){echo number_format($totalrealisasi,'0','','.');  }?></th>
      <th class="text-center"><?php if(!empty($totpresent)){echo number_format($totpresent,'0','','.');  }?></th>
      <th class="text-right"><?php if(!empty($totaltarget)){echo number_format($totalomset,'0','','.');  }?></th>
      <th></th>
    </tr>
  </thead>
</table>

<script type="text/javascript">
  $(function(){
    $('.detail').click(function(e){
      e.preventDefault();
      var bulan     = $(this).attr("data-bulan");
      var ta        = $(this).attr("data-ta");
      var presenter = $(this).attr("data-presenter");
      //alert(presenter);
      $.ajax({
        url    : '<?php echo base_url(); ?>marketing/listtargetregister',
        type   : 'POST',
        data   : {bulan:bulan,ta:ta,presenter:presenter},
        cache  : false,
        success : function(respond)
        {
          $("#modaltarget").modal("show");
          $("#loadmodaltarget").html(respond);
        }
      });
    });
  });
</script>
