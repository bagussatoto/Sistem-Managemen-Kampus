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
<body class="A4" style="font-size:10px">
  <section class="sheet padding-10mm" style="font-family:Tahoma">
    <table>
      <tr>
        <td><img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt=""></td>
        <td style="font-size:14px; font-weight:bold">
          CABANG TASIKMALAYA
          <br>
          DATA PENDAFTARAN CALON MAHASISWA BARU
          <br>
          <?php
            if(empty($dari) AND empty($sampai)){
              echo "GELOMBANG 1 s/d GELOMBANG TERAKHIR";
            }else{
              echo "PERIODE ".DateToIndo2($dari)." s/d ".DateToIndo2($sampai);
            }
           ?>
          <br>
          PENERIMAAN MAHASISWA BARU TAHUN AKADEMIK <?php echo $ta; ?>
        </td>
      </tr>
    </table>

    <p>
      <table width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:10px">
          <th>NO</th>
          <th>NO BUKTI</th>
          <th>TGL</th>
          <th>GEL</th>
          <th>NAMA APLIKAN</th>
          <th>PRESENTER</th>
          <th>KETERANGAN</th>
          <th>BIAYA</th>
        </tr>
        <tr>
          <?php
            $no = 1;
            $totalbiaya = 0;
            foreach($rekapdaftar as $r)
            {
              $totalbiaya = $totalbiaya + $r->biaya_pendaftaran;
          ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r->nomor_bukti; ?></td>
                <td><?php echo DateToIndo2($r->tgl_daftar); ?></td>
                <td><?php echo $r->gelombang_daftar; ?></td>
                <td><?php echo $r->nama_lengkap; ?></td>
                <td><?php echo $r->nama_presenter; ?></td>
                <td><?php echo $r->ket_daftar; ?></td>
                <td align="right"><?php echo number_format($r->biaya_pendaftaran,'0','','.'); ?></td>
              </tr>
          <?php
              $no++;
            }
          ?>
        </tr>
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:10px">
          <td colspan="7">TOTAL</td>
          <td align="right"><?php echo number_format($totalbiaya,'0','','.'); ?></td>
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
          <td style="height:200px"><b><?php echo $conf['ho_mkt']; ?></b><br><i>Head Of Marketing </i></td>
          <td style="height:200px"><b><?php echo $conf['branch_manager']; ?></b><br><i>Branch Manager</i></td>
        </tr>
      </table>
    </p>

  </section>
</body>
</html>
