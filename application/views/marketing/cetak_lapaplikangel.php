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
        DATA APLIKAN
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
          <th rowspan="3">No</th>
          <th rowspan="3">Nama Jurusan</th>
          <th rowspan="2" colspan="3">Aplikan</th>
          <th rowspan="2" colspan="3">Daftar</th>
          <th rowspan="3">Ujian</th>
          <th rowspan="3">Lulus</th>
          <th colspan="5">Registrasi</th>
        </tr>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th colspan="3">Junior</th>
          <th rowspan="2">Senior</th>
          <th rowspan="2">Total</th>
        </tr>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>DTG</th>
          <th>ONL</th>
          <th>TOTAL</th>
          <th>DTG</th>
          <th>ONL</th>
          <th>TOTAL</th>
          <th>DTG</th>
          <th>ONL</th>
          <th>TOTAL</th>
        </tr>
        <?php
          $no = 1;
          $grandtot_aplikandatang       = 0;
          $grandtot_aplikanonline       = 0;
          $grandtot_aplikandaftar       = 0;
          $grandtot_aplikandaftaronline = 0;
          $grandtot_ujian               = 0;
          $grandtot_lulus               = 0;
          $grandtotall_datang           = 0;
          $grandtotall_daftar           = 0;
          $grandtotall_regisjuniordtg   = 0;
          $grandtotall_regisjuniorol    = 0;
          $grandtotall_regissenior      = 0;
          $grandtotall_regisjunior      = 0;
          $grandtotall_regis            = 0;
          foreach($apgel as $a){
            $totalaplikandatang = $a->jml_aplikandatang + $a->jml_aplikanonline;
            $totalaplikandaftar = $a->jml_aplikandaftar + $a->jml_aplikandaftaronline;
            $totalregisjunior  = $a->jml_regisjunior + $a->jml_regisjunioronline;
            $totalregissenior  =  $a->jml_regissenior;
            $totalregis        = $totalregisjunior + $totalregissenior;
            $grandtot_aplikandatang       = $grandtot_aplikandatang + $a->jml_aplikandatang;
            $grandtot_aplikanonline       = $grandtot_aplikanonline + $a->jml_aplikanonline;
            $grandtot_aplikandaftar       = $grandtot_aplikandaftar + $a->jml_aplikandaftar;
            $grandtot_aplikandaftaronline = $grandtot_aplikandaftaronline + $a->jml_aplikandaftaronline;
            $grandtot_ujian               = $grandtot_ujian + $a->jml_ujian;
            $grandtot_lulus               = $grandtot_lulus + $a->jml_lulus;
            $grandtotall_datang           = $grandtotall_datang + $totalaplikandatang;
            $grandtotall_daftar           = $grandtotall_daftar + $totalaplikandaftar;
            $grandtotall_regisjuniordtg   = $grandtotall_regisjuniordtg + $a->jml_regisjunior;
            $grandtotall_regisjuniorol    = $grandtotall_regisjuniorol + $a->jml_regisjunioronline;
            $grandtotall_regissenior      = $grandtotall_regissenior + $a->jml_regissenior;
            $grandtotall_regisjunior      = $grandtotall_regisjunior + $totalregisjunior;
            $grandtotall_regis            = $grandtotall_regis + $totalregis;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $a->nama_jurusan;?></td>
            <td align="center"><?php echo $a->jml_aplikandatang;?></td>
            <td align="center"><?php if(!empty($a->jml_aplikanonline)){ echo $a->jml_aplikanonline;}?></td>
            <td align="center"><?php if(!empty($totalaplikandatang)){ echo $totalaplikandatang;}?></td>
            <td align="center"><?php if(!empty($a->jml_aplikandaftar)){ echo $a->jml_aplikandaftar;}?></td>
            <td align="center"><?php if(!empty($a->jml_aplikandaftaronline)){ echo $a->jml_aplikandaftaronline;}?></td>
            <td align="center"><?php if(!empty($totalaplikandaftar)){ echo $totalaplikandaftar;}?></td>
            <td align="center"><?php if(!empty($a->jml_ujian)){ echo $a->jml_ujian;}?></td>
            <td align="center"><?php if(!empty($a->jml_lulus)){ echo $a->jml_lulus;}?></td>
            <td align="center"><?php if(!empty($a->jml_regisjunior)){ echo $a->jml_regisjunior;}?></td>
            <td align="center"><?php if(!empty($a->jml_regisjunioronline)){ echo $a->jml_regisjunioronline;}?></td>
            <td align="center"><?php if(!empty($totalregisjunior)){ echo $totalregisjunior;}?></td>
            <td align="center"><?php if(!empty($a->jml_regissenior)){ echo $a->jml_regissenior;}?></td>
            <td align="center"><?php if(!empty($totalregis)){ echo $totalregis;}?></td>
          </tr>
        <?php
            $no++;
          }
        ?>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <td colspan="2">TOTAL</td>
          <td align="center"><?php if(!empty($grandtot_aplikandatang)){ echo $grandtot_aplikandatang;}?></td>
          <td align="center"><?php if(!empty($grandtot_aplikanonline)){ echo $grandtot_aplikanonline;}?></td>
          <td align="center"><?php if(!empty($grandtotall_datang)){ echo $grandtotall_datang;}?></td>
          <td align="center"><?php if(!empty($grandtot_aplikandaftar)){ echo $grandtot_aplikandaftar;}?></td>
          <td align="center"><?php if(!empty($grandtot_aplikandaftaronline)){ echo $grandtot_aplikandaftaronline;}?></td>
          <td align="center"><?php if(!empty($grandtotall_daftar)){ echo $grandtotall_daftar;}?></td>
          <td align="center"><?php if(!empty($grandtot_ujian)){ echo $grandtot_ujian;}?></td>
          <td align="center"><?php if(!empty($grandtot_lulus)){ echo $grandtot_lulus;}?></td>
          <td align="center"><?php if(!empty($grandtotall_regisjuniordtg)){ echo $grandtotall_regisjuniordtg;}?></td>
          <td align="center"><?php if(!empty($grandtotall_regisjuniorol)){ echo $grandtotall_regisjuniorol;}?></td>
          <td align="center"><?php if(!empty($grandtotall_regisjunior)){ echo $grandtotall_regisjunior;}?></td>
          <td align="center"><?php if(!empty($grandtotall_regissenior)){ echo $grandtotall_regissenior;}?></td>
          <td align="center"><?php if(!empty($grandtotall_regis)){ echo $grandtotall_regis;}?></td>
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
