<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Konfigurasi Data PMB</h4>
            <span>Data PMB</span>
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
            <li class="breadcrumb-item"><a href="#!">Konfigurasi</a></li>
            <li class="breadcrumb-item"><a href="#!">Data PMB Cabang</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
        <!-- Default card start -->
        <div class="card">
          <div class="card-header">
            <h5>Konfigurasi Data PMB</h5>
          </div>
          <div class="card-block">
            <div class="wrapper">
              <form action="<?php echo base_url(); ?>konfigurasi/update_confpmb" id="test" method="post" class="j-forms">
                <div class="content">
                  <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>Konfigurasi Data Departemen Marketing</span>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Branch Manager</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-user"></i>
                        </label>
                        <input type="text" class="form-control" value="<?php echo $conf['branch_manager']; ?>" id="bm" name="bm" placeholder="Branch Manager">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Head Of Marketing</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-user"></i>
                        </label>
                        <input type="text"  value="<?php echo $conf['ho_mkt']; ?>" id="homarketing" name="homarketing" placeholder="Head Of Marketing">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Tahun Akademik Marketing</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-file"></i>
                        </label>
                        <input type="text" id="tamkt"  value="<?php echo $conf['ta_mkt']; ?>" name="tamkt" placeholder="YYYY/YYYY">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Biaya Pendaftaran</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-money"></i>
                        </label>
                        <input type="text" id="biayapendaftaran"  value="<?php echo $conf['biaya_pendaftaran']; ?>" name="biayapendaftaran" placeholder="Biaya Pendaftara" style="text-align:right">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Petugas PMB</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-user"></i>
                        </label>
                        <input type="text" id="petugaspmb"  value="<?php echo $conf['petugas_pmb']; ?>" name="petugaspmb" placeholder="Petugas PMB" style="text-align:left">
                      </div>
                    </div>
                  </div>
                  <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>Konfigurasi Data Departemen Pendidikan</span>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Head Of Pendidikan</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-user"></i>
                        </label>
                        <input type="text" id="hopdd"  value="<?php echo $conf['ho_pdd']; ?>" name="hopdd" placeholder="Head Of Pendidikan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Tahun Akademik Pendidikan</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-file"></i>
                        </label>
                        <input type="text" id="tapdd"  value="<?php echo $conf['ta_pdd']; ?>" name="tapdd" placeholder="YYYY/YYYY">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Semester Berlangsung</label>
                      <div class="input">
                        <select name="semester_aktif" >
                          <option <?php if($conf['semester_aktif']=='ganjil'){ echo "selected";} ?> value="ganjil">Ganjil</option>
                          <option <?php if($conf['semester_aktif']=='genap'){ echo "selected";} ?> value="genap">Genap</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>Konfigurasi Data Departemen Keuangan</span>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Head Of Keuangan</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-user"></i>
                        </label>
                        <input type="text" value="<?php echo $conf['ho_keuangan']; ?>" id="hokeuangan" name="hokeuangan" placeholder="Head Of Keuangan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label" style="color:black !important">Petugas Kasir</label>
                      <div class="input">
                        <label class="icon-right" for="coma">
                          <i class="ti-user"></i>
                        </label>
                        <input type="text" value="<?php echo $conf['petugas_kasir']; ?>" id="kasir" name="kasir" placeholder="Petugas Kasir" style="text-align:left">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end /.content -->
                <div class="footer">
                  <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
       <!-- Menu -->
        <div class="card">
          <div class="card-block">
            <ul class="list-group list-contacts">
               <li class="list-group-item active"><a href="#">Konfigurasi</a></li>
                <?php foreach($menu as $m){ ?>
                  <li class="list-group-item"><i class="<?php echo $m->icon; ?>"></i><?php echo anchor($m->url,$m->name,array('style'=>'margin-left:10px')); ?></li>
                <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">

  $(document).ready(function() {
    $('#test').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        bm: {
          validators: {
            notEmpty: {
              message: 'Branch Manager tidak Boleh Kosong'
            },
          }
        },

        homarketing: {
          validators: {
            notEmpty: {
              message: 'Head Of Marketing tidak Boleh Kosong'
            },
          }
        },

        tamkt: {
          validators: {
            notEmpty: {
              message: 'Tahun Akademik Marketing tidak boleh kosong'
            },
          }
        },

        biayapendaftaran: {
          validators: {
            notEmpty: {
              message: 'Biaya Pendaftaran tidak Boleh Kosong'
            },
            regexp: {
              regexp: /^[0-9]+$/,
              message: 'Hanya bisa diisi dengan Angka'
            },
          }
        },

        petugaspmb: {
          validators: {
            notEmpty: {
              message: 'Petugas PMB Harus Diisi'
            },
          }
        },

        hopdd: {
          validators: {
            notEmpty: {
              message: 'Head Of Pendidikan tidak Boleh Kosong'
            },
          }
        },

        tapdd: {
          validators: {
            notEmpty: {
              message: 'Tahun Akademik Pendidikan tidak Boleh Kosong'
            },
          }
        },

        hokeuangan: {
          validators: {
            notEmpty: {
              message: 'Head Of Keuangan tidak Boleh Kosong'
            },
          }
        },

        kasir: {
          validators: {
            notEmpty: {
              message: 'Petugas Kasir tidak Boleh Kosong'
            },
          }
        },


      }
    });
  });

</script>
