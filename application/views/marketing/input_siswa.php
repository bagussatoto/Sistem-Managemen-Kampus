<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Input Data Siswa</h4>
            <span>Input Data Siswa</span>
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
            <li class="breadcrumb-item"><a href="#!">Input Data Siswa</a></li>
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
            <h5>Input Data Siswa </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/insert_siswa" id="frmaplikan" method="post">
              <input type="hidden" name="ta" value="<?php echo $ta; ?>">
              <fieldset class="mb-4">
      					<legend>Data Profil Siswa</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value="" placeholder="Nama Lengkap"  name="namalengkap" id="namalengkap" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="" placeholder="Tempat Lahir"  name="tempatlahir" id="tempatlahir" class="form-control">
                  </div>
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <select id="hello-single" class="form-control" name="tgllahir">
                      <option value="">Tanggal</option>
                      <?php
                        for($i=1; $i<=31; $i++)
                        {
                      ?>
                          <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                    <input type="text" value="" placeholder="Tahun" name="tahunlahir" id="tahunlahir" class="form-control">
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
                    <input type="text" value="" placeholder="Dusun/Kp"  name="dusun" id="dusun" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="" placeholder="RT/RW"  name="rtrw" id="rtrw" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="" placeholder="Kelurahan"  name="kelurahan" id="kelurahan" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="" placeholder="Kecamatan"  name="kecamatan" id="kecamatan" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="kota">
                      <option  value="KOTA TASIKMALAYA">KOTA TASIKMALAYA</option>
											<option  value="KABUPATEN TASIKMALAYA">KABUPATEN TASIKMALAYA</option>
											<option  value="KABUPATEN CIAMIS">KABUPATEN CIAMIS</option>
											<option  value="KOTA BANJAR">KOTA BANJAR</option>
											<option  value="PANGANDARAN">PANGANDARAN</option>
											<option  value="GARUT">GARUT</option>
											<option  value="LUAR PULAU">LUAR PULAU</option>
                    </select>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="" placeholder="Kode Pos" name="kodepos" id="kodepos" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kontak</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="No HP" value=""  name="nohp" id="nohp" class="form-control">
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Whatsapp" value=""  name="whatsapp" id="whatsapp" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Facebook/Twitter" value=""  name="facebook" id="facebook" class="form-control">
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Instagram" value=""  name="ig" id="ig" class="form-control">
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
                        <option   value="<?php echo $s->nama_sekolah; ?>"><?php echo $s->nama_sekolah; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" value=""  placeholder="Jurusan Sekolah"  name="jurusansekolah" id="jurusansekolah" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value=""  placeholder="Kelas"  name="kelas" id="kelas" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value=""  placeholder="Tahun Lulus"  name="tahunlulus" id="tahunlulus" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Ranking</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="number" value=""  placeholder="Ranking"  name="ranking" id="ranking" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Prestasi</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Prestasi"  name="prestasi" id="prestasi" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Email"  name="email" id="email" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Minat</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select id="hello-single" class="form-control minat" name="minat">
                      <option  value="">Minat</option>
                      <option  value="LP3I">LP3I</option>
											<option value="KAMPUS LAIN">KAMPUS LAIN</option>
											<option value="KERJA">KERJA</option>
											<option value="NIKAH">NIKAH</option>
                      <option value="WIRASWASTA">WIRASWASTA</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row" id="jurusanlp3i">
                  <label class="col-sm-2 col-form-label">Jurusan</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="jurusanlp3i">
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
                  <label class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Keterangan"  name="keterangan" id="keterangan" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kesan</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <textarea name="kesan" class="form-control"  placeholder="Kesan" rows="8" cols="80"></textarea>
                  </div>
                </div>
      				</fieldset>
              <fieldset class="mb-4">
      					<legend>Data Orangtua</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Orangtua/Wali</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Nama Orangtua"  name="namaortu" id="namaortu" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pekerjaan Orangtua</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Pekerjaan Orangtua"  name="pekerjaanortu" id="pekerjaanortu" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Penghasilan Orangtua</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select id="hello-single" class="form-control" name="penghasilanortu">
                      <option  value="< 1.000.0000">< 1.000.000</option>
											<option value="1.0000.0000 - 2.000.000">1.000.000 - 2.000.000</option>
											<option value="2.000.000 - 4.000.000">2.000.000 - 4.000.000 </option>
											<option value="> 5.000.000">> 5.000.000</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. HP </label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value="" placeholder="No HP"  name="nohportu" id="nohportu" class="form-control">
                  </div>
                </div>
              </fieldset>
              <fieldset class="mb-4">

      					<legend>Data Presenter</legend>
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
                  <label class="col-sm-2 col-form-label">Pengentri</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Pengentri"  name="pengentri" id="pengentri" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Folder</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value=""  placeholder="Nama Folder"  name="namafolder" id="namafolder" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Folder</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select id="hello-single" class="form-control folder" name="folder">
                      <option  value="">Folder</option>
                      <option  value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
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

          email: {
            validators: {
              notEmpty: {
                message: 'Email Harus Diisi !'
              },
              emailAddress: {
                message: 'Gunakan Email Yang Valid.. !'
              }
            }
          },

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



          presenter: {
            validators: {
              notEmpty: {
                message: 'Presenter  Harus Diisi !'
              }
            }
          },




          minat: {
            validators: {
              notEmpty: {
                message: 'Minat  Harus Diisi !'
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

      function hidejurusan()
      {
        $("#jurusanlp3i").hide();
      }

      function showjurusan()
      {
        $("#jurusanlp3i").show();
      }

      $(".minat").change(function(e){
        var minat = $(this).val();
        if(minat === "LP3I")
        {
          showjurusan();
        }else{
          hidejurusan();
        }
      });

      hidejurusan();
    });

  </script>
