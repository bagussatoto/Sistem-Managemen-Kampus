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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Pendaftaran</a>
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
                                <form action="<?php echo base_url(); ?>marketing/update_aplikandaftar" id="frmaplikandaftar" method="post">
                                  <input type="hidden"  name="kode_aplikan" value="<?php echo $aplikan['kode_aplikan']; ?>">
                                  <fieldset class="mt-4">
                          					<legend>Data Pendaftaran</legend>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang/Tgl Datang</label>
                                      <label class="col-sm-3 col-form-label">
                                        <b><?php echo $aplikan['gelombang']."/".DateToIndo2($aplikan['tgl_datang']); ?></b>
                                      </label>
                                    </div>
                                    <div class="form-group row">
                                      <?php
                                        $dft  = explode("-", $aplikan['tgl_daftar']);
                                      ?>
                                      <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
                                      <div class="col-sm-1 col-md-1 col-xs-12">
                                        <select id="hello-single" class="form-control" name="tgldaftar">
                                          <option value="">Tgl</option>
                                          <?php
                                            for($i=1; $i<=31; $i++)
                                            {
                                          ?>
                                              <option <?php if($dft[2]==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="col-sm-2 col-md-2 col-xs-12">
                                        <select id="hello-single" class="form-control" name="bulandaftar">
                                          <option value="">Bulan</option>
                                          <?php
                                            for($i=1; $i<count($bulan); $i++){
                                          ?>
                                            <option <?php if($dft[1]==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="col-sm-2 col-md-2 col-xs-12">
                                        <input type="text" value="<?php echo $dft[0]; ?>" placeholder="Tahun" name="tahundaftar" id="tahundaftar" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang Daftar</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="hello-single" class="form-control" name="gelombangdaftar">
                                          <option value="">Gelombang</option>
                                          <option <?php if($aplikan['gelombang_daftar']=='1'){echo "selected";} ?> value="1">1</option>
                    											<option <?php if($aplikan['gelombang_daftar']=='2'){echo "selected";} ?> value="2">2</option>
                    											<option <?php if($aplikan['gelombang_daftar']=='3'){echo "selected";} ?> value="3">3</option>
                    											<option <?php if($aplikan['gelombang_daftar']=='4'){echo "selected";} ?> value="4">4</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Nomor Ujian</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" placeholder="Nomor Ujian" readonly value="<?php echo $aplikan['nomor_ujian']; ?>"  name="nomorujian" id="nomorujian" class="form-control">
                                      </div>
                                    </div>
                                  </fieldset>
                                  <fieldset class="mt-4">
                          					<legend>Data Pembayaran</legend>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Nomor Bukti</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" value="<?php echo $aplikan['nomor_bukti']; ?>"  placeholder="Nomor Bukti"  name="nomorbukti" id="nomorbukti" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Biaya Pendaftaran</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" onkeyup="calc()" value="<?php echo number_format($aplikan['biaya_pendaftaran'],'0','','.'); ?>" style="text-align:right" placeholder="Biaya Pendaftaran"  name="biayapendaftaran" id="biayapendaftaran" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Diskon</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" onkeyup="calc()" value="<?php echo number_format($aplikan['diskon'],'0','','.'); ?>" style="text-align:right" placeholder="Diskon"  name="diskon" id="diskon" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Total Bayar</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="hidden" readonly style="text-align:right" placeholder="Total Bayar"  name="totalbayar" id="totalbayar" class="form-control">
                                        <input type="text" readonly style="text-align:right" placeholder="Total Bayar"  name="totalbayarrupiah" id="totalbayarrupiah" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Sumber</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="hello-single" class="form-control" name="sumber">
                                          <option value="">Sumber</option>
                                          <option <?php if($aplikan['sumber_daftar']=='Datang Langsung'){echo "selected";} ?> value="Datang Langsung">Datang Langsung</option>
                                          <option <?php if($aplikan['sumber_daftar']=='MGM'){echo "selected";} ?> value="MGM">MGM</option>
                                          <option <?php if($aplikan['sumber_daftar']=='Guru BK'){echo "selected";} ?> value="Guru BK">Guru BK</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Keterangan</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="hello-single" class="form-control" name="keterangan">
                                          <option value="">Keterangan</option>
                                          <option <?php if($aplikan['keterangan']=='Daftar Kampus'){echo "selected";} ?> value="Daftar Kampus">Daftar Kampus</option>
                          								<option <?php if($aplikan['keterangan']=='Daftar Guru BK'){echo "selected";} ?> value="Daftar Guru BK">Daftar Guru BK</option>
                          								<option <?php if($aplikan['keterangan']=='Daftar Online'){echo "selected";} ?> value="Daftar Online">Daftar Online</option>
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
  <script>

    var bpn = document.getElementById('biayapendaftaran');
    bpn.addEventListener('keyup', function(e){
      bpn.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var d = document.getElementById('diskon');
    d.addEventListener('keyup', function(e){
      d.value = formatRupiah(this.value, '');
      //alert(b);
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
    function calc(){
    		bprupiah      = document.getElementById("biayapendaftaran").value;
        bp            = bprupiah.replace(/\./g,'');
    		diskonrupiah  = document.getElementById("diskon").value;
        diskon        = diskonrupiah.replace(/\./g,'');

        if(bp == ""){
          bp = 0;
        }
        if(diskon == ""){
          diskon = 0;
        }

        var result  = parseInt(bp) - parseInt(diskon);
        if (!isNaN(result)) {
         totalbayar = document.getElementById('totalbayar').value = result;
         document.getElementById("totalbayarrupiah").value=convertToRupiah(totalbayar);
        }
    }
    calc();
    function convertToRupiah(angka){
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');
    }
  </script>
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
          tgldaftar: {
            validators: {
              notEmpty: {
                message: 'Tanggal Datang Harus Diisi !'
              }
            }
          },
          bulandaftar: {
            validators: {
              notEmpty: {
                message: 'Bulan  Daftar Harus Diisi !'
              }
            }
          },
          tahundaftar: {
            validators: {
              notEmpty: {
                message: 'Tahun Daftar Harus Diisi !'
              },
              stringLength: {
                min: 4,
                max: 4,
                message: 'Tahun Daftar Harus 4 Karakter ex. 1993'
              },
              regexp: {
                  regexp: /^[0-9]+$/,
                  message: 'Harus Angka !'
              }
            }
          },
          gelombangdaftar: {
            validators: {
              notEmpty: {
                message: 'Gelombang Daftar Harus Diisi !'
              },
            }
          },
          nomorujian: {
            validators: {
              notEmpty: {
                message: 'Nomor Ujian Harus Diisi !'
              },
            }
          },

          nomorbukti: {
            validators: {
              notEmpty: {
                message: 'Nomor Bukti Harus Diisi !'
              },
            }
          },

          biayapendaftaran: {
            validators: {
              notEmpty: {
                message: 'Biaya Pendaftaran Harus Diisi !'
              },
            }
          },

          biayapendaftaran: {
            validators: {
              notEmpty: {
                message: 'Biaya Pendaftaran Harus Diisi !'
              },
            }
          },

          totalbayar: {
            validators: {
              notEmpty: {
                message: 'Total Bayar Harus Diisi !'
              },
            }
          },

          sumber: {
            validators: {
              notEmpty: {
                message: 'Sumber Harus Diisi !'
              },
            }
          },

          keterangan: {
            validators: {
              notEmpty: {
                message: 'Keterangan Harus Diisi !'
              },
            }
          },

          diskon: {
            validators: {
              notEmpty: {
                message: 'Diskon Harus Diisi !, Isi dengan 0 Jika tidak ada Diskon'
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
