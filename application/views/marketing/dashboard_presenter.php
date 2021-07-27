<div class="row">
  <div class="col-xl-6 col-md-12">
    <div class="card user-card-full">
      <div class="row m-l-0 m-r-0">
        <div class="col-sm-4 bg-c-lite-green user-profile">
          <div class="card-block text-center text-white">
            <div class="m-b-25">
              <img width="200px" height="250px" src="<?php echo base_url(); ?>assets/images/presenter/<?php echo $username;?>.jpg" class="img-radius" alt="User-Profile-Image">
            </div>
            <h6 class="f-w-600"><?php echo $fullname; ?></h6>
            <p>Presenter</p>
            <i class="feather icon-edit m-t-10 f-16"></i>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card-block">
            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
            <div class="row">
              <div class="col-sm-6">
                <p class="m-b-10 f-w-600">Email</p>
                <h6 class="text-muted f-w-400"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="177d72796e57707a767e7b3974787a">presenter@lp3i.ac.id</a></h6>
              </div>
              <div class="col-sm-6">
                <p class="m-b-10 f-w-600">Phone</p>
                <h6 class="text-muted f-w-400">0023-333-526136</h6>
              </div>
            </div>
            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>
            <div class="row">
              <div class="col-sm-6">
                <p class="m-b-10 f-w-600">Recent</p>
                <h6 class="text-muted f-w-400">Guruable Admin</h6>
              </div>
              <div class="col-sm-6">
                <p class="m-b-10 f-w-600">Most Viewed</p>
                <h6 class="text-muted f-w-400">Able Pro Admin</h6>
              </div>
            </div>
            <ul class="social-link list-unstyled m-t-40 m-b-10">
              <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook"><i class="feather icon-facebook facebook" aria-hidden="true"></i></a></li>
              <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter"><i class="feather icon-twitter twitter" aria-hidden="true"></i></a></li>
              <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram"><i class="feather icon-instagram instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-6">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card statustic-progress-card">
          <div class="card-header">
            <h5>Progres Target Register</h5>
          </div>
          <div class="card-block">
            <div class="row align-items-center">
              <div class="col">
                <label class="label label-success">
                  <?php
                    $persentasereg = $regis/$treg['jmltarget']*100;
                  ?>
                  <?php echo round($persentasereg); ?>% <i class="m-l-10 feather icon-arrow-up"></i>
                </label>
              </div>
              <div class="col text-right">
                <h5 class=""><?php echo $regis." Dari ".$treg['jmltarget']; ?></h5> <br>
              </div>
            </div>
            <div class="progress m-t-15">
              <div class="progress-bar bg-c-green" style="width:<?php echo round($persentasereg); ?>%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card statustic-progress-card">
          <div class="card-header">
            <h5>Progres Target Omset</h5>
          </div>
          <div class="card-block">
            <div class="row align-items-center">
              <div class="col">
                <label class="label label-success">
                  <?php
                    $persentaseomset = $omset['omset']/$tomset['jmltarget']*100;
                  ?>
                  <?php echo round($persentaseomset); ?>% <i class="m-l-10 feather icon-arrow-up"></i>
                </label>
              </div>
              <div class="col text-right">
                <h5 class=""><?php echo number_format($omset['omset'],'0','','.')." Dari ".number_format($tomset['jmltarget'],'0','','.'); ?></h5>
              </div>
            </div>
            <div class="progress m-t-15">
              <div class="progress-bar bg-c-green" style="width:<?php echo round($persentaseomset); ?>%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-md-12">
    <div class="card statustic-progress-card">
      <div class="card-header">
        <h5>Detail Target Regis Pesenter</h5>
      </div>
      <div class="card-block">
        <div id="loadrekaptargetregis"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12">
    <div class="card statustic-progress-card">
      <div class="card-header">
        <h5>Detail Target Omset Pesenter</h5>
      </div>
      <div class="card-block">
        <div id="loadrekaptargetomset"></div>
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
    function loadrekaptargetregis()
    {
      var tahunakademik = "<?php echo $ta_mkt; ?>";
      var kodetarget    = "T00001";
      var kodepresenter = "<?php echo $username; ?>";

      if(kodetarget=='T00001'){
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>marketing/getrekaptargetpresenter',
          data   : {kodetarget:kodetarget,kodepresenter:kodepresenter,tahunakademik:tahunakademik},
          cache  : false,
          success: function(respond){
            $('#loadrekaptargetregis').html(respond);
          }
        });
      }else{
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>marketing/getrekaptargetomsetpresenter',
          data   : {kodetarget:kodetarget,kodepresenter:kodepresenter,tahunakademik:tahunakademik},
          cache  : false,
          success: function(respond){
            $('#loadrekaptargetomset').html(respond);
          }
        });
      }
    }

    function loadrekaptargetomset()
    {
      var tahunakademik = "<?php echo $ta_mkt; ?>";
      var kodetarget    = "T00002";
      var kodepresenter = "<?php echo $username; ?>";

      if(kodetarget=='T00001'){
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>marketing/getrekaptargetpresenter',
          data   : {kodetarget:kodetarget,kodepresenter:kodepresenter,tahunakademik:tahunakademik},
          cache  : false,
          success: function(respond){
            $('#loadrekaptargetregis').html(respond);
          }
        });
      }else{
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>marketing/getrekaptargetomsetpresenter',
          data   : {kodetarget:kodetarget,kodepresenter:kodepresenter,tahunakademik:tahunakademik},
          cache  : false,
          success: function(respond){
            $('#loadrekaptargetomset').html(respond);
          }
        });
      }
    }

    loadrekaptargetregis();
    loadrekaptargetomset();
  });
</script>
