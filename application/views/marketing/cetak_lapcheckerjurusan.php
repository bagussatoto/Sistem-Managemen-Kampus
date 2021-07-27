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
      DATA REKAP CHECKER APLIKAN JURUSAN
      <?php
        echo "PERIODE $dari s/d $sampai";
      ?>
      <br>
      TAHUN AKADEMIK <?php echo $ta; ?>
    </p>
    <p>
      <table border="1" bordercolor="#000000" class="garis6">
        <thead style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <tr >
            <th rowspan="3">No</th>
            <th rowspan="3">Nama Jurusan</th>
            <th colspan="<?php echo ($selisih +1) * 3;?>">Tanggal</th>
          </tr>
          <tr>
            <?php
              $a = $dari;
              $b = $sampai;
              while (strtotime($a) <= strtotime($b)) {
            ?>
              <td colspan="3"><?php echo $a; ?></td>
            <?php
                $a = date ("Y-m-d", strtotime("+1 day", strtotime($a)));//looping tambah 1 date
              }
            ?>
          </tr>
          <tr>
            <?php
              $c = $dari;
              $d = $sampai;
              while (strtotime($c) <= strtotime($d)) {
            ?>
              <td>DTG</td>
              <td>DFT</td>
              <td>REG</td>
            <?php
                $c = date ("Y-m-d", strtotime("+1 day", strtotime($c)));//looping tambah 1 date
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
           $no = 1;
           foreach($checker as $c){ ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $c['nama_jurusan']; ?></td>
              <?php
                $e = $dari;
                $f = $sampai;
                $i = 0;
                while (strtotime($e) <= strtotime($f)) {
              ?>
                <td <?php if(empty($c['datang'][$i]) ){echo "bgcolor=red";} ?>><?php if(!empty($c['datang'][$i]) ){echo $c['datang'][$i];} ?></td>
                <td <?php if(empty($c['daftar'][$i]) ){echo "bgcolor=red";} ?>><?php if(!empty($c['daftar'][$i])){echo $c['daftar'][$i];} ?></td>
                <td <?php if(empty($c['regis'][$i]) ){echo "bgcolor=red";} ?>><?php if(!empty($c['regis'][$i])){echo $c['regis'][$i];} ?></td>
              <?php
                  $e = date ("Y-m-d", strtotime("+1 day", strtotime($e)));//looping tambah 1 date
                  $i++;
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
