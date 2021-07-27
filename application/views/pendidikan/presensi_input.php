<form action="<?php echo base_url(); ?>pendidikan/simpanpresensi" method="POST" id="presensi">
<input type="hidden" value="<?php echo $jadwal['kode_jadwal']; ?>" name="kodejadwal" id="kodejadwal">
<input type="hidden" value="<?php echo $jadwal['semester']; ?>" name="semester" id="semester">
<input type="hidden" value="<?php echo $jadwal['tahun_akademik']; ?>" name="tahun_akademik" id="tahun_akademik">
<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Input Presensi</h4>
            <span>Input Presensi</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Konfigurasi</a></li>
            <li class="breadcrumb-item"><a href="#!">Input Presensi</a></li>
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
                          <h2><?php echo $jadwal['nama_lengkap']; ?></h2>
                          <span class="text-white"><?php echo $jadwal['matakuliah']; ?></span>
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
                  <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Data Presensi</a>
                  <div class="slide"></div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#orantua" role="tab">Detail Presensi</a>
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
                    <h5 class="card-header-text">Data Presensi</h5>
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
                                        <th scope="row">Matakuliah</th>
                                        <td><?php echo $jadwal['matakuliah']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">SKS</th>
                                        <td><?php echo $jadwal['sks']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Semester</th>
                                        <td><?php echo $jadwal['semester']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Kelas</th>
                                        <td><?php echo $jadwal['kelas']; ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Dosen</th>
                                        <td><?php echo $jadwal['nama_lengkap']; ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                <table class="table m-0">
                                  <tbody>
                                    <tr>
                                      <th scope="row">Hari</th>
                                      <td><?php echo $jadwal['hari']; ?></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Waktu</th>
                                      <td><?php echo $jadwal['waktu']; ?></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Program Studi</th>
                                      <td><?php echo $jadwal['nama_jurusan']; ?></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Tanggal</th>
                                      <td>
                                      <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                          <input type="text"  class="form-control has-feedback-left" id="tglpresensi" name ="tglpresensi"  placeholder="Tanggal Presensi" >
                                        </div>
                                      </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Pertemuan</th>
                                      <td>
                                        <div class="row">
                                          <div class="col-md-6 col-sm-12 col-xs-12 form-group has-feedback">
                                            <select name="pertemuan" class="form-control" id="pertemuan">
                                              <option value="">Pilih Pertemuan</option>
                                              <?php 
                                                if($jadwal['sks']==4)
                                                {
                                                  $jmlpertemuan = 28;
                                                }else{
                                                  $jmlpertemuan = 14;
                                                }
                                                foreach($prt as $p){
                                              ?>
                                                <option value="<?php echo $p->pertemuan; ?>"><?php echo $p->pertemuan; ?></option>
                                              <?php 
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12" style="padding:60px">
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped ">
                                  <thead>
                                    <tr class="table-inverse">
                                      <th>No</th>
                                      <th>NIM</th>
                                      <th>Nama Lengkap</th>
                                      <th>Kelas</th>
                                      <th>Status</th>
                                      <th>Foto</th>
                                      <th>Presensi</th>
                                    </tr>
                                  </thead>
                                  <tbody id="loadmhs">
                                  
                                  </tbody>
                                </table>
                                <input type="hidden" name="jumlahmhs" id="jumlahmhs">
                                </div>
                                <label for="" class="control-label"><b>Pokok Bahasan</b></label>
                                <div class="form-group">
                                  <textarea name="materi" id="materi" placeholder="Pokok Bahasan" cols="30" rows="10"></textarea>
                                </div>
                                <label for="" class="control-label"><b>Motivator</b></label>
                                <div class="form-group">
                                <input type="text" placeholder="Motivator" id="motivator" class="form-control">
                                </div>
                                <label for="" class="control-label"><b>Motivasi</b></label>
                               <div class="form-group">
                                <textarea name="Motivasi" id="motivasi" placeholder="Motivasi cols="30" rows="10"></textarea>
                               </div>
                               
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" id="simpanpresensi"  class="btn btn-primary btn-lg btn-"><i class="fa fa-send"></i></button>
              </div>

              <div class="tab-pane" id="orantua" role="tabpanel">
                <!-- personal card start -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-header-text">Data Tatap Muka</h5>
                  </div>
                  <div class="card-block">
                    <div class="view-info">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="general-info">
                            <div class="row">
                              <div class="col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                  <table class="table m-0">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pertemuan</th>
                                        <th>Penginput</th>
                                        <th>Tgl Input</th>
                                        <th>Tgl Update</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $no = 1;foreach($presensi as $d){ ?>
                                        <tr>
                                          <td><?php echo $no; ?></td>
                                          <td><?php echo DateToIndo2($d->tgl_presensi); ?></td>
                                          <td><?php echo $d->pertemuan; ?></td>
                                          <td><?php echo $d->fullname; ?></td>
                                          <td><?php echo $d->tgl_input; ?></td>
                                          <td><?php echo $d->tgl_update; ?></td>
                                          <td>
                                            <a href="#" class="btn btn-info btn-mini edit" data-id="<?php echo $d->kode_jadwal; ?>"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url(); ?>keuangan/hapusbayar/<?php echo $d->kode_jadwal;  ?>" class="btn btn-danger btn-mini hapus"><i class="fa fa-trash-o"></i></a>
                                            <a href="<?php echo base_url(); ?>keuangan/cetakkwitansi/<?php echo $d->kode_jadwal;  ?>" class="btn btn-success btn-mini"><i class="fa fa-print"></i></a>
                                          </td>
                                        </tr>
                                      <?php $no++;} ?>
                                    </tbody>
                                  </table>
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
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
        <?php
         $this->load->view('pendidikan/menu_konfigurasi');
        ?>
      </div>
    </div>
  </div>
</div>
</form>
<script>tinymce.init({selector:'textarea'});</script>
<script>
  $(function(){
    function loadmhs()
    {
      var tahun_akademik = "<?php echo $jadwal['tahun_akademik']; ?>";
      var semester = "<?php echo $jadwal['semester']; ?>";
      var kelas = "<?php echo $jadwal['kelas']; ?>";
      var jurusan = "<?php echo $jadwal['kode_jurusan']; ?>";
      if(semester=="1" || semester=="2")
      {
        var tingkat = "1";
      }else{
        var tingkat = "2";
      }
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadpresensimhs',
        data : {tahun_akademik:tahun_akademik,tingkat:tingkat,kelas:kelas,jurusan:jurusan},
        cache : false,
        success : function(respond)
        {
          $("#loadmhs").html(respond);
        }
      });


    }
    $('#tglpresensi').bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true
    });

    $("#presensi").submit(function(e){
      var tglpresensi = $("#tglpresensi").val();
      var pertemuan = $("#pertemuan").val();
      var materi = $("#materi").val();
      var motivator = $("#motivator").val();
      var motivasi = $("#motivasi").val();
      if(tglpresensi==""){
        swal("Oops","Tanggal Presensi Harus Diisi","warning");
        $("#tglpresensi").focus();
        return false;
      }else if(pertemuan==""){
        swal("Oops","Pertemuan Harus Diisi","warning");
        $("#pertemuan").focus();
        return false;
      }else if(materi==""){
        swal("Oops","Materi Harus Diisi","warning");
        $("#materi").focus();
        return false;
      }else if(motivator==""){
        swal("Oops","Motivator Harus Diisi","warning");
        $("#motivator").focus();
        return false;
      }else if(motivasi==""){
        swal("Oops","Motivasi Harus Diisi","warning");
        return false;
      }else{
        return true;
      }
      
    });
    loadmhs();
  });

</script>
