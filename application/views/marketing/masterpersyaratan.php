<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Master Persyaratan</h4>
            <span>Master Persyaratan</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Master Persyaratan</a></li>
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
            <h5>Master Persyaratan</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/inputmasterpersyaratan" id="masterpersyaratan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Persyaratan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <input type="text" name="kodepersyaratan" id="kodepersyaratan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Persyaratan</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <input type="text" name="namapersyaratan" id="namapersyaratan" class="form-control">
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
                    <th>Kode Persyaratan</th>
                    <th>Nama Persyaratan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach($syarat as $p){
                   ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $p->kode_persyaratan; ?></td>
                      <td><?php echo $p->nama_persyaratan; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>marketing/hapusmasterpersyaratan/<?php echo $p->kode_persyaratan; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
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
          $this->load->view('marketing/menu_master');
        ?>
      </div>
    </div>
  </div>
  <!-- Modal large-->
  <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Master Presenter</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="loadformedit">

          </div>

        </div>
      </div>
   </div>
   <script type="text/javascript">

     $(document).ready(function() {
       $('#masterpersyaratan').bootstrapValidator({
       // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
       feedbackIcons: {
           valid: 'glyphicon glyphicon-ok',
           invalid: 'glyphicon glyphicon-remove',
           validating: 'glyphicon glyphicon-refresh'
       },
       fields: {
           kodepersyaratan: {
             validators: {
               notEmpty: {
                 message: 'Kode Persyaratan Harus Diisi !'
               },
               stringLength: {
                 min: 5,
                 max: 5,
                 message: 'Kode Persyaratan Harus 5 Karakter ex. PS001'
               }
             }
           },

           namapersyaratan: {
             validators: {
               notEmpty: {
                 message: 'Nama Persyaratan Harus Diisi !'
               }
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
