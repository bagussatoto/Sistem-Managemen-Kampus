<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Transaksi</h4>
            <span>Data Transaksi</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
            <li class="breadcrumb-item"><a href="#!">Pembayaran <?php echo $tingkat; ?></a></li>
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
            <?php if($tingkat=='t3'){ ?>
              <h5>Pembayaran <?php echo "Tingkat III"; ?></h5>
            <?php }else if($tingkat=='t4'){ ?>
              <h5>Pembayaran <?php echo "Tingkat IV"; ?></h5>
            <?php }else{ ?>
              <h5>Pembayaran <?php echo $tingkat; ?></h5>
            <?php } ?>
          </div>
          <div class="card-block">

            <form action="<?php echo base_url(); ?>keuangan/pembayaran/<?php echo strtolower($tingkat); ?>" id="frmcariaplikan" method="post">
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
                  <button type="submit" name="sync" class="btn btn-success"><i class="ti-loop"></i>  Sync</button>
                </div>
              </div>
            </form>

            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Mahasiswa Tahun Akademik <b><?php echo $tahun_akademik; ?></b></p>
            <p>
              <?php if($ceksync['notsync'] !=0){ ?>
                [ <b><?php echo $ceksync['notsync']; ?></b> ] <label for="" class="label label-danger">Not Synchronized</label>
              <?php }else{ ?>
                [ <b><?php echo $totaldata; ?></b> ] <label for="" class="label label-success">Synchronized</label>
              <?php } ?>
            </p>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Status</th>
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
                      <td><a href="<?php echo base_url(); ?>marketing/detailmhs/<?php echo $d['kode_aplikan']; ?>" style="color:#01a9ac"><?php echo $d['nim']; ?></a></td>
                      <td><?php echo $d['nama_lengkap']; ?></td>
                      <td><?php echo $d['nama_jurusan']; ?></td>
                      <td><?php echo $d['kelas']; ?></td>
                      <td><?php echo $d['no_hp']; ?></td>
                      <td><?php echo $d['status']; ?></td>
                      <td><?php echo $d['status_akademik']; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>keuangan/detail/<?php echo $d['kode_registrasi']; ?>"  class="btn btn-mini btn-primary btn-xlg edit">Rincian</a>
                        <a href="#"  data-kodeaplikan="<?php echo $d['kode_aplikan']; ?>" class="btn btn-mini btn-danger btn-xlg ubahnim">Ubah Nim</a>
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
         $this->load->view('keuangan/menu_transaksi');
        ?>
      </div>
    </div>
  </div>
  <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">UBAH NIM</h4>
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
                text              : 'Dengan Menghapus Data Pendaftaran Juga Akan Menghapus Data Ujian,Wawancara dan Registrasi',
                //html              : true,
                confirmButtonColor: '#d43737',
                showCancelButton  : true,
                },function(){
                window.location.href = getLink
              });
          return false;
      });

      $('.ubahnim').click(function(e){
        e.preventDefault();
        var kodeaplikan = $(this).attr("data-kodeaplikan");
        var tingkat     = '<?php echo $this->uri->segment(3); ?>';
        var halaman     = '<?php echo $this->uri->segment(4); ?>';
        //alert(halaman);
        $.ajax({
          type : 'POST',
          url  : '<?php echo base_url(); ?>keuangan/ubahnim',
          data : {kodeaplikan:kodeaplikan,tingkat:tingkat,halaman:halaman},
          cache : false,
          success : function(respond)
          {
            $("#modaledit").modal("show");
            $("#modal-body").html(respond);
          }
        });
      });
    });
  </script>
