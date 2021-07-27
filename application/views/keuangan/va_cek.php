<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Transaksi</h4>
            <span>Virtual Account</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
            <li class="breadcrumb-item"><a href="#!">Create VA</a></li>
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
            <h5>Create Virtual Account </h5>
          </div>
          <div class="card-block">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Kode Registrasi</th>
                  <th>Virtual Account</th>
                  <th>Nama Lengkap</th>
                  <th>Tagihan</th>
                  <th>Expire</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $success = 0;
                $found   = 0;
                $error   = 0;
                foreach($va as $v){
                  if($v['ket']=='Data Sudah Ada')
                  {
                    $found = $found + 1;
                    $color = 'warning';

                  }else if($v['ket']=='VA Berhasil Dibuat'){
                    $success = $success + 1;
                    $color   = 'success';
                  }else{
                    $error = $error + 1;
                    $color = 'danger';
                  }
                ?>
                  <tr>
                    <td><?php echo $v['kode_registrasi'] ?></td>
                    <td><?php echo $v['va']; ?></td>
                    <td><?php echo $v['nama']; ?></td>
                    <td align="right"><?php echo number_format($v['sisatunggakan'],'0','','.'); ?></td>
                    <td><?php echo $v['expire']; ?></td>
                    <td><label class="badge badge-sm bg-<?php echo $color; ?>"><?php echo $v['ket']; ?></td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
            Success : <label class="badge badge-lg bg-success"><?php echo $success; ?></label>
            Found   : <label class="badge badge-lg bg-warning"><?php echo $found; ?></label>
            Error   : <label class="badge badge-lg bg-danger"><?php echo $error; ?></label>
            <hr>
            <a href="<?php echo base_url(); ?>keuangan/valist" class="btn btn-primary" style="float:right">Next</a>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_transaksi');
        ?>
      </div>
    </div>
  </div>
