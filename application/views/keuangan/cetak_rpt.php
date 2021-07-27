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
        <td><h3 style="font-family:Tahoma">DAFTAR RENCANA, PEMBAYARAN / REALISASI & TUNGGAKAN BIAYA PENDIDIKAN <br>
        TAHUN AJARAN <?php echo $ta; ?> </h3></td>
      </tr>
    </table>
    <br>
    <table class="datatable3" style="font-family:Tahoma">
      <tr bgcolor="#024a75" style="color:white; font-size:12px">
        <th colspan="15" style="text-align:left">RENCANA</th>
      </tr>
      <tr bgcolor="#fcf8e3" style="color:black; font-size:12px">
        <th>TINGKAT</th>
        <th>Sebelum Juli</th>
        <th>Juli</th>
        <th>Agustus</th>
        <th>September</th>
        <th>Oktober</th>
        <th>November</th>
        <th>Desember</th>
        <th>Januari</th>
        <th>Februari</th>
        <th>Maret</th>
        <th>April</th>
        <th>Mei</th>
        <th>Juni</th>
        <th>Jumlah</th>
      </tr>
      <?php
      $rensebelumjuli = 0;
      $renjuli=0;
      $renagustus=0;
      $renseptember=0;
      $renoktober=0;
      $rennovember=0;
      $rendesember=0;
      $renjanuari=0;
      $renfebruari=0;
      $renmaret=0;
      $renapril=0;
      $renmei=0;
      $renjuni=0;
      $rentotalrencana=0;
      foreach($rencana as $ren){
        $rensebelumjuli = $rensebelumjuli + $ren['sebelumjuli']  ;
        $renjuli        = $renjuli + $ren['juli'];
        $renagustus     = $renagustus + $ren['agustus'];
        $renseptember   = $renseptember + $ren['september'];
        $renoktober     = $renoktober + $ren['oktober'];
        $rennovember    = $rennovember + $ren['november'];
        $rendesember    = $rendesember + $ren['desember'];
        $renjanuari     = $renjanuari + $ren['januari'];
        $renfebruari    = $renfebruari + $ren['februari'];
        $renmaret       = $renmaret + $ren['maret'];
        $renapril       = $renapril + $ren['april'];
        $renmei         = $renmei + $ren['mei'];
        $renjuni        = $renjuni + $ren['juni'];
        $rentotalrencana= $rentotalrencana + $ren['totalrencana'];
       ?>
        <tr style="font-size:12px">
          <td><?php echo $ren['tingkat']; ?></td>
          <td align="right"><?php echo number_format($ren['sebelumjuli'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['juli'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['agustus'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['september'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['oktober'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['november'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['desember'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['januari'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['februari'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['maret'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['april'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['mei'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['juni'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($ren['totalrencana'],0,'','.'); ?></td>
        </tr>
      <?php } ?>
      <tr bgcolor="#fcf8e3" style="color:black; font-size:12px; font-weight:bold">
        <td>TOTAL</td>
        <td align="right"><?php echo number_format($rensebelumjuli,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renjuli,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renagustus,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renseptember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renoktober,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($rennovember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($rendesember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renjanuari,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renfebruari,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renmaret,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renapril,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renmei,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($renjuni,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($rentotalrencana,0,'','.'); ?></td>
      </tr>
      <tr bgcolor="#024a75" style="color:white; font-size:12px">
        <th colspan="15" style="text-align:left">REALISASI</th>
      </tr>
      <tr bgcolor="#dff0d8" style="color:black; font-size:12px">
        <th>TINGKAT</th>
        <th>Sebelum Juli</th>
        <th>Juli</th>
        <th>Agustus</th>
        <th>September</th>
        <th>Oktober</th>
        <th>November</th>
        <th>Desember</th>
        <th>Januari</th>
        <th>Februari</th>
        <th>Maret</th>
        <th>April</th>
        <th>Mei</th>
        <th>Juni</th>
        <th>Jumlah</th>
      </tr>
      <?php
        $realsebelumjuli = 0;
        $realjuli=0;
        $realagustus=0;
        $realseptember=0;
        $realoktober=0;
        $realnovember=0;
        $realdesember=0;
        $realjanuari=0;
        $realfebruari=0;
        $realmaret=0;
        $realapril=0;
        $realmei=0;
        $realjuni=0;
        $realtotalrealisasi=0;
        foreach($realisasi as $real){
          $realsebelumjuli = $realsebelumjuli + $real['sebelumjuli']  ;
          $realjuli        = $realjuli + $real['juli'];
          $realagustus     = $realagustus + $real['agustus'];
          $realseptember   = $realseptember + $real['september'];
          $realoktober     = $realoktober + $real['oktober'];
          $realnovember    = $realnovember + $real['november'];
          $realdesember    = $realdesember + $real['desember'];
          $realjanuari     = $realjanuari + $real['januari'];
          $realfebruari    = $realfebruari + $real['februari'];
          $realmaret       = $realmaret + $real['maret'];
          $realapril       = $realapril + $real['april'];
          $realmei         = $realmei + $real['mei'];
          $realjuni        = $realjuni + $real['juni'];
          $realtotalrealisasi= $realtotalrealisasi + $real['totalrealisasi'];
      ?>
        <tr style="font-size:12px; ">
          <td><?php echo $real['tingkat']; ?></td>
          <td align="right"><?php echo number_format($real['sebelumjuli'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['juli'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['agustus'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['september'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['oktober'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['november'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['desember'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['januari'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['februari'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['maret'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['april'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['mei'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['juni'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($real['totalrealisasi'],0,'','.'); ?></td>
        </tr>
      <?php } ?>
      <tr bgcolor="#dff0d8" style="color:black; font-size:12px; font-weight:bold">
        <td>TOTAL</td>
        <td align="right"><?php echo number_format($realsebelumjuli,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realjuli,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realagustus,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realseptember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realoktober,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realnovember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realdesember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realjanuari,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realfebruari,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realmaret,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realapril,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realmei,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realjuni,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($realtotalrealisasi,0,'','.'); ?></td>
      </tr>
      <tr bgcolor="#024a75" style="color:white; font-size:12px">
        <th colspan="15" style="text-align:left">TUNGGAKAN</th>
      </tr>
      <tr bgcolor="#ebcccc" style="color:black; font-size:12px">
        <th>TINGKAT</th>
        <th>Sebelum Juli</th>
        <th>Juli</th>
        <th>Agustus</th>
        <th>September</th>
        <th>Oktober</th>
        <th>November</th>
        <th>Desember</th>
        <th>Januari</th>
        <th>Februari</th>
        <th>Maret</th>
        <th>April</th>
        <th>Mei</th>
        <th>Juni</th>
        <th>Jumlah</th>
      </tr>
      <?php
        $tungsebelumjuli = 0;
        $tungjuli=0;
        $tungagustus=0;
        $tungseptember=0;
        $tungoktober=0;
        $tungnovember=0;
        $tungdesember=0;
        $tungjanuari=0;
        $tungfebruari=0;
        $tungmaret=0;
        $tungapril=0;
        $tungmei=0;
        $tungjuni=0;
        $tungtotaltunggakan=0;
        foreach($tunggakan as $tung){
          $tungsebelumjuli   = $tungsebelumjuli + $tung['sebelumjuli']  ;
          $tungjuli          = $tungjuli + $tung['juli'];
          $tungagustus       = $tungagustus + $tung['agustus'];
          $tungseptember     = $tungseptember + $tung['september'];
          $tungoktober       = $tungoktober + $tung['oktober'];
          $tungnovember      = $tungnovember + $tung['november'];
          $tungdesember      = $tungdesember + $tung['desember'];
          $tungjanuari       = $tungjanuari + $tung['januari'];
          $tungfebruari      = $tungfebruari + $tung['februari'];
          $tungmaret         = $tungmaret + $tung['maret'];
          $tungapril         = $tungapril + $tung['april'];
          $tungmei           = $tungmei + $tung['mei'];
          $tungjuni          = $tungjuni + $tung['juni'];
          $tungtotaltunggakan= $tungtotaltunggakan + $tung['totaltunggakan'];
      ?>
        <tr style="font-size:12px">
          <td><?php echo $tung['tingkat']; ?></td>
          <td align="right"><?php echo number_format($tung['sebelumjuli'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['juli'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['agustus'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['september'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['oktober'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['november'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['desember'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['januari'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['februari'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['maret'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['april'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['mei'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['juni'],0,'','.'); ?></td>
          <td align="right"><?php echo number_format($tung['totaltunggakan'],0,'','.'); ?></td>
        </tr>
      <?php } ?>
      <tr bgcolor="#ebcccc" style="color:black; font-size:12px; font-weight:bold">
        <td>TOTAL</td>
        <td align="right"><?php echo number_format($tungsebelumjuli,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungjuli,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungagustus,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungseptember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungoktober,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungnovember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungdesember,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungjanuari,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungfebruari,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungmaret,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungapril,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungmei,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungjuni,0,'','.'); ?></td>
        <td align="right"><?php echo number_format($tungtotaltunggakan,0,'','.'); ?></td>
      </tr>
    </table>
  </section>
  <p>**Data Tingkat Yang tidak muncul berarti belum ada mahasiswa yang registrasi di tingkat tersebut.</p>
</body>
</html>
