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
            <li class="breadcrumb-item"><a href="#!">Registrasi Tingkat 3</a></li>
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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Registrasi Mahasiswa Tingkat 3</a>
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
                                        <th scope="row">NIM</th>
                                        <td><?php echo $aplikan['nim']; ?></td>
                                      </tr>
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
                                        <th scope="row">Kelas</th>
                                        <td><?php echo $kelas['kelas']; ?></td>
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

                                <form action="<?php echo base_url(); ?>keuangan/insert_regissenior" id="formregis" method="post">
                                  <input type="hidden"  name="kode_aplikan" value="<?php echo $aplikan['kode_aplikan']; ?>">
                                  <input type="hidden"  name="kelas" value="<?php echo $kelas['kelas']; ?>">
                                  <input type="hidden"  id="ta_mkt" name="ta_mkt" value="<?php echo $ta; ?>">
                                  <input type="hidden"  name="tingkat" id="tingkat" value="<?php echo $tingkat; ?>">
                                  <!-- <input type="hidden"  name="kode_jurusan" value="<?php echo $aplikan['kode_jurusan']; ?>"> -->
                                  <fieldset class="mt-4">
                          					<legend>Data Registrasi</legend>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Tanggal Registrasi</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" value="<?php echo date('Y-m-d'); ?>" placeholder="Tanggal Registrasi"  name="tglregis"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Gelombang Registrasi</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="gelombangregis" class="form-control" name="gelombangregis">
                                          <option value="">Gelombang</option>
                                          <option value="1">1</option>
                    											<option value="2">2</option>
                    											<option value="3">3</option>
                    											<option value="4">4</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input  readonly   value="<?php echo $ta; ?>" name="ta" id="ta" type="text" class="form-control" placeholder="Tahun Akademik">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Status</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="status" class="form-control" name="status">
                                          <option value="">-- Pilih Status --</option>
                                          <?php
                                            foreach($status as $s){
                                          ?>
                                            <option value="<?php echo $s->status; ?>"><?php echo $s->status; ?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Jurusan</label>
                                      <div class="col-sm-3 col-md-3 col-xs-12">
                                        <select id="jurusan" class="form-control" name="kode_jurusan">
                                          <option value="">-- Pilih Jurusan --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Harga Publish</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="hidden" name="kodebiaya" id="kodebiaya" >
                                        <input style="text-align:right" readonly onkeyup="calc()"  name="hargapublish" id="hargapublish" type="text" class="form-control" placeholder="Harga Publish">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Gelombang</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="0"  name="potgel" id="potgel"   type="text" class="form-control" placeholder="Potongan Gelombang">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Prestasi</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="0"  type="text" name="potpres" id="potpres"  class="form-control" placeholder="Potongan Prestasi">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Cash</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right"  onkeyup="calc()" value="0"  type="text" name="potcash" id="potcash"  class="form-control" placeholder="Potongan Cash">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Potongan Lain Lain</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="0"  type="text" name="potlainlain" id="potlainlain"  class="form-control" placeholder="Potongan Lain Lain">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Harga Deal</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="0"  type="hidden" name="hargadeal" id="hargadeal"  class="form-control" >
                                        <input style="text-align:right"  value="0" readonly  type="text" name="terbilangdeal" id="terbilangdeal"  class="form-control" >
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Registrasi</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" value="0" onkeyup="calc()"  name="jmlregis" id="jmlregis"  type="text" class="form-control">
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
                                        <input style="text-align:right" value="10" onkeyup="calc()" name="jmlcicilan" id="jmlcicilan" value="0"  type="text" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Biaya/Cicilan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input style="text-align:right" onkeyup="calc()" value="0"  type="hidden" name="cicilanper" id="cicilanper" class="form-control">
                                        <input style="text-align:right" readonly  value="0"  type="text" readonly name="terbilangcicilan" id="terbilangcicilan" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Mulai Cicilan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="hidden" name="selisih" id="selisih">
                                        <input type="text" value="<?php echo date('Y-m-10'); ?>" name="mulaicicilan" id="mulaicicilan" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Keterangan</label>
                                      <div class="col-sm-4 col-md-4 col-xs-12">
                                        <input type="text" name="keterangan" id="keterangan" class="form-control">
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

      $("#status").change(function(){

        var status      = $("#status").val();
        var tingkat     = $("#tingkat").val();
        var ta          = $("#ta_mkt").val();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>keuangan/get_jurusan',
          data    : {status:status,tingkat:tingkat,ta:ta},
          cache   : false,
          success : function(html){
            $("#jurusan").html(html);
          }
        });
      })

      $("#jurusan").change(function(){

        var status      = $("#status").val();
        var tingkat     = $("#tingkat").val();
        var ta          = $("#ta_mkt").val();
        var jurusan     = $("#jurusan").val();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>keuangan/get_biaya',
          data    : {status:status,tingkat:tingkat,ta:ta,jurusan:jurusan},
          cache   : false,
          success : function(html){
            var biaya = html.split("|");
            $("#hargapublish").val(biaya[0]);
            $("#kodebiaya").val(biaya[1]);
            calc();

          }
        });
      })

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
