<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Aplikan & Siswa</h4>
            <span>Aplikan & Siswa</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="index-1.htm">
                <i class="icofont icofont-home"></i>
              </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Marketing</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Aplikan & Siswa</a></li>
            <li class="breadcrumb-item"><a href="#!">Import Siswa</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12">
        <!-- Default card start -->
        <div class="card">
          <div class="card-header">
            <h5>Import Database Siswa </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url("marketing/importsiswa"); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-sm-6">
                  <input type="file" required name="file" class="form-control">
                </div>
                <div class="col-sm-4">
                  <input type="submit" name="preview" value="Preview"/ class="btn btn-primary">
                </div>
            </div>
            </form>
            <?php
            if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
              if(isset($upload_error)){ // Jika proses upload gagal
                echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
                die; // stop skrip
              }
              // Buat sebuah tag form untuk proses import data ke database
              echo "<form method='post' action='".base_url("marketing/importdata")."'>";
              // Buat sebuah div untuk alert validasi kosong
              echo "
                <div class='card bg-c-pink order-card' id='kosong'>
                  <div class='card-block'>
                    <h6><i class='ti-info'></i>Ada <span id='jumlah_kosong'></span> data yang belum diisi. !</h6>
                  </div>
                </div>
              ";
              echo
              "
              <div class='table-responsive'>
              <table class='table table-bordered  table-hover table-sm'>
              <tr>
                <th colspan='5'>Preview Data</th>
              </tr>
              <tr>
                <th>Kode Siswa</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tgl Lahir</th>
                <th>JK</th>
                <th>Dusun</th>
                <th>RT/RW</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kota</th>
                <th>Kode POS</th>
                <th>No HP</th>
                <th>Whatsapp</th>
                <th>Facebook</th>
                <th>Instagram</th>
                <th>Pendidikan</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Tahun Lulus</th>
                <th>Email</th>
                <th>Nama Ortu</th>
                <th>Pekerjaan</th>
                <th>Penghasilan</th>
                <th>No HP</th>
                <th>Presenter</th>
                <th>Folder</th>
              </tr>";
              $numrow = 1;
              $kosong = 0;
              // Lakukan perulangan dari data yang ada di excel
              // $sheet adalah variabel yang dikirim dari controller
              foreach($sheet as $row){
                // Ambil data pada excel sesuai Kolom
                $nis           = $row['A'];
                $nama          = $row['B'];
                $tempatlahir   = $row['C'];
                $tgllahir      = $row['D'];
                $jk            = $row['E'];
                $dusun         = $row['F'];
                $rtrw          = $row['G'];
                $kelurahan     = $row['H'];
                $kecamatan     = $row['I'];
                $kota          = $row['J'];
                $kodepos       = $row['K'];
                $no_hp         = $row['L'];
                $whatsapp      = $row['M'];
                $facebook      = $row['N'];
                $instagram     = $row['O'];
                $pendidikan    = $row['P'];
                $asalsekolah   = $row['Q'];
                $jurusan       = $row['R'];
                $tahunlulus    = $row['S'];
                $email         = $row['T'];
                $namaortu      = $row['U'];
                $pekerjaan     = $row['V'];
                $penghasilan   = $row['W'];
                $nohportu      = $row['X'];
                $presenter     = $row['Y'];
                $folder        = $row['Z'];
                // Cek jika semua data tidak diisi
                if(empty($nis) && empty($nama) && empty($tempatlahir) && empty($tgllahir) && empty($jk) && empty($dusun) && empty($rtrw) && empty($kelurahan)
                && empty($kecamatan) && empty($kota) && empty($kodepos) && empty($no_hp) && empty($whatsapp) && empty($facebook) && empty($instagram)
                && empty($pendidikan) && empty($asalsekolah) && empty($jurusan)
                && empty($tahunlulus) && empty($email) && empty($namaortu) && empty($penghasilan)
                && empty($nohportu) && empty($presenter) && empty($folder) && empty($pekerjaan))
                  continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if($numrow > 1){
                  // Validasi apakah semua data telah diisi
                  $nis_td         = (!empty($nis))? "" : " style='background: #E07171;'";
                  $nama_td        = (!empty($nama))? "" : " style='background: #E07171;'";
                  $tempatlahir_td = (!empty($tempatlahir))? "" : " style='background: #E07171;'";
                  $tgllahir_td    = (!empty($tgllahir))? "" : " style='background: #E07171;'";
                  $jk_td          = (!empty($jk))? "" : " style='background: #E07171;'";
                  $dusun_td       = (!empty($dusun))? "" : " style='background: #E07171;'";
                  $rtrw_td        = (!empty($rtrw))? "" : " style='background: #E07171;'";
                  $kelurhan_td    = (!empty($kelurahan))? "" : " style='background: #E07171;'";
                  $kecamatan_td   = (!empty($kecamatan))? "" : " style='background: #E07171;'";
                  $kota_td        = (!empty($kota))? "" : " style='background: #E07171;'";
                  $kodepos_td     = (!empty($kodepos))? "" : " style='background: #E07171;'";
                  $no_hp_td       = (!empty($no_hp))? "" : " style='background: #E07171;'";
                  $whatsapp_td    = (!empty($whatsapp))? "" : " style='background: #E07171;'";
                  $facebook_td    = (!empty($facebook))? "" : " style='background: #E07171;'";
                  $instagram_td   = (!empty($instagram))? "" : " style='background: #E07171;'";
                  $pendidikan_td  = (!empty($pendidikan))? "" : " style='background: #E07171;'";
                  $asalsekolah_td = (!empty($asalsekolah))? "" : " style='background: #E07171;'";
                  $jurusan_td     = (!empty($jurusan))? "" : " style='background: #E07171;'";
                  $tahunlulus_td  = (!empty($tahunlulus))? "" : " style='background: #E07171;'";
                  $email_td       = (!empty($email))? "" : " style='background: #E07171;'";
                  $namaortu_td     = (!empty($namaortu))? "" : " style='background: #E07171;'";
                  $pekerjaan_td   = (!empty($pekerjaan))? "" : " style='background: #E07171;'";
                  $penghasilan_td = (!empty($penghasilan))? "" : " style='background: #E07171;'";
                  $nohportu_td    = (!empty($nohportu))? "" : " style='background: #E07171;'";
                  $presenter_td   = (!empty($presenter))? "" : " style='background: #E07171;'";
                  $folder_td      = (!empty($folder))? "" : " style='background: #E07171;'";
                  // Jika salah satu data ada yang kosong
                  if(empty($nis) OR empty($nama) OR empty($tempatlahir) OR empty($tgllahir) OR empty($jk) OR empty($dusun) OR empty($rtrw) OR empty($kelurahan)
                  OR empty($kecamatan) OR empty($kota) OR empty($kodepos) OR empty($no_hp) OR empty($whatsapp) OR empty($facebook) OR empty($instagram)
                  OR empty($pendidikan) OR empty($asalsekolah) && empty($jurusan)
                  OR empty($tahunlulus) OR empty($email) OR empty($namaortu) OR empty($penghasilan)
                  OR empty($nohportu) OR empty($presenter) OR empty($folder) OR empty($pekerjaan)){
                    $kosong++; // Tambah 1 variabel $kosong
                  }
                  echo "<tr>";
                  echo "<td".$nis_td.">".$nis."</td>";
                  echo "<td".$nama_td.">".$nama."</td>";
                  echo "<td".$tempatlahir_td.">".$tempatlahir."</td>";
                  echo "<td".$tgllahir_td.">".$tgllahir."</td>";
                  echo "<td".$jk_td.">".$jk."</td>";
                  echo "<td".$dusun_td.">".$dusun."</td>";
                  echo "<td".$rtrw_td.">".$rtrw."</td>";
                  echo "<td".$kelurhan_td.">".$kelurahan."</td>";
                  echo "<td".$kecamatan_td.">".$kecamatan."</td>";
                  echo "<td".$kota_td.">".$kota."</td>";
                  echo "<td".$kodepos_td.">".$kodepos."</td>";
                  echo "<td".$no_hp_td.">".$no_hp."</td>";
                  echo "<td".$whatsapp_td.">".$whatsapp."</td>";
                  echo "<td".$facebook_td.">".$facebook."</td>";
                  echo "<td".$instagram_td.">".$instagram."</td>";
                  echo "<td".$pendidikan_td.">".$pendidikan."</td>";
                  echo "<td".$asalsekolah_td.">".$asalsekolah."</td>";
                  echo "<td".$jurusan_td.">".$jurusan."</td>";
                  echo "<td".$tahunlulus_td.">".$tahunlulus."</td>";
                  echo "<td".$email_td.">".$email."</td>";
                  echo "<td".$namaortu_td.">".$namaortu."</td>";
                  echo "<td".$pekerjaan_td.">".$pekerjaan."</td>";
                  echo "<td".$penghasilan_td.">".$penghasilan."</td>";
                  echo "<td".$nohportu_td.">".$nohportu."</td>";
                  echo "<td".$presenter_td.">".$presenter."</td>";
                  echo "<td".$folder_td.">".$folder."</td>";
                  echo "</tr>";
                }

                $numrow++; // Tambah 1 setiap kali looping
              }

              echo "</table></div>";
              echo "<input type='hidden' id='ksg' name='kosong' value=$kosong>";
              //echo $kosong;
              // Cek apakah variabel kosong lebih dari 0
              // Jika lebih dari 0, berarti ada data yang masih kosong
              if($kosong > 0){
              ?>
              <?php
              }else{ // Jika semua data sudah diisi
                echo "<hr>";
                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' class='btn btn-info' name='import'><i class ='ti-import'></i> Import</button>";
                echo "<a href='".base_url("marketing/dbsekolah")."' class='btn btn-danger'>Cancel</a>";
              }
              echo "</form>";
            }
            ?>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('marketing/menu_aplikansiswa');
        ?>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $("#kosong").hide();
    var ksg = $("#ksg").val();
    if(parseInt(ksg)>0){
      $("#kosong").show();
      $("#jumlah_kosong").html('<?php echo $kosong; ?>');
    }
  </script>
