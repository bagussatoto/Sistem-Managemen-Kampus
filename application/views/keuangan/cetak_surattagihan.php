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
  <?php
    $jmlbayar = 0;
    foreach($tagihan as $t){
    $t = $t[0];
    $jmlbayar = $t['jmlbayarall'];
  ?>
    <section class="sheet padding-10mm" style="font-family:Tahoma">
      <p style="font-size:11px">
        Tasikmalaya, <?php echo DateToIndo2($batas); ?>
      </p>
      <p style="font-size:11px; margin-top:30px">
        <b>Kepada Yth.<br>Bpk/Ibu Orangtua Peserta Didik dari <?php echo $t['nama_lengkap']; ?><br></b><br>di<br>Tempat
      </p>
      <p style="font-size:11px; margin-top:20px">
        <b>Perihal : <?php echo $surat['perihal']; ?></b>
      </p>
      <p style="font-size:11px; margin-top:30px">
        <?php
          $string       = $surat['isi_surat'];
          $replace      = ['{batas}','{jumlahtagihan}'];
          $info         = [
            'batas'           => DateToIndo2($batas),
            'jumlahtagihan'   => number_format($t['sisatunggakan'],0,',','.')
          ];
          echo str_replace($replace, $info, $string);
        ?>
      </p>
      <p style="font-size:11px; margin-top:10px">
        <table width="100%" border="1" bordercolor="#000000" class="garis6">
          <tr bgcolor="#a7bee1">
            <th colspan="5">Rincian Rencana Pembayaran</th>
          </tr>
    			<tr bgcolor="#a7bee1">
    				<th>Cicilan Ke</th>
    				<th>Tgl Rencana Bayar</th>
    				<th>Rencana</th>
    				<th>Realisasi</th>
    				<th>Tertunggak</th>
    			</tr>
          <?php
            $detailrencana = $this->db->get_where('detailrencana',array('kode_registrasi'=>$t['kode_registrasi']))->result();
            foreach($detailrencana as $d)
            {
              if($d->cicilanke == 0){
                $ket = "REGISTRASI";
              }else{
                $ket = $d->cicilanke;
              }

              if($jmlbayar >= $d->wajib_bayar)
              {
                $warna     = "";
                $realisasi = $d->wajib_bayar;
              }else{

                if($jmlbayar>0)
                {
                  $realisasi = $d->wajib_bayar - $jmlbayar;
                }else{
                  $realisasi = 0;
                }

                $bulanskrg2   = substr($d->jatuh_tempo,5,2);
                $bulanskrg    = substr($batas,5,2);
                if($bulanskrg2!=$bulanskrg){
                  $warna="EEEEEE";
                }else{
                  $warna="DDDDDD";
                }
              }

              $tunggakan = $d->wajib_bayar - $realisasi;

          ?>
          <tr bgcolor="<?php echo $warna; ?>">
            <td align="center"><?php echo $ket; ?></td>
            <td align="left"><?php echo DateToIndo2($d->jatuh_tempo); ?></td>
            <td align="right"><?php echo number_format($d->wajib_bayar,0,'','.'); ?></td>
            <td align="right"><?php echo number_format($realisasi,0,'','.'); ?></td>
            <td align="right"><?php echo number_format($tunggakan,0,'','.'); ?></td>
          </tr>
          <?php
            $jmlbayar = $jmlbayar - $d->wajib_bayar;
           }
          ?>
          <tr bgcolor="#a7bee1">
            <th colspan="5">Histori Pembayaran</th>
          </tr>
          <tr bgcolor="#a7bee1">
            <th>BTK</th>
            <th>BTB</th>
            <th>Tgl. Bayar</th>
            <th>Keterangan</th>
            <th>Jumlah Bayar</th>
          </tr>
          <?php
            $historibayar = $this->db->get_where('historibayar',array('kode_registrasi'=>$t['kode_registrasi']));
            $cek = $historibayar->num_rows();
            $hb  = $historibayar->result();
            if(empty($cek))
            {
              echo "<tr><td colspan='5'>Maaf Mahasiswa/i ini Belum Melakukan Pembayaran !</td></tr>";
            }else{
              $totalbayar = 0;
              foreach($hb as $h){
                $totalbayar = $totalbayar + $h->bayar;
            ?>
              <tr>
                <td align="center"><?php echo $h->nobtk; ?></td>
                <td align="center"><?php echo $h->nobtb; ?></td>
                <td><?php echo DateToIndo2($h->tgl); ?></td>
                <td><?php echo $h->keterangan; ?></td>
                <td align="right"><?php echo number_format($h->bayar,0,'','.'); ?></td>
              </tr>
          <?php
              }
            }
          ?>
          <tr bgcolor="#a7bee1">
            <td colspan="4" align="center"><b>JUMLAH YG TELAH DIBAYARKAN</b></td>
            <td align="right"><b>Rp. <?php  echo number_format($totalbayar,0,',','.');?></b></td>
          </tr>
        </table>
      </p>
      <p style="font-size:11px; margin-top:10px">
        <?php echo $surat['isi_surat2']; ?>
      </p>
      <p style="font-size:11px; margin-top:20px">
        <b>LP3I TASIKMALAYA
        <br /><i>Business & Technology College</i></b>
      </p>
      <p style="font-size:11px; margin-top:60px">
        <table style="width:100%">
          <tr>
            <td style="width:50%; text-align:center"><u><?php echo $fullname; ?></u><br>Finance Staff</td>
            <td style="width:50%; text-align:center"><u>Dheri Febiyani Lestari</u><br>Head Of Finance & HRD Dept.</td>
          </tr>
        </table>
      </p>
    </section>
  <?php } ?>
</body>
</html>
