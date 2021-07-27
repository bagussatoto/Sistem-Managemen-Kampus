<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Detail Dana Pinjaman</h4>
            <span>Detail Dana Pinjaman</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
            <li class="breadcrumb-item"><a href="#!">Detail Dana Pinjaman</a></li>
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
                          <h2><?php echo $aplikan['nama_lengkap']; ?></h2>
                          <span class="text-white"><?php echo $aplikan['nama_jurusan']; ?></span>
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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Data Mahasiswa</a>
                  <div class="slide"></div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#orantua" role="tab">Data Orangtua / Wali</a>
                  <div class="slide"></div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#pendaftaran" role="tab">Data Pendaftaran</a>
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
                    <h5 class="card-header-text">Data Aplikan</h5>
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
                                        <th scope="row">Nama Lengkap</th>
                                        <td><?php echo $aplikan['nama_lengkap']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tempat/Tanggal Lahir</th>
                                        <td><?php echo $aplikan['tempat_lahir']."/".DateToIndo2($aplikan['tgl_lahir']); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Jenis Kelamin</th>
                                        <td><?php if($aplikan['jenis_kelamin']=="L"){echo "Laki-Laki";}else{echo "Perempuan";}; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Dusun</th>
                                        <td><?php echo $aplikan['dusun']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">RT/RW</th>
                                        <td><?php echo $aplikan['rtrw']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kecamatan</th>
                                        <td><?php echo $aplikan['kecamatan']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kabupaten/Kota</th>
                                        <td><?php echo $aplikan['kota']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kode POS</th>
                                        <td><?php echo $aplikan['kode_pos']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">No HP</th>
                                        <td><?php echo $aplikan['no_hp']; ?></td>
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
                                        <td><?php echo $aplikan['whatsapp']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Instagram</th>
                                        <td><?php echo $aplikan['instagram']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Facebook</th>
                                        <td><?php echo $aplikan['facebook']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <div class="modal-body">
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped">
                            <thead style="background-color:#183475; color:White">
                              <tr>
                                <th colspan="2">Rincian Dana Pinjaman</th>
                              </tr>
                              <tr>
                                <th>Tahun Akademik</th>
                                <th>Jumlah</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $total = 0; foreach($listpinjaman as $l){ $total = $total + $l->danapinjaman;?>
                                <tr>
                                  <td><?php echo $l->tahun_akademik; ?></td>
                                  <td align="right"><?php echo number_format($l->danapinjaman,'0','','.'); ?></td>
                                </tr>
                              <?php } ?>
                              <tr>
                                <th>Total</th>
                                <th style="text-align:right"><?php echo number_format($l->danapinjaman,'0','','.'); ?></th>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-12">
                      <div class="modal-body">
                        <a href="#" class="btn btn-sm btn-success" id="inputpenerimaan"><i class="fa fa-plus"></i> Bayar</a>
                        <hr>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead style="background-color:#183475; color:White">
                              <tr>
                                <th colspan="6">Histori Pembayaran</th>
                              </tr>
                              <tr>
                								<th>No</th>
                								<th>BTK</th>
                								<th>BTB</th>
                								<th>Tgl Bayar</th>
                								<th>Jumlah</th>
                                <th></th>
                							</tr>
                            </thead>
                            <tbody>
                              <?php
                              $no = 1;
                              foreach($historipnj as $h){
                              ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $h->nobtk; ?></td>
                                  <td><?php echo $h->nobtb; ?></td>
                                  <td><?php echo $h->tgl; ?></td>
                                  <td align="right"><?php echo number_format($h->bayar,'0','','.'); ?></td>
                                  <td>
                                    <a href="#" class="btn btn-info btn-mini edit" data-id="<?php echo $h->nobukti; ?>"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url(); ?>keuangan/hapuspenerimaanlain/<?php echo $h->nobukti; ?>" class="btn btn-danger btn-mini hapus"><i class="fa fa-trash-o"></i></a>
                  									<a href="<?php echo base_url(); ?>keuangan/cetakkwitansi/<?php echo $h->nobukti; ?>/II" class="btn btn-success btn-mini"><i class="fa fa-print"></i></a>
                                    <a href="<?php echo base_url(); ?>keuangan/sendmail/<?php echo $h->nobukti; ?>" class="btn btn-primary btn-mini"><i class="fa fa-send"></i></a>
                                  </td>
                                </tr>
                              <?php $no++; } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="orantua" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Orangtua / Wali</h5>
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
                                        <th scope="row">Nama Orangtua / Wali</th>
                                        <td><?php echo $aplikan['nama_ortu']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Pekerjaan Orangtua</th>
                                        <td><?php echo $aplikan['pekerjaan_ortu']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Penghasilan Orangtua</th>
                                        <td><?php echo $aplikan['penghasilan_ortu']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">No HP Orangtua</th>
                                        <td><?php echo $aplikan['nohp_ortu']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
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
              <div class="tab-pane" id="pendaftaran" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Pendaftaran</h5>
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
                                        <th scope="row">Jurusan</th>
                                        <td><?php echo $aplikan['nama_jurusan']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Sumber Informasi</th>
                                        <td><?php echo $aplikan['sumber_informasi']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Sumber Aplikan</th>
                                        <td><?php echo $aplikan['sumber_aplikan']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Presenter</th>
                                        <td><?php echo $aplikan['nama_presenter']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Tanggal Datang</th>
                                        <td><?php echo DateToIndo2($aplikan['tgl_datang']); ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Gelombang Datang</th>
                                        <td><?php echo $aplikan['gelombang']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
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
         <h4 class="modal-title" id="myModalLabel">BAYAR PINJAMAN</h4>
        </div>
        <form class="form-horizontal form-label-left" id="payment-form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/insertlainlain" method="POST">
          <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
           <div class="modal-body">
            <div class="row">
              <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
                <select class="form-control" name="pilih">
                  <option value="btk">BTK</option>
                  <option value="btb">BTB</option>
                </select>
              </div>
              <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" name ="nobtkbtb" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="hidden" name="kode_transaksi" value="<?php echo $aplikan['kode_aplikan']; ?>">
                <input type="hidden"  class="form-control has-feedback-left" id="terimadari" name ="terimadari" value="<?php echo $aplikan['nama_lengkap']; ?>"  placeholder="Terima Dari" required>
              </div>
            </div>
            <div class="row">
              <input type="hidden" name="pilihjenis" value="DANA PINJAMAN">
            </div>
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
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text"  class="form-control" placeholder="Keterangan" name="ket">
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
         <h4 class="modal-title" id="myModalLabel">EDIT BAYAR PINJAMAN</h4>
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
  <script type="text/javascript">

    $(document).ready(function() {
      $("#inputpenerimaan").click(function(e){
        e.preventDefault();
        $("#modal").modal("show");
      });

      $(".edit").click(function(e){
        e.preventDefault();
        nobukti  = $(this).attr('data-id');
        jenis    = 'DANAPINJAMAN';
        $("#modaledit").modal("show");
        $("#modal-body").load("<?php echo base_url(); ?>keuangan/editpenerimanlain/"+nobukti+"/"+jenis);
      });

      $('#tglbayar').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
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
