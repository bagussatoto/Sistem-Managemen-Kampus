<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Rekapitulasi Pencapaian Target <?php echo $tahun_akademik; ?></h4>
            <span>Pencapaian Target</span>
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
            <li class="breadcrumb-item"><a href="#!">Pencapaian Target</a></li>
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
            <h5>Rekap Pencapaian Target</h5>
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
                    <option value=""> Presenter</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Target Presenter</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="hello-single" class="form-control targetpresenter" name="targetpresenter" >
                    <option value="">Target Presenter</option>
                  </select>
                </div>
              </div>
            </form>
            <hr>
            <div class="table-responsive" id="loadrekaptarget">

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
</div>
<div class="modal fade" id="modaltarget" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Detail</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="loadmodaltarget">
        </div>
      </div>
    </div>
 </div>
<script type="text/javascript">
  $(function(){
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

    function loadTargetPresenter()
    {
      var tahunakademik = $('.tahunakademik').val();

      $.ajax({
        type      : 'POST',
        url       : '<?php echo base_url(); ?>marketing/listTargetPresenter',
        data      : {ta:tahunakademik},
        cache     : false,
        success   : function(respond)
        {
          $(".targetpresenter").html(respond);
        }
      });
    }


    function loadrekaptarget()
    {
      var tahunakademik = $('.tahunakademik').val();
      var kodetarget    = $('.targetpresenter').val();
      var kodepresenter = $('.presenter').val();

      if(kodetarget=='T00001'){
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>marketing/getrekaptargetpresenter',
          data   : {kodetarget:kodetarget,kodepresenter:kodepresenter,tahunakademik:tahunakademik},
          cache  : false,
          success: function(respond){
            $('#loadrekaptarget').html(respond);
          }
        });
      }else{
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>marketing/getrekaptargetomsetpresenter',
          data   : {kodetarget:kodetarget,kodepresenter:kodepresenter,tahunakademik:tahunakademik},
          cache  : false,
          success: function(respond){
            $('#loadrekaptarget').html(respond);
          }
        });
      }

    }
    loadPresenter();
    loadTargetPresenter();

    $(".tahunakademik").click(function(e){
      loadPresenter();
      loadTargetPresenter();
      loadrekaptarget();
    });

    $(".targetpresenter").change(function(){
      loadrekaptarget();
    });
  });


</script>
