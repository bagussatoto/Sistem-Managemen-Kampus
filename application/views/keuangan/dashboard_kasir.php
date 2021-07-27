<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Dashboard</h4>
            <span>Dashboard</span>
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
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">
      <div class="col-xl-5 col-md-12">
        <div class="card user-card-full">
          <div class="row m-l-0 m-r-0">
            <div class="col-sm-4 bg-c-lite-green user-profile">
              <div class="card-block text-center text-white">
                <div class="m-b-25">
                  <img width="200px" height="250px" src="<?php echo base_url(); ?>assets/images/kasir/<?php echo $username;?>.jpg" class="img-radius" alt="User-Profile-Image">
                </div>
                <h6 class="f-w-600"><?php echo $fullname; ?></h6>
                <p>Finance & HRD</p>
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
      <div class="col-xl-5 col-md-5">
        <div class="card widget-statstic-card">
          <div class="card-block">
            <h5>Rekap Penerimaan Kasir Hari Ini</h5>
            <hr>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kasir</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php if($rekapkasir->num_rows()==0){ ?>
                  <tr>
                    <td colspan="3">Tidak Ada Transaksi Hari Ini</td>
                  </tr>
                <?php }else{ ?>
                <?php $totalbayar=0; $no =1;foreach($rekapkasir->result() as $r){ $totalbayar = $totalbayar + $r->bayar; ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $r->kasir; ?></td>
                    <td align="right"><?php echo number_format($r->bayar,'0','','.'); ?></td>
                  </tr>
                <?php $no++;} ?>
                <?php } ?>
                <tr>
                  <th colspan="2">TOTAL</th>
                  <th style="text-align:right"><?php echo number_format($totalbayar,'0','','.'); ?></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-lg-2 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-header-text">Finance & HRD</h5>
          </div>
          <div class="card-block user-box">
            <?php foreach($listkasir as $d){
              if(empty($d->foto)){
                $foto = "user.png";
              }else{
                $foto = $d->foto;
              }
              ?>
              <div class="media m-b-10">
                <a class="media-left" href="#!">
                  <img class="media-object img-radius" src="<?php echo base_url(); ?>assets/images/kasir/<?php echo $foto; ?>" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                </a>
                <div class="media-body">
                  <div class="chat-header"><?php echo $d->fullname; ?></div>
                  <div class="text-muted social-designation"><?php echo $d->jabatan; ?></div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-lg4 col-xs-12">
        <div class="col-md-12 col-lg-12">
          <div class="card">
            <div class="card-block text-center">
              <i class="feather icon-users text-c-lite-green d-block f-40"></i>
              <h4 class="m-t-20"><span class="text-c-lite-green"><?php echo $apdaftar; ?></span> Pendaftar</h4>
              <p class="m-b-20">Tahun Akademik <b><?php echo $ta_mkt; ?></p></b>
            </div>
            <div class="card-block text-center">
              <i class="feather icon-users text-c-lite-green d-block f-40"></i>
              <h4 class="m-t-20"><span class="text-c-lite-green"><?php echo $njunior; ?></span> Register</h4>
              <p class="m-b-20">Tahun Akademik <b><?php echo $ta_mkt; ?></p></b>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xs-12">
        <div class="row">
          <div class="col-md-6 col-xl-6">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat Junior</h5>
                  <p class="p-t-10 m-b-0 text-c-yellow">Jumlah Registrasi Tk. Junior TA <b><?php echo $ta; ?></b></p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-yellow"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bjunior,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block" style="color:green"><?php echo number_format($junior,'0','','.'); ?></h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-6">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat Senor</h5>
                  <p class="p-t-10 m-b-0 text-c-green">Jumlah Registrasi Tk. Senior TA <b><?php echo $ta; ?></b></p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-green"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bsenior,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block"><?php echo number_format($senior,'0','','.'); ?></h3>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xl-6">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat III</h5>
                  <p class="p-t-10 m-b-0 text-c-blue">Jumlah Registrasi Tk. III TA <b><?php echo $ta; ?></b></p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-blue"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bt3,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block"><?php echo number_format($t3,'0','','.'); ?></h3>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-6">
            <div class="card widget-statstic-card">
              <div class="card-header">
                <div class="card-header-left">
                  <h5>Registrasi Tingkat IV</h5>
                  <p class="p-t-10 m-b-0 text-c-pink">Jumlah Registrasi Tk. IV TA <b><?php echo $ta; ?></b></p>
                </div>
              </div>
              <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-pink"></i>
                <div class="text-left">
                  <h3 class="d-inline-block" style="color:red"><?php echo number_format($bt4,'0','','.'); ?></h3>
                  |
                  <h3 class="d-inline-block"><?php echo number_format($t4,'0','','.'); ?></h3>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-12 col-lg-12">
        <div class="card widget-statstic-card">
          <div class="card-block">
            <p style="text-align:center; font-weight:bold">
              DAFTAR RENCANA, PEMBAYARAN / REALISASI & TUNGGAKAN BIAYA PENDIDIKAN <br>
              TAHUN AJARAN <?php echo $ta; ?>
            </p>
            <table class="table" style="font-family:Tahoma">
              <tr style="color:white; font-size:12px; background-color:#024a75">
                <th colspan="15" style="text-align:left">RENCANA</th>
              </tr>
              <tr bgcolor="#fcf8e3" style="color:black; font-size:12px">
                <th>TINGKAT</th>
                <th>Sebelum Juli</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Jumlah</th>
              </tr>
              <?php
              $rensebelumjuli = 0;
              $renjuli=0;
              $renagustus=0;
              $renseptember=0;
              $renoktober=0;
              $rennovember=0;
              $rendesember=0;
              $renjanuari=0;
              $renfebruari=0;
              $renmaret=0;
              $renapril=0;
              $renmei=0;
              $renjuni=0;
              $rentotalrencana=0;
              foreach($rencana as $ren){
                $rensebelumjuli = $rensebelumjuli + $ren['sebelumjuli']  ;
                $renjuli        = $renjuli + $ren['juli'];
                $renagustus     = $renagustus + $ren['agustus'];
                $renseptember   = $renseptember + $ren['september'];
                $renoktober     = $renoktober + $ren['oktober'];
                $rennovember    = $rennovember + $ren['november'];
                $rendesember    = $rendesember + $ren['desember'];
                $renjanuari     = $renjanuari + $ren['januari'];
                $renfebruari    = $renfebruari + $ren['februari'];
                $renmaret       = $renmaret + $ren['maret'];
                $renapril       = $renapril + $ren['april'];
                $renmei         = $renmei + $ren['mei'];
                $renjuni        = $renjuni + $ren['juni'];
                $rentotalrencana= $rentotalrencana + $ren['totalrencana'];
               ?>
                <tr style="font-size:12px">
                  <td><?php echo $ren['tingkat']; ?></td>
                  <td align="right"><?php echo number_format($ren['sebelumjuli'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['juli'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['agustus'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['september'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['oktober'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['november'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['desember'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['januari'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['februari'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['maret'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['april'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['mei'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['juni'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($ren['totalrencana'],0,'','.'); ?></td>
                </tr>
              <?php } ?>
              <tr bgcolor="#fcf8e3" style="color:black; font-size:12px; font-weight:bold">
                <td>TOTAL</td>
                <td align="right"><?php echo number_format($rensebelumjuli,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renjuli,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renagustus,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renseptember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renoktober,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($rennovember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($rendesember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renjanuari,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renfebruari,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renmaret,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renapril,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renmei,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($renjuni,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($rentotalrencana,0,'','.'); ?></td>
              </tr>
              <tr bgcolor="#024a75" style="color:white; font-size:12px">
                <th colspan="15" style="text-align:left">REALISASI</th>
              </tr>
              <tr bgcolor="#dff0d8" style="color:black; font-size:12px">
                <th>TINGKAT</th>
                <th>Sebelum Juli</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Jumlah</th>
              </tr>
              <?php
                $realsebelumjuli = 0;
                $realjuli=0;
                $realagustus=0;
                $realseptember=0;
                $realoktober=0;
                $realnovember=0;
                $realdesember=0;
                $realjanuari=0;
                $realfebruari=0;
                $realmaret=0;
                $realapril=0;
                $realmei=0;
                $realjuni=0;
                $realtotalrealisasi=0;
                foreach($realisasi as $real){
                  $realsebelumjuli = $realsebelumjuli + $real['sebelumjuli']  ;
                  $realjuli        = $realjuli + $real['juli'];
                  $realagustus     = $realagustus + $real['agustus'];
                  $realseptember   = $realseptember + $real['september'];
                  $realoktober     = $realoktober + $real['oktober'];
                  $realnovember    = $realnovember + $real['november'];
                  $realdesember    = $realdesember + $real['desember'];
                  $realjanuari     = $realjanuari + $real['januari'];
                  $realfebruari    = $realfebruari + $real['februari'];
                  $realmaret       = $realmaret + $real['maret'];
                  $realapril       = $realapril + $real['april'];
                  $realmei         = $realmei + $real['mei'];
                  $realjuni        = $realjuni + $real['juni'];
                  $realtotalrealisasi= $realtotalrealisasi + $real['totalrealisasi'];
              ?>
                <tr style="font-size:12px; ">
                  <td><?php echo $real['tingkat']; ?></td>
                  <td align="right"><?php echo number_format($real['sebelumjuli'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['juli'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['agustus'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['september'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['oktober'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['november'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['desember'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['januari'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['februari'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['maret'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['april'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['mei'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['juni'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($real['totalrealisasi'],0,'','.'); ?></td>
                </tr>
              <?php } ?>
              <tr bgcolor="#dff0d8" style="color:black; font-size:12px; font-weight:bold">
                <td>TOTAL</td>
                <td align="right"><?php echo number_format($realsebelumjuli,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realjuli,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realagustus,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realseptember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realoktober,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realnovember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realdesember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realjanuari,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realfebruari,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realmaret,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realapril,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realmei,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realjuni,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($realtotalrealisasi,0,'','.'); ?></td>
              </tr>
              <tr bgcolor="#024a75" style="color:white; font-size:12px">
                <th colspan="15" style="text-align:left">TUNGGAKAN</th>
              </tr>
              <tr bgcolor="#ebcccc" style="color:black; font-size:12px">
                <th>TINGKAT</th>
                <th>Sebelum Juli</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Jumlah</th>
              </tr>
              <?php
                $tungsebelumjuli = 0;
                $tungjuli=0;
                $tungagustus=0;
                $tungseptember=0;
                $tungoktober=0;
                $tungnovember=0;
                $tungdesember=0;
                $tungjanuari=0;
                $tungfebruari=0;
                $tungmaret=0;
                $tungapril=0;
                $tungmei=0;
                $tungjuni=0;
                $tungtotaltunggakan=0;
                foreach($tunggakan as $tung){
                  $tungsebelumjuli   = $tungsebelumjuli + $tung['sebelumjuli']  ;
                  $tungjuli          = $tungjuli + $tung['juli'];
                  $tungagustus       = $tungagustus + $tung['agustus'];
                  $tungseptember     = $tungseptember + $tung['september'];
                  $tungoktober       = $tungoktober + $tung['oktober'];
                  $tungnovember      = $tungnovember + $tung['november'];
                  $tungdesember      = $tungdesember + $tung['desember'];
                  $tungjanuari       = $tungjanuari + $tung['januari'];
                  $tungfebruari      = $tungfebruari + $tung['februari'];
                  $tungmaret         = $tungmaret + $tung['maret'];
                  $tungapril         = $tungapril + $tung['april'];
                  $tungmei           = $tungmei + $tung['mei'];
                  $tungjuni          = $tungjuni + $tung['juni'];
                  $tungtotaltunggakan= $tungtotaltunggakan + $tung['totaltunggakan'];
              ?>
                <tr style="font-size:12px">
                  <td><?php echo $tung['tingkat']; ?></td>
                  <td align="right"><?php echo number_format($tung['sebelumjuli'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['juli'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['agustus'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['september'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['oktober'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['november'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['desember'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['januari'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['februari'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['maret'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['april'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['mei'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['juni'],0,'','.'); ?></td>
                  <td align="right"><?php echo number_format($tung['totaltunggakan'],0,'','.'); ?></td>
                </tr>
              <?php } ?>
              <tr bgcolor="#ebcccc" style="color:black; font-size:12px; font-weight:bold">
                <td>TOTAL</td>
                <td align="right"><?php echo number_format($tungsebelumjuli,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungjuli,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungagustus,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungseptember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungoktober,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungnovember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungdesember,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungjanuari,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungfebruari,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungmaret,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungapril,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungmei,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungjuni,0,'','.'); ?></td>
                <td align="right"><?php echo number_format($tungtotaltunggakan,0,'','.'); ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
