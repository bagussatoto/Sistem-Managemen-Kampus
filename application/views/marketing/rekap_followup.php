<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Rekap Follow UP Presenter Tahun Akademik <?php echo $tahun_akademik; ?></h4>
            <span>Rekap Follow UP</span>
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
            <li class="breadcrumb-item"><a href="#!">Rekap Follow UP</a></li>
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
            <h5>Data Rekap Follow UP Presenter</h5>
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
                <label class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <input type="text" value="<?php echo $namasiswa; ?>" name="namasiswa" id="namasiswa" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <div class="input-daterange input-group" id="datepicker">
                    <input type="text" value="<?php echo $dari; ?>" class="input-sm form-control" name="dari" id="dari" >
                    <input type="hidden" value="<?php echo $dari; ?>" class="input-sm form-control" name="dr" id="dr" >
                     <span class="input-group-addon">to</span>
                     <input type="text" value="<?php echo $sampai; ?>" class="input-sm form-control" name="sampai" id="sampai">
                     <input type="hidden" value="<?php echo $sampai; ?>" class="input-sm form-control" name="sm" id="sm">
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
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Asal Sekolah</th>
                    <th>No HP</th>
                    <th>Total Follow UP</th>
                    <th>Follow UP Terakhir</th>
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
                      <td><?php echo $d['nama_lengkap']; ?></td>
                      <td><?php echo $d['asal_sekolah']; ?></td>
                      <td><?php echo $d['no_hp']; ?></td>
                      <td><a href="#" data-kodesiswa = "<?php echo $d['kode_siswa']; ?>" class="btn btn-mini btn-success detail"><?php echo $d['totalfollowup']; ?></a></td>
                      <td><?php echo DateToIndo2($d['tglact']); ?></td>
                    </tr>
                  <?php
                  $sno++; }
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Detail</h6>
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

      $('.detail').on('click',function(e){
        e.preventDefault();
        var kode     = $(this).attr("data-kodesiswa");
        var dari     = $("#dr").val();
        var sampai   = $("#sm").val();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>marketing/detailfollowup',
          data    : {kode:kode,dari:dari,sampai:sampai},
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
