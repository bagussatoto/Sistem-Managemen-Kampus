<?php
error_reporting(0);
$tanggal       =  $data['tgl'];
$ncuy          =  $data['jenis'];
$namamhs       =  $data['namamhs'];
$namatingkat   =  $data['namatingkat'];
$kelas         =  $data['kelas'];
$keterangan    =  $data['keterangan'];
$terimadari=$data['terimadari'];
if ($terimadari==""){
  $terimadari=$data['namamhs'];
}

if($data['jenis']=='REGULER'){
  $konelo="Pembayaran $namatingkat $data[statuskelas] untuk $keterangan";
  $bear="$terimadari (NIM : $data[nim], Kelas :$data[kelas])";
}else{
  $konelo="$keterangan";
  $bear=$terimadari;
}

?>
<style>
body {
letter-spacing: 5px;
font-family: Arial;
font-size:13px;
}

table {
font-family: Arial;
font-size:13px;
}

.lega
{
letter-spacing: 7px;
font-family: Arial;
font-size:12px;
line-height: 1.6;
}

.garis5, .garis5 td, .garis5 tr
{
border: 2px solid black;
border-collapse:collapse;
}
</style>
<center>
<table border="0" width="93%">

<tr><td colspan="4" align="center"><div class="lega">LEMBAGA PENDIDIKAN & PENGEMBANGAN<br>PROFESI INDONESIA CABANG TASIKMALAYA<br>BUSINESS & TECHNOLOGY COLLEGE</div></td></tr>
<tr><td colspan="4" align="center"><!--<hr>--><br></td></tr>
<tr><td colspan="4" align="center">BUKTI TERIMA KAS<br><br></td></tr>
<tr><td>&nbsp;</td><td>No. BTK</td><td>:</td><td><?php echo $data['nobtk'];?></td></tr>
<tr><td>&nbsp;</td><td>Tanggal</td><td>:</td><td><?php echo DateToIndo2($data['tgl']);?></td></tr>
<tr><td>&nbsp;</td><td>Telah terima dari</td><td>:</td><td><?php echo $bear;?></td></tr>
<tr><td>&nbsp;</td><td>Uang sejumlah</td><td>:</td><td>Rp. <?php  echo number_format($data['bayar'],0,',','.');?></td></tr>
<tr><td>&nbsp;</td><td>Terbilang</td><td>:</td><td><?php echo ucwords(Terbilang($data['bayar']));?> Rupiah</td></tr>
<tr><td>&nbsp;</td><td>Untuk Pembayaran</td><td>:</td><td><?php echo $konelo;?></td></tr>
<tr><td>&nbsp;</td><td colspan="3">
<table border="2" width="95%" class="garis5">
  <tr align="center">
    <td width="20%">Kode Perkiraan</td>
    <td colspan="2" width="50%">Nama Perkiraan</td>
    <td width="30%">Jumlah</td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td colspan="2" width="50%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td colspan="2" width="50%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
  </tr>

  <tr>
    <td width="50%" colspan="2">&nbsp;</td>
    <td width="20%" align="center">Jumlah Total</td>
    <td width="20%">&nbsp;</td>
  </tr>
  <tr align="center">
    <td>&nbsp;<br><br><br><br><br></td>
    <td>Entry<br><br><br><br><br></td>
    <td>Mengetahui<br><br><br><br><br></td>
    <td>Kasir<br><br><br><br><?php echo $data['kasir'];?></td>
  </tr>
</table>

</td></table>
</center>
