<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Target Tahun Akademik <?php echo $ta; ?></h4>
            <span>Target</span>
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
            <li class="breadcrumb-item"><a href="#!">Target & kegiatan</a></li>
            <li class="breadcrumb-item"><a href="#!">Target</a></li>
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
            <h5>Data Master AKtivitas</h5>
          </div>
          <div class="card-block">
            <a href="#" id="input" class="btn btn-danger btn-sm"><i class="ti-plus"></i> Input Master Aktivitas</a>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Kode Aktivitas</th>
                    <th>Nama Aktivitas</th>
                    <th>Tahun Akademik</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach ($aktivitas as $t ) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $t->kode_aktivitas; ?></td>
                      <td><?php echo $t->nama_aktivitas; ?></td>
                      <td><?php echo $t->ta_mkt; ?></td>
                      <td>
                        <a href="#" data-kode="<?php echo $t->kode_aktivitas; ?>" class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
                        <a href="<?php echo base_url(); ?>marketing/hapus_aktivitas/<?php echo $t->kode_aktivitas; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
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
        $this->load->view('marketing/menu_targetkegiatan');
       ?>
      </div>
    </div>
  </div>
  <!-- Modal large-->
  <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Master Aktivitas</h4>
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

      $('#input').on('click',function(e){
        e.preventDefault();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>marketing/inputaktivitas',
          cache   : false,
          success : function(respond){
            $("#loadformedit").html(respond);
            $("#modaledit").modal("show");
            console.log(respond);
          }
        });

      });
      $('.edit').on('click',function(e){
        e.preventDefault();
        var kodeaktivitas = $(this).attr("data-kode");
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>marketing/editaktivitas',
          data    : {kodeaktivitas:kodeaktivitas},
          cache   : false,
          success : function(respond){
            $("#loadformedit").html(respond);
            $("#modaledit").modal("show");

            //console.log(respond);
          }
        });

      });

    });

  </script>
