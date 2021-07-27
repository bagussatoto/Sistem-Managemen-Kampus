<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Keuangan</h4>
            <span>DP3</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">DP3</a></li>
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
            <h5>DP3 </h5>
          </div>
          <div class="card-block">
            <fieldset class="mb-4">
              <legend>Data Karyawan</legend>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-6 col-lg-6 col-xs-12">
                  <div class="input-group">
                    <input type="text"id="namakaryawan" readonly class="form-control" placeholder="Nama Karyawan">
                    <span class="input-group-addon" id="basic-addon3"><i class="ti-search"></i></span>
                 </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nomor Karyawan</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" id="nik" value="" readonly placeholder="Nomor Karyawan"  name="nik" id="nik" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Posisi & Grading</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="" readonly placeholder="Posisi & Grading"  name="posisi" id="jabatan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Departemen</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="" readonly placeholder="Departemen"  name="departemen" id="divisi" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Bergabung</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="" readonly placeholder="Tanggal Bergabung"  name="tglbergabung" id="tglbergabung" class="form-control">
                </div>
              </div>
              <input type="hidden" name="semester" id="semester" value="<?php echo $setdp3['semester']; ?>">
              <input type="hidden" name="tahun" id="tahun" value="<?php echo $setdp3['tahun']; ?>">
              <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select name="semester" id="semester" class="form-control">
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                  </select>
                </div>
              </div> -->
              <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select name="tahun" id="tahun" class="form-control">
                    <?php 
                      $tahun = 2019;
                      $tahunini = date("Y");
                      for($thn = $tahun; $thn<=$tahunini; $thn++){  
                    ?>
                      <option <?php if($tahunini == $thn){echo "Selected";} ?> value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                    <?php 
                      } 
                    ?>
                  </select>
                </div>
              </div> -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button id="proses" class="btn btn-primary"><i class="ti-stats-up"></i>  PROSES</button>
                </div>
              </div>
            </fieldset>
            <div id="penilaian"></div>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_dp3');
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example" id="modalkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width:1200px">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">List Data Karyawan</h4>
      </div>
      <div id="modal-bodykaryawan">
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    $("#basic-addon3").click(function(e){
      e.preventDefault();
      $("#modal-bodykaryawan").load("<?php echo base_url(); ?>keuangan/listkaryawan");
      $("#modalkaryawan").modal("show");
    });

    $("#proses").click(function(e){
      e.preventDefault();
      var nik     = $("#nik").val();
      var smt     = $("#semester").val();
      var tahun   = $("#tahun").val();
      if(nik=="")
      {
        swal("Oops!", "NIK Harus Diisi!", "warning");
      //}
      //else if(smt==""){
      //   swal("Oops!", "Semester Harus Diisi!", "warning");
      // }else if(tahun==""){
      //   swal("Oops!", "Tahun Harus Diisi!", "warning");
      }else{
        $.ajax({
          type   : 'POST',
          url    : '<?php echo base_url(); ?>keuangan/getdp3',
          data   : {nik:nik,smt:smt,tahun:tahun},
          cache  : false,
          success: function(respond)
          {
            $("#penilaian").html(respond);
          }
        });
      }

    });
   
   
    
  });
</script>