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
          DATA PENDAFTARAN CALON MAHASISWA BARU TIDAK DAFTAR
          <br>
          PENERIMAAN MAHASISWA BARU TAHUN AKADEMIK <?php echo $ta; ?>
        </td>
      </tr>
    </table>

    <p>
      <table width="100%" border="1" bordercolor="#000000" class="garis6">
        <tr style="background-color:rgb(48,92,155); color:white; border-color:black; font-size:12px">
          <th>NO</th>
          <th>NAMA APLIKAN</th>
          <th>PROGRAM JURUSAN</th>
          <th>ALAMAT</th>
          <th>NO HP</th>
          <th>PRESENTER</th>
        </tr>
        <?php
          $no = 1;
          foreach($aplikantidakdaftar as $key => $d){
            $kodepresenter  = @$aplikantidakdaftar[$key+1]->kode_presenter;
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $d->nama_lengkap; ?></td>
            <td><?php echo $d->nama_jurusan; ?></td>
            <td><?php echo $d->kota; ?></td>
            <td><?php echo $d->no_hp; ?></td>
            <td><?php echo $d->nama_presenter; ?></td>
          </tr>
        <?php
          if($kodepresenter != $d->kode_presenter){
            echo '
            <tr style="background-color:rgb(48,92,155); color:white; font-weight:bold; height:20px">
              <td colspan="6"></td>
            </tr>';
            $no    = 0;
          }
          $no++;
        } ?>
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
