<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Konfigurasi Matakuliah</h4>
            <span>Konfigurasi Matakuliah</span>
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
            <li class="breadcrumb-item"><a href="#!">Konfigurasi Matakuliah</a></li>
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
            <b>Konfigurasi Matakuliah</b>
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
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="semester" class="form-control" name="semester">
                      <option value="">Pilih Semester</option>
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
                    <th>Kode Matakuliah</th>
                    <th>Matakuliah</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadmatkul">
                </tbody>
              </table>
            </div>
            <hr>
            
            <table class="table  table-striped table-sm table-styling">
              <thead>
                <tr style="background-color:#0ac282; color:white">
                    <th colspan="5">DATA MATAKULIAH <span id="tahun"></span></th>
                </tr>
                <tr class="table-inverse">
                  <th>#</th>
                  <th>Kode Matakuliah</th>
                  <th>Matakuliah</th>
                  <th>Semester</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="loadmatkulaktif">
              </tbody>
            </table>
            
           
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
      $("#tahun").text(tahun_akademik);
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/getjurusan',
        data : {tahun_akademik:tahun_akademik},
        cache : false,
        success : function(respond)
        {
          $("#jurusan").html(respond);
          loadmatkul();
          loadmatkulaktif();
        }
      });
    });

    $("#jurusan").change(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/getsemester',
        cache : false,
        success : function(respond)
        {
          $("#semester").html(respond);
          loadmatkul();
          loadmatkulaktif();
        }
      });
    });
    
    
    function loadmatkulaktif()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadmatkulaktif',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester},
        cache : false,
        success : function(respond)
        {
          $("#loadmatkulaktif").html(respond);
        }
      });

    }


    function loadmatkul()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadmatkul',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester},
        cache : false,
        success : function(respond)
        {
          $("#loadmatkul").html(respond);
        }
      });

    }
    $("#semester").change(function(e){
      e.preventDefault();
      loadmatkul();
      loadmatkulaktif();
    });
  });
                      
  </script>