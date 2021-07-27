<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Matakuliah</h4>
            <span>Data Matakuliah</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Matakuliah</a></li>
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
            <b>Data Kelas</b>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="jurusan" class="form-control" name="jurusan">
                  <option value="">Jurusan</option>
                    <?php
                      foreach ($jurusan as $t){
                    ?>
                      <option value="<?php echo $t->kode_jurusan; ?>"><?php echo $t->nama_jurusan; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="semester" class="form-control" name="semester">
                    <option value="">Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
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
                    <th>Jurusan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadmatkul">
                </tbody>
              </table>
            </div>
            <hr>
            <a href="#" class="btn btn-sm btn-success" id="tambahmatakuliah"><i class="fa fa-user-plus"></i> Tambah Matakuliah</a>
           
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('pendidikan/menu_master');
        ?>
      </div>
    </div>
  </div>
  <div class="modal fade bs-example" id="modalmatakuliah" tabindex="-1" role="dialog" aria-hidden="true" >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">MATAKUKLIAH</h4>
        </div>
        <div id="modal-body">
        </div>
      </div>
   </div>
  </div>
  <script type="text/javascript">
    $(function(){
      $('.hapus').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                title             : 'Yakin di Hapus ?',
                text              : '',
                //html              : true,
                confirmButtonColor: '#d43737',
                showCancelButton  : true,
                },function(){
                window.location.href = getLink
              });
          return false;
      });

      function loadmatkul()
      {
        var jurusan = $("#jurusan").val();
        var semester = $("#semester").val();
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/getmatakuliah',
          data  : {jurusan:jurusan,semester:semester},
          cache : false,
          success : function(respond)
          {
            $("#loadmatkul").html(respond);
          }
        });
      }

      loadmatkul();
      $("#jurusan").change(function(e){
        e.preventDefault();
        loadmatkul();
      });
      $("#semester").change(function(e){
        e.preventDefault();
        loadmatkul();
      });
      $("#tambahmatakuliah").click(function(e){
        e.preventDefault();
        var jurusan = $("#jurusan").val();
        var semester = $("#semester").val();
        if(jurusan == "")
        {
          swal("Oops!", "Silahkan Pilih Jurusan !", "warning");
        }else if(semester == "")
        {
          swal("Oops!", "Silahkan Pilih Semester !", "warning");
        }else{
          $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url(); ?>pendidikan/inputmatakuliah',
            data  : {jurusan:jurusan,semester:semester},
            cache : false,
            success : function(respond)
            {
              $("#modalmatakuliah").modal("show");
              $("#modal-body").html(respond);
            }
          });
        }
      });
    });
  </script>
