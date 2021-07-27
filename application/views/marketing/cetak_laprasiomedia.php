<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>A4</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/paper.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tabel.css">
  <style>@page { size: A4 }</style>
</head>
<body class="A4" style="font-size:11px">
  <section class="sheet padding-10mm" style="font-family:Tahoma">
    <center>
      <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="">
      <br>
      <p style="font-size:16px; font-weight:bold">
        CABANG TASIKMALAYA
        <br>
        DATA RASIO MEDIA
        <?php
          if(empty($dari) AND empty($sampai)){
            echo "GELOMBANG 1 s/d GELOMBANG TERAKHIR";
          }else{
            echo "PERIODE ".DateToIndo2($dari)." s/d ".DateToIndo2($sampai);
          }
         ?>
        <br>
        PENERIMAAN MAHASISWA BARU TAHUN AKADEMIK <?php echo $ta; ?>
      </p>
      <table  width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>No</th>
          <th>MEDIA INFORMASI</th>
          <th>APLIKAN</th>
          <th>RASIO MEDIA</th>
        </tr>
        <?php
          $no = 1;
          $grandtot_aplikandatang       = 0;
          foreach($apgel as $a){

            $grandtot_aplikandatang       = $grandtot_aplikandatang + $a->jml_aplikandatang;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $a->sumber_informasi;?></td>
            <td align="center"><?php echo $a->jml_aplikandatang;?></td>
            <td align="center">
              <?php
                if(!empty($a->jml_aplikandatang)){
                  $rasio = round($a->jml_aplikandatang/$allcount*100);
                }else{
                  $rasio = 0;
                }
                echo $rasio;
              ?>%
            </td>
          </tr>
        <?php
            $no++;
          }
        ?>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <td colspan="2">TOTAL</td>
          <td align="center"><?php if(!empty($grandtot_aplikandatang)){ echo $grandtot_aplikandatang;}?></td>
          <td align="center">
            <?php
              if(!empty($grandtot_aplikandatang)){
                $totalrasio = round($grandtot_aplikandatang/$allcount*100);
              }else{
                $totalrasio = 0;
              }
              echo $totalrasio;
            ?>%
          </td>

        </tr>
      </table>
      <hr>
      <table  width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>No</th>
          <th>MEDIA INFORMASI</th>
          <th>REGISTRASI</th>
          <th>RASIO MEDIA</th>
        </tr>
        <?php
          $no = 1;
          $grandtot_aplikanreg       = 0;
          foreach($apreg as $a){

            $grandtot_aplikanreg = $grandtot_aplikanreg + $a->jml_aplikanregis;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $a->sumber_informasi;?></td>
            <td align="center"><?php echo $a->jml_aplikanregis;?></td>
            <td align="center">
              <?php
                if(!empty($a->jml_aplikanregis)){
                  $rasio = round($a->jml_aplikanregis/$allcount2*100);
                }else{
                  $rasio = 0;
                }
                echo $rasio;
              ?>%
            </td>
          </tr>
        <?php
            $no++;
          }
        ?>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <td colspan="2">TOTAL</td>
          <td align="center"><?php if(!empty($grandtot_aplikanreg)){ echo $grandtot_aplikanreg;}?></td>
          <td align="center">
            <?php
              if(!empty($grandtot_aplikanreg)){
                $totalrasio = round($grandtot_aplikanreg/$allcount2*100);
              }else{
                $totalrasio = 0;
              }
              echo $totalrasio;
            ?>%
          </td>

        </tr>
      </table>
    </center>
    <p>
      <table width="100%">
        <tr>
          <td>Tasikmalaya, <?php echo DateToIndo2(date('Y-m-d')); ?><br>Dibuat Oleh,</td>
          <td><br>Disetujui Oleh,</td>
        </tr>
        <tr>
          <td style="height:200px"><b><?php echo $conf['ho_mkt']; ?></b><br><i>Head Of Marketing </i></td>
          <td style="height:200px"><b><?php echo $conf['branch_manager']; ?></b><br><i>Branch Manager</i></td>
        </tr>
      </table>
    </p>
  </section>
</body>
</html>
