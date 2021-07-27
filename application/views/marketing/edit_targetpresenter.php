<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Target Presenter Tahun Akademik</h4>
            <span>Target Presenter</span>
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
            <li class="breadcrumb-item"><a href="#!">Penetapan Target</a></li>
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
            <h5>Input Target Presenter</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/update_targetpresenter" id="targetpresenter" method="post" autocomplete="off">
              <div class="col-md-6">
                <div class="table-responsive">
                  <table class="table  table-striped table-sm table-styling">
                    <tr>
                      <td><b>Nama Presenter</b></td>
                      <td>:</td>
                      <td>
                        <input type="hidden" name="presenter" value="<?php echo $target['kode_presenter']; ?>">
                        <?php echo $target['nama_presenter']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Target</b></td>
                      <td>:</td>
                      <td>
                        <input type="hidden" name="target" value="<?php echo $target['kode_target']; ?>">
                        <?php echo $target['nama_target']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Tahun Akademik</b></td>
                      <td>:</td>
                      <td>
                        <?php echo $target['ta_mkt']; ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="table-responsive">
                  <table class="table  table-striped table-sm table-styling">
                    <thead>
                      <tr class="table-inverse">
                        <th>Bulan</th>
                        <th style="width:200px">Target</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach($detail as $d){ ?>
                        <tr>
                          <td>
                            <input type="hidden" name="kode<?php echo $no; ?>" value="<?php echo $d->kode_targetpresenter; ?>">
                            <input type="hidden" name="bulan<?php echo $no; ?>" value="<?php echo $d->id_bulan; ?>">
                            <?php echo $d->nama_bulan; ?>
                          </td>
                          <td>
                              <input type="text" value="<?php echo $d->jumlah; ?>" style="text-align:right" placeholder="" name="jumlahtarget<?php echo $no;  ?>" id="jumlahtarget" class="form-control">
                          </td>
                        </tr>
                      <?php $no++; $jum = $no-1;  } ?>
                      <input type="hidden" name="jum" value="<?php echo $jum; ?>">

                    </tbody>
                  </table>
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
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
  <script type="text/javascript">

  $(function(){
    $('#targetpresenter').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
      valid      : 'glyphicon glyphicon-ok',
      invalid    : 'glyphicon glyphicon-remove',
      validating : 'glyphicon glyphicon-refresh'
    },
    fields: {
        presenter: {
          validators: {
            notEmpty: {
              message: 'Silahkan Pilih Presenter !'
            }

          }
        },

        target: {
          validators: {
            notEmpty: {
              message: 'Silahkan Pilih Target !'
            }
          }
        },

      }
    });
  });
  </script>
