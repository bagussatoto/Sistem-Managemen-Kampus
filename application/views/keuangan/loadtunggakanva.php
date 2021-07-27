<?php
  $no = 0;
  $a = 1;
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
      <input type="checkbox"  name="data[]" value ="<?php echo $no; ?>" >
      <input type="hidden"  name="kodekontrak[]" value ="<?php echo $d->kode_registrasi; ?>" >
    </td>
    <td><?php echo $a; ?> </td>
    <td>
      <?php echo $d->nim; ?>
      <input type="hidden" name="nim[]" value="<?php echo $d->nim; ?>">
    </td>
    <td>
       <?php
          $tahun = substr($d->nim,0,2);
          $nim   = substr($d->nim,5,8);
          $va    = "94827902".$tahun.$nim;
          echo $va;
        ?>
        <input type="hidden" name="va[]" value="<?php echo $va; ?>">
    </td>
    <td>
      <?php echo $d->nama_lengkap; ?>
      <input type="hidden" name="namamhs[]" value="<?php echo $d->nama_lengkap; ?>">
    </td>
    <td>
      <?php echo $d->no_hp; ?>
      <input type="hidden" name="nohp[]" value="<?php echo $d->no_hp; ?>">
    </td>
    <td>
      <?php
        $hariini    = date("Y-m-d");
        $expiredate = date('Y-m-d', strtotime('+1 year', strtotime( $hariini )));
        echo $expiredate;
      ?>
      <input type="hidden" name="expiredate[]" value="<?php echo $expiredate; ?>">
    </td>
    <td>
      <?php echo "23:59:59"; ?>
      <input type="hidden" name="expiretime[]" value="23:59:59">
    </td>
    <td align="right">
      <?php echo number_format($d->sisaalltunggakan,'0','','.'); ?>
      <input type="hidden" name="sisatunggakan[]" value="<?php echo $d->sisaalltunggakan; ?>">
    </td>
  </tr>
<?php
  $no++;
  $a++;
}
$jmldata = $no-1;
?>

