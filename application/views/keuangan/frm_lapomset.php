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
            <li class="breadcrumb-item"><a href="#!">Omset</a></li>
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
            <h5>Laporan Omset </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>keuangan/cetak_omsetf5" id="frmcariaplikan" method="post" target="_blank">
              <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tingkat</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="tingkat" class="form-control" name="tingkat">
                    <?php
                      foreach ($tingkat as $d){
                    ?>
                      <option  value="<?php echo $d->kode_tingkat; ?>"><?php echo $d->nama_tingkat; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div> -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kampus</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="kampus" class="form-control" name="kampus">
                    <?php
                      foreach ($kampus as $k){
                    ?>
                      <option <?php if($k->status=='LP3I'){echo "selected";} ?>  value="<?php echo $k->status; ?>"><?php echo $k->status; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="tahun_akademik" class="form-control" name="tahun_akademik">
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
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-printer"></i>  Cetak</button>
                  <button type="submit" name="export" class="btn btn-success"><i class="ti-export"></i>  Export to Excel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_laporan');
        ?>
      </div>
    </div>
  </div>
