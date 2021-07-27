<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Target Presenter Tahun Akademik <?php echo $ta; ?></h4>
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
            <form action="<?php echo base_url(); ?>marketing/insert_targetpresenter" id="targetpresenter" method="post" autocomplete="off">
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
                <label class="col-sm-2 col-form-label">Target</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="target">
                    <option value="">Target</option>
                    <?php
                      foreach ($target as $t){
                    ?>
                      <option value="<?php echo $t->kode_target; ?>"><?php echo $t->nama_target; ?></option>
                    <?php
                      }
                    ?>
                  </select>
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
                      <?php
                        $no=1;
                        foreach($bulan as $b){
                        if($b->order<=3)
                        {
                          $tahun = substr($ta,0,4)-1;
                        }else{
                          $tahun = substr($ta,5,4)-1;
                        }
                      ?>
                        <tr>
                          <td>
                            <input type="hidden" name="bulan<?php echo $no; ?>" value="<?php echo $b->id_bulan; ?>">
                            <?php echo $b->nama_bulan." ".$tahun; ?>
                          </td>
                          <td>
                            <input type="text" style="text-align:right" placeholder="" name="jumlahtarget<?php echo $no;  ?>" id="jumlahtarget" class="form-control">
                          </td>
                        </tr>
                      <?php $no++; } $jum = $no-1;  ?>
                      <input type="hidden" name="jum" value="<?php echo $jum; ?>">
                      <input type="hidden" name="ta_mkt" value="<?php echo $ta; ?>">
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
