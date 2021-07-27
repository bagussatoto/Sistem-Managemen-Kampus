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
      DATA CHECKER APLIKAN PRESENTER
      <?php
        echo "PERIODE $dari s/d $sampai Bulan $bulan[$bln]";
      ?>
      <br>
      TAHUN AKADEMIK <?php echo $ta; ?>
    </p>
    <p>
      <table border="1" bordercolor="#000000" class="garis6">
        <thead style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <tr >
            <th rowspan="3">No</th>
            <th rowspan="3">Nama Presenter</th>
            <th colspan="<?php echo $sampai*3; ?>">Tanggal</th>
          </tr>
          <tr>
            <?php

              for ($i=$dari; $i<=$sampai;$i++) {
                echo "<td colspan='3' align='center'>$i</td>";
              }
            ?>
          </tr>
          <tr>
            <?php
              for ($i=$dari; $i<=$sampai;$i++) {
                echo "
                <td>DTG</td>
                <td>DFT</td>
                <td>REG</td>
                ";
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($checker as $c){ ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $c['nama_presenter']; ?></td>
              <?php
                for ($i=$dari; $i<=$sampai;$i++) {
                  $datang = "datang".$i;
                  $daftar = "daftar".$i;
                  $regis  = "registrasi".$i;
              ?>
                <td><?php echo $c[$datang]; ?></td>
                <td><?php echo $c[$daftar]; ?></td>
                <td><?php echo $c[$regis]; ?></td>
              <?php
                }
              ?>
            </tr>
          <?php $no++;} ?>
        </tbody>
      </table>
    </p>
  </center>
</body>
</html>
