<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Aplikan & Siswa</h4>
            <span>Aplikan & Siswa</span>
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
            <li class="breadcrumb-item"><a href="#!">Database Siswa</a></li>
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
            <h5>Database Siswa </h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Siswa</label>
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
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Siswa</button>
                </div>
              </div>
            </form>
            <a href="<?php echo base_url(); ?>marketing/inputsiswa" class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i> Input Siswa</a>
            <hr>
            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Siswa Tahun Akademik <b><?php echo $tahun_akademik; ?></b></p>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Asal Sekolah</th>
                    <th>No HP</th>
                    <th>Presenter</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d)
                    {
                  ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><a href="<?php echo base_url(); ?>marketing/detailsiswa/<?php echo $d['kode_siswa']; ?>" style="color:#01a9ac"><?php echo $d['nama_lengkap']; ?></a></td>
                      <td><?php echo $d['asal_sekolah']; ?></td>
                      <td><?php echo $d['no_hp']; ?></td>
                      <td><?php echo $d['nama_presenter']; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>marketing/editsiswa/<?php echo $d['kode_siswa']; ?>"  class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
                        <a href="<?php echo base_url(); ?>marketing/hapussiswa/<?php echo $d['kode_siswa']; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
                        <?php if(!empty($d['kode_aplikan'])){?>
                          <a href="" class="btn btn-mini btn-success btn-xlg">Aplikan</i></a>
                        <?php } else{ ?>
                          <a href="<?php echo base_url(); ?>marketing/jadikanaplikan/<?php echo $d['kode_siswa']; ?>" class="btn btn-mini btn-info btn-xlg">Jadikan Aplikan</i></a>
                        <?php } ?>
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
    });
  </script>
