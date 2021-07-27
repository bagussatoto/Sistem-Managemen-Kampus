<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Karyawan</h4>
            <span>Data Karyawan</span>
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
            <li class="breadcrumb-item"><a href="#!">Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Karyawan</a></li>
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
            <h5>Data Karyawan </h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $nama_karyawan; ?>" name="nama_karyawan" id="nama_karyawan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Karyawan</button>
                </div>
              </div>
            </form>
            <a href="<?php echo base_url(); ?>keuangan/inputkaryawan" class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i> Input Karyawan</a>
            <hr>
            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Karyawan</p>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                  <thead>
                    <tr class="table-inverse">
                      <th>#</th>
                      <th>NIK</th>
                      <th>Nama Karyawan</th>
                      <th>Divisi</th>
                      <th>Jabatan</th>
                      <th>Tgl Bergabung</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sno  = $row+1;
                      foreach ($result as $d)
                      {
                    ?>
                      <tr>
                        <td><?php echo $sno; ?></td>
                        <td><a href="<?php echo base_url(); ?>keuangan/detailkaryawan/<?php echo $d['nik']; ?>" style="color:#01a9ac"><?php echo $d['nik']; ?></a></td>
                        <td><?php echo $d['nama_karyawan']; ?></td>
                        <td><?php echo $d['kode_divisi']; ?></td>
                        <td><?php echo $d['jabatan']; ?></td>
                        <td><?php echo $d['tgl_bergabung']; ?></td>
                        <td>
                          <a href="<?php echo base_url(); ?>keuangan/editkaryawan/<?php echo $d['nik']; ?>"  class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
                          <a href="<?php echo base_url(); ?>keuangan/hapuskaryawan/<?php echo $d['nik']; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
                        </td>
                      </tr>
                    <?php
                        $sno++;
                      }
                    ?>
                  </tbody>
                </table>
            </div>
            <div style='margin-top: 10px;'>
              <?php echo $pagination; ?>
           </div>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_master');
        ?>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    $('.hapus').on('click',function(){
      var getLink = $(this).attr('href');
      swal({
            title             : 'Yakin di Hapus ?',
            text              : '',
            //html              : true,
            confirmButtonColor: '#d43737',
            showCancelButton  : true,
            },function(){
            window.location.href = getLink
          });
      return false;
      });
  });
</script>
