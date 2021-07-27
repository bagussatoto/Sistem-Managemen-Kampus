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
            <li class="breadcrumb-item"><a href="#!">Input APlikan Ujian</a></li>
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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Proses Ujian</a>
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
                    <h5 class="card-header-text">Pendaftaran Aplikan</h5>
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
                            <div class="row">
                              <div class="col-lg-12 col-xl-12">
                                <form action="<?php echo base_url(); ?>marketing/insert_aplikanujian" id="frmaplikandaftar" method="post">
                                  <input type="hidden"  name="kode_aplikan" value="<?php echo $aplikan['kode_aplikan']; ?>">
                                  <fieldset class="mt-4">
                          					<legend>Data Proses Ujian</legend>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang/Tgl Datang</label>
                                      <label class="col-sm-3 col-form-label">
                                        <b><?php echo $aplikan['gelombang']."/".DateToIndo2($aplikan['tgl_datang']); ?></b>
                                      </label>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang/Tgl Daftar</label>
                                      <label class="col-sm-3 col-form-label">
                                        <b><?php echo $aplikan['gelombang_daftar']."/".DateToIndo2($aplikan['tgl_daftar']); ?></b>
                                      </label>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Tanggal Ujian</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" value="<?php echo date('Y-m-d'); ?>" placeholder="Tanggal Ujian" id="dropper-animation"  name="tgl_ujian"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang Ujian</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="hello-single" class="form-control" name="gelombangujian">
                                          <option value="">Gelombang</option>
                                          <option value="1">1</option>
                    											<option value="2">2</option>
                    											<option value="3">3</option>
                    											<option value="4">4</option>
                                        </select>
                                      </div>
                                    </div>
                                  </fieldset>
                                  <div class="form-group row mt-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-8 col-md-8 col-xs-12">
                                      <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                                      <button type="submit" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</button>
                                    </div>
                                  </div>
                                </form>
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

  <script type="text/javascript">

    $(document).ready(function() {
      $('#frmaplikandaftar').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          tgl_ujian: {
            validators: {
              notEmpty: {
                message: 'Tanggal Ujian Harus Diisi !'
              },
            }
          },
          gelombangujian: {
            validators: {
              notEmpty: {
                message: 'Gelombang Ujian Harus Diisi !'
              },
            }
          },

        }
      });

      $("#dropper-animation").dateDropper( {
        dropWidth: 200,
        init_animation: "bounce",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        format: "Y-m-d",

      });
    });

  </script>
