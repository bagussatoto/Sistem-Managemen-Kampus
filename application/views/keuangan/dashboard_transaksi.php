<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Data Transaksi</h4>
            <span>Data Transaksi</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-3 col-xl-3">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat Junior</h5>
                  <p class="p-t-10 m-b-0 text-c-yellow">Jumlah Registrasi Tk. Junior</p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-yellow"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bjunior,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block" style="color:green"><?php echo number_format($junior,'0','','.'); ?></h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-xl-3">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat Senor</h5>
                  <p class="p-t-10 m-b-0 text-c-green">Jumlah Registrasi Tk. Senior</p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-green"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bsenior,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block"><?php echo number_format($senior,'0','','.'); ?></h3>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-xl-3">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat III</h5>
                  <p class="p-t-10 m-b-0 text-c-blue">Jumlah Registrasi Tk. III</p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-blue"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bt3,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block"><?php echo number_format($t3,'0','','.'); ?></h3>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-xl-3">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat IV</h5>
                  <p class="p-t-10 m-b-0 text-c-pink">Jumlah Registrasi Tk. IV</p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-pink"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bt4,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block"><?php echo number_format($t4,'0','','.'); ?></h3>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xs-12 col-lg-6">
            <div class="card widget-statstic-card">
              <div class="card-block">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kasir</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($rekapkasir->num_rows==0){ ?>
                      <tr>
                        <td colspan="3">Tidak Ada Transaksi Hari Ini</td>
                      </tr>
                    <?php }else{ ?>
                    <?php $no =1;foreach($rekapkasir->result() as $r){ ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r->kasir; ?></td>
                        <td align="right"><?php echo number_format($r->bayar,'0','','.'); ?></td>
                      </tr>
                    <?php $no++;} ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-header-text">Daftar Kasir</h5>
              </div>
              <div class="card-block user-box">
                <?php foreach($listkasir as $d){
                  if(empty($d->foto)){
                    $foto = "user.png";
                  }else{
                    $foto = $d->foto;
                  }
                  ?>
                  <div class="media m-b-10">
                    <a class="media-left" href="#!">
                      <img class="media-object img-radius" src="<?php echo base_url(); ?>assets/images/kasir/<?php echo $foto; ?>" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                    </a>
                    <div class="media-body">
                      <div class="chat-header"><?php echo $d->fullname; ?></div>
                      <div class="text-muted social-designation">Kasir</div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
       <?php
        $this->load->view('keuangan/menu_transaksi');
       ?>
      </div>
    </div>

  </div>
