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
            <li class="breadcrumb-item"><a href="#!">Edit Registrasi</a></li>
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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Edit Registrasi</a>
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
                                        <th scope="row">Kelas</th>
                                        <td><?php echo $reg['kelas']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12 col-xl-12">
                                <form action="<?php echo base_url(); ?>keuangan/updateregis" id="formregis" method="post">
                                  <input type="hidden"  name="kodekontrak" value="<?php echo $reg['kode_registrasi']; ?>">
                                  <fieldset class="mt-4">
                          					<legend>Data Registrasi</legend>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Tanggal Registrasi</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" value="<?php echo $reg['tgl_registrasi']; ?>" placeholder="Tanggal Registrasi"  name="tglregis"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang Registrasi</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="gelombangregis" class="form-control" name="gelombangregis">
                                          <option value="">Gelombang</option>
                                          <option <?php if($reg['gelombang_registrasi']==1){echo "selected";} ?> value="1">1</option>
                    											<option <?php if($reg['gelombang_registrasi']==2){echo "selected";} ?>value="2">2</option>
                    											<option <?php if($reg['gelombang_registrasi']==3){echo "selected";} ?>value="3">3</option>
                    											<option <?php if($reg['gelombang_registrasi']==4){echo "selected";} ?>value="4">4</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Harga Publish</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="hidden" name="kodebiaya" value="<?php echo $reg['kode_biaya']; ?>">
                                        <input style="text-align:right" readonly onkeyup="calc()"  value="<?php echo number_format($reg['biaya'],'0','','.'); ?>" ame="hargapublish" id="hargapublish" type="text" class="form-control" placeholder="Harga Publish">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Gelombang</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()"  value="<?php echo number_format($reg['pot_gelombang'],'0','','.'); ?>"  name="potgel" id="potgel"   type="text" class="form-control" placeholder="Potongan Gelombang">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Prestasi</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['pot_prestasi'],'0','','.'); ?>"  type="text" name="potpres" id="potpres"  class="form-control" placeholder="Potongan Prestasi">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Cash</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right"  onkeyup="calc()" value="<?php echo number_format($reg['pot_cash'],'0','','.'); ?>"  type="text" name="potcash" id="potcash"  class="form-control" placeholder="Potongan Cash">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Lain Lain</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['pot_lainlain'],'0','','.'); ?>"  type="text" name="potlainlain" id="potlainlain"  class="form-control" placeholder="Potongan Lain Lain">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Penyesuaian</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['penyesuaian'],'0','','.'); ?>"  type="text" name="penyesuaian" id="penyesuaian"  class="form-control" placeholder="Penyesuaian">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Dana Pinjaman</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['danapinjaman'],'0','','.'); ?>"  type="text" name="danapinjaman" id="danapinjaman"  class="form-control" placeholder="Dana Pinjaman">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Harga Deal</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['harga_deal'],'0','','.'); ?>"  type="hidden" name="hargadeal" id="hargadeal"  class="form-control" >
                                        <input style="text-align:right"  value="<?php echo number_format($reg['harga_deal'],'0','','.'); ?>" readonly  type="text" name="terbilangdeal" id="terbilangdeal"  class="form-control" >
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Registrasi</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" value="<?php echo number_format($reg['biaya_registrasi'],'0','','.'); ?>" onkeyup="calc()"  name="jmlregis" id="jmlregis"  type="text" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Sisa</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" value="0" onkeyup="calc()"  name="sisa" id="sisa" type="hidden" readonly class="form-control">
                                        <input style="text-align:right" value="0" onkeyup="calc()"  name="terbilangsisa" id="terbilangsisa" type="text" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Jumlah Cicilan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" value="<?php echo number_format($reg['jml_cicilan'],'0','','.'); ?>" onkeyup="calc()" name="jmlcicilan" id="jmlcicilan" value="0"  type="text" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Biaya/Cicilan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['cicilanper'],'0','','.'); ?>"  type="hidden" name="cicilanper" id="cicilanper" class="form-control">
                                        <input style="text-align:right" readonly  value="<?php echo number_format($reg['cicilanper'],'0','','.'); ?>"  type="text" readonly name="terbilangcicilan" id="terbilangcicilan" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Mulai Cicilan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="hidden" name="selisih" id="selisih">
                                        <input type="text" value="<?php echo $reg['tgl_registrasi']; ?>" name="mulaicicilan" id="mulaicicilan" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Keterangan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" name="keterangan" id="keterangan" value="<?php echo $reg['keterangan']; ?>" class="form-control">
                                      </div>
                                    </div>
                                  </fieldset>
                                  <div class="form-group row mt-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-8 col-md-8 col-xs-12">
                                      <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                                      <button type="submit" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</button>
                                    </div>
                                  </div>
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

    var py = document.getElementById('penyesuaian');
    py.addEventListener('keyup', function(e){
      py.value = formatRupiah(this.value, '');
      //alert(b);
    });
    var dp = document.getElementById('danapinjaman');
    dp.addEventListener('keyup', function(e){
      dp.value = formatRupiah(this.value, '');
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
        penyesuaian             = document.getElementById("penyesuaian").value;
        peny                    = penyesuaian.replace(/\./g,'');
        danapinjamanrupiah      = document.getElementById("danapinjaman").value;
        danapinjaman            = danapinjamanrupiah.replace(/\./g,'');
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
        if(peny == ""){
          peny = 0;
        }
        if(danapinjaman == ""){
          danapinjaman = 0;
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


        var result  = parseInt(hargapublish) - parseInt(potcash) - parseInt(potpres) - parseInt(potgel)-parseInt(potlainlain)-parseInt(danapinjaman)+parseInt(peny);
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

      $('#mulaicicilan').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
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
