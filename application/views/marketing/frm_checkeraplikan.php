<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Laporan</h4>
            <span>Laporan</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Laporan</a></li>
            <li class="breadcrumb-item"><a href="#!">Checker Aplikan</a></li>
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
            <h5>Checker Aplikan </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/cetakcheckeraplikan" id="frmcariaplikan" method="post" target="_blank">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="tahun_akademik">
                    <?php
                      foreach ($ta as $t){
                    ?>
                      <option <?php if($t->tahun_akademik == $tahun_akademik){echo "selected";} ?> value="<?php echo $t->tahun_akademik; ?>"><?php echo $t->tahun_akademik; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="bulan">
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
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-1 col-md-1 col-xs-12">
                  <select id="hello-single" class="form-control" name="dari">
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
                <div class="col-sm-1 col-md-1 col-xs-12">
                  <select id="hello-single" class="form-control" name="sampai">
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
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-printer"></i>  Cetak</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('marketing/menu_laporan');
        ?>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(function(){
      $('#dari').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });

      $('#sampai').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });
    });
  </script>
