<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Data Target & Kegiatan</h4>
            <span>Target & Kegiatan</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-pink">
              <div class="card-block">
                <i class="feather icon-user bg-simple-c-pink card1-icon"></i>
                <h4><?php echo $db; ?></h4>
                <p>Database</p>
                <a href="#!" class="more-info">More Info</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-yellow">
              <div class="card-block">
                <i class="feather icon-user bg-simple-c-yellow card1-icon"></i>
                <h4><?php echo $act; ?></h4>
                <p>Follow UP</p>
                <a href="#!" class="more-info">More Info</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-blue">
              <div class="card-block">
                <i class="feather icon-user bg-simple-c-blue card1-icon"></i>
                <h4><?php echo $daftar; ?></h4>
                <p>Daftar</p>
                <a href="#!" class="more-info">More Info</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-green">
              <div class="card-block">
                <i class="feather icon-user bg-simple-c-green card1-icon"></i>
                <h4><?php echo $regis; ?></h4>
                <p>Registrasi</p>
                <a href="#!" class="more-info">More Info</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <?php
              foreach($listtreg as $d){
                $persentase = $d->realisasi / $d->jmltarget * 100;
            ?>
            <div class="col-md-12 col-lg-12">
              <div class="card">
                <div class="card-block user-radial-card">
                  <div data-label="<?php echo round($persentase); ?>%" class="radial-bar radial-bar-<?php echo round($persentase); ?> radial-bar-lg radial-bar-danger">
                    <img src="<?php echo base_url(); ?>assets/images/presenter/<?php echo $d->foto; ?>" alt="User-Image">
                  </div>
                  <span class="f-36 text-c-pink"><?php echo $d->realisasi; ?></span>
                  <p>Dari <?php echo $d->jmltarget; ?></p>
                </div>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-12 col-lg-12">
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
            <div class="row">
              <div class="col-xl-6 col-md-6">
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
              <div class="col-xl-6 col-md-6">
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
      </div>

      <div class="col-md-3">
       <?php
        $this->load->view('marketing/menu_targetkegiatan');
       ?>
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
