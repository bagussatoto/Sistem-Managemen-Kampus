<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Data Laporan</h4>
            <span>Laporan</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Laporan</a></li>
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
                      $persentasedaftar = $apdaftar / $apdatang * 100;
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
                  <h6 class="text-white m-b-0"><?php echo round($presentaseregis); ?>%</h6>
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
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th rowspan="2" style="text-align:center; color:white" class="bg-c-blue">Nama Presenter</th>
                      <th colspan="3" style="text-align:center">DATA</th>
                      <th colspan="2" style="text-align:center">RASIO</th>
                    </tr>
                    <tr>
                      <th style="text-align:center">Aplikan</th>
                      <th style="text-align:center">Daftar</th>
                      <th style="text-align:center">Registrasi</th>
                      <th style="text-align:center">Daftar</th>
                      <th style="text-align:center">Registrasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $totalaplikandatang = 0;
                      $totalaplikandaftar = 0;
                      foreach($rasiopresenter as $r){
                        $totalaplikandatang = $totalaplikandatang + $r->aplikandatang;
                        $totalaplikandaftar = $totalaplikandaftar + $r->aplikandaftar;
                    ?>
                      <tr>
                        <td class="text-left bg-c-blue text-white" ><?php echo $r->nama_presenter; ?></td>
                        <td><?php echo $r->aplikandatang; ?></td>
                        <td><?php echo $r->aplikandaftar; ?></td>
                        <td></td>
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
                        <td></td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td class="bg-c-blue text-white"><b>TOTAL</b></td>
                      <td><?php echo $totalaplikandatang; ?></td>
                      <td><?php echo $totalaplikandaftar; ?></td>
                      <td></td>
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
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card statustic-card">
              <div class="card-header">
                <h5>Rasio Media</h5>
              </div>
              <div class="card-block text-center">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th style="text-align:center; color:white" class="bg-c-green">Media Informasi</th>
                      <th style="text-align:center">JUMLAH APLIKAN</th>
                      <th style="text-align:center">RASIO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $jumlah = 0;
                      foreach($rasiomedia as $rm){
                        $jumlah = $jumlah+$rm->jumlah;
                    ?>
                      <tr>
                        <td style="text-align:center; color:white" class="bg-c-green"><?php echo $rm->sumber_informasi; ?></td>
                        <td><?php echo $rm->jumlah; ?></td>
                        <td>
                          <?php
                            $rasio = $rm->jumlah/$allcount*100;
                            echo round($rasio)."%";
                          ?>

                        </td>
                      </tr>
                    <?php
                      }
                    ?>
                    <tr>
                      <td class="bg-c-green text-white"><b>TOTAL</b></td>
                      <td><?php echo $jumlah; ?></td>
                      <td>
                        <?php
                          $totalrasio = $jumlah/$allcount*100;
                          echo round($totalrasio)."%";
                        ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
       <?php
        $this->load->view('marketing/menu_laporan');
       ?>
      </div>
    </div>
  </div>
