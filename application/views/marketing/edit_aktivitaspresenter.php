<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Aktivitas Presenter Tahun Akademik <?php echo $ta; ?></h4>
            <span>Aktivitas Presenter</span>
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
            <li class="breadcrumb-item"><a href="#!">Target & kegiatan</a></li>
            <li class="breadcrumb-item"><a href="#!">Input Aktivitas Presenter</a></li>
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
            <h5>Edit Aktivitas Presenter</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/update_aktivitaspresenter" id="aktivitas_presenter" method="post" autocomplete="off">
              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <div class="input-group">
                    <input type="text" value="<?php echo $actpre['tgl_act']; ?>" id="tanggal" class="form-control" placeholder="Tanggal" name="tanggal">
                    <input type="hidden" value="<?php echo $actpre['kode_actpresenter']; ?>" id="kode" class="form-control" placeholder="Kode" name="kode">
                    <span class="input-group-addon" id="basic-addon3"><i class="ti-calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <div class="input-group">
                    <input type="text" readonly value="<?php echo $actpre['nama_lengkap']; ?>" id="siswa" name="siswa" class="form-control" placeholder="Nama Siswa">
                    <input type="hidden" value="<?php echo $actpre['kode_siswa']; ?>" id="kodesiswa" name="kodesiswa" class="form-control">
                    <span class="input-group-addon" id="basic-addon3"><i class="ti-search"></i></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <div class="input-group">
                    <input type="text" readonly value="<?php echo $actpre['nama_presenter']; ?>" id="presenter" class="form-control" placeholder="Presenter">
                    <input type="hidden" value="<?php echo $actpre['kode_presenter']; ?>" id="kodepresenter" name="kodepresenter" class="form-control">
                    <span class="input-group-addon" id="basic-addon3"><i class="ti-user"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <select id="hello-single" class="form-control" name="aktivitas">
                    <option value="">Semua Aktivitas</option>
                    <?php
                      foreach ($aktivitas as $t){
                    ?>
                      <option <?php if($actpre['kode_aktivitas']==$t->kode_aktivitas){echo "selected";} ?>  value="<?php echo $t->kode_aktivitas; ?>"><?php echo $t->nama_aktivitas; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <textarea rows="5" name="keterangan" id="keterangan" cols="5" class="form-control" placeholder="Keterangan"><?php echo $actpre['keterangan']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <select id="hello-single" class="form-control" name="hasilfollowup">
                    <option value="<?php echo $actpre['hasilfollowup']; ?>"><?php echo $actpre['hasilfollowup']; ?></option>
                    <option value="SNMPTN">SNMPTN</option>
										<option value="SBMPTN">SBMPTN</option>
										<option value="UM">UM</option>
										<option value="KERJA">KERJA</option>
										<option value="KULIAH TAHUN DEPAN">KULIAH TAHUN DEPAN</option>
										<option value="BELUM PASTI">BELUM PASTI</option>
										<option value="KE PEMERINTAHAN">KE PEMERINTAHAN</option>
										<option value="BERMINAT LP3I">BERMINAT LP3I</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <select id="hello-single" class="form-control" name="status">
                    <option value="">Status</option>
                    <option <?php if($actpre['status']==1){echo "selected";} ?> value="1">HOT PROSPEK</option>
										<option <?php if($actpre['status']==2){echo "selected";} ?> value="2">PROSPEK</option>
										<option <?php if($actpre['status']==3){echo "selected";} ?> value="3">BELUM PROSPEK</option>
										<option <?php if($actpre['status']==4){echo "selected";} ?> value="4">BATAL</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                  <a href="#" onclick="goBack()" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
       <?php
        $this->load->view('marketing/menu_targetkegiatan');
       ?>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width:1300px !important" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Data Siswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="loadformedit">
        </div>
      </div>
    </div>
  </div>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
  <script type="text/javascript">

  $(function(){
    $('#siswa').on('click',function(e){
      e.preventDefault();
      $.ajax({
        type      : 'POST',
        url       : '<?php echo base_url(); ?>marketing/listSiswa',
        cache     : false,
        success   : function(respond)
        {
          $("#loadformedit").html(respond);
        }
      });
      $("#modaledit").modal("show");
    });
    $("#tanggal").dateDropper( {
      dropWidth: 200,
      dropPrimaryColor: "#1abc9c",
      dropBorder: "1px solid #1abc9c",
      format: "Y-m-d",
    });
    $('#aktivitas_presenter').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
      valid      : 'glyphicon glyphicon-ok',
      invalid    : 'glyphicon glyphicon-remove',
      validating : 'glyphicon glyphicon-refresh'
    },
    fields: {
        tanggal: {
          validators: {
            notEmpty: {
              message: 'Tanggal Harus Diisi !'
            }

          }
        },

        siswa: {
          validators: {
            notEmpty: {
              message: 'Nama Siswa Harus Diisi !'
            }
          }
        },

        aktivitas: {
          validators: {
            notEmpty: {
              message: 'Silahkan Pilih AKtivitas Dulu!'
            }
          }
        },

        keterangan: {
          validators: {
            notEmpty: {
              message: 'Keterangan Harus Diisi!'
            }
          }
        },

        hasilfollowup: {
          validators: {
            notEmpty: {
              message: 'Hasil Follow UP Harus Dipilih'
            }
          }
        },

        status: {
          validators: {
            notEmpty: {
              message: 'Status Harus Dipilih.!'
            }
          }
        },
      }
    });
  });
  </script>
