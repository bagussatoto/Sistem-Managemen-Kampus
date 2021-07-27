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
            <li class="breadcrumb-item"><a href="#!">Rencana Pembayaran</a></li>
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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Rencana Pembayaran</a>
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
                                        <th scope="row">Asal Sekolah</th>
                                        <td><?php echo $aplikan['asal_sekolah']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Presenter</th>
                                        <td><?php echo $aplikan['nama_presenter']; ?></td>
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
                            <div class="row">
                              <div class="col-lg-12 col-xl-12">
                                <form action="<?php echo base_url(); ?>keuangan/updaterencana" id="formregis" method="post">
                                  <input type="hidden" name="id" value="<?php echo $aplikan['kode_registrasi'];?>"/>
                          				<input type="hidden" name="jml_cicilan" value="<?php echo $aplikan['jml_cicilan'];?>"/>
                                  <fieldset class="mt-4">
                                    <legend>Data Registrasi</legend>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label"><b>Tanggal Registrasi</b></label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <label class="col-form-label"><?php echo DateToIndo2($aplikan['tgl_registrasi']); ?></label>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label"><b>Gelombang</b></label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <label class="col-form-label"><?php echo $aplikan['gelombang_registrasi']; ?></label>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label"><b>Harga Deal</b></label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <label class="col-form-label"><?php echo number_format($aplikan['harga_deal'],'0','','.'); ?></label>
                                      </div>
                                    </div>
                                  </fieldset>
                                  <fieldset class="mt-4">
                                    <legend>Data Rencana</legend>
                                    <div class="table-responsive">
                                      <table class="table table-bordered  table-sm table-styling" style="width:60%">
                                				<tr class="table-inverse">
                                					<th>Cicilan</th>
                                					<th>Jatuh Tempo</th>
                                					<th>Wajib Bayar</th>
                                				</tr>
                                        <?php
                                          $n = 0;
                                          foreach($ren as $r){
                                            if ($r->cicilanke==0){
                              					?>
                                  					<tr>
                                  						<td colspan="2"><input type="text" readonly="readonly" class="form-control" style="width:215px;" id="cicilanke<?php echo $n; ?>" name="cicilanke<?php echo $n; ?>" value="Registrasi"/></td>
                                  						<td align="right"><input type="text" style="text-align:right" readonly="readonly" class="form-control" style="width:150px;" id="wajibbayar<?php echo $n; ?>" name="wajibbayar<?php echo $n; ?>" value="<?php  echo $r->wajib_bayar;?>"/></td>
                                  					</tr>
                                  				<?php
                                  					}else{
                                  				?>
                                          <tr>
                                            <td><input type="text" readonly="readonly" class="form-control" style="width:100px;" id="cicilanke<?php echo $n; ?>" name="cicilanke<?php echo $n; ?>" value="<?php echo $r->cicilanke; ?>"/></td>
                                            <td><input type="text" class="form-control" style="width:100px;" id="jatuhtempo<?php echo $n; ?>" name="jatuhtempo<?php echo $n; ?>" value="<?php echo $r->jatuh_tempo; ?>"/></td>
                                            <td align="right"><input type="text" style="text-align:right"  class="form-control" style="width:150px;" id="wajibbayar<?php echo $n; ?>" name="wajibbayar<?php echo $n; ?>" value="<?php  echo $r->wajib_bayar;?>"/></td>
                                          </tr>
                                        <?php
                                          }
                                          $n++;
                                        }
                                        ?>
                                        <tr>
                                					<td align="right"></td>
                                					<td align="right">Dana Pinjaman</td>
                                					<td align="right"><input style="text-align:right"  type="text" readonly="readonly" class="form-control" name="danapinjaman" value="<?php echo $aplikan['danapinjaman']; ?>"/></td>
                                				</tr>
                                        <tr>
                                					<td align="right"><button type="submit" class="btn btn-primary">Submit</button></td>
                                					<td align="right">Total Rencana Bayar</td>
                                					<td align="right"><input style="text-align:right"  type="text" readonly="readonly" class="form-control" name="total" value="<?php echo $aplikan['harga_deal'] + $aplikan['danapinjaman']; ?>"/></td>
                                				</tr>
                                      </table>
                                    </div>
                                  </fieldset>
                                </form>
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

  <script>
    calc();
    var hp = document.getElementById('hargapublish');
    hp.addEventListener('keyup', function(e){
      hp.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var pg = document.getElementById('potgel');
    pg.addEventListener('keyup', function(e){
      pg.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var pp = document.getElementById('potpres');
    pp.addEventListener('keyup', function(e){
      pp.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var pc = document.getElementById('potcash');
    pc.addEventListener('keyup', function(e){
      pc.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var pl = document.getElementById('potlainlain');
    pl.addEventListener('keyup', function(e){
      pl.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var hd = document.getElementById('hargadeal');
    hd.addEventListener('keyup', function(e){
      hd.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var reg = document.getElementById('jmlregis');
    reg.addEventListener('keyup', function(e){
      reg.value = formatRupiah(this.value, '');
      //alert(b);
    });
    var s = document.getElementById('sisa');
    s.addEventListener('keyup', function(e){
      s.value = formatRupiah(this.value, '');
      //alert(b);
    });

    var cp = document.getElementById('cicilanper');
    cp.addEventListener('keyup', function(e){
      cp.value = formatRupiah(this.value, '');
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
    function calc(){
    		hargapublishrupiah      = document.getElementById("hargapublish").value;
        hargapublish            = hargapublishrupiah.replace(/\./g,'');
    		potgelrupiah   	        = document.getElementById("potgel").value;
        potgel                  = potgelrupiah.replace(/\./g,'');
    		potpresrupiah           = document.getElementById("potpres").value;
        potpres                 = potpresrupiah.replace(/\./g,'');
        potcashrupiah           = document.getElementById("potcash").value;
        potcash                 = potcashrupiah.replace(/\./g,'');
        potlainlainrupiah       = document.getElementById("potlainlain").value;
        potlainlain             = potlainlainrupiah.replace(/\./g,'');
        hargadealrupiah         = document.getElementById("hargadeal").value;
        hargadeal               = hargadealrupiah.replace(/\./g,'');
        jmlregisrupiah          = document.getElementById("jmlregis").value;
        jmlregis                = jmlregisrupiah.replace(/\./g,'');
        sisarupiah              = document.getElementById("sisa").value;
        sisa                    = sisarupiah.replace(/\./g,'');
        cicilanperrupiah        = document.getElementById("cicilanper").value;
        cicilanper              = cicilanperrupiah.replace(/\./g,'');
        jmlcicilan              = document.getElementById("jmlcicilan").value;

        if(hargapublish == ""){
          hargapublish = 0;
        }
        if(potgel == ""){
          potgel = 0;
        }
        if(potpres == ""){
          potpres = 0;
        }
        if(potcash == ""){
          potcash = 0;
        }
        if(potlainlain == ""){
          potlainlain = 0;
        }
        if(hargadeal == ""){
          hargadeal = 0;
        }
        if(jmlregis == ""){
          jmlregis = 0;
        }
        if(sisa == ""){
          sisa = 0;
        }
        if(cicilanper == ""){
          cicilanper = 0;
        }
        if(jmlcicilan == ""){
          jmlcicilan = 0;
        }


        var result  = parseInt(hargapublish) - parseInt(potcash) - parseInt(potpres) - parseInt(potgel)-parseInt(potlainlain);
        var deal    = parseInt(result)-parseInt(jmlregis);
        var cicilan = parseInt(deal) / parseInt(jmlcicilan);
        //var selisih = parseInt(result)-parseInt(totallhp);
        if (!isNaN(result)) {
         hargadeals = document.getElementById('hargadeal').value = result;
         document.getElementById("terbilangdeal").value=convertToRupiah(hargadeals);
        }

        if (!isNaN(deal)) {
         sisas = document.getElementById('sisa').value = deal;
         //document.getElementById("terbilangtotalsetoran").innerHTML=convertToRupiah(totalsetoran);
         document.getElementById("terbilangsisa").value=convertToRupiah(sisas);
        }

        if (!isNaN(cicilan)) {
         cicilans = document.getElementById('cicilanper').value = cicilan;
         document.getElementById("terbilangcicilan").value=convertToRupiah(cicilans);
        }




  	}
    function convertToRupiah(angka){
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');
    }
  </script>

  <script type="text/javascript">
    $(function(){
      function loadSelisih(){
        var tglmulai = $("#mulaicicilan").val();
        //alert(tglmulai);
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>keuangan/getselisih',
          data    : {tglmulai:tglmulai},
          cache   : false,
          success : function(respond){
            console.log(respond);
            $("#selisih").val(respond);
          }
        });
      }
      loadSelisih();
      $("#mulaicicilan").change(function(e){
        e.preventDefault();
        loadSelisih();
      });
      $('#formregis').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          tgl_registrasi: {
            validators: {
              notEmpty: {
                message: 'Tanggal Registrasi Harus Diisi !'
              },
            }
          },
          gelombangregis: {
            validators: {
              notEmpty: {
                message: 'Gelombang Registrasi Harus Diisi !'
              },
            }
          },
          hargadeal: {
            validators: {
              notEmpty: {
                message: 'Harga Deal Harus Diisi !'
              },
            }
          },

          jmlcicilan: {
            validators: {
              notEmpty: {
                message: 'Jumlah Cicilan Harus Diisi !'
              },
              between: {
                min: 1,
                max: 12,
                message: 'Jumlah Cicilan Tidak Boleh 0 Maksimal 12'
              }
            }
          },


          jmlregis: {
            validators: {
              notEmpty: {
                message: 'Jumlah Registrasi Harus Diisi !'
              },
            }
          },
          keterangan: {
            validators: {
              notEmpty: {
                message: 'Keterangan Harus Diisi !'
              },
            }
          },

        }
      });

      $("#mulaicicilan").dateDropper( {
        dropWidth: 200,
        init_animation: "bounce",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        format: "Y-m-d",

      });

      $("#formregis").submit(function(){
          var hargadeal      = $("#hargadeal").val();
          var registrasi     = $("#jmlregis").val();
          var jmlcicilan     = $("#jmlcicilan").val();
          var selisih        = $("#selisih").val();
          //alert(selisih);
          if(hargadeal == 0){
             swal("Oops!", "Harga Deal Masih Kosong Cuy.. !", "warning");
             return false;
          }else if(registrasi == 0 ){
             swal("Oops!", "Registrasi Tidak Boleh 0.. !", "warning");
             return false;
          }else if(jmlcicilan == 0 ){
             swal("Oops!", "Jumlah Tidak Boleh 0.. !", "warning");
             return false;
          }else if(parseInt(jmlcicilan) > parseInt(selisih)){
             swal("Oops!", "Jumlah Cicilan yang memungkinkan s/d Bulan Juni Adalah "+selisih+". !", "warning");
             return false;
          }else{
              return true;
          }
      });
    });
  </script>
