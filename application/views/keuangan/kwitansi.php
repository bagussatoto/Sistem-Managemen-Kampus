<style>
body {
	letter-spacing: 5px;
	font-family: Arial;
	font-size:13px;
}
table {
	font-family: Arial;
	font-size:13px;
	border-collapse:collapse;
}
</style>

<?php
if($kw['jenis']=='REGULER'){
  if($kw['tingkat']=="3"){
    $konelo="Pembayaran ". $kw['nama_jurusan']. "untuk ". $kw['keterangan'];
  }else{
    $konelo="Pembayaran tingkat ". $kw['nama_tingkat']. "untuk ". $kw['keterangan'];
  }
  //$konelo="Pembayaran $namatingkat untuk $keterangan";

}else{
  $konelo=$kw['keterangan'];
}
?>
<table width="100%" bordercolor="#000000" class="garis3">
  <tr>
    <td colspan="2" align="center"><font size="4">BUKTI TANDA TERIMA <br> PEMBAYARAN BIAYA PENDIDIKAN <br> LP3I TASIKMALAYA</font></td>
    <td width="40%">
&nbsp;No Kwitansi : <?php echo $kw['nobukti'];?><br>

<?php
$nobtk=$kw['nobtk'];
$nobtb=$kw['nobtb'];

if ($nobtb=="0" || $nobtb==""){
?>
&nbsp;No BTK : <?php echo $kw['nobtk'];?>
<?php
} else if ($nobtk=="0" || $nobtk==""){
?>
&nbsp;No BTB : <?php echo $kw['nobtb'];?>
<?php
}
?>



    </td>
  </tr>
  <tr>
  <tr>
    <td colspan="4" align="center">KAMPUS LP3I TASIKMALAYA : Jl. Ir. H. Djuanda (By Pass) No. 106 KM 2 Rancabango Telp. (0265) 311766</td>
</tr>
<tr>
    <td colspan="4" align="center"><br><br>&nbsp;URAIAN SETORAN</td>
  </tr>
<tr>
<td colspan="4">
<table border="0">
<tr><td><font color="FFFFFF">AAAAAA</font></td><td>Tanggal</td><td>:</td><td><?php echo DateToIndo2($kw['tgl']); ?></td></tr>
<tr><td><font color="FFFFFF">AAAAAA</font></td><td>Telah terima dari</td><td>:</td><td>
<?php if($jn==""){
?>
<?php echo $kw['terimadari'];?> (No Induk :, Kelas :<?php echo $kw['kelas'];?>)
<?php
}else if($jn=="II"){
echo $kw['terimadari'];
}
?>
</td></tr>
<tr><td><font color="FFFFFF">AAAAAA</font></td><td>Uang sejumlah</td><td>:</td><td>Rp. <?php  echo number_format($kw['bayar'],0,',','.');?></td></tr>
<tr><td><font color="FFFFFF">AAAAAA</font></td><td>Terbilang</td><td>:</td><td><?php echo ucwords(terbilang($kw['bayar']));?> Rupiah</td></tr>
<tr><td><font color="FFFFFF">AAAAAA</font></td><td>Untuk Pembayaran</td><td>:</td><td><?php echo $konelo;?></td></tr></table>
</td>
</tr>
  <tr>
    <td colspan="2">

    &nbsp;&nbsp;&nbsp;Keterangan :<br>
    &nbsp;&nbsp;&nbsp;1. Lembar ke-1 (satu) untuk Penyetor<br>
    &nbsp;&nbsp;&nbsp;2. Lembar ke-2 (dua) untuk Bag. Keuangan LP3I Tasikmalaya<br>

<br>
<br>

</td>
    <td colspan="2"><table width="100%" border="0" bordercolor="#000000" class="garis">
      <tr>
        <td align="center"><br><br><br>Staff Keuangan</td>
      </tr>
      <tr>
        <td ><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td align="center">(<?php echo $kw['kasir'];?>)</td>
      </tr>
    </table></td>
  </tr>
</table>
