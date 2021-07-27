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
    <table>
      <tr>
        <td><img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt=""></td>
        <td style="font-size:14px; font-weight:bold">
          CABANG TASIKMALAYA
          <br>
          DATA POTENSI INCOME
          <br>
          PENERIMAAN MAHASISWA BARU TAHUN AKADEMIK <?php echo $ta; ?>
          <br>
          ( DISESUAIKAN DENGAN RENCANA PEMBAYARAN MAHASISWA )
        </td>
      </tr>
    </table>

    <p>
      <table width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>NO</th>
          <th>PROGRAM</th>
          <th>POTENSI OMSET</th>
        </tr>
        <?php
          $no = 1;
          $totalomsettingkat = 0 ;
          $totalomset        = 0;
          foreach($potensiomset as $key => $d){
            $tingkat  = @$potensiomset[$key+1]->tingkat;
            $totalomsettingkat = $totalomsettingkat + $d->omset;
            $totalomset        = $totalomset + $d->omset;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $d->nama_jurusan; ?></td>
            <td align="right"><?php echo number_format($d->omset,'0','','.'); ?></td>
          </tr>
        <?php
          if($tingkat != $d->tingkat){
            if($d->tingkat=='1')
            {
              $t = "JUNIOR";
            }else if($d->tingkat=='2')
            {
              $t = "SENIOR";
            }else if($d->tingkat)
            {
              $t = "TINGKAT 3";
            }else{
              $t = "TINGKAT 4";
            }
            echo '
            <tr style="background-color:rgb(48,92,155); color:white; font-weight:bold; height:20px">
              <td colspan="2">OMSET '. $t.'</td>
              <td align=right>'.number_format($totalomsettingkat,'0','','.').'</td>
            </tr>';
            $no    = 0;
            $totalomsettingkat = 0;
          }
          $no++;
        } ?>
          <tr style="background-color:rgb(48,92,155); color:white; font-weight:bold; height:20px">
            <td colspan="2">TOTAL OMSET</td>
            <td align="right"><?php echo number_format($totalomset,'0','','.');  ?></td>
          </tr>
      </table>
    </p>
    <p>
      <table width="100%">
        <tr>
          <td>Tasikmalaya, <?php echo DateToIndo2(date('Y-m-d')); ?><br>Dibuat Oleh,</td>
          <td><br>Disetujui Oleh,</td>
        </tr>
        <tr>
          <td style="height:200px"><b><?php echo $conf['ho_keuangan']; ?></b><br><i>Head Of Marketing </i></td>
          <td style="height:200px"><b><?php echo $conf['branch_manager']; ?></b><br><i>Branch Manager</i></td>
        </tr>
      </table>
    </p>

  </section>
</body>
</html>
