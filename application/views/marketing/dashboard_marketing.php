<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Dashboard</h4>
            <span>Halaman Utama Marketing</span>
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
            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <div class="page-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="content social-timeline">
          <div class="">
            <!-- Row Starts -->
            <div class="row">
              <div class="col-md-12">
                <!-- Social wallpaper start -->
                <div class="social-wallpaper">
                  <img src="<?php echo base_url(); ?>assets/images/user-profile/bg.jpg" class="img-fluid width-100" alt="">
                </div>
                <!-- Social wallpaper end -->
                 <!-- Timeline button start -->
                <div class="timeline-btn">
                  <a href="#" class="btn btn-primary waves-effect waves-light m-r-10">Edit Profile</a>
                </div>
                <!-- Timeline button end -->
              </div>
            </div>
            <!-- Row end -->
            <!-- Row Starts -->
            <div class="row">
              <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                <!-- Social timeline left start -->
                <div class="social-timeline-left">
                  <!-- social-profile card start -->
                  <div class="card">
                    <div class="social-profile">
                      <img class="img-fluid width-100" src="<?php echo base_url(); ?>assets/images/user-profile/<?php echo $user['foto']; ?>" alt="">
                    </div>
                    <div class="card-block social-follower">
                      <h4><?php echo $user['fullname']; ?></h4>
                      <h5><?php echo $user['jabatan']; ?></h5>
                      <div class="row follower-counter">
                        <div class="col-4">
                          <button class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="485"><i class="icofont icofont-user-alt-3"></i></button>
                        </div>
                        <div class="col-4">
                          <button class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="2k"><i class="icofont icofont-like"></i></button>
                        </div>
                        <div class="col-4">
                          <button class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="90"><i class="icofont icofont-eye-alt"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- social-profile card end -->
                  <!-- Who to follow card start -->
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-header-text">Daftar Presenter</h5>
                    </div>
                    <div class="card-block user-box">
                      <?php foreach($presenter as $d){
                        if(empty($d->foto)){
                          $foto = "user.png";
                        }else{
                          $foto = $d->foto;
                        }
                        ?>
                        <div class="media m-b-10">
                          <a class="media-left" href="#!">
                            <img class="media-object img-radius" src="<?php echo base_url(); ?>assets/images/presenter/<?php echo $foto; ?>" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">
                          </a>
                          <div class="media-body">
                            <div class="chat-header"><?php echo $d->nama_presenter; ?></div>
                            <div class="text-muted social-designation">Presenter</div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <!-- Who to follow card end -->
                </div>
              </div>
              <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h5>Grafik Perolehan Mahasiswa</h5>
                    <span>Grafik Perolehan Mahasiswa</span>
                  </div>
                  <div class="card-block">
                    <?php
                      foreach($grafikreg as $g){
                        $bulan[]    = $g->nama_bulan;
                        $reglast[]  = $g->jmlregislast;
                        $regnow[]   = $g->jmlregisnow;
                      }
                    ?>
                    <canvas id="barChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  "use strict";
  $(document).ready(function(){

  /*Bar chart*/
  var data1 = {
      labels: <?php echo json_encode($bulan); ?>,
      datasets: [{
          label: "<?php echo $ta_last; ?>",
          backgroundColor: [
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
              'rgba(95, 190, 170, 0.99)',
          ],
          hoverBackgroundColor: [
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
              'rgba(26, 188, 156, 0.88)',
          ],
          data: <?php echo json_encode($reglast); ?>,
      }, {
          label: "<?php echo $ta_mkt; ?>",
          backgroundColor: [
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
              'rgba(93, 156, 236, 0.93)',
          ],
          hoverBackgroundColor: [
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
              'rgba(103, 162, 237, 0.82)',
          ],
          data: <?php echo json_encode($regnow); ?>,
      }]
  };

  var bar = document.getElementById("barChart").getContext('2d');
  var myBarChart = new Chart(bar, {
      type: 'bar',
      data: data1,
      options: {
          barValueSpacing: 20
      }
  });
  });
</script>
