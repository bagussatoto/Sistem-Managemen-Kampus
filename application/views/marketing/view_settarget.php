<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Target Presenter Tahun Akademik <?php echo $tahun_akademik; ?></h4>
            <span>Target Presenter</span>
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
            <li class="breadcrumb-item"><a href="#!">Penetapan Target</a></li>
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
            <h5>Data Target Presenter</h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="tahun_akademik">
                    <?php
                      foreach ($ta as $t){
                    ?>
                      <option <?php if($tahun_akademik == $t->tahun_akademik){echo "selected";} ?> value="<?php echo $t->tahun_akademik; ?>"><?php echo $t->tahun_akademik; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Presenter</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="presenter">
                    <option value="">Semua Presenter</option>
                    <?php
                      foreach ($presenter as $p){
                    ?>
                      <option <?php if($pr == $p->kode_presenter){echo "selected";} ?> value="<?php echo $p->kode_presenter; ?>"><?php echo $p->nama_presenter; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Target</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="target">
                    <option value="">Semua Target</option>
                    <?php
                      foreach ($target as $t){
                    ?>
                      <option <?php if($tgt == $t->kode_target){echo "selected";} ?> value="<?php echo $t->kode_target; ?>"><?php echo $t->nama_target; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Aplikan</button>
                </div>
              </div>
            </form>
            <a href="<?php echo base_url(); ?>marketing/inputtargetpresenter" id="input" class="btn btn-danger btn-sm"><i class="ti-plus"></i> Input Target Presenter</a>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Kode Presenter</th>
                    <th>Nama Presenter</th>
                    <th>Tahun Akademik</th>
                    <th>Target</th>
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
                      <td><?php echo $d['kode_presenter']; ?></td>
                      <td><?php echo $d['nama_presenter']; ?></td>
                      <td><?php echo $d['ta_mkt']; ?></td>
                      <td><?php echo $d['nama_target']; ?></td>
                      <td>
                        <a href="#" data-presenter ="<?php echo $d['kode_presenter'] ?>" data-target="<?php echo $d['kode_target'] ?>" class="btn btn-mini btn-primary detail">Detail</a>
                        <a href="<?php echo base_url(); ?>marketing/edittargetpresenter/<?php echo $d['kode_presenter'] ?>/<?php echo $d['kode_target'] ?>" class="btn btn-mini btn-success">Update</a>
                        <a href="<?php echo base_url(); ?>marketing/hapus_settarget/<?php echo $d['kode_presenter'] ?>/<?php echo $d['kode_target'] ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                      $sno++;
                    }
                  ?>
                </tbody>
              </table>
              <div style='margin-top: 10px;'>
                <?php echo $pagination; ?>
             </div>
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Data Target</h4>
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

      $('.detail').on('click',function(e){
        e.preventDefault();
        var kodetarget     = $(this).attr("data-target");
        var kodepresenter  = $(this).attr("data-presenter");
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>marketing/detailtargetpresenter',
          data    : {kodetarget:kodetarget,kodepresenter:kodepresenter},
          cache   : false,
          success : function(respond){
            $("#loadformedit").html(respond);
            $("#modaledit").modal("show");
            console.log(respond);
          }
        });

      });


    });

  </script>
