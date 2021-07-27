<?php 
  $no = 1;
  foreach($mhs as $d){
    if($d->status_akademik=="D.O")
    {
      $color ="danger";
      $select ="selected";
      $read = "readonly";
    }else{
      $color = "success";
      $select = "";
      $read ="";
    }
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td>
      <input type="hidden" name="kodeaplikan<?php echo $no; ?>" value="<?php echo $d->kode_aplikan; ?>">
      <?php echo $d->nim; ?>
    </td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td><?php echo $d->kelas; ?></td>
    <td><label class="badge badge-<?php echo $color; ?>"><?php echo $d->status_akademik; ?></label></td>
    <td>
      <?php 
        if(!empty($d->foto_mhs))
        {
          $foto = $d->foto_mhs;
          
        }else{
          $foto = "user.jpg";
        }
       
      ?>
       <img src="<?php echo base_url(); ?>assets/images/foto_mhs/<?php echo $foto; ?>" class="img-40">
    </td>
    <td>
      <select <?php echo $read; ?> id="ket<?php echo $no; ?>" class="form-control" name="ket<?php echo $no; ?>">
        <option value="H">Hadir</option>
        <option value="I">Ijin</option>
        <option value="S">Sakit</option>
        <option value="A">Alpa</option>
        <option value="K">Kerja</option>
        <option <?php echo $select; ?> value="D">DO</option>
      </select>
    </td>
  </tr>
<?php 
    $no++;
    $jumlahmhs = $no-1;
  }
?>

<script>
  $(function(e){
    function loadjmlmhs()
    {
      var jmlmhs = "<?php echo $jumlahmhs; ?>";
      $("#jumlahmhs").val(jmlmhs);
    }

    loadjmlmhs();
  });
</script>