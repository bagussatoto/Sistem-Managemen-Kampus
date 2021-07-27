<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Input Data Dosen</h4>
            <span>Input Data Dosen</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Dosen</a></li>
            <li class="breadcrumb-item"><a href="#!">Input Data Dosen</a></li>
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
            <h5>Input Data Dosen</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>pendidikan/insertdosen" id="frmaplikan" method="post">
              <fieldset class="mb-4">
      					<legend>Data Profil Dosen</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kode Dosen</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Kode Dosen"  name="kodedosen" id="kodedosen" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10 col-md-10 col-xs-12">
                    <input type="text" placeholder="Nama Lengkap"  name="namalengkap" id="namalengkap" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="Tempat Lahir"  name="tempatlahir" id="tempatlahir" class="form-control">
                  </div>
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <select id="hello-single" class="form-control" name="tgllahir">
                      <option value="">Tanggal</option>
                      <?php
                        for($i=1; $i<=31; $i++)
                        {
                      ?>
                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="bulanlahir">
                      <option value="">Bulan</option>
                      <?php
                        for($i=1; $i<count($bulan); $i++){
                      ?>
                        <option value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <input type="text" placeholder="Tahun" name="tahunlahir" id="tahunlahir" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="jk">
                      <option value="">Jenis Kelamin</option>
                      <option value="L">Laki - Laki</option>
											<option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10 col-md-10 col-xs-12">
                    <input type="text" placeholder="Alamat Lengkap"  name="alamat" id="alamat" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kontak</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="No HP"  name="nohp" id="nohp" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" placeholder="Email"  name="email" id="email" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status Dosen</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="statusdosen">
                      <option value="Full-time">Full-Time</option>
                      <option value="Part-time">Part-ime</option>
											<option value="Koordinator">Koordinator</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">PAI</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="pai">
                      <option value="N">N</option>
                      <option value="Y">Y</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">NPWP</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="NPWP"  name="npwp" id="npwp" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Honor</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" style="text-align:right" placeholder="Honor"  name="honor" id="honor" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kewajiban Mengajar</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" style="text-align:right" placeholder="Kewajiban Mengajar"  name="kewajiban" id="kewajiban" class="form-control">
                  </div>
                </div>
      				</fieldset>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                  <button type="submit" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</button>
                </div>
              </div>
            </form>
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
  <script type="text/javascript">

    $(document).ready(function() {
      $('#frmaplikan').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          kodedosen: {
            validators: {
              notEmpty: {
                message: 'Kode Dosen Harus Diisi !'
              },
            }
          },
          namalengkap: {
            validators: {
              notEmpty: {
                message: 'Nama Lengkap Harus Diisi !'
              },
            }
          },

          tempatlahir: {
            validators: {
              notEmpty: {
                message: 'Tempat Lahir Harus Diisi !'
              }
            }
          },

          tgllahir: {
            validators: {
              notEmpty: {
                message: 'Tanggal Lahir Harus Diisi !'
              }
            }
          },
          bulanlahir: {
            validators: {
              notEmpty: {
                message: 'Bulan  Lahir Harus Diisi !'
              }
            }
          },
          tahunlahir: {
            validators: {
              notEmpty: {
                message: 'Tahun Lahir Harus Diisi !'
              },
              stringLength: {
                min: 4,
                max: 4,
                message: 'Tahun Lahir Harus 4 Karakter ex. 1993'
              },
              regexp: {
                  regexp: /^[0-9]+$/,
                  message: 'Harus Angka !'
              }
            }
          },

          
          jk: {
            validators: {
              notEmpty: {
                message: 'Jenis Kelamin Harus Diisi !'
              }
            }
          },
          alamat: {
            validators: {
              notEmpty: {
                message: 'Alamat Harus Diisi !'
              }
            }
          },

         

          nohp: {
            validators: {
              notEmpty: {
                message: 'No HP Harus Diisi !'
              },
              regexp: {
                  regexp: /^[0-9]+$/,
                  message: 'Harus Angka !'
              }
            }
          },

          statusdosen: {
            validators: {
              notEmpty: {
                message: 'Status Dosen Harus Diisi !'
              },
            }
          },

          pai: {
            validators: {
              notEmpty: {
                message: 'PAI Harus Diisi !'
              },
            }
          },

          npwp: {
            validators: {
              notEmpty: {
                message: 'NPWP Harus Diisi !'
              },
            }
          },

          honor: {
            validators: {
              notEmpty: {
                message: 'Honor Harus  Diisi !'
              },
              regexp: {
                  regexp: /^[0-9]+$/,
                  message: 'Harus Angka !'
              }
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
      })
      $(".js-example-basic-single").select2();
    });

  </script>
