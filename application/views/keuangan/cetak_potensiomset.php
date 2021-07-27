<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>A4</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tabel.css">
  <style>@page { size: A4 }</style>
</head>
<body  style="font-size:12px; font-family:Tahoma">
  
    <table>
      <tr>
        <td><img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt=""></td>
        <td style="font-size:14px; font-weight:bold">
          LP3I TASIKMALAYA
          <br>
          LAPORAN MINGGUAN FINANCE
          <br>
          DAFTAR REALISASI DAN TARGET MAHASISWA T.A <?php echo $ta; ?>
        </td>
      </tr>
    </table>

    <p>
      <table width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th rowspan="2">NO</th>
          <th rowspan="2">TINGKAT</th>
          <th rowspan="2">TARGET REGIST</th>
          <th rowspan="2">MHS REGIST</th>
          <th rowspan="2">TARGET OMSET</th>
          <th rowspan="2">OMSET <?php echo $ta; ?></th>
          <th rowspan="2">TARGET HARGA RATA2</th>
          <th rowspan="2">HARGA RATA2</th>
          <th colspan="2">SISA</th>
        </tr>
        <tr  style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>OMSET</th>
          <th>JML MHS</th>
        </tr>
        <?php 
          $no = 1;
          foreach ($potensiomset as $p){
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $p->status." ".$p->tingkat; ?></td>
            <td align="center"><?php echo $p->targetjmlmhs; ?></td>
            <td align="center"><?php echo $p->jmlmhs; ?></td>
            <td align="right"><?php echo number_format($p->targetomset,'0','','.'); ?></td>
            <td align="right"><?php echo number_format($p->omset,'0','','.'); ?></td>
            <td align="right"><?php echo number_format($p->hargaratarata,'0','','.'); ?></td>
            <td align="right"><?php echo number_format($p->omset/$p->jmlmhs,'0','','.'); ?></td>
            <td align="right"><?php echo number_format($p->targetomset-$p->omset,'0','','.'); ?></td>
            <td align="right"><?php echo number_format($p->targetjmlmhs - $p->jmlmhs,'0','','.'); ?></td>
          </tr>
        <?php 
            $no++;
          }
        ?>
      </table>
    </p>

  
</body>
</html>
