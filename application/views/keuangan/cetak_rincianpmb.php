<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <style>@page { size: A4 }</style>
  <style media="screen">
    .judul{
      font-size:14px;
      font-weight: bold;
      font-family: Tahoma;
    }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table class="datatable3">
      <tr>
        <td style="width:5%" align="center"><img src="<?php echo base_url(); ?>assets/images/lp3i.png" width="100px" height="100px"></td>
        <td align="center" colspan="7" style="width:65%">
          <h1 style="font-family:Tahoma">DAFTAR RENCANA, PEMBAYARAN / REALISASI & TUNGGAKAN BIAYA PENDIDIKAN <br>
          TAHUN AJARAN  </h1>
        </td>
        <td style="width:30%">
          <table class="datatable3" style="font-size:14px; font-family:Tahoma">
            <tr>
              <td style="width:30%">No Induk</td>
              <td><?php echo $mhs['nim']; ?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td><?php echo $mhs['nama_lengkap'];?></td>
            </tr>
            <tr>
              <td>Jurusan</td>
              <td><?php echo $mhs['nama_jurusan']; ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="9" class="judul" style="text-align:center">RINCIAN PEMBAYARAN TINGKAT JUNIOR</td>
      </tr>
      <tr>
        <td colspan="3" width="20%">
          <table class="datatable3">
            <tr>
              <th colspan="3" class="judul">RENCANA PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Cicilan</th>
              <th>Jatuh Tempo</th>
              <th>Wajib Bayar</th>
            </tr>
            <?php $totalwb = 0; foreach($ren1 as $r1){ $totalwb = $totalwb + $r1->wajib_bayar;
                if($r1->cicilanke==0)
                {
                  $ket = "REGISTRASI";
                }else{
                  $ket = $r1->cicilanke;
                }
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $ket; ?></td>
                <td><?php echo DateToIndo2($r1->jatuh_tempo); ?></td>
                <td align="right"><?php echo number_format($r1->wajib_bayar,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="2" class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="40%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="4" class="judul">POSTING PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Bulan</th>
              <th>Wajib Bayar</th>
              <th>Realisasi</th>
              <th>Tunggakan</th>
            </tr>
            <?php $totalwb = 0;
              $totalreal = 0;
              $totaltung = 0;
              foreach($ren1 as $p1){
                $totalwb   = $totalwb + $p1->wajib_bayar;
                $totalreal = $totalreal + $p1->realisasi;
                $totaltung = $totaltung + $p1->wajib_bayar-$p1->realisasi;
                $bulan = explode("-",$p1->jatuh_tempo);
                $bln   = $bulan[1]."-".$bulan[0];
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $bln; ?></td>
                <td align="right"><?php echo number_format($p1->wajib_bayar,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p1->realisasi,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p1->wajib_bayar-$p1->realisasi,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totalreal,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totaltung,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="30%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="5" class="judul">REALISASI PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>No. Bukti</th>
              <th>BTK</th>
              <th>BTB</th>
              <th>Tgl Bayar</th>
              <th>Jumlah Bayar</th>
            </tr>
            <?php
              $totalbayar = 0;
              foreach ($hb1 as $h1) {
                $totalbayar = $totalbayar + $h1->bayar;
            ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td><?php echo $h1->nobukti; ?></td>
                <td><?php echo $h1->nobtk; ?></td>
                <td><?php echo $h1->nobtb; ?></td>
                <td><?php echo DateToIndo2($h1->tgl); ?></td>
                <td align="right" ><?php echo number_format($h1->bayar,'0','','.'); ?></td>
              </tr>
            <?php
              }
             ?>
             <tr>
               <td class="judul" colspan="4">TOTAL</td>
               <td align="right" class="judul"><?php echo number_format($totalbayar,'0','','.'); ?></td>
             </tr>
          </table>
        </td>

      </tr>
      <tr>
        <td colspan="9" class="judul" style="text-align:center">RINCIAN PEMBAYARAN TINGKAT SENIOR</td>
      </tr>
      <tr>
        <td colspan="3" width="20%">
          <table class="datatable3">
            <tr>
              <th colspan="3" class="judul">RENCANA PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Cicilan</th>
              <th>Jatuh Tempo</th>
              <th>Wajib Bayar</th>
            </tr>
            <?php $totalwb = 0; foreach($ren2 as $r2){ $totalwb = $totalwb + $r2->wajib_bayar;
                if($r2->cicilanke==0)
                {
                  $ket = "REGISTRASI";
                }else{
                  $ket = $r2->cicilanke;
                }
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $ket; ?></td>
                <td><?php echo DateToIndo2($r2->jatuh_tempo); ?></td>
                <td align="right"><?php echo number_format($r2->wajib_bayar,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="2" class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="40%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="4" class="judul">POSTING PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Bulan</th>
              <th>Wajib Bayar</th>
              <th>Realisasi</th>
              <th>Tunggakan</th>
            </tr>
            <?php $totalwb = 0;
              $totalreal = 0;
              $totaltung = 0;
              foreach($ren2 as $p2){
                $totalwb   = $totalwb + $p2->wajib_bayar;
                $totalreal = $totalreal + $p2->realisasi;
                $totaltung = $totaltung + $p2->wajib_bayar-$p2->realisasi;
                $bulan = explode("-",$p2->jatuh_tempo);
                $bln   = $bulan[1]."-".$bulan[0];
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $bln; ?></td>
                <td align="right"><?php echo number_format($p2->wajib_bayar,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p2->realisasi,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p2->wajib_bayar-$p2->realisasi,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totalreal,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totaltung,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="30%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="5" class="judul">REALISASI PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>No. Bukti</th>
              <th>BTK</th>
              <th>BTB</th>
              <th>Tgl Bayar</th>
              <th>Jumlah Bayar</th>
            </tr>
            <?php
              $totalbayar = 0;
              foreach ($hb2 as $h2) {
                $totalbayar = $totalbayar + $h2->bayar;
            ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td><?php echo $h2->nobukti; ?></td>
                <td><?php echo $h2->nobtk; ?></td>
                <td><?php echo $h2->nobtb; ?></td>
                <td><?php echo DateToIndo2($h2->tgl); ?></td>
                <td align="right" ><?php echo number_format($h2->bayar,'0','','.'); ?></td>
              </tr>
            <?php
              }
             ?>
             <tr>
               <td class="judul" colspan="4">TOTAL</td>
               <td align="right" class="judul"><?php echo number_format($totalbayar,'0','','.'); ?></td>
             </tr>
          </table>
        </td>

      </tr>
      <tr>
        <td colspan="9" class="judul" style="text-align:center">RINCIAN PEMBAYARAN TINGKAT III</td>
      </tr>
      <tr>
        <td colspan="3" width="20%">
          <table class="datatable3">
            <tr>
              <th colspan="3" class="judul">RENCANA PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Cicilan</th>
              <th>Jatuh Tempo</th>
              <th>Wajib Bayar</th>
            </tr>
            <?php $totalwb = 0; foreach($ren3 as $r3){ $totalwb = $totalwb + $r3->wajib_bayar;
                if($r3->cicilanke==0)
                {
                  $ket = "REGISTRASI";
                }else{
                  $ket = $r3->cicilanke;
                }
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $ket; ?></td>
                <td><?php echo DateToIndo2($r3->jatuh_tempo); ?></td>
                <td align="right"><?php echo number_format($r3->wajib_bayar,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="2" class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="40%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="4" class="judul">POSTING PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Bulan</th>
              <th>Wajib Bayar</th>
              <th>Realisasi</th>
              <th>Tunggakan</th>
            </tr>
            <?php $totalwb = 0;
              $totalreal = 0;
              $totaltung = 0;
              foreach($ren3 as $p3){
                $totalwb   = $totalwb + $p3->wajib_bayar;
                $totalreal = $totalreal + $p3->realisasi;
                $totaltung = $totaltung + $p3->wajib_bayar-$p3->realisasi;
                $bulan = explode("-",$p3->jatuh_tempo);
                $bln   = $bulan[1]."-".$bulan[0];
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $bln; ?></td>
                <td align="right"><?php echo number_format($p3->wajib_bayar,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p3->realisasi,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p3->wajib_bayar-$p3->realisasi,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totalreal,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totaltung,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="30%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="5" class="judul">REALISASI PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>No. Bukti</th>
              <th>BTK</th>
              <th>BTB</th>
              <th>Tgl Bayar</th>
              <th>Jumlah Bayar</th>
            </tr>
            <?php
              $totalbayar = 0;
              foreach ($hb3 as $h3) {
                $totalbayar = $totalbayar + $h3->bayar;
            ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td><?php echo $h3->nobukti; ?></td>
                <td><?php echo $h3->nobtk; ?></td>
                <td><?php echo $h3->nobtb; ?></td>
                <td><?php echo DateToIndo2($h3->tgl); ?></td>
                <td align="right" ><?php echo number_format($h3->bayar,'0','','.'); ?></td>
              </tr>
            <?php
              }
             ?>
             <tr>
               <td class="judul" colspan="4">TOTAL</td>
               <td align="right" class="judul"><?php echo number_format($totalbayar,'0','','.'); ?></td>
             </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="9" class="judul" style="text-align:center">RINCIAN PEMBAYARAN TINGKAT IV</td>
      </tr>
      <tr>
        <td colspan="3" width="20%">
          <table class="datatable3">
            <tr>
              <th colspan="3" class="judul">RENCANA PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Cicilan</th>
              <th>Jatuh Tempo</th>
              <th>Wajib Bayar</th>
            </tr>
            <?php $totalwb = 0; foreach($ren4 as $r4){ $totalwb = $totalwb + $r4->wajib_bayar;
                if($r4->cicilanke==0)
                {
                  $ket = "REGISTRASI";
                }else{
                  $ket = $r4->cicilanke;
                }
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $ket; ?></td>
                <td><?php echo DateToIndo2($r4->jatuh_tempo); ?></td>
                <td align="right"><?php echo number_format($r4->wajib_bayar,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="2" class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="40%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="4" class="judul">POSTING PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>Bulan</th>
              <th>Wajib Bayar</th>
              <th>Realisasi</th>
              <th>Tunggakan</th>
            </tr>
            <?php $totalwb = 0;
              $totalreal = 0;
              $totaltung = 0;
              foreach($ren4 as $p4){
                $totalwb   = $totalwb + $p4->wajib_bayar;
                $totalreal = $totalreal + $p4->realisasi;
                $totaltung = $totaltung + $p4->wajib_bayar-$p4->realisasi;
                $bulan = explode("-",$p4->jatuh_tempo);
                $bln   = $bulan[1]."-".$bulan[0];
              ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td align="center"><?php echo $bln; ?></td>
                <td align="right"><?php echo number_format($p4->wajib_bayar,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p4->realisasi,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($p4->wajib_bayar-$p4->realisasi,'0','','.'); ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td class="judul">TOTAL</td>
              <td align="right" class="judul"><?php echo number_format($totalwb,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totalreal,'0','','.'); ?></td>
              <td align="right" class="judul"><?php echo number_format($totaltung,'0','','.'); ?></td>
            </tr>
          </table>
        </td>
        <td colspan="3" width="30%" valign="top">
          <table class="datatable3"  >
            <tr>
              <th colspan="5" class="judul">REALISASI PEMBAYARAN</th>
            </tr>
            <tr class="judul">
              <th>No. Bukti</th>
              <th>BTK</th>
              <th>BTB</th>
              <th>Tgl Bayar</th>
              <th>Jumlah Bayar</th>
            </tr>
            <?php
              $totalbayar = 0;
              foreach ($hb4 as $h4) {
                $totalbayar = $totalbayar + $h4->bayar;
            ?>
              <tr style="font-size:14px; font-family:tahoma">
                <td><?php echo $h4->nobukti; ?></td>
                <td><?php echo $h4->nobtk; ?></td>
                <td><?php echo $h4->nobtb; ?></td>
                <td><?php echo DateToIndo2($h4->tgl); ?></td>
                <td align="right" ><?php echo number_format($h4->bayar,'0','','.'); ?></td>
              </tr>
            <?php
              }
             ?>
             <tr>
               <td class="judul" colspan="4">TOTAL</td>
               <td align="right" class="judul"><?php echo number_format($totalbayar,'0','','.'); ?></td>
             </tr>
          </table>
        </td>

      </tr>
    </table>
    <br>
</body>
</html>
