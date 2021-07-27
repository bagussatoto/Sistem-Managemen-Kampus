<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Database Sekolah</h4>
            <span>Database Sekolah</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Aplikan & Siswa</a></li>
            <li class="breadcrumb-item"><a href="#!">Database Sekolah</a></li>
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
            <h5>Database Sekolah</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/insert_dbsekolah" id="frmsekolah" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Sekolah</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" name="namasekolah" placeholder="Nama Sekolah" id="namasekolah" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
                </div>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling" id="simpletable">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Nama Sekolah</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no=1;
                    foreach($sekolah as $s){
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $s->nama_sekolah; ?></td>
                      <td>
                        <a href="#" data-kode="<?php echo $s->id; ?>" class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
                      </td>
                    </tr>
                  <?php
                      $no++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('marketing/menu_aplikansiswa');
        ?>
      </div>
    </div>
  </div>
  <!-- Modal large-->
  <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Database Sekolah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="loadformedit">

          </div>

        </div>
      </div>
   </div>
  <script type="text/javascript">

    $(document).ready(function() {
      $('#frmsekolah').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          namasekolah: {
            validators: {
              notEmpty: {
                message: 'Nama Sekolah Harus Diisi !'
              },

            }
          },


        }
      });


      $('.edit').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr("data-kode");
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>marketing/editdbsekolah',
          data    : {id:id},
          cache   : false,
          success : function(respond){
            $("#loadformedit").html(respond);
            $("#modaledit").modal("show");

            console.log(respond);
          }
        });

      });

      $('#simpletable').DataTable();


    });

  </script>
