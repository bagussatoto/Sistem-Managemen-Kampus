<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Ruangan</h4>
            <span>Data Ruangan</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Ruangan</a></li>
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
            <h5>Data Ruangan</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>pendidikan/insertruangan" id="ruangan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Ruangan</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <input type="text" name="namaruangan" id="namaruangan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                  <button type="submit" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</button>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach($ruangan as $p){
                   ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $p->ruangan; ?></td>
                      <td>
                        
                        <a href="<?php echo base_url(); ?>pendidikan/hapusruangan/<?php echo $p->id_ruangan; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                      $no++;
                    }
                  ?>
                </tbody>
              </table>
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
 
  <script type="text/javascript">

    $(document).ready(function() {
      $('#ruangan').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          namaruangan: {
            validators: {
              notEmpty: {
                message: 'Nama Ruangan Harus Diisi !'
              },
              
            }
          },

        }
      });

      $('.hapus').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                title             : 'Alert',
                text              : 'Hapus Data?',
                html              : true,
                confirmButtonColor: '#d43737',
                showCancelButton  : true,
                },function(){
                window.location.href = getLink
              });
          return false;
      });

      

    });

  </script>
