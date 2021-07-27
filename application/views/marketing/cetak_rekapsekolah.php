<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>A4</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tabel.css">
  <style>@page { size: A4 }</style>
</head>
<body style="font-family:Tahoma">

  <center>
    <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="">
    <br>
    <p style="font-size:16px; font-weight:bold">
      CABANG TASIKMALAYA
      <br>
      DATA REKAP APLIKAN / SEKOLAH
      <br>
      TAHUN AKADEMIK <?php echo $ta; ?>
    </p>
    <p>
      <table border="1" bordercolor="#000000" class="garis6">
        <thead style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Sekolah</th>
            <th colspan="3">Aplikan</th>
          </tr>
          <tr>
            <th>DATANG</th>
            <th>DAFTAR</th>
            <th>REGISTRASI</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $totaldatang = 0;
            $totaldaftar = 0;
            $totalregis  = 0;
            $no=1; foreach($rekapsekolah as $r){
            $totaldatang = $totaldatang + $r->apdatang;
            $totaldaftar = $totaldaftar + $r->apdaftar;
            $totalregis  = $totalregis + $r->apregis;
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $r->asal_sekolah; ?></td>
              <td><?php echo $r->apdatang; ?></td>
              <td><?php echo $r->apdaftar; ?></td>
              <td><?php echo $r->apregis; ?></td>
            </tr>
          <?php $no++; } ?>
            <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
              <td colspan="2">TOTAL</td>
              <td><?php echo $totaldatang; ?></td>
              <td><?php echo $totaldaftar; ?></td>
              <td><?php echo $totalregis; ?></td>
            </tr>
        </tbody>
      </table>
    </p>
  </center>
</body>
</html>
