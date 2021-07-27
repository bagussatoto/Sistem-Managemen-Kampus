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
        <td><h3 style="font-family:Tahoma">DAFTAR RENCANA DAN REALISASI PEMBAYARAN DAN PROGRAM PROFESI KELAS <?php echo $kelas; ?> <br>s/d <?php echo DateToIndo2($batas); ?><br>TAHUN AJARAN <?php echo $ta; ?> </h3></td>
      </tr>
    </table>

    <br>
    <table class="datatable3" style="font-family:Tahoma; font-size:11px; width:250% !important">
      <tr bgcolor="#024a75" style="color:white;">
        <th rowspan="2">No</th>
        <th rowspan="2">NIM</th>
        <th rowspan="2">Nama Mahasiswa</th>
        <th rowspan="2">Program Studi</th>
        <th rowspan="2">Rencana Bayar</th>
        <td colspan="5">Potongan</td>
        <th rowspan="2">Harga Deal</th>
        <th rowspan="2">Registrasi</th>
        <th colspan="3">Sebelum Juli</th>
        <th colspan="3">Juli</th>
        <th colspan="3">Agustus</th>
        <th colspan="3">September</th>
        <th colspan="3">Oktober</th>
        <th colspan="3">November</th>
        <th colspan="3">Desember</th>
        <th colspan="3">Januari</th>
        <th colspan="3">Februari</th>
        <th colspan="3">Maret</th>
        <th colspan="3">April</th>
        <th colspan="3">Mei</th>
        <th colspan="3">Juni</th>
        <th rowspan="2">Tunggakan s/d <?php echo $batas; ?></th>
        <th rowspan="2">Sisa Tunggakan</th>

      </tr>
      <tr bgcolor="#024a75" style="color:white;">
        <td>Gelombang</td>
        <td>Pestasi</td>
        <td>Cash</td>
        <td>Lain Lain</td>
        <td>Dana Pinjaman</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
        <td>Rencana</td>
        <td>Realisasi</td>
        <td>Tunggakan</td>
      </tr>
      <?php
        $no = 1;
        $totalrensj           = 0;
        $totalrenjuli         = 0;
        $totalrenagustus      = 0;
        $totalrenseptember    = 0;
        $totalrenoktober      = 0;
        $totalrennovember     = 0;
        $totalrendesember     = 0;
        $totalrenjanuari      = 0;
        $totalrenfebruari     = 0;
        $totalrenmaret        = 0;
        $totalrenapril        = 0;
        $totalrenmei          = 0;
        $totalrenjuni         = 0;


        $totalrealsj           = 0;
        $totalrealjuli         = 0;
        $totalrealagustus      = 0;
        $totalrealseptember    = 0;
        $totalrealoktober      = 0;
        $totalrealnovember     = 0;
        $totalrealdesember     = 0;
        $totalrealjanuari      = 0;
        $totalrealfebruari     = 0;
        $totalrealmaret        = 0;
        $totalrealapril        = 0;
        $totalrealmei          = 0;
        $totalrealjuni         = 0;


        $totaltungsj           = 0;
        $totaltungjuli         = 0;
        $totaltungagustus      = 0;
        $totaltungseptember    = 0;
        $totaltungoktober      = 0;
        $totaltungnovember     = 0;
        $totaltungdesember     = 0;
        $totaltungjanuari      = 0;
        $totaltungfebruari     = 0;
        $totaltungmaret        = 0;
        $totaltungapril        = 0;
        $totaltungmei          = 0;
        $totaltungjuni         = 0;

        $totalsisasampai       = 0;
        $totalsisatunggakan    = 0;


        foreach($cetak0 as $d){

          $totalrensj           = $totalrensj + $d->rensj;
          $totalrenjuli         = $totalrenjuli + $d->renjuli;
          $totalrenagustus      = $totalrenagustus + $d->renagustus;
          $totalrenseptember    = $totalrenseptember + $d->renseptember;
          $totalrenoktober      = $totalrenoktober + $d->renoktober;
          $totalrennovember     = $totalrennovember + $d->rennovember;
          $totalrendesember     = $totalrendesember + $d->rendesember;
          $totalrenjanuari      = $totalrenjanuari + $d->renjanuari;
          $totalrenfebruari     = $totalrenfebruari + $d->renfebruari;
          $totalrenmaret        = $totalrenmaret + $d->renmaret;
          $totalrenapril        = $totalrenapril + $d->renapril;
          $totalrenmei          = $totalrenmei + $d->renmei;
          $totalrenjuni         = $totalrenjuni + $d->renjuni;

          $totalrealsj           = $totalrealsj + $d->realsj;
          $totalrealjuli         = $totalrealjuli + $d->realjuli;
          $totalrealagustus      = $totalrealagustus + $d->realagustus;
          $totalrealseptember    = $totalrealseptember + $d->realseptember;
          $totalrealoktober      = $totalrealoktober + $d->realoktober;
          $totalrealnovember     = $totalrealnovember + $d->realnovember;
          $totalrealdesember     = $totalrealdesember + $d->realdesember;
          $totalrealjanuari      = $totalrealjanuari + $d->realjanuari;
          $totalrealfebruari     = $totalrealfebruari + $d->realfebruari;
          $totalrealmaret        = $totalrealmaret + $d->realmaret;
          $totalrealapril        = $totalrealapril + $d->realapril;
          $totalrealmei          = $totalrealmei + $d->realmei;
          $totalrealjuni         = $totalrealjuni + $d->realjuni;

          $totaltungsj           = $totaltungsj + $d->tungsj;
          $totaltungjuli         = $totaltungjuli + $d->tungjuli;
          $totaltungagustus      = $totaltungagustus + $d->tungagustus;
          $totaltungseptember    = $totaltungseptember + $d->tungseptember;
          $totaltungoktober      = $totaltungoktober + $d->tungoktober;
          $totaltungnovember     = $totaltungnovember + $d->tungnovember;
          $totaltungdesember     = $totaltungdesember + $d->tungdesember;
          $totaltungjanuari      = $totaltungjanuari + $d->tungjanuari;
          $totaltungfebruari     = $totaltungfebruari + $d->tungfebruari;
          $totaltungmaret        = $totaltungmaret + $d->tungmaret;
          $totaltungapril        = $totaltungapril + $d->tungapril;
          $totaltungmei          = $totaltungmei + $d->tungmei;
          $totaltungjuni         = $totaltungjuni + $d->tungjuni;

          $totalsisasampai       = $totalsisasampai + $d->sisasampaidengan;
          $totalsisatunggakan    = $totalsisatunggakan + $d->sisatunggakan;


      ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d->nim; ?></td>
          <td><?php echo $d->nama_lengkap; ?></td>
          <td><?php echo $d->nama_jurusan; ?></td>
          <td align="right"><?php echo number_format($d->biaya,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->pot_gelombang,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->pot_prestasi,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->pot_cash,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->pot_lainlain,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->danapinjaman,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->harga_deal,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->biaya_registrasi,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->rensj,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realsj,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungsj,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renjuli,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realjuli,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungjuli,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renagustus,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realagustus,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungagustus,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renseptember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realseptember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungseptember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renoktober,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realoktober,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungoktober,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->rennovember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realnovember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungnovember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->rendesember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realdesember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungdesember,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renjanuari,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realjanuari,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungjanuari,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renfebruari,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realfebruari,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungfebruari,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renmaret,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realmaret,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungmaret,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renapril,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realapril,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungapril,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renmei,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realmei,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungmei,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->renjuni,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->realjuni,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->tungjuni,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->sisasampaidengan,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($d->sisatunggakan,'0','','.'); ?></td>
        </tr>
      <?php
          $no++;
        }
      ?>
      <tr bgcolor="#024a75" style="color:white;">
        <th colspan="12">TOTAL</th>
        <th align="right"><?php echo number_format($totalrensj,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealsj,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungsj,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenjuli,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealjuli,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungjuli,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenagustus,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealagustus,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungagustus,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenseptember,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealseptember,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungseptember,'0','','.'); ?></th>


        <th align="right"><?php echo number_format($totalrenoktober,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealoktober,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungoktober,'0','','.'); ?></th>


        <th align="right"><?php echo number_format($totalrennovember,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealnovember,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungnovember,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrendesember,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealdesember,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungdesember,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenjanuari,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealjanuari,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungjanuari,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenfebruari,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealfebruari,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungfebruari,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenmaret,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealmaret,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungmaret,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenapril,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealapril,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungapril,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenmei,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealmei,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungmei,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalrenjuni,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalrealjuni,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totaltungjuni,'0','','.'); ?></th>

        <th align="right"><?php echo number_format($totalsisasampai,'0','','.'); ?></th>
        <th align="right"><?php echo number_format($totalsisatunggakan,'0','','.'); ?></th>
      </tr>
    </table>
  </section>

</body>
</html>
