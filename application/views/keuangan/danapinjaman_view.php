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
            <li class="breadcrumb-item"><a href="#!">Dana Pinjaman</a></li>
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
            <h5>Dana Pinjaman </h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Mahasiwa</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $namamhs; ?>" name="namamhs" id="namamhs" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Mahasiswa</button>
                </div>
              </div>
            </form>
            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Mahasiswa</b></p>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Nama Aplikan</th>
                    <th>Dana Pinjaman</th>
                    <th>Total Bayar</th>
                    <th>Ket</th>
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
                      <td><a href="<?php echo base_url(); ?>keuangan/detaildanapinjaman/<?php echo $d['kode_aplikan']; ?>" style="color:#01a9ac"><?php echo $d['nama_lengkap']; ?></a></td>
                      <td align="right"><?php echo number_format($d['danapinjaman'],'0','','.'); ?></td>
                      <td align="right"><?php echo number_format($d['totalbayar'],'0','','.'); ?></td>
                      <td>
                        <?php if($d['danapinjaman']==$d['totalbayar']){ ?>
                          <label class="label label-md label-success">Lunas</label>
                        <?php }else{ ?>
                          <label class="label label-md label-danger">Belum Lunas</label>
                        <?php }  ?>
                      </td>
                      <td>
                        <a href="<?php echo base_url(); ?>keuangan/detaildanapinjaman/<?php echo $d['kode_aplikan']; ?>" class="btn btn-mini btn-success">Rincian</a>
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
         $this->load->view('keuangan/menu_transaksi');
        ?>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(function(){
      $('.hapus').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                title             : 'Yakin di Hapus ?',
                text              : 'Dengan Menghapus Data Pendaftaran Juga Akan Menghapus Data Ujian,Wawancara dan Registrasi',
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
