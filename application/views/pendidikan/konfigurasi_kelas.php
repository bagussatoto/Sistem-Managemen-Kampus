<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Konfigurasi Kelas</h4>
            <span>Konfigurasi Kelas</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#!">Konfigurasi</a></li>
            <li class="breadcrumb-item"><a href="#!">Konfigurasi Kelas</a></li>
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
            <b>Konfigurasi Kelas</b>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                
                  <select id="tahun_akademik" class="form-control" name="tahun_akademik">
                    <option value="">Tahun Akademik</option>
                    <?php
                      foreach ($ta as $t){
                    ?>
                      <option value="<?php echo $t->tahun_akademik; ?>"><?php echo $t->tahun_akademik; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="jurusan" class="form-control" name="jurusan">
                      <option value="">Pilih Jurusan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tingkat</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="tingkat" class="form-control" name="tingkat">
                      <option value="">Pilih Tingkat</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelas Lama</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="kelaslama" class="form-control" name="kelaslama">
                      <option value="">Kelas Lama</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelas Baru</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="kelasbaru" class="form-control" name="kelasbaru">
                      <option value="">Kelas Baru</option>
                  </select>
                </div>
              </div>
            </form>
            
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kelas</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadmhs">
                </tbody>
              </table>
            </div>
            <hr>
           
           
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('pendidikan/menu_konfigurasi');
        ?>
      </div>
    </div>
  </div>
  
  <script>
   $(function(){
    $("#tahun_akademik").change(function(e){
      e.preventDefault();
      var tahun_akademik = $("#tahun_akademik").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/getjurusan',
        data : {tahun_akademik:tahun_akademik},
        cache : false,
        success : function(respond)
        {
          $("#jurusan").html(respond);
        }
      });
    });

    $("#jurusan").change(function(e){
      e.preventDefault();
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/gettingkat',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan},
        cache : false,
        success : function(respond)
        {
          $("#tingkat").html(respond);
        }
      });
    });

    $("#tingkat").change(function(e){
      e.preventDefault();
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var tingkat = $("#tingkat").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/getkelaslama',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,tingkat:tingkat},
        cache : false,
        success : function(respond)
        {
          $("#kelaslama").html(respond);
        }
      });
    });

    function loadmhs()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var tingkat = $("#tingkat").val();
      var kelaslama = $("#kelaslama").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadkelasmhs',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,tingkat:tingkat,kelaslama:kelaslama},
        cache : false,
        success : function(respond)
        {
          $("#loadmhs").html(respond);
        }
      });

    }

    function loadkelasbaru()
    {
      var jurusan = $("#jurusan").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/getkelasjurusan',
        data : {jurusan:jurusan},
        cache : false,
        success : function(respond)
        {
          $("#kelasbaru").html(respond);
        }
      });
    }
    $("#kelaslama").change(function(){
      //loadmhs();
      loadkelasbaru();
      loadmhs();
    });
  });
                      
  </script>