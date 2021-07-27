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

    h4{
      font-family:Tahoma;
    }

    body{
      font-family:Tahoma;
    }

    p{
      font-family:tahoma;
      font-size:14px;
    }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table>
      <tr>
        <td style="width:60px"><img src="<?php echo base_url(); ?>assets/images/lp3i.png" width="50px" height="50px"></td>
        <td><h3 style="font-family:Tahoma">DAFTAR PENILAIAN PRESTASI PEKERJAAN (DP3)<br> LP3I CABANG TASIKMALAYA SEMESTER <?php echo $dp3['semester']; ?><br> TAHUN <?php echo $dp3['tahun']; ?> <br>  </h3></td>
      </tr>
    </table>
    <br>
    <table class="datatable3" style="font-size:14px; font-family:Tahoma">
      <tr>
        <td>Penilaiaan Bagi Masa Percobaan Baru</td>
        <td></td>
        <td>Lulus</td>
        <td></td>
        <td>Tidak Lulus</td>
      </tr>
      <tr>
        <td>Penilaiaan Bagi Karyawan Masa Percobaan Saat Promosi & Mutasi</td>
        <td></td>
        <td>Lulus</td>
        <td></td>
        <td>Tidak Lulus</td>
      </tr>
      <tr>
        <td>Penilaiaan Kerja Pertengahan Tahun</td>
        <td></td>
        <td>Lulus</td>
        <td></td>
        <td>Tidak Lulus</td>
      </tr>
      <tr>
        <td><b>Penilaiaan Kerja Akhir Tahun</b></td>
        <td align="center"><b>V</b></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    <h4>BAGIAN I ( Data Karyawan Yang Di Nilai )</h4>
    <table style="font-size:14px; font-family:Tahoma">
      <tr>
        <td>Nama Karyawan</td>
        <td>:</td>
        <td><?php echo $dp3['nama_karyawan']; ?></td>
      </tr>
      <tr>
        <td>Nomor Karyawan</td>
        <td>:</td>
        <td><?php echo $dp3['nik']; ?></td>
      </tr>
      <tr>
        <td>Posisi / Grading</td>
        <td>:</td>
        <td><?php echo $dp3['jabatan']; ?></td>
      </tr>
      <tr>
        <td>Departemen Kerja</td>
        <td>:</td>
        <td><?php echo $dp3['kode_divisi']; ?></td>
      </tr>
      <tr>
        <td>Tanggal Bergabung</td>
        <td>:</td>
        <td><?php echo $dp3['tgl_bergabung']; ?></td>
      </tr>
    <table>
    <hr>
    <h4>BAGIAN II ( Penilaian Kinerja )</h4>
    <table class="datatable3" style="font-size:13px; font-family:Tahoma; width:100%; border-top:none !important; border-bottom:none !important; border-right:none !important">
      <tr>
        <td style="text-align:center; font-weight:bold">5</td>
        <td style="border:none; !important"><i>Baik</i></td>
        <td style="text-align:center; font-weight:bold">2</td>
        <td style="border:none; !important"><i>Dibawah Rata rata</i></td>
      </tr>
      <tr>
        <td style="text-align:center; font-weight:bold">4</td>
        <td style="border:none; !important"><i>Diatas Rata Rata</i></td>
        <td style="text-align:center; font-weight:bold">1</td>
        <td style="border:none; !important"><i>Tidak Memuaskan (Buruk) Tidak Perlu dilakukan Asessment</i></td>
      </tr>
      <tr>
        <td style="text-align:center; font-weight:bold">3</td>
        <td style="border:none; !important"><i>Rata Rata</i></td>
      </tr>
    </table>
    <br>
    <p style="font-size:14px">(*) Point no 3.3 dan 3.4 jangan diisi (diisi oleh bagian HRD, sesuai dengan data yang ada)	</p>
    <p style="font-weight:bold; font-size:14px"><i>Berilah tanda V pada kolom kotak diatas sesuai dengan kategori penilaian</i></p>
    <table class="datatable3" style="font-size:14px; font-family:Tahoma" >
    <?php 
      $a   =1;
      $no = 1;
      $totalnilai = 0;
      $kategori = "";
      foreach($q as $d){
        $getpiljawaban = $this->db->get_where('dp3_piljawaban',array('id_pertanyaan'=>$d->id_pertanyaan))->result();
        $jawaban = $this->db->get_where('dp3_detailkaryawan',array('id_dp3'=>$iddp3,'id_pertanyaan'=>$d->id_pertanyaan))->row_array();
        //echo $jawaban['id_piljawaban'];
        if($kategori !=$d->kode_kategori){
         
          echo "<tr><td colspan='3' style='background-color:#05307b; color:white'><b>$a. $d->nama_kategori</b></td></tr>";
          $a++;
        }
    ?>
      <tr style='background-color:#f3f3f3;'>
        <td style="font-weight:bold; text-align:center"><?php echo $no; ?></td>
        <td style='background-color:#f3f3f3;'><b><?php  echo $d->pertanyaan;?><b></td>
      </tr>
      <?php 
        
        foreach($getpiljawaban as $j){
          if($jawaban['id_piljawaban']==$j->id_piljawaban){$totalnilai = $totalnilai + $j->nilai; }
      ?>
        <tr>
          <td style="width:1px"  bgcolor="<?php if($jawaban['id_piljawaban']==$j->id_piljawaban){echo "#a2a4a7"; } ?>" ><?php echo $j->nilai; ?></td>
          <td><?php echo $j->pil_jawaban; ?></td>
        </tr>
      <?php 
          $kategori = $d->kode_kategori;
        }
      ?>
    <?php
        
        $no++; 
      }
    ?>
    </table>
    <br>
    <br>
    <table  style="font-size:14px; font-family:Tahoma">
      <tr>
        <td>Jumlah  Penilaian Keseluruhan</td>
        <td></td>
        <td>angka 1.1 s/d angka 3.5</td>
      </tr>
      <tr>
        <td>(Jumlah keseluruhan nilai kemudian dibagi dengtan 12)	</td>
        <td></td>
        <td><?php echo $totalnilai; ?>/12=<b><?php echo number_format($totalnilai/12,'2',',','.'); ?></b></td>
      </tr>
      <tr>
        <td>Konversi hasil penilaian terakhir:	</td>
        <td></td>
        <td>
          <b>
          <?php
            $konversi = ($totalnilai/12) / 5 * 100;
            echo number_format($konversi,'2',',','.'); 
          ?>
          </b>
        </td>
      </tr>
    </table>
    <p style="font-size:14px; font-family:Tahoma">Perolehan keseluruhan dikonversikan dengan rumus : Besaran nilai terakhir dibagi 5 kali 100
       Misal : seorang staf dengan penilaian terakhir 4.20, hasil konversi:
       4,20/5 x 100 =84.00
    </p>
    <p style="font-size:14px; font-family:Tahoma">Penilaian Terakhir</p>
    <table class="datatable3" style="font-size:14px; font-family:Tahoma">
      <tr bgcolor="#a2a4a7" style="font-weight:bold">
        <td>Tandai</td>
        <td>Besaran Nilai <Br> Terakhir</td>
        <td colspan="2">Konversi</td>
        <td>Deskripsi Hasil Penilaian Akhir</td>
        <td>Paraf</td>
      </tr>
      <tr>
        <td align="center">
          <?php 
            if($konversi >= 94 && $konversi <=100){echo "&#10004";  }
          ?>
        </td>
        <td>4,70 s/d 5.00</td>
        <td>94,00 -100,</td>
        <td>A</td>
        <td>Konsisten untuk lebih dari yang dipersyaratkan atas tugas dan jabatannya, dan senantiasa proactive untuk mengembangkan diri</td>
        <td></td>
      </tr>
      <tr>
        <td align="center">
          <?php 
            if($konversi >= 74 && $konversi <=93.99){echo "&#10004";  }
          ?>
        </td>
        <td>3.70 s/d 4.69</td>
        <td>74.00 -93.99</td>
        <td>B</td>
        <td>Kinerjanya berjalan dengan baik dan senantiasa melebihi persyaratan yang diberikan</td>
        <td></td>
      </tr>
      <tr>
        <td align="center">
          <?php 
            if($konversi >= 54 && $konversi <=73.99){echo "&#10004";  }
          ?>
        </td>
        <td>2.70 s/d 3.69</td>
        <td>54.00 – 73.99</td>
        <td>C</td>
        <td>Biasanya memenuhi persyaratan tugas yang diberi namun cenderung reaktif dalam kerja, perlu bimbingan dalam hal-hal tertentu</td>
        <td></td>
      </tr>
      <tr>
        <td align="center">
        <?php 
            if($konversi >= 34 && $konversi <=53.99){echo "&#10004";  }
          ?>
        </td>
        <td>1.70 s/d 2.69</td>
        <td>34.00 – 53.99</td>
        <td>D</td>
        <td>Terkadang hasil kerjanya kurang memenuhi persyaratan tugas yang diberi, senantiasa perlu didikte dan sering berbuat kesalahan </td>
        <td></td>
      </tr>
      <tr>
        <td align="center">
        <?php 
            if($konversi >= 20 && $konversi <=33.99){echo "&#10004";  }
          ?>
        </td>
        <td>1.00 s/d 1.69</td>
        <td>20.00 – 33.99</td>
        <td>E</td>
        <td>Secara nyata tidak sesuai dengan kualifikasi, tidak memiliki keinginan untuk memperbaiki diri, reaktif dan perlu dorongan berlebihan selalu berbuat kesalahan yang tidak perlu </td>
        <td></td>
      </tr>
    </table>
    <h4>Evaluasi Kualitatif - Wawancara</h4>
    <p>Alasan yang diberikan harus relevan dengan beberapa faktor yang terbaik atau terburuk hasil Penilaian 
      Nilai Positif (Kelebihan ) yang diperlihatkan :
    </p>
    <p style="font-weight:bold"><?php echo $evaluasi['nilai_positif']; ?></p>
    <br>
    <p>Nilai Negatif (Kelemahan) yang diperhatikan : </p>
    <p style="font-weight:bold"><?php echo $evaluasi['nilai_negatif']; ?></p>
    <br>
    <p>Komentar </p>
    <p style="font-weight:bold"><?php echo $evaluasi['komentar']; ?></p>
    <br>
    <p>Rekomendasi </p>
    <p style="font-weight:bold"><?php echo $evaluasi['rekomendasi']; ?></p>
    <br>
    <p>Rekomendasi Akhir </p>
    <p style="font-weight:bold"></p>
    <br>
    <br>

    <table style="font-size:14px; font-family:Tahoma"> 
      <tr>
        <td align="center">
          Tasikmalaya, <?php echo DateToIndo2(date("Y-m-d")); ?>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <b>H. Rudi Kurniawan,ST.,MM</b>
        </td>
      </tr>
    </table>
  </section>

</body>
</html>
