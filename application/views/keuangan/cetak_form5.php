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
  <h4 style="text-align:center">FORM-5</h4>
  <center>
    <table>
      <tr>
        <td style="font-size:14px; font-weight:bold; text-align:right">
          LP3I CABANG
        </td>
        <td>:</td>
        <td style="font-size:14px; font-weight:bold;text-align:left">
          TASIKMALAYA
        </td>
      </tr>
      <tr>
        <td colspan="3" style="font-size:14px; font-weight:bold; text-align:center">DATA POTENSI INCOME PROFESI</td>
      </tr>
      <tr>
        <td colspan="3" style="font-size:12px; font-weight:bold; text-align:center">(DISESUAIKAN DENGAN RENCANA PEMBAYARAN MAHASISWA)</td>
      </tr>
    </table>
  </center>

    <p>
      <table width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>NO</th>
          <th>JURUSAN</th>
          <th>TINGKAT</th>
          <th>POTENSI OMSET</th>
        </tr>
        <?php
          $no = 1;
          $jurusan = "";
          $totalpendatanjunior = 0;
          $totalpendapatansenior = 0;
          $totaljunior = 0;
          $totalsenior = 0;
          $totalall = 0;
          foreach($potensiomset as $p){
            if($p->tingkat=='1')
            {
              $totalpendatanjunior = $totalpendatanjunior + $p->omset;
              $totalpendapatansenior = $totalpendapatansenior + 0;
              $totaljunior = $totaljunior + $p->jmlmhs;
              $totalsenior = $totalsenior + 0;
            }else{
              $totalpendatanjunior = $totalpendatanjunior + 0;
              $totalpendapatansenior = $totalpendapatansenior + $p->omset;
              $totaljunior = $totaljunior + 0;
              $totalsenior = $totalsenior + $p->jmlmhs;
            }

            $totalall = $totalall + $p->omset;
            if($jurusan != $p->kode_jurusan){
        ?>
            <tr>
              <td rowspan="2"><?php echo $no; ?></td>
              <td rowspan="2"><?php echo $p->nama_jurusan; ?></td>
              <td><?php echo $p->nama_tingkat; ?></td>
              <td align="right"><?php echo number_format($p->omset,'0','','.'); ?></td>
            </tr>
        <?php 
            }else{
        ?>
            <tr>
              <td><?php echo $p->nama_tingkat; ?></td>
              <td align="right"><?php echo number_format($p->omset,'0','','.'); ?></td>
            </tr>
        <?php 
            }
          $jurusan = $p->kode_jurusan;
          $no++;
          }
        ?>
        <tr>
          <td  colspan="4"></td>
        </tr>
        <tr>
          <td rowspan="7"></td>
          <td rowspan="7"></td>
          <td>TOTAL PENDAPATAN JUNIOR</td>
          <td align="right"><?php echo number_format($totalpendatanjunior,'0','','.'); ?></td>
        </tr>
        <tr>
          <td>TOTAL PENDAPATAN SENIOR</td>
          <td align="right"><?php echo number_format($totalpendapatansenior,'0','','.'); ?></td>
        </tr>
        <tr>
          
          <td>TOTAL POTENSI INCOME JUNIOR & SENIOR</td>
          <td align="right"><?php echo number_format($totalall,'0','','.'); ?></td>
        </tr>
        <tr>
          
          <td>TARGET OMSET REVENUE</td>
          <td></td>
        </tr>
        <tr>
          
          <td>HARGA JUAL RATA RATA JUNIOR</td>
          <td align="right"><?php  if(!empty($totaljunior)){echo number_format($totalpendatanjunior/$totaljunior,'0','','.');} ?></td>
        </tr>
        <tr>
          
          <td>HARGA JUAL RATA RATA SENIOR</td>
          <td align="right"><?php  if(!empty($totalsenior)){echo number_format($totalpendapatansenior/$totalsenior,'0','','.');} ?></td>
        </tr>
        <tr>
          
          <td>% REALISASI PENCAPAIAN TARGET OMZET </td>
          <td></td>
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
          <td style="height:200px"><b><?php echo $conf['ho_keuangan']; ?></b><br><i>Head Of Finance & HRD </i></td>
          <td style="height:200px"><b><?php echo $conf['ho_mkt']; ?></b><br><i>Head of Marketing</i></td>
        </tr>
        <tr>
          <td  height="200px" colspan="2" style="text-align:center">
            Approved By
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <b><?php echo $conf['branch_manager']; ?></b><br>
            <i>Branch Manager</i>
          </td>
        </tr>
      </table>
    </p>

  </section>
</body>
</html>
