<?php 
  $no = 1;
  foreach($jadwal as $d){
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->hari; ?></td>
    <td><?php echo $d->waktu; ?></td>
    <td><?php echo $d->matakuliah; ?></td>
    <td><?php echo $d->sks; ?></td>
    <td><?php echo $d->nama_lengkap; ?></td>
    <td><?php echo $d->ruangan; ?></td>
    <td>
      <a href="<?php echo base_url(); ?>pendidikan/inputpresensi/<?php echo $d->kode_jadwal; ?>"  class="btn btn-mini btn-success"><i class="ti-new-window"></i></a>
      <a href="#"  class="btn btn-mini btn-info"><i class="ti-pencil"></i></a>
      <a href="#"  class="btn btn-mini btn-danger"><i class="ti-trash"></i></a>
      <a href="#"  class="btn btn-mini btn-primary"><i class="ti-printer"></i></a>
    </td>
  </tr>
<?php 
    $no++;
  }
?>
