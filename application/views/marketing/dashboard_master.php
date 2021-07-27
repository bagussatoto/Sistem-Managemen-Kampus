<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Master Maketing</h4>
            <span>Data Master Marketing</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">

      <div class="col-sm-4">
        <div class="card bg-c-pink text-white widget-visitor-card">
          <div class="card-block-small text-center">
            <h2><?php echo $presenter; ?></h2>
            <h6>Data Presenter</h6>
            <i class="feather icon-user"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="card bg-c-green text-white widget-visitor-card">
          <div class="card-block-small text-center">
            <h2><?php echo $jmlsyarat; ?></h2>
            <h6>Data Persyaratan</h6>
            <i class="feather icon-file"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <?php
          $this->load->view('marketing/menu_master');
        ?>
       
      </div>
    </div>
  </div>
