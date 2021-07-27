<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <style>@page { size: A4 }</style>
  <style media="screen">
    .judul{
      font-size:14px;
      font-weight: bold;
      font-family: Tahoma;
    }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table>
      <tr>
        <td style="width:60px"><img src="<?php echo base_url(); ?>assets/images/lp3i.png" width="50px" height="50px"></td>
        <td><h3 style="font-family:Tahoma">TABEL PEROLEHAN OMSET <?php echo $kampus; ?><br>TAHUN AJARAN <?php echo $ta; ?> </h3></td>
      </tr>
    </table>
    <table class="datatable3" style="width:30%">
      <?php 
        $totalpendapatanpoltek = 0;
        $totalpoltek          = 0;
        foreach($registrasi as $d){
          $totalpendapatanpoltek = $totalpendapatanpoltek + $d->harga_deal;
          $totalpoltek = $totalpoltek + 1;
        }
      ?>
      <thead style="font-size:14px !important; font-family:Tahoma !important">
        <tr>
          <td>Target Omset Poltek</td>
          <td></td>
        </tr>
        <tr>
          <td>Perolehan Pendapatan Poltek </td>
          <td align="right"><?php  echo number_format($totalpendapatanpoltek,'0','','.'); ?></td>
        </tr>
        <tr>
          <td>Pencapaian</td>
          <td></td>
        </tr>
        <tr>
          <td>Total Pendapatan Poltek</td>
          <td align="right"><?php  echo number_format($totalpendapatanpoltek,'0','','.'); ?></td>
        </tr>

        <tr>
          <td>Rata-Rata Pendapatan Poltek</td>
          <td align="right"><?php  if(!empty($totalpoltek)){echo number_format($totalpendapatanpoltek/$totalpoltek,'0','','.');} ?></td>
        </tr>
        
      </thead>
    </table>
    <br>
    <br>
    <table class="datatable3">
      <thead style="font-size:14px !important; font-family:Tahoma !important; background-color:#71d081">
        <tr>
          <td>No</td>
          <td>Tgl Registrasi</td>
          <td>Nama Mahasiswa</td>
          <td>Program</td>
          <td>Tingkat</td>
          <td>Harga Normal</td>
          <td>Harga Deal</td>
          <td>Registrasi</td>
          <td>Keterangan</td>
        </tr>
      </thead>
      <tbody style="font-size:14px !important; font-family:Tahoma !important">
        <?php 
          $no = 1;
          
          $tingkat = "";
          foreach($registrasi as $key => $r){ 
          if ($tingkat != $r->tingkat) 
          {
            $no = 1;
            echo "
              <tr>
                <td colspan='9' style='background-color:#05307b; color:white'>$r->nama_tingkat</td>
              </tr>
            ";
          }
            
        ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $r->tgl_registrasi; ?></td>
          <td><?php echo $r->nama_lengkap; ?></td>
          <td><?php echo $r->nama_jurusan; ?></td>
          <td><?php echo strtoupper($r->nama_tingkat); ?></td>
          <td align="right"><?php echo number_format($r->biaya,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($r->harga_deal,'0','','.'); ?></td>
          <td align="right"><?php echo number_format($r->realisasi,'0','','.'); ?></td>
          <td><?php echo $r->keterangan; ?></td>
        </tr>
        <?php 
           $tingkat  = $r->tingkat;
          
        $no++;} ?>
      </tbody>
    </table>
  </section>

</body>
</html>
