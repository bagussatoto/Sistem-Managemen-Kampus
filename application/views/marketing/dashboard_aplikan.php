<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Data Aplikan & Siswa</h4>
            <span>Aplikan & Siswa</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Aplikan & Siswa</a></li>
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
          <div class="col-md-4">
            <div class="card statustic-card">
              <div class="card-header">
                <h5>Aplikan Datang</h5>
              </div>
              <div class="card-block text-center">
                 <span class="d-block text-c-pink f-20"><?php echo $apdatang; ?></span>
                 <p class="m-b-0">Total</p>
                 <div class="progress">
                    <div class="progress-bar bg-c-pink" style="width:100%"></div>
                 </div>
              </div>
               <div class="card-footer bg-c-pink">
                  <h6 class="text-white m-b-0"><?php echo $apdatang." Aplikan Datang"; ?></h6>
               </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card statustic-card">
              <div class="card-header">
                <h5>Aplikan Daftar</h5>
              </div>
              <div class="card-block text-center">
                 <span class="d-block text-c-blue f-20"><?php echo $apdaftar; ?></span>
                 <p class="m-b-0">Total</p>
                 <div class="progress">
                    <?php
                      if(!empty($apdatang)){
                        $persentasedaftar = $apdaftar / $apdatang * 100;
                      }else{
                        $persentasedaftar = 0;
                      }
                    ?>
                    <div class="progress-bar bg-c-blue" style="width:<?php echo $persentasedaftar; ?>%"></div>
                 </div>
              </div>
               <div class="card-footer bg-c-blue">
                  <h6 class="text-white m-b-0"><?php echo $apdaftar." Dari ".$apdatang." (".round($persentasedaftar)."%)"; ?></h6>
               </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card statustic-card">
              <div class="card-header">
                <h5>Aplikan Registrasi</h5>
              </div>
              <div class="card-block text-center">
                 <span class="d-block text-c-green f-20"><?php echo $apregis; ?></span>
                 <p class="m-b-0">Total</p>
                 <div class="progress">
                   <?php
                     if(!empty($apregis)){
                       $presentaseregis = $apregis / $apdatang * 100;
                     }else{
                       $presentaseregis = 0;
                     }
                   ?>
                    <div class="progress-bar bg-c-green" style="width:<?php echo $presentaseregis.'%'; ?>"></div>
                 </div>
              </div>
               <div class="card-footer bg-c-green">
                  <h6 class="text-white m-b-0"><?php echo $apregis." Dari ".$apdatang." (".round($presentaseregis)."%)"; ?></h6>
               </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card statustic-card">
              <div class="card-header">
                <h5>Rasio Presenter</h5>
              </div>
              <div class="card-block text-center">
                <div class="table table-responsive">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th rowspan="2" style="text-align:center; color:white" class="bg-c-blue">Nama Presenter</th>
                      <th colspan="4" style="text-align:center">DATA</th>
                      <th colspan="2" style="text-align:center">RASIO</th>
                    </tr>
                    <tr>
                      <th style="text-align:center">Aplikan</th>
                      <th style="text-align:center">Daftar</th>
                      <th style="text-align:center">Registrasi</th>
                      <th style="text-align:center">Regis < 30%</th>
                      <th style="text-align:center">Daftar</th>
                      <th style="text-align:center">Registrasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $totalaplikandatang = 0;
                      $totalaplikandaftar = 0;
                      $totalaplikanreg    = 0;
                      $totalaplikanunder30= 0;
                      foreach($rasiopresenter as $r){
                        $totalaplikandatang = $totalaplikandatang + $r->aplikandatang;
                        $totalaplikandaftar = $totalaplikandaftar + $r->aplikandaftar;
                        $totalaplikanreg    = $totalaplikanreg + $r->aplikanregistrasi;
                        $totalaplikanunder30= $totalaplikanunder30 + $r->regisunder30;
                    ?>
                      <tr>
                        <td class="text-left bg-c-blue text-white" ><?php echo $r->nama_presenter; ?></td>
                        <td><a href="#" data-kodepresenter="<?php echo $r->kode_presenter; ?>" class="apdatang"><?php echo $r->aplikandatang; ?></a></td>
                        <td><a href="#" data-kodepresenter="<?php echo $r->kode_presenter; ?>" class="apdaftar"><?php echo $r->aplikandaftar; ?></a></td>
                        <td><a href="#" data-kodepresenter="<?php echo $r->kode_presenter; ?>" class="apregis"><?php echo $r->aplikanregistrasi; ?></a></td>
                        <td><a href="#" data-kodepresenter="<?php echo $r->kode_presenter; ?>" class="detailunder30"><?php echo $r->regisunder30; ?></a></td>
                        <td>
                          <?php
                            if(!empty($r->aplikandatang)){
                              $rasiodaftar = round($r->aplikandaftar/$r->aplikandatang*100);
                            }else{
                              $rasiodaftar = 0;
                            }
                            echo $rasiodaftar;
                          ?>%
                        </td>
                        <td>
                          <?php
                            if(!empty($r->aplikanregistrasi)){
                              $rasioregistrasi = round($r->aplikanregistrasi/$r->aplikandatang*100);
                            }else{
                              $rasioregistrasi = 0;
                            }
                            echo $rasioregistrasi;
                          ?>%
                        </td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td class="bg-c-blue text-white"><b>TOTAL</b></td>
                      <td><a href="#" data-kodepresenter="" class="apdatang"><?php echo $totalaplikandatang; ?></a></td>
                      <td><a href="#" data-kodepresenter="" class="apdaftar"><?php echo $totalaplikandaftar; ?></a></td>
                      <td><a href="#" data-kodepresenter="" class="apregis"><?php echo $totalaplikanreg; ?></a></td>
                      <td><a href="#" data-kodepresenter="" class="detailunder30"><?php echo $totalaplikanunder30; ?></a></td>
                      <td>
                        <?php
                          if(!empty($totalaplikandatang)){
                            $totalrasiodaftar = round($totalaplikandaftar/$totalaplikandatang*100);
                          }else{
                            $totalrasiodaftar = 0;
                          }
                          echo $totalrasiodaftar;
                        ?>%
                      </td>
                      <td>
                        <?php
                          if(!empty($totalaplikanreg)){
                            $totalrasioregistrasi = round($totalaplikanreg/$totalaplikandatang*100);
                          }else{
                            $totalrasioregistrasi = 0;
                          }
                          echo $totalrasioregistrasi;
                        ?>%
                      </td>
                    </tr>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5>Grafik Minat Siswa</h5>
                <span>Grafik Minat Siswa</span>
              </div>
              <div class="card-block">
                <?php
                  foreach($minat as $g){
                    $m[]        = $g->minat;
                    $jumlah[]   = $g->jumlah;
                  }
                ?>
                <canvas id="barChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
       <?php
        $this->load->view('marketing/menu_aplikansiswa');
       ?>
      </div>
    </div>
  </div>
  <div class="modal fade bs-example" id="modalunder30" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:1200px">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">Detail Registrasi < 30%</h4>
        </div>
        <div id="modal-body">
        </div>
      </div>
   </div>
  </div>
  <div class="modal fade bs-example" id="modalaplikandatang" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:1200px">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">Aplikan Datang</h4>
        </div>
        <div id="modal-bodydatang">
        </div>
      </div>
   </div>
  </div>

  <div class="modal fade bs-example" id="modalaplikandaftar" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:1200px">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">Aplikan Daftar</h4>
        </div>
        <div id="modal-bodydaftar">
        </div>
      </div>
   </div>
  </div>

  <div class="modal fade bs-example" id="modalaplikanregistrasi" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:1200px">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">Aplikan Registrasi</h4>
        </div>
        <div id="modal-bodyregistrasi">
        </div>
      </div>
   </div>
  </div>
  <script type="text/javascript">
    "use strict";
    $(document).ready(function(){

    $(".detailunder30").click(function(e){
      e.preventDefault();
      var kodepresenter = $(this).attr("data-kodepresenter");
      var ta            = '<?php echo $ta; ?>';
      $("#modalunder30").modal("show");
      $.ajax({
         type   : 'POST',
         url    : '<?php echo base_url(); ?>marketing/listunder30',
         data   : {kodepresenter:kodepresenter,ta:ta},
         cache  : false,
         success: function(respond)
         {
          $("#modal-body").html(respond);
         }
      });
    });

    $(".apdatang").click(function(e){
      e.preventDefault();
      var kodepresenter = $(this).attr("data-kodepresenter");
      var ta            = '<?php echo $ta; ?>';
      $("#modalaplikandatang").modal("show");
      $.ajax({
         type   : 'POST',
         url    : '<?php echo base_url(); ?>marketing/listapdatang',
         data   : {kodepresenter:kodepresenter,ta:ta},
         cache  : false,
         success: function(respond)
         {
          $("#modal-bodydatang").html(respond);
         }
      });
    });

    $(".apdaftar").click(function(e){
      e.preventDefault();
      var kodepresenter = $(this).attr("data-kodepresenter");
      var ta            = '<?php echo $ta; ?>';
      $("#modalaplikandaftar").modal("show");
      $.ajax({
         type   : 'POST',
         url    : '<?php echo base_url(); ?>marketing/listapdaftar',
         data   : {kodepresenter:kodepresenter,ta:ta},
         cache  : false,
         success: function(respond)
         {
          $("#modal-bodydaftar").html(respond);
         }
      });
    });

    $(".apregis").click(function(e){
      e.preventDefault();
      var kodepresenter = $(this).attr("data-kodepresenter");
      var ta            = '<?php echo $ta; ?>';
      $("#modalaplikanregistrasi").modal("show");
      $.ajax({
         type   : 'POST',
         url    : '<?php echo base_url(); ?>marketing/listapregis',
         data   : {kodepresenter:kodepresenter,ta:ta},
         cache  : false,
         success: function(respond)
         {
          $("#modal-bodyregistrasi").html(respond);
         }
      });
    });
    /*Bar chart*/
    var data1 = {
        labels: <?php echo json_encode($m); ?>,
        datasets: [{
            label: "Minat Siswa",
            backgroundColor: [
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)'
            ],
            hoverBackgroundColor: [
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)'
            ],
            data: <?php echo json_encode($jumlah); ?>,
        }]
    };

    var bar = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(bar, {
        type: 'bar',
        data: data1,
        options: {
            barValueSpacing: 10
        }
    });
    });
  </script>
