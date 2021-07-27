<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h4>Data Transaksi</h4>
            <span>Data Transaksi</span>
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
            <li class="breadcrumb-item"><a href="#!">Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Transasksi</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Pembayaran</a></li>
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
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="cover-profile">
              <div class="profile-bg-img">
                <img class="profile-bg-img img-fluid" src="<?php echo base_url(); ?>assets\images\user-profile\bg.jpg" alt="bg-img">
                <div class="card-block user-info">
                  <div class="col-md-12">
                    <div class="media-left">
                      <a href="#" class="profile-image">
                        <img class="user-img img-radius" src="<?php echo base_url(); ?>assets\images\user-profile\user-img.jpg" alt="user-img">
                      </a>
                    </div>
                    <div class="media-body row">
                      <div class="col-lg-12">
                        <div class="user-title">
                          <h2><?php echo $reg['nama_lengkap']; ?></h2>
                          <span class="text-white"><?php echo $reg['nama_jurusan']; ?></span>
                        </div>
                      </div>
                      <div>
                        <div class="pull-right cover-btn">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <!-- tab header start -->
            <div class="tab-header card">
              <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Data Pembayaran</a>
                  <div class="slide"></div>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <!-- tab panel personal start -->
              <div class="tab-pane active" id="personal" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Mahasiswa</h5>
                  </div>
                  <div class="card-block">
                    <div class="view-info">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="general-info">
                            <div class="row">
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">NIM</th>
                                        <td><?php echo $reg['nim']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Nama Lengkap</th>
                                        <td><?php echo $reg['nama_lengkap']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tempat/Tanggal Lahir</th>
                                        <td><?php echo $reg['tempat_lahir']."/".DateToIndo2($reg['tgl_lahir']); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Jenis Kelamin</th>
                                        <td><?php if($reg['jenis_kelamin']=="L"){echo "Laki-Laki";}else{echo "Perempuan";}; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Asal Sekolah</th>
                                        <td><?php echo $reg['asal_sekolah']; ?></td>
                                      </tr>

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Whatsapp</th>
                                        <td><?php echo $reg['whatsapp']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kelas</th>
                                        <td><?php echo $reg['kelas']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tingkat</th>
                                        <td>
                                          <?php
                                            if($reg['tingkat']==1){
                                              echo "Junior";
                                            }else if($reg['tingkat']==2){
                                              echo "Senior";
                                            }else if($reg['tingkat']==3){
                                              echo "Tingkat 3";
                                            }else if($reg['tingkat']==4){
                                              echo "Tingkat 4";
                                            }
                                          ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tanggal Registrasi</th>
                                        <td><?php echo DateToIndo2($reg['tgl_registrasi']); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Presenter</th>
                                        <td><?php echo $reg['nama_presenter']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-header">
                            <h5 class="card-header-text">Data Registrasi</h5>
                          </div>
                          <div class="general-info">
                            <div class="row">
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Harga Publish</th>
                                        <td align="right"><?php echo number_format($reg['biaya'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Potongan Gelombang</th>
                                        <td align="right"><?php echo number_format($reg['pot_gelombang'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Potongan Prestasi</th>
                                        <td align="right"><?php echo number_format($reg['pot_prestasi'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Potongan Cash</th>
                                        <td align="right"><?php echo number_format($reg['pot_cash'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Potongan Lain Lain</th>
                                        <td align="right"><?php echo number_format($reg['pot_lainlain'],'0','','.'); ?></td>
                                      </tr
                                      <tr>
                                        <th scope="row">Penyesuaian</th>
                                        <td align="right"><?php echo number_format($reg['penyesuaian'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Dana Pinjaman</th>
                                        <td align="right"><?php echo number_format($reg['danapinjaman'],'0','','.'); ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Harga Deal</th>
                                        <td align="right"><?php echo number_format($reg['harga_deal'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Registrasi</th>
                                        <td align="right"><?php echo number_format($reg['biaya_registrasi'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Wajib Bayar</th>
                                        <td align="right"><?php echo number_format($reg['harga_deal']-$reg['biaya_registrasi'],'0','','.'); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Keterangan</th>
                                        <td><?php echo $reg['keterangan']; ?></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                          <a href="<?php echo base_url(); ?>keuangan/editregistrasi/<?php echo $reg['kode_registrasi']; ?>" class="btn btn-info btn-sm" name="input-mhs"><i class="fa fa-pencil"></i> Edit Rencana Registrasi</a>
                                          <?php
                                            if($reg['tingkat']==1){
                                          ?>
                                            <a href="<?php echo base_url();?>keuangan/hapusregistrasi/<?php echo $reg['kode_registrasi']; ?>/<?php echo $reg['kode_aplikan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin mau menghapus data registrasi ini?')"><i class="fa fa-trash-o"></i> Hapus Data Registrasi</a>
                                          <?php
                                            }else{
                                          ?>
                                            <a href="<?php echo base_url();?>keuangan/hapusregis/<?php echo $reg['kode_registrasi']; ?>/<?php echo $reg['kode_aplikan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin mau menghapus data registrasi ini?')"><i class="fa fa-trash-o"></i> Hapus Data Registrasi</a>
                                          <?php
                                            }
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
                      </div>
                      <div class="row mt-5" >
              					<div class="col-md-3 col-xs-12">
                          <h5>Rencana Pembayaran</h5>
                          <hr>
              						<table class="table  table-striped">
              							<tr>
              								<th colspan="3"><a href="<?php echo base_url(); ?>keuangan/editrencana/<?php echo $reg['kode_registrasi']; ?>" class="btn btn-sm btn-success">Edit Rencana Pembayaran</a></th>
              							</tr>
              							<tr style="background-color:#0c3c90; color:white; font-size:12px">
              								<th>Cicilan Ke</th>
              								<th>Jatuh Tempo</th>
              								<th>Wajib Bayar</th>
              							</tr>
              							<tr style="font-size:12px">
              								<td>REGISTRASI</td>
              								<td></td>
              								<td align="right" style="color:blue; font-weight:bold"><?php echo number_format($reg['biaya_registrasi'],'0','','.'); ?></td>
              							</tr>
              							<?php foreach ($ren as $r){ ?>
              							<tr style="font-size:12px">
              								<td><?php echo $r->cicilanke; ?></td>
              								<td><?php echo $r->jatuh_tempo; ?></td>
              								<td align="right" style="color:blue; font-weight:bold"><?php echo number_format($r->wajib_bayar,'0','','.'); ?></td>
              							</tr>
              							<?php } ?>
              							<?php if($reg['jenis_regis']=='DANAPINJAMAN'){ ?>
              							<tr class="bg-primary" style="font-size:11px">
              								<th colspan="2">TOTAL RENCANA BAYAR</th>
              								<td align="right" style="font-weight:bold"><?php echo number_format($w,'0','','.'); ?></td>
              							</tr>
              						<?php }else{ ?>
                            <tr style="background-color:#0c3c90; color:white; font-size:12px">
              								<th colspan="2">TOTAL RENCANA BAYAR</th>
              								<td align="right" style="font-weight:bold"><?php echo number_format($reg['harga_deal'],'0','','.'); ?></td>
              							</tr>
              						<?php } ?>
              						</table>
              					</div>

                        <div class="col-md-4 col-xs-12">
                          <h5>Rencana Pembayaran</h5>
                          <hr>
              						<table class="table table-striped">
                            <tr>
                              <th colspan="4"><a href="#" class="btn btn-sm btn-default" style="color:white" disabled>A</a></th>
                            </tr>
                            <tr class="bg-danger" style="font-size:12px">
                              <th>Bulan</th>
                              <th>Rencana</th>
                              <th>Realisasi</th>
                              <th>Tunggakan</th>
                            </tr>
              							<?php
                            $totalrencana = 0;
                            $totalrealisasi = 0;
                            $totaltunggakan = 0;
                            foreach ($allren as $r){
                              $jt = explode("-",$r->jatuh_tempo);
                              $tunggakan = $r->wajib_bayar-$r->realisasi;
                              $totalrencana = $totalrencana + $r->wajib_bayar;
                              $totalrealisasi = $totalrealisasi + $r->realisasi;
                              $totaltunggakan = $totaltunggakan + $tunggakan;
                            ?>
                              <tr style="font-size:12px">
                                <td><?php echo $jt[1]."-".$jt[0]; ?></td>
                                <td align="right"><?php echo number_format($r->wajib_bayar,'0','','.'); ?></td>
                                <td align="right"><?php echo number_format($r->realisasi,'0','','.'); ?></td>
                                <td align="right" style="color:#fe5d70; font-weight: bold"><?php echo number_format($tunggakan,'0','','.'); ?></td>
                              </tr>
              						  <?php } ?>
                            <tr class="bg-danger" style="font-size:12px">
                              <th>TOTAL</th>
                              <th style=" font-weight: bold; text-align:Right"><?php echo number_format($totalrencana,'0','','.'); ?></th>
                              <th style=" font-weight: bold; text-align:Right"><?php echo number_format($totalrealisasi,'0','','.'); ?></th>
                              <th style=" font-weight: bold; text-align:Right"><?php echo number_format($totaltunggakan,'0','','.'); ?></th>
                            </tr>
              						</table>
              					</div>

                        <div class="col-md-5 col-xs-12">
                          <h5>Histori Pembayaran</h5>
                          <hr>
                          <?php
                            $cek = $hbayar->num_rows();
                            if(empty($cek)){
                          ?>
                          <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                              <h6><i class="ti-info"></i> Maaf Mahasiswa Belum Melakukan Pembayarann Cicilan !</h6>
                            </div>
                          </div>
                          <td align="right"><a href="#" id="bayar" class="btn btn-success btn-sm" name="input-mhs">Bayar Registrasi</a></td>
                          <?php
                            }else{
                          ?>
                            <div class="table table-responsive">
                            <table class="table table-striped">
                              <tr>
                                <?php if($totaltunggakan > 0){ ?>
                                  <th colspan="6">
                                    <a href="#" id="bayar" class="btn btn-sm btn-danger" style="color:white">Bayar Cicilan</a>
                                    <?php if(empty($reg['kode_aplikan'])){ ?>
                                      <a href="#" id="inputemail" class="btn btn-sm btn-info" style="color:white">Input Email</a>
                                    <?php }else{ ?>
                                      <a href="#" id="inputemail" class="btn btn-sm btn-success" style="color:white"><?php echo $reg['email']; ?></a>
                                    <?php } ?>

                                  </th>
                                <?php }else{ ?>
                                  <th colspan="6"><a href="#" disabled class="btn btn-sm btn-success" style="color:white">LUNAS</a></th>
                                <?php } ?>
                              </tr>
                              <tr class="bg-success" style="font-size:12px">
                                <th>No</th>
                                <th>BTK</th>
                                <th>BTB</th>
                                <th>Tgl Bayar</th>
                                <th>Jumlah</th>
                                <th></th>
                              </tr>
                              <?php $totalbayar = 0; foreach($hbayar->result() as $h){ $totalbayar = $totalbayar + $h->bayar; ?>
                                <tr style="font-size:12px">
                                  <td><?php echo $h->nobukti;?></td>
                                  <td><?php echo $h->nobtk;?></td>
                                  <td><?php echo $h->nobtb;?></td>
                                  <?php
                                  $bear1 = substr($h->tgl,2,2);
                                  $bear2 = substr($h->tgl,5,2);
                                  $bear3 = substr($h->tgl,8,2);
                                  ?>
                                  <td><?php echo "$bear3/$bear2/$bear1";?></td>
                                  <td align="right"><?php  echo number_format($h->bayar,0,',','.');?></td>
                                  <td>
                                    <?php if($h->va!='1'){?>
                                    <a href="#" class="btn btn-info btn-mini edit" data-id="<?php echo $h->nobukti; ?>"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url(); ?>keuangan/hapusbayar/<?php echo $h->nobukti; ?>/<?php echo $reg['kode_registrasi']; ?>" class="btn btn-danger btn-mini hapus"><i class="fa fa-trash-o"></i></a>
                                    <a href="<?php echo base_url(); ?>keuangan/cetakkwitansi/<?php echo $h->nobukti; ?>" class="btn btn-success btn-mini"><i class="fa fa-print"></i></a>
                                    <?php }?>
                                    <a href="<?php echo base_url(); ?>keuangan/sendmail/<?php echo $h->nobukti; ?>/<?php echo $reg['kode_registrasi']; ?>" class="btn btn-primary btn-mini"><i class="fa fa-send"></i></a>
                                  </td>
                                </tr>
                              <?php } ?>
                              <tr class="bg-success" style="font-size:12px; font-weight:bold">
                                <td colspan="4">JUMLAH BAYAR</td>
                                <td align="right"><?php  echo number_format($totalbayar,0,',','.');?></td>
                                <td>&nbsp </td>
                              </tr>
                            </table>
                            </div>
                          <?php } ?>
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
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
        <?php
         $this->load->view('keuangan/menu_transaksi');
        ?>
      </div>
    </div>
  </div>
  <div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">BAYAR</h4>
        </div>
        <form class="form-horizontal form-label-left" id="payment-form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/bayar" method="POST">
          <input type="hidden" name="result_type" id="result-type" value="">
          <input type="hidden" name="result_data" id="result-data" value="">
         <input id="kodekontrak" type="hidden" name="kodekontrak" value="<?php echo $reg['kode_registrasi'];?>" readonly="readonly" >
         <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
         <input id="terimadari" name="terimadari" value="<?php echo $reg['nama_lengkap'];?>" type="hidden" >
         <div class="modal-body">
           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
               <input type="text"  class="form-control has-feedback-left" id="tglbayar" name ="tglbayar" value="<?php echo $tglmeng; ?>" placeholder="Tanggal Bayar" >
             </div>
           </div>
           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
               <input type="text"  style="text-align:right" class="form-control has-feedback-left" name ="bayar" id="byr" placeholder="Masukan Nominal Bayar" autofocus>
             </div>
           </div>
           <div class="row">
             <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
               <select class="form-control" name="pilih">
                 <option value="btk">BTK</option>
                 <option value="btb">BTB</option>
               </select>
             </div>
             <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
               <input type="text" class="form-control has-feedback-left" name ="nobtkbtb" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
               <div class="col-md-12" style="text-align:right">
                <b>NO BTK Terakhir : <?php echo $nobtk['nobtk']; ?></b>
               </div>
             </div>

           </div>
           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
               <textarea class="form-control" placeholder="Keterangan" name="ket" required>-</textarea>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button class="btn btn-primary" type="submit" id="pay-button">Save changes</button>
         </div>
        </form>
      </div>
   </div>
  </div>
  <div class="modal fade bs-example" id="modalemail" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">Email</h4>
        </div>
        <form class="form-horizontal form-label-left" id="payment-form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updateemail" method="POST">
         <input id="kodeaplikan" type="hidden" name="kodeaplikan" value="<?php echo $reg['kode_aplikan'];?>" readonly="readonly" >
         <input id="kodekontrak" type="hidden" name="kodekontrak" value="<?php echo $reg['kode_registrasi'];?>" readonly="readonly" >
         <div class="modal-body">
           <div class="form-group row">
             <div class="col-sm-12 col-md-12 col-xs-12">
               <input type="text" placeholder="Email" value="<?php echo $reg['email']; ?>"  name="email" id="email" class="form-control" required>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button class="btn btn-primary" type="submit" id="pay-button">Save changes</button>
         </div>
        </form>
      </div>
   </div>
  </div>
  <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">EDIT BAYAR</h4>
        </div>
        <div id="modal-body">
        </div>
      </div>
   </div>
  </div>
  <script>
    var b = document.getElementById('byr');
    b.addEventListener('keyup', function(e){
      b.value = formatRupiah(this.value, '');
      //alert(b);
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
    function convertToRupiah(angka){
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');
    }
  </script>
   <script>
     $(function(){

      $("#bayar").click(function(e){
        e.preventDefault();
        $("#modal").modal("show");
        $('#byr').focus();
      });

      $("#inputemail").click(function(e){
        e.preventDefault();
        $("#modalemail").modal("show");
      });

      $('#tglbayar').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });

      $(".edit").click(function(e){
        e.preventDefault();
        nobukti  = $(this).attr('data-id');
        $("#modaledit").modal("show");
        $("#modal-body").load("<?php echo base_url(); ?>keuangan/editbayar/"+nobukti);
      });

      $('.hapus').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title             : 'Alert',
                  text              : 'Hapus Data?',
                  html              : true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton  : true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });


  });

   </script>
