<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Aplikan</h4>
            <span>Aplikan</span>
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
            <li class="breadcrumb-item"><a href="#!">Detail Aplikan</a></li>
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
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="cover-profile">
              <div class="profile-bg-img">
                <img class="profile-bg-img img-fluid" src="<?php echo base_url(); ?>assets\images\user-profile\bg.jpg" alt="bg-img">
                <div class="card-block user-info">
                  <div class="col-md-12">
                    <div class="media-left">
                      <a href="#" class="profile-image">
                        <img class="user-img img-radius" src="<?php echo base_url(); ?>assets\images\user-profile\user-img.jpg" alt="user-img">
                      </a>
                    </div>
                    <div class="media-body row">
                      <div class="col-lg-12">
                        <div class="user-title">
                          <h2><?php echo $aplikan['nama_lengkap']; ?></h2>
                          <span class="text-white"><?php echo $aplikan['nama_jurusan']; ?></span>
                        </div>
                      </div>
                      <div>
                        <div class="pull-right cover-btn">
                          <a href="<?php echo base_url(); ?>marketing/editaplikan/<?php echo $aplikan['kode_aplikan']; ?>" class="btn btn-primary m-r-10 m-b-5"><i class="icofont icofont-pencil-alt-1"></i> Edit Data Aplikan</a>
                          <a href="#" class="btn btn-danger"><i class="icofont icofont-trash"></i> Hapus Data Aplikan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <!-- tab header start -->
            <div class="tab-header card">
              <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Data Aplikan</a>
                  <div class="slide"></div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#orantua" role="tab">Data Orangtua / Wali</a>
                  <div class="slide"></div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#pendaftaran" role="tab">Data Pendaftaran</a>
                  <div class="slide"></div>
                </li>

              </ul>
            </div>
            <div class="tab-content">
              <!-- tab panel personal start -->
              <div class="tab-pane active" id="personal" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Aplikan</h5>
                  </div>
                  <div class="card-block">
                    <div class="view-info">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="general-info">
                            <div class="row">
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Nama Lengkap</th>
                                        <td><?php echo $aplikan['nama_lengkap']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tempat/Tanggal Lahir</th>
                                        <td><?php echo $aplikan['tempat_lahir']."/".DateToIndo2($aplikan['tgl_lahir']); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Jenis Kelamin</th>
                                        <td><?php if($aplikan['jenis_kelamin']=="L"){echo "Laki-Laki";}else{echo "Perempuan";}; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Dusun</th>
                                        <td><?php echo $aplikan['dusun']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">RT/RW</th>
                                        <td><?php echo $aplikan['rtrw']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kecamatan</th>
                                        <td><?php echo $aplikan['kecamatan']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kabupaten/Kota</th>
                                        <td><?php echo $aplikan['kota']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kode POS</th>
                                        <td><?php echo $aplikan['kode_pos']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">No HP</th>
                                        <td><?php echo $aplikan['no_hp']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Pendidikankan Terakhir</th>
                                        <td><?php echo $aplikan['pendidikan_terakhir']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Asal Sekolah</th>
                                        <td><?php echo $aplikan['asal_sekolah']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Jurusan</th>
                                        <td><?php echo $aplikan['jurusan_sekolah']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tahun Lulus</th>
                                        <td><?php echo $aplikan['tahun_lulus']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Whatsapp</th>
                                        <td><?php echo $aplikan['whatsapp']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Instagram</th>
                                        <td><?php echo $aplikan['instagram']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Facebook</th>
                                        <td><?php echo $aplikan['facebook']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="orantua" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Orangtua / Wali</h5>
                  </div>
                  <div class="card-block">
                    <div class="view-info">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="general-info">
                            <div class="row">
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Nama Orangtua / Wali</th>
                                        <td><?php echo $aplikan['nama_ortu']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Pekerjaan Orangtua</th>
                                        <td><?php echo $aplikan['pekerjaan_ortu']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Penghasilan Orangtua</th>
                                        <td><?php echo $aplikan['penghasilan_ortu']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">No HP Orangtua</th>
                                        <td><?php echo $aplikan['nohp_ortu']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="pendaftaran" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Pendaftaran</h5>
                  </div>
                  <div class="card-block">
                    <div class="view-info">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="general-info">
                            <div class="row">
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Jurusan</th>
                                        <td><?php echo $aplikan['nama_jurusan']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Sumber Informasi</th>
                                        <td><?php echo $aplikan['sumber_informasi']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Sumber Aplikan</th>
                                        <td><?php echo $aplikan['sumber_aplikan']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Presenter</th>
                                        <td><?php echo $aplikan['nama_presenter']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tanggal Datang</th>
                                        <td><?php echo DateToIndo2($aplikan['tgl_datang']); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Gelombang Datang</th>
                                        <td><?php echo $aplikan['gelombang']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
        <?php
         $this->load->view('marketing/menu_aplikansiswa');
        ?>
      </div>
    </div>
  </div>
