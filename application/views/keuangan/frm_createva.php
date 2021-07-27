<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Transaksi</h4>
            <span>Virtual Account</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
            <li class="breadcrumb-item"><a href="#!">Create VA</a></li>
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
        <!-- Default card start -->
        <div class="card">
          <div class="card-header">
            <h5>Create Virtual Account </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>keuangan/insertcreateva" id="" method="post" target="_blank">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="tahun_akademik" class="form-control" name="tahun_akademik">
                    <?php
                      foreach ($ta as $t){
                    ?>
                      <option <?php if($t->tahun_akademik == $tahun_akademik){echo "selected";} ?> value="<?php echo $t->tahun_akademik; ?>"><?php echo $t->tahun_akademik; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tingkat</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="tingkat" class="form-control" name="tingkat">
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="jurusan" class="form-control" name="jurusan">
                      <option value="">-- Jurusan --</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="kelas" class="form-control" name="kelas">
                      <option value="">-- Kelas --</option>
                  </select>
                </div>
              </div>
              <div class="row" id="tgl">
                <label class="col-sm-4 col-lg-2 col-form-label">s/d Tanggal</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="ti-calendar"></i></span>
                    <input type="text" value="<?php echo date("Y-m-d"); ?>" id="batastgl" name="batastgl" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-printer"></i>  Create Virtual Account</button>
                </div>
              </div>
              <table class="table table-bordered table-hover table-striped">
                <thead style="background-color:#dff0d8">
                  <tr class="success">
                    <th style="width:100px">
                      <input type="checkbox" onClick="toggle(this)"> Check All
                    </th>
                    <th>No</th>
                    <th>NIM</th>
                    <th>VA</th>
                    <th style="text-align:left">Nama</th>
                    <th style="text-align:left">Tlp/HP</th>
                    <th style="text-align:left">Expired Date</th>
                    <th style="text-align:left">Expired Time</th>
                    <th style="text-align:right">Sisa Tunggakan</th>
                  </tr>
                </thead>
                <tbody id="loaddatatunggakan">
                </tbody>
              </table>
            </form>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_transaksi');
        ?>
      </div>
    </div>
  </div>
  <script>
  function toggle(pilih)
  {
    checkboxes = document.getElementsByName('data[]');
    for(var i=0, n=checkboxes.length;i<n;i++)
    {
      checkboxes[i].checked = pilih.checked;
     }
   }
  </script>
  <script type="text/javascript">
    $(function(){
      function loaddatatunggakan(){
       var surat        = $("#surat").val();
        var ta          = $("#tahun_akademik").val();
        var tingkat     = $("#tingkat").val();
        var kelas       = $("#kelas").val();
        var batastgl    = $("#batastgl").val();
        //alert(batastgl);
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>keuangan/loadtunggakanva',
          cache   : false,
          data    : {ang:ta,tingkat:tingkat,kelas:kelas,batastgl:batastgl,surat:surat},
          success : function(respond){
            $("#loaddatatunggakan").html(respond);
          }
        });
      }


      function loadtingkat()
      {
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>keuangan/gettingkat',
          cache   : false,
          success : function(respond){
            $("#tingkat").html(respond);
          }
        });
      }

      $("#tahun_akademik").change(function(){
        loadtingkat();
        loaddatatunggakan();
      });

      $("#tingkat").change(function(){
        var ta        = $("#tahun_akademik").val();
        var tingkat   = $("#tingkat").val();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>keuangan/getjur',
          data    : {ta:ta,tingkat:tingkat},
          cache   : false,
          success : function(respond){
            loaddatatunggakan();
            $("#jurusan").html(respond);
          }
        });
      });

      $("#jurusan").change(function(){
        var ta          = $("#tahun_akademik").val();
        var tingkat     = $("#tingkat").val();
        var jurusan     = $("#jurusan").val();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>keuangan/getkelas',
          data    : {ta:ta,tingkat:tingkat,jurusan:jurusan},
          cache   : false,
          success : function(respond){
            $("#kelas").html(respond);
            loaddatatunggakan();
          }
        });
      });

      $("#kelas").change(function(e){
        e.preventDefault();
        loaddatatunggakan();
      });

      $("#batastgl").change(function(e){
        e.preventDefault();
        loaddatatunggakan();
      });

      $("#surat").change(function(e){
        e.preventDefault();
        loaddatatunggakan();
      });
      $('#batastgl').bootstrapMaterialDatePicker
  		({
  			time: false,
  			clearButton: true,
  		});
      $("#tgl").hide();
      loadtingkat();
    });
  </script>
