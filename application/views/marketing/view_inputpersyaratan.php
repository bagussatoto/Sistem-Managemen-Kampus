<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Pengumpulan Persyaratan Aplikan</h4>
            <span>Data Persyaratan Aplikan</span>
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
            <li class="breadcrumb-item"><a href="#!">Persyaratan Aplikan</a></li>
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
            <h5>Data Persyaratan <?php echo $tingkat; ?></h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $nama_aplikan; ?>" name="nama_aplikan" id="nama_aplikan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control" name="tahun_akademik">
                    <?php
                      foreach ($ta as $t){
                    ?>
                      <option <?php if($tahun_akademik == $t->tahun_akademik){echo "selected";} ?> value="<?php echo $t->tahun_akademik; ?>"><?php echo $t->tahun_akademik; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Aplikan</button>
                </div>
              </div>
            </form>

            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Mahasiswa Tahun Akademik <b><?php echo $tahun_akademik; ?></b></p>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jurusan</th>
                    <th>Progress</th>
                    <th>Aksi</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d)
                    {
                      $persentase = round($d['jmlsyarat']/$jmlsyarat*100);
                      if($persentase < 50)
                      {
                        $color ="danger";
                      }else if($persentase <80)
                      {
                        $color = "warning";
                      }else{
                        $color = "success";
                      }
                  ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><a href="<?php echo base_url(); ?>marketing/detailmhs/<?php echo $d['kode_aplikan']; ?>" style="color:#01a9ac"><?php echo $d['nim']; ?></a></td>
                      <td><?php echo $d['nama_lengkap']; ?></td>
                      <td><?php echo $d['nama_jurusan']; ?></td>
                      <td>
                        <div class="progress ">
                          <div class="progress-bar progress-bar-striped progress-bar-<?php echo $color;?>" role="progressbar" style="width: <?php echo $persentase; ?>%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"><label><?php echo $persentase; ?>%</label></div>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="btn btn-mini btn-success upload" data-kodeaplikan="<?php echo $d['kode_aplikan']; ?>"><i class="ti-upload"></i></a>
                        <a href="#" class="btn btn-mini btn-info detail" data-kodeaplikan="<?php echo $d['kode_aplikan']; ?>"><i class="ti-eye"></i></a>
                      </td>

                    </tr>
                  <?php
                      $sno++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div style='margin-top: 10px;'>
              <?php echo $pagination; ?>
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
  <div class="modal fade" id="modalpersyaratan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Detail</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="loadformpersyaratan">
          </div>
        </div>
      </div>
   </div>
  <script type="text/javascript">
  $(function(){
    $('.upload').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-kodeaplikan");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/inputpersyaratanaplikanfrm',
        data    : {kode:kode},
        cache   : false,
        success : function(respond){
          $("#loadformpersyaratan").html(respond);
          $("#modalpersyaratan").modal("show");
          console.log(respond);
        }
      });
    });

    $('.detail').on('click',function(e){
      e.preventDefault();
      var kode     = $(this).attr("data-kodeaplikan");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>marketing/detailpersyaratanaplikan',
        data    : {kode:kode},
        cache   : false,
        success : function(respond){
          $("#loadformpersyaratan").html(respond);
          $("#modalpersyaratan").modal("show");
          console.log(respond);
        }
      });

    });
  })

  </script>
