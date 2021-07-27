<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Aktivitas Presenter Tahun Akademik <?php echo $tahun_akademik; ?></h4>
            <span>Aktivitas Presenter</span>
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
            <li class="breadcrumb-item"><a href="#!">Aktivitas Presenter</a></li>
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
            <h5>Data Aktivitas Presenter</h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="hello-single" class="form-control tahunakademik" name="tahun_akademik">
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
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="hello-single" class="form-control presenter" name="presenter" >
                    <option value="">Semua Presenter</option>
                  </select>
                </div>
                <input type="hidden" name="pr" id="kodepresenter"  value="<?php echo $pr; ?>">
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Aktivitas</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="hello-single" class="form-control aktivitas" name="aktivitas">
                    <option value="">Semua Aktivitas</option>
                  </select>
                </div>
                <input type="hidden" name="pr" id="kodeaktivitas"  value="<?php echo $act; ?>">
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="hello-single" class="form-control" name="status">
                    <option value="">Semua Status</option>
                    <option <?php if($status==1){echo "selected";} ?> value="1">HOT PROSPEK</option>
										<option <?php if($status==2){echo "selected";} ?> value="2">PROSPEK</option>
										<option <?php if($status==3){echo "selected";} ?> value="3">BELUM PROSPEK</option>
										<option <?php if($status==4){echo "selected";} ?> value="4">BATAL</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Aplikan</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <input type="text" value="<?php echo $namasiswa; ?>" name="namasiswa" id="namasiswa" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <div class="input-daterange input-group" id="datepicker">
                    <input type="text" value="<?php echo $dari; ?>" class="input-sm form-control" name="dari" id="dari" >
                     <span class="input-group-addon">to</span>
                     <input type="text" value="<?php echo $sampai; ?>" class="input-sm form-control" name="sampai" id="sampai">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Aplikan</button>
                </div>
              </div>
            </form>
            <a href="<?php echo base_url(); ?>marketing/pilihsiswa" id="input" class="btn btn-danger btn-sm"><i class="ti-plus"></i> Input Aktivitas Presenter</a>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama Siswa</th>
                    <th>Nama Presenter</th>
                    <th>Kegiatan</th>
                    <th>Hasil Follow UP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d)
                    {
                      if($d['status']==1){
                        $status = "HOT PROSPEK";
                        $color  = "label-success";
                      }else if($d['status']==2){
                        $status = "PROSPEK";
                        $color  = "label-warning";
                      }else if($d['status']==3){
                        $status = "BELUM PROSPEK";
                        $color  = "label-inverse";
                      }else if($d['status']==4){
                        $status = "BATAL";
                        $color  = "label-danger";
                      }
                  ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><?php echo DateToIndo2($d['tgl_act']); ?></td>
                      <td><?php echo $d['nama_lengkap']; ?></td>
                      <td><?php echo $d['nama_presenter']; ?></td>
                      <td><?php echo $d['nama_aktivitas']; ?></td>
                      <td><?php echo $d['hasilfollowup']; ?></td>
                      <td><label class="label <?php echo $color; ?>"><?php echo $status; ?></label></td>
                      <td>
                        <a href="#" data-kode="<?php echo $d['kode_actpresenter'] ?>" class="btn btn-mini btn-info detail"><i class="ti-eye"></i></a>
                        <a href="<?php echo base_url(); ?>marketing/editaktivitaspresenter/<?php echo $d['kode_actpresenter'] ?>" class="btn btn-mini btn-primary"><i class="ti-pencil"></i></a>
                        <a href="<?php echo base_url(); ?>marketing/hapusaktivitaspresenter/<?php echo $d['kode_actpresenter'] ?>" class="btn btn-mini btn-danger hapus"><i class="ti-trash"></i></a>
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
          <h6 class="modal-title">Keterangan</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="loadformedit">
          </div>
        </div>
      </div>
   </div>
</div>

  <script type="text/javascript">

    $(document).ready(function() {

      function loadPresenter()
      {
        var tahunakademik = $('.tahunakademik').val();
        var kodepresenter = $("#kodepresenter").val();
        $.ajax({
          type      : 'POST',
          url       : '<?php echo base_url(); ?>marketing/listPresenter',
          data      : {ta:tahunakademik,kodepresenter:kodepresenter},
          cache     : false,
          success   : function(respond)
          {
            $(".presenter").html(respond);
          }
        });
      }

      function loadAktivitas()
      {
        var  tahunakademik = $('.tahunakademik').val();
        var  kodeaktivitas = $("#kodeaktivitas").val();
        $.ajax({
          type      : 'POST',
          url       : '<?php echo base_url(); ?>marketing/listAktivitas',
          data      : {ta:tahunakademik,kodeaktivitas:kodeaktivitas},
          cache     : false,
          success   : function(respond)
          {
            $(".aktivitas").html(respond);
          }
        });
      }
      $('.tahunakademik').change(function(){
        loadPresenter();
        loadAktivitas();
      });
      loadPresenter();
      loadAktivitas();
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
        var kode     = $(this).attr("data-kode");
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>marketing/detailaktivitas',
          data    : {kode:kode},
          cache   : false,
          success : function(respond){
            $("#loadformedit").html(respond);
            $("#modaledit").modal("show");
            console.log(respond);
          }
        });

      });

      $('#dari').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });

      $('#sampai').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });


    });

  </script>
