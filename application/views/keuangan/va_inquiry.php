<table class="table table-bordered">
  <tr>
    <td>VA</td>
    <td><?php echo $inqva['va']; ?></td>
  </tr>
  <tr>
    <td>Nama Lengkap</td>
    <td><?php echo $inqva['nama']; ?></td>
  </tr>
  <tr>
    <td>No HP</td>
    <td><?php echo $inqva['noid']; ?></td>
  </tr>
  <tr>
    <td>Tagihan</td>
    <td align="right"><?php echo number_format($inqva['tagihan'],'0','','.'); ?></td>
  </tr>
</table>
