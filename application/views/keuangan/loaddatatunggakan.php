<?php
  $no = 1;
  $totaltunggakan = 0;
  $totalalltunggakan = 0;
  foreach($cetak0 as $d){


    if($d->sisatunggakan < 0)
    {
      $sisatunggakan = 0;
    }else{
      $sisatunggakan = $d->sisatunggakan;
    }

    $totaltunggakan = $totaltunggakan + $sisatunggakan;
    $totalalltunggakan = $totalalltunggakan + $d->sisaalltunggakan;
?>
  <tr>
    <td>
      <?php if($sisatunggakan !=0 AND $surat=='1' OR $surat=='2'){ ?>
        <input type="checkbox"  name="kodekontrak[]" value ="<?php echo $d->kode_registrasi; ?>" >
      <?php } ?>
    </td>
    <td><?php echo $d->nim; ?></td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td><?php echo $d->no_hp; ?></td>
    <td><?php echo $d->status_akademik; ?></td>
    <td align="right"><?php echo number_format($sisatunggakan,'0','','.'); ?></td>
    <td align="right"><?php echo number_format($d->sisaalltunggakan,'0','','.'); ?></td>
  </tr>
<?php
  $no++;
}
?>
<tr style="background-color:#dff0d8"; style="color:white;">
  <td colspan="5"><b>TOTAL</b></td>
  <td align="right"><b><?php echo number_format($totaltunggakan,'0','','.'); ?></b></td>
  <td align="right"><b><?php echo number_format($totalalltunggakan,'0','','.'); ?></b></td>
</tr>
