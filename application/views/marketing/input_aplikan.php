<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Input Data Aplikan</h4>
            <span>Input Data Aplikan</span>
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
            <li class="breadcrumb-item"><a href="#!">Input Data Aplikan</a></li>
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
            <h5>Input Data Aplikan Tahun Akademik <?php echo $ta; ?> </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/insert_aplikan" id="frmaplikan" method="post">
              <input type="hidden" name="ta_mkt" value="<?php echo $ta; ?>">
              <input type="hidden" name="kode_siswa" value="">
              <fieldset class="mb-4">
      					<legend>Data Profil Aplikan</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Nama Lengkap"  name="namalengkap" id="namalengkap" class="form-control">
                  </div>
                  <div class="col-sm-1 col-md-1 col-xs-12">
                    <select id="hello-single" class="form-control" name="tgldatang">
                      <option value="">Tgl</option>
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
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <select id="hello-single" class="form-control" name="bulandatang">
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
                    <input type="text" placeholder="Tahun" name="tahundatang" id="tahundatang" class="form-control">
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
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="Dusun/Kp"  name="dusun" id="dusun" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="RT/RW"  name="rtrw" id="rtrw" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="Kelurahan"  name="kelurahan" id="kelurahan" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="Kecamatan"  name="kecamatan" id="kecamatan" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="kota">
                      <option value="KOTA TASIKMALAYA">KOTA TASIKMALAYA</option>
											<option value="KABUPATEN TASIKMALAYA">KABUPATEN TASIKMALAYA</option>
											<option value="KABUPATEN CIAMIS">KABUPATEN CIAMIS</option>
											<option value="KOTA BANJAR">KOTA BANJAR</option>
											<option value="PANGANDARAN">PANGANDARAN</option>
											<option value="GARUT">GARUT</option>
											<option value="LUAR PULAU">LUAR PULAU</option>
                    </select>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="Kode Pos" name="kodepos" id="kodepos" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kontak</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="No HP"  name="nohp" id="nohp" class="form-control">
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Whatsapp"  name="whatsapp" id="whatsapp" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Facebook/Twitter"  name="facebook" id="facebook" class="form-control">
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Instagram"  name="ig" id="ig" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="pendidikanterakhir">
                      <option value="SMA">SMA</option>
											<option value="SMK">SMK</option>
											<option value="MA">MA</option>
											<option value="DIPLOMA">DIPLOMA</option>
											<option value="LAINNYA">LAINNYA</option>
                    </select>
                  </div>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select class="js-example-basic-single col-sm-12" name="asalsekolah" style="line-height:35px !important;">
                      <option value="">Asal Sekolah</option>
                      <?php
                        foreach ($sekolah as $s){
                      ?>
                        <option value="<?php echo $s->nama_sekolah; ?>"><?php echo $s->nama_sekolah; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Jurusan Sekolah"  name="jurusansekolah" id="jurusansekolah" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" placeholder="Tahun Lulus"  name="tahunlulus" id="tahunlulus" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" placeholder="Email"  name="email" id="email" class="form-control" required>
                  </div>
                </div>
      				</fieldset>
              <fieldset class="mb-4">
      					<legend>Data Orangtua</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Orangtua/Wali</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" placeholder="Nama Orangtua"  name="namaortu" id="namaortu" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pekerjaan Orangtua</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" placeholder="Pekerjaan Orangtua"  name="pekerjaanortu" id="pekerjaanortu" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Penghasilan Orangtua</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select id="hello-single" class="form-control" name="penghasilanortu">
                      <option value="< 1.000.0000">< 1.000.000</option>
											<option value="1.0000.0000 - 2.000.000">1.000.000 - 2000.000</option>
											<option value="2.000.000 - 4000.000">2.000.000 - 4000.000 </option>
											<option value="> 5.000.000">> 5.000.000</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. HP </label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" placeholder="No HP"  name="nohportu" id="nohportu" class="form-control">
                  </div>
                </div>
              </fieldset>
              <fieldset class="mb-4">
      					<legend>Data Registrasi</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jurusan</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="jurusan">
                      <option value="">Jurusan</option>
                      <?php
                        foreach ($jurusan as $m){
                      ?>
                        <option value="<?php echo $m->kode_jurusan; ?>"><?php echo $m->nama_jurusan; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sumber Informasi</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="sumberinformasi">
                      <option value="">Sumber Informasi</option>
                      <option value="Presentasi">Presentasi</option>
											<option value="Guru BK">Guru BK</option>
											<option value="Direct Mailing">Direct Mailing</option>
											<option value="Spanduk">Spanduk</option>
											<option value="Internet">Internet</option>
											<option value="Koran">Koran</option>
											<option value="Radio">Radio</option>
											<option value="MGM">MGM</option>
                    	<option value="Facebook">Facebook</option>
                    	<option value="Instagram">Instagram</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sumber Aplikan</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="sumberaplikan">
                      <option value="">Sumber Aplikan</option>
                      <option value="Datang Langsung">Datang Langsung</option>
											<option value="Didatangkan">Didatangkan</option>
											<option value="Didatangi">Didatangi</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Presenter</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="presenter">
                      <option value="">Presenter</option>
                      <?php
                        foreach ($presenter as $p){
                      ?>
                        <option value="<?php echo $p->kode_presenter; ?>"><?php echo $p->nama_presenter; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gelombang</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="gelombang">
                      <option value="">Gelombang</option>
                      <option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
                    </select>
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
         $this->load->view('marketing/menu_aplikansiswa');
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

          tgldatang: {
            validators: {
              notEmpty: {
                message: 'Tanggal Datang Harus Diisi !'
              }
            }
          },
          bulandatang: {
            validators: {
              notEmpty: {
                message: 'Bulan  Datang Harus Diisi !'
              }
            }
          },
          tahundatang: {
            validators: {
              notEmpty: {
                message: 'Tahun Datang Harus Diisi !'
              },
              stringLength: {
                min: 4,
                max: 4,
                message: 'Tahun Datang Harus 4 Karakter ex. 1993'
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
          dusun: {
            validators: {
              notEmpty: {
                message: 'Nama Dusun Harus Diisi !'
              }
            }
          },

          rtrw: {
            validators: {
              notEmpty: {
                message: 'RT RW Harus Diisi !'
              }
            }
          },

          tempatlahir: {
            validators: {
              notEmpty: {
                message: 'Tempat Lahir Harus Diisi !'
              }
            }
          },

          kelurahan: {
            validators: {
              notEmpty: {
                message: 'Nama Kelurahan Harus Diisi !'
              }
            }
          },

          kecamatan: {
            validators: {
              notEmpty: {
                message: 'Nama Kecamatan Harus Diisi !'
              }
            }
          },

          kota: {
            validators: {
              notEmpty: {
                message: 'Nama Kota Harus Diisi !'
              }
            }
          },

          kodepos: {
            validators: {
              notEmpty: {
                message: 'Kode POS Harus Diisi !'
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

          pendidikanterakhir: {
            validators: {
              notEmpty: {
                message: 'Pendidikan Terakhir Harus Diisi !'
              }
            }
          },

          asalsekolah: {
            validators: {
              notEmpty: {
                message: 'Asal Sekolah Harus Diisi !'
              }
            }
          },

          jurusansekolah: {
            validators: {
              notEmpty: {
                message: 'Jurusan Sekolah Harus Diisi !'
              }
            }
          },

          tahunlulus: {
            validators: {
              notEmpty: {
                message: 'Tahun Lulus Harus Diisi !'
              }
            }
          },

          // email: {
          //   validators: {
          //     notEmpty: {
          //       message: 'Email Harus Diisi !'
          //     },
          //     emailAddress: {
          //       message: 'Gunakan Email Yang Valid.. !'
          //     }
          //   }
          // },

          namaortu: {
            validators: {
              notEmpty: {
                message: 'Nama Orang tua Harus Diisi !'
              }
            }
          },

          nohportu: {
            validators: {
              notEmpty: {
                message: 'No HP Orang tua Harus Diisi !'
              }
            }
          },

          pekerjaanortu: {
            validators: {
              notEmpty: {
                message: 'Pekerjaan Orang tua Harus Diisi !'
              }
            }
          },

          penghasilanortu: {
            validators: {
              notEmpty: {
                message: 'Penghasilan Orang tua Harus Diisi !'
              }
            }
          },

          jurusan: {
            validators: {
              notEmpty: {
                message: 'Jurusan Harus Diisi !'
              }
            }
          },

          presenter: {
            validators: {
              notEmpty: {
                message: 'Presenter  Harus Diisi !'
              }
            }
          },

          sumberinformasi: {
            validators: {
              notEmpty: {
                message: 'Sumber Informasi  Harus Diisi !'
              }
            }
          },

          sumberaplikan: {
            validators: {
              notEmpty: {
                message: 'Sumber Aplikan  Harus Diisi !'
              }
            }
          },

          gelombang: {
            validators: {
              notEmpty: {
                message: 'Gelombang  Harus Diisi !'
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
