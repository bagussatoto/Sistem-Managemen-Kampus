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
<body class="A4  landscape" style="font-size:11px">
  <section class="sheet padding-10mm" style="font-family:Tahoma">
    <center>
      <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="">
      <br>
      <p style="font-size:16px; font-weight:bold">
        CABANG TASIKMALAYA
        <br>
        DATA RASIO PRESENTER
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
          <th rowspan="2">No</th>
          <th rowspan="2">NAMA PRESENTER</th>
          <th colspan="3">APLIKAN</th>
          <th colspan="3">RASIO PRESENTER</th>
        </tr>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>DATANG</th>
          <th>DAFTAR</th>
          <th>REGISTRASI</th>
          <th>DAFTAR</th>
          <th>REGISTRASI</th>
        </tr>

        <?php
          $no = 1;
          $grandtot_aplikandatang       = 0;
          $grandtot_aplikandaftar       = 0;
          $grandtot_aplikanregis        = 0;
          foreach($apgel as $a){
            $totalaplikandatang = $a->jml_aplikandatang;
            $totalaplikandaftar = $a->jml_aplikandaftar;

            $grandtot_aplikandatang       = $grandtot_aplikandatang + $a->jml_aplikandatang;
            $grandtot_aplikandaftar       = $grandtot_aplikandaftar + $a->jml_aplikandaftar;
            $grandtot_aplikanregis        = $grandtot_aplikanregis + $a->jml_aplikanregisjunior;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $a->nama_presenter;?></td>
            <td align="center"><?php echo $a->jml_aplikandatang;?></td>
            <td align="center"><?php if(!empty($a->jml_aplikandaftar)){ echo $a->jml_aplikandaftar;}?></td>
            <td align="center"><?php if(!empty($a->jml_aplikanregisjunior)){ echo $a->jml_aplikanregisjunior;}?></td>
            <td align="center">
              <?php
                if(!empty($a->jml_aplikandatang)){
                  $rasiodaftar = round($a->jml_aplikandaftar/$a->jml_aplikandatang*100);
                }else{
                  $rasiodaftar = 0;
                }
                echo $rasiodaftar;
              ?>%
            </td>
            <td align="center">
              <?php
                if(!empty($a->jml_aplikandatang)){
                  $rasioregis = round($a->jml_aplikanregisjunior/$a->jml_aplikandatang*100);
                }else{
                  $rasioregis = 0;
                }
                echo $rasioregis;
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
          <td align="center"><?php if(!empty($grandtot_aplikandaftar)){ echo $grandtot_aplikandaftar;}?></td>
          <td align="center"><?php if(!empty($grandtot_aplikanregis)){ echo $grandtot_aplikanregis;}?></td>
          <td align="center">
            <?php
              if(!empty($grandtot_aplikandatang)){
                $totalrasiodaftar = round($grandtot_aplikandaftar/$grandtot_aplikandatang*100);
              }else{
                $totalrasiodaftar = 0;
              }
              echo $totalrasiodaftar;
            ?>%
          </td>
          <td></td>
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
