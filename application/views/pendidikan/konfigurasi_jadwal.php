<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Konfigurasi Jadwal</h4>
            <span>Konfigurasi Jadwal</span>
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
            <li class="breadcrumb-item"><a href="#!">Konfigurasi Jadwal</a></li>
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
            <b>Konfigurasi Jadwal</b>
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
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="kelas" class="form-control" name="kelas">
                      <option value="">Pilih Kelas</option>
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
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Dosen</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadjadwal">
                </tbody>
              </table>
            </div>
            <hr>
            <a href="#" class="btn btn-sm btn-success" id="tambahjadwal"><i class="fa fa-user-plus"></i> Tambah Jadwal</a>
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
  <div class="modal fade bs-example" id="modaljadwal" tabindex="-1" role="dialog" aria-hidden="true" >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">JADUAL</h4>
        </div>
        <div id="modal-body">
        </div>
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
          loadjadwal();
       
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
          loadjadwal();

        }
      });
    });
    
    

    function loadjadwal()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      var kelas = $("#kelas").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadjadwal',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester,kelas:kelas},
        cache : false,
        success : function(respond)
        {
          $("#loadjadwal").html(respond);
        }
      });

    }
    $("#semester").change(function(e){
      e.preventDefault();
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      if (semester == '1' || semester=='2')
      {
        var tingkat = '1';
      }else {
        var tingkat = '2';
      }
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/getkelaslama',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,tingkat:tingkat},
        cache : false,
        success : function(respond)
        {
          $("#kelas").html(respond);
          loadjadwal();
        }
      });
  
    });

    $("#kelas").change(function(e){
      e.preventDefault();
      loadjadwal();
    });

    $("#tambahjadwal").click(function(e){
      e.preventDefault();
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      var kelas = $("#kelas").val();
      if(tahun_akademik=="")
      {
        swal("Opps","Silahkan Pilih Tahun Akademik Terlebih Dahulu !","warning");
      }else if(jurusan=="")
      {
        swal("Opps","Silahkan Pilih Jurusan Terlebih Dahulu !","warning");
      }else if(semester=="")
      {
        swal("Opps","Silahkan Pilih Semester Terlebih Dahulu !","warning");
      }else if(kelas=="")
      {
        swal("Opps","Silahkan Pilih Kelas Terlebih Dahulu !","warning");
      }else{
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/inputjadwal',
          data  : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester,kelas:kelas},
          cache : false,
          success : function(respond)
          {
            $("#modaljadwal").modal("show");
            $("#modal-body").html(respond);
          }
        });
        
      }
    });
    
  });
                      
  </script>