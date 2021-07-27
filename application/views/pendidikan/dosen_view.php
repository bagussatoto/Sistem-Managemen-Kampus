<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Dosen</h4>
            <span>Data Dosen</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Dosen</a></li>
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
            <b>Data Dosen</b>
          </div>
          <div class="card-block">

            <form action="<?php echo base_url(); ?>pendidikan/dosen/" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $nama; ?>" name="nama" id="nama" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Dosen</button>
                </div>
              </div>
            </form>
            <a href="<?php echo base_url(); ?>pendidikan/inputdosen" class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i> Tambah Dosen</a>
            <hr>
            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Dosen</b></p>
  
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Kode Dosen</th>
                    <th>Nama Dosen</th>
                    <th>NPWP</th>
                    <th>No HP</th>
                    <th>Email</th>
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
                      <td><a href="<?php echo base_url(); ?>pendidikan/detaildosen/<?php echo $d['kodedosen']; ?>" style="color:#01a9ac"><?php echo $d['kodedosen']; ?></a></td>
                      <td><?php echo $d['nama_lengkap']; ?></td>
                      <td><?php echo $d['npwp']; ?></td>
                      <td><?php echo $d['no_telp']; ?></td>
                      <td><?php echo $d['email']; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>pendidikan/editdosen/<?php echo $d['kodedosen']; ?>"  class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
                        <a href="<?php echo base_url(); ?>pendidikan/hapusdosen/<?php echo $d['kodedosen']; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
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
         $this->load->view('pendidikan/menu_master');
        ?>
      </div>
    </div>
  </div>
  <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">UBAH NIM</h4>
        </div>
        <div id="modal-body">
        </div>
      </div>
   </div>
  </div>
  <script type="text/javascript">
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
