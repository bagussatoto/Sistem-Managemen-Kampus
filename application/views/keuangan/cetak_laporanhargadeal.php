<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <style>@page { size: A4 }</style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table>
      <tr>
        <td style="width:60px"><img src="<?php echo base_url(); ?>assets/images/lp3i.png" width="50px" height="50px"></td>
        <td><h3 style="font-family:Tahoma">DATA HARGA DEAL & TUNGGAKAN KELAS <?php echo $kelas; ?> <br>s/d <?php echo DateToIndo2($batas); ?><br>TAHUN AJARAN <?php echo $ta; ?> </h3></td>
      </tr>
    </table>
    <table style="font-family:Tahoma">
      <tr>
        <td>Pembimbing Akademik</td>
        <td>:</td>
        <td><b></b></td>
      </tr>
    </table>
    <br>
    <table class="datatable3" style="font-family:Tahoma">
      <tr bgcolor="#024a75" style="color:white;">
        <th>No</th>
        <th>Nama Mhs</th>
        <th>No HP</th>
	      <th>Nama Ortu</th>
        <th>No HP Ortu</th>
        <th>Status</th>
        <th>Harga Deal</th>
        <th>Jumlah Bayar</th>
        <th>Jumlah Tunggakan</th>
        <th>Tunggakan s/d <br> <?php echo DateToIndo2($batas); ?></th>
      </tr>
      <?php
        $no = 1;
        $totalhargadeal     = 0;
        $totaltunggakan     = 0;
        $totalbayar         = 0;
        $totalalltunggakan  = 0;
        foreach($cetak0 as $d){
          if($d->sisaalltunggakan>0){
            $bgcolor ="ffbddb";
          }else{
            $bgcolor ="";
          }

          $totaltunggakan = $totaltunggakan + $d->sisatunggakan;
          $totalhargadeal = $totalhargadeal + $d->harga_deal;
          $totalbayar     = $totalbayar + $d->jmlbayarall;
          $totalalltunggakan = $totalalltunggakan + $d->sisaalltunggakan;
      ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td><?php echo $no; ?></td>
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->no_hp; ?></td>
          <td><?php echo $d->nama_ortu; ?></td>
          <td><?php echo $d->nohp_ortu; ?></td>
          <td><?php echo $d->status_akademik; ?></td>
          <td align="right"><?php echo number_format($d->harga_deal,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->jmlbayarall,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->sisaalltunggakan,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->sisatunggakan,'0','','.'); ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
      <tr bgcolor="#024a75" style="color:white;">
        <td colspan="6"><b>TOTAL</b></td>
        <td align="right"><b><?php echo number_format($totalhargadeal,'0','','.'); ?></b></td>
        <td align="right"><b><?php echo number_format($totalbayar,'0','','.'); ?></b></td>
        <td align="right"><b><?php echo number_format($totalalltunggakan,'0','','.'); ?></b></td>
        <td align="right"><b><?php echo number_format($totaltunggakan,'0','','.'); ?></b></td>
      </tr>
    </table>
    <p align="left" style="font-size:12px" class="parhas"><?php echo 'Bagi yang belum Registrasi, biaya normal untuk jurusan '.$kode_jurusan.' '.$biaya['nama_tingkat'].' Tahun Akademik '.$ta.' ialah sebesar <strong>Rp. '.number_format($biaya['biaya'],0,',','.').'</strong> (belum termasuk potongan-potongan).';?></p>
    <table  width="100%" style="font-family:Tahoma; font-size:11px" >
    	<tr>
          <td width="50%" align="center">
            <br>
            <br>
            <br>
            <br>
    		    <u><?php echo $fullname;?></u>
    		    <br>
            <b>Finance Staff</b>
          </td>
          <td width="50%"  align="center">
            <br>
            <br>
            <br>
            <br>
            <u>Dheri Febiyani Lestari, S.Pd</u>
    		    <br>
            <b>Head of Finance & HRD Dept.</b>
          </td>
    	</tr>
      <tr>
        <td colspan="2"><p align="right"><br><br><i>Catatan : Jika terjadi kesalahan pencetakan tunggakan mohon konfirmasi ke Bagian Keuangan LP3I Tasikmalaya</i></p></td>
      </tr>
    </table>
  </section>

</body>
</html>
