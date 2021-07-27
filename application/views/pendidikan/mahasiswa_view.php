<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Mahasiswa</h4>
            <span>Data Mahasiswa</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Mahasiswa</a></li>
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
            <b>Data Kelas</b>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $nama_mhs; ?>" name="nama_mhs" id="nama_mhs" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="jurusan">
                    <option value="">Semua Jurusan</option>
                    <?php
                      foreach ($jurusan as $m){
                    ?>
                      <option <?php if($jr==$m->kode_jurusan){echo "selected";} ?> value="<?php echo $m->kode_jurusan; ?>"><?php echo $m->nama_jurusan; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Angkatan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single2" class="form-control" name="tahun_angkatan">
                    <?php
                      foreach ($ta as $t){
                    ?>
                      <option <?php if($tahun_angkatan == $t->tahun_akademik){echo "selected";} ?> value="<?php echo $t->tahun_akademik; ?>"><?php echo $t->tahun_akademik; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Mahaiswa</button>
                </div>
              </div>
            </form>
            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Mahasiswa Tahun Angkatan <b><?php echo $tahun_angkatan; ?></b></p>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d)
                    {
                  ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><a href="<?php echo base_url(); ?>pendidikan/detailmahasiswa/<?php echo $d['kode_aplikan']; ?>" style="color:#01a9ac"><?php echo $d['nim']; ?></a></td>
                      <td><?php echo $d['nama_lengkap']; ?></td>
                      <td><?php echo $d['nama_jurusan']; ?></td>
                      <td><?php echo $d['kelas']; ?></td>
                      <td><?php echo $d['no_hp']; ?></td>
                      <td><?php echo $d['status']; ?></td>
                      <td><?php echo $d['status_akademik']; ?></td>
                    </tr>
                  <?php
                      $sno++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <hr>
           
           
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('pendidikan/menu_master');
        ?>
      </div>
    </div>
  </div>
  