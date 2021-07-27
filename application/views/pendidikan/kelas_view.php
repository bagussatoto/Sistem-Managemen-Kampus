<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Kelas</h4>
            <span>Data Kelas</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Kelas</a></li>
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
                <label class="col-sm-2 col-form-label">Tahun Angkatan</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control tahun_angkatan" name="tahun_angkatan">
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
            </form>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Nama Kelas</th>
                    <th>Jurusan</th>
                    <th>Pembimbing Akademik</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadkelas">
                </tbody>
              </table>
            </div>
            <hr>
            <a href="#" class="btn btn-sm btn-success" id="tambahkelas"><i class="fa fa-user-plus"></i> Tambah Kelas</a>
           
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
  <div class="modal fade bs-example" id="modalkelas" tabindex="-1" role="dialog" aria-hidden="true" >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">KELAS</h4>
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

      $(".tahun_angkatan").change(function(){
        var tahun_angkatan = $(this).val();
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/getkelas',
          data  : {tahun_angkatan:tahun_angkatan},
          cache : false,
          success : function(respond)
          {
            $("#loadkelas").html(respond);
          }
        });
      });

      $("#tambahkelas").click(function(e){
        e.preventDefault();
        var tahun_angkatan = $(".tahun_angkatan").val();
        if(tahun_angkatan == "")
        {
          swal("Oops!", "Silahkan Pilih Tahun Angkatan !", "warning");
        }else{
          $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url(); ?>pendidikan/inputkelas',
            data  : {tahun_angkatan:tahun_angkatan},
            cache : false,
            success : function(respond)
            {
              $("#modalkelas").modal("show");
              $("#modal-body").html(respond);
            }
          });
        }
      });
    });
  </script>
