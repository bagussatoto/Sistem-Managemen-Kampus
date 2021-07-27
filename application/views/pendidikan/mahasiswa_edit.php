<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Edit Data Mahasiswa</h4>
            <span>Edit Data Mahasiswa</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Mahasisa</a></li>
            <li class="breadcrumb-item"><a href="#!">Edit Data Mahasiswa</a></li>
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
            <h5>Edit Data Mahasiswa </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>pendidikan/update_mahasiswa" id="frmaplikan" method="post">
              <input type="hidden" name="kode_aplikan" value="<?php echo $aplikan['kode_aplikan']; ?>">
              <fieldset class="mb-4">
      					<legend>Data Profil Mahasiswa</legend>
                <div class="form-group row">
                  <?php
                    $dtg  = explode("-", $aplikan['tgl_datang']);
                  ?>
                  <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['nama_lengkap']; ?>" placeholder="Nama Lengkap"  name="namalengkap" id="namalengkap" class="form-control">
                  </div>
                  <div class="col-sm-1 col-md-1 col-xs-12">
                    <select id="hello-single" class="form-control" name="tgldatang">
                      <option value="">Tgl</option>
                      <?php
                        for($i=1; $i<=31; $i++)
                        {
                      ?>
                          <option <?php if($dtg[2]==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                        <option <?php if($dtg[1]==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <input type="text" value="<?php echo $dtg[0]; ?>" placeholder="Tahun" name="tahundatang" id="tahundatang" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['tempat_lahir']; ?>" placeholder="Tempat Lahir"  name="tempatlahir" id="tempatlahir" class="form-control">
                  </div>
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <?php
                      $data = explode("-" , $aplikan['tgl_lahir']);

                    ?>
                    <select id="hello-single" class="form-control" name="tgllahir">
                      <option value="">Tanggal</option>
                      <?php
                        for($i=1; $i<=31; $i++)
                        {
                      ?>
                          <option <?php if($data[2]==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                        <option <?php if($data[1]==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-2 col-md-2 col-xs-12">
                    <input type="text" value="<?php echo $data[0]; ?>" placeholder="Tahun" name="tahunlahir" id="tahunlahir" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <select id="hello-single" class="form-control" name="jk">
                      <option value="">Jenis Kelamin</option>
                      <option <?php if($aplikan['jenis_kelamin']=='L'){echo "selected";} ?> value="L">Laki - Laki</option>
											<option <?php if($aplikan['jenis_kelamin']=='P'){echo "selected";} ?> value="P">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['dusun']; ?>" placeholder="Dusun/Kp"  name="dusun" id="dusun" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['rtrw']; ?>" placeholder="RT/RW"  name="rtrw" id="rtrw" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['kelurahan']; ?>" placeholder="Kelurahan"  name="kelurahan" id="kelurahan" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['kecamatan']; ?>" placeholder="Kecamatan"  name="kecamatan" id="kecamatan" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="kota">
                      <option <?php if($aplikan['kota']=='KOTA TASIKMALAYA'){echo "selected";} ?> value="KOTA TASIKMALAYA">KOTA TASIKMALAYA</option>
											<option <?php if($aplikan['kota']=='KABUPATEN TASIKMALAYA'){echo "selected";} ?> value="KABUPATEN TASIKMALAYA">KABUPATEN TASIKMALAYA</option>
											<option <?php if($aplikan['kota']=='KABUPATEN CIAMIS'){echo "selected";} ?> value="KABUPATEN CIAMIS">KABUPATEN CIAMIS</option>
											<option <?php if($aplikan['kota']=='KOTA BANJAR'){echo "selected";} ?> value="KOTA BANJAR">KOTA BANJAR</option>
											<option <?php if($aplikan['kota']=='PANGANDARAN'){echo "selected";} ?> value="PANGANDARAN">PANGANDARAN</option>
											<option <?php if($aplikan['kota']=='GARUT'){echo "selected";} ?> value="GARUT">GARUT</option>
											<option <?php if($aplikan['kota']=='LUAR PULAU'){echo "selected";} ?> value="LUAR PULAU">LUAR PULAU</option>
                    </select>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['kode_pos']; ?>" placeholder="Kode Pos" name="kodepos" id="kodepos" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kontak</label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="No HP" value="<?php echo $aplikan['no_hp']; ?>"  name="nohp" id="nohp" class="form-control">
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Whatsapp" value="<?php echo $aplikan['whatsapp']; ?>"  name="whatsapp" id="whatsapp" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Facebook/Twitter" value="<?php echo $aplikan['facebook']; ?>"  name="facebook" id="facebook" class="form-control">
                  </div>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" placeholder="Instagram" value="<?php echo $aplikan['instagram']; ?>"  name="ig" id="ig" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <select id="hello-single" class="form-control" name="pendidikanterakhir">
                      <option <?php if($aplikan['pendidikan_terakhir']=='SMA'){echo "selected";} ?> value="SMA">SMA</option>
											<option <?php if($aplikan['pendidikan_terakhir']=='SMK'){echo "selected";} ?> value="SMK">SMK</option>
											<option <?php if($aplikan['pendidikan_terakhir']=='MA'){echo "selected";} ?> value="MA">MA</option>
											<option <?php if($aplikan['pendidikan_terakhir']=='DIPLOMA'){echo "selected";} ?> value="DIPLOMA">DIPLOMA</option>
											<option <?php if($aplikan['pendidikan_terakhir']=='LAINNYA'){echo "selected";} ?> value="LAINNYA">LAINNYA</option>
                    </select>
                  </div>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select class="js-example-basic-single col-sm-12" name="asalsekolah" style="line-height:35px !important;">
                      <option value="">Asal Sekolah</option>
                      <?php
                        foreach ($sekolah as $s){
                      ?>
                        <option <?php if($aplikan['asal_sekolah']==$s->nama_sekolah){echo "selected";} ?>  value="<?php echo $s->nama_sekolah; ?>"><?php echo $s->nama_sekolah; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['jurusan_sekolah']; ?>"  placeholder="Jurusan Sekolah"  name="jurusansekolah" id="jurusansekolah" class="form-control">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['tahun_lulus']; ?>"  placeholder="Tahun Lulus"  name="tahunlulus" id="tahunlulus" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['email']; ?>"  placeholder="Email"  name="email" id="email" class="form-control" required>
                  </div>
                </div>
      				</fieldset>
              <fieldset class="mb-4">
      					<legend>Data Orangtua</legend>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Orangtua/Wali</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['nama_ortu']; ?>"  placeholder="Nama Orangtua"  name="namaortu" id="namaortu" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pekerjaan Orangtua</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['pekerjaan_ortu']; ?>"  placeholder="Pekerjaan Orangtua"  name="pekerjaanortu" id="pekerjaanortu" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Penghasilan Orangtua</label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <select id="hello-single" class="form-control" name="penghasilanortu">
                      <option <?php if($aplikan['penghasilan_ortu']=='< 1.000.0000'){echo "selected";} ?>  value="< 1.000.0000">< 1.000.000</option>
											<option <?php if($aplikan['penghasilan_ortu']=='1.0000.0000 - 2.000.000'){echo "selected";} ?> value="1.0000.0000 - 2.000.000">1.000.000 - 2.000.000</option>
											<option <?php if($aplikan['penghasilan_ortu']=='2.000.000 - 4.000.000'){echo "selected";} ?> value="2.000.000 - 4.000.000">2.000.000 - 4.000.000 </option>
											<option <?php if($aplikan['penghasilan_ortu']=='> 5.000.000'){echo "selected";} ?> value="> 5.000.000">> 5.000.000</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. HP </label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="text" value="<?php echo $aplikan['nohp_ortu']; ?>" placeholder="No HP"  name="nohportu" id="nohportu" class="form-control">
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

          gldatang: {
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
