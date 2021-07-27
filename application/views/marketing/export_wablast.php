<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
<table class="datatable3" border="1">
  <thead>
    <tr style="font-size:12px; font-family:Tahoma; background-color:#3268a8; color:white">
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>Asal Sekolah</th>
      <th>No HP</th>
      <th>Nama Orangtua</th>
      <th>No HP Ortu</th>
      <th>Minat</th>
      <th>Penghasilan Ortu</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      foreach($wablast as $w){
    ?>
      <tr style="font-size:11px; font-family:Tahoma;">
        <td><?php echo $no; ?></td>
        <td><?php echo $w->nama_lengkap; ?></td>
        <td><?php echo $w->asal_sekolah; ?></td>
        <td><?php echo $w->no_hp; ?></td>
        <td><?php echo $w->nama_ortu; ?></td>
        <td><?php echo $w->nohp_ortu; ?></td>
        <td><?php echo $w->minat; ?></td>
        <td><?php echo $w->penghasilan_ortu; ?></td>
      </tr>
    <?php $no++; } ?>
  </tbody>
</table>
