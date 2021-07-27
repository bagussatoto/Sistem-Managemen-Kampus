<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Keuangan</h4>
            <span>Data Master</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Biaya</a></li>
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
            <h5>Data Biaya </h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
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
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari </button>
                </div>
              </div>
            </form>
            <a href="#" id="add" class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i> Input Biaya</a>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Kode Biaya</th>
                    <th>Nama Jurusan</th>
                    <th>Tingkat</th>
                    <th>Biaya</th>
                    <th>Tahun Akademik</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach ($biaya as $b) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->kode_biaya; ?></td>
                      <td><?php echo $b->nama_jurusan; ?></td>
                      <td><?php echo $b->tingkat; ?></td>
                      <td align="right"><?php echo number_format($b->biaya,'0','','.'); ?></td>
                      <td><?php echo $b->tahun_akademik; ?></td>
                      <td><?php echo $b->status; ?></td>
                      <td>
                        <a href="#" data-kodebiaya = "<?php echo $b->kode_biaya; ?>"   class="btn btn-mini btn-primary btn-xlg edit"><i class="ti-pencil"></i></a>
                        <a href="<?php echo base_url(); ?>keuangan/hapusbiaya/<?php echo $b->kode_biaya; ?>" class="btn btn-mini btn-danger btn-xlg hapus"><i class="ti-trash"></i></a>
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
         $this->load->view('keuangan/menu_master');
        ?>
      </div>
    </div>
  </div>
   <div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
  	<div class="modal-dialog">
  	  <div class="modal-content">
  		<div class="modal-header">
  		  <h4 class="modal-title" id="myModalLabel">INPUT BIAYA</h4>
  		</div>
  		<form class="form-horizontal form-label-left" name="input_data" id="frmbayar" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/insertbiaya" method="POST">
  			<div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="tingkat" id="tingkat" required>
                <option value="">-- Pilih Tingkat --</option>
                <?php foreach($tk as $t){ ?>
                  <option value="<?php echo $t->kode_tingkat ?>"><?php echo $t->nama_tingkat; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="jurusan" id="jurusan" required >
                <option value="">-- Pilih Jurusan --</option>
                <?php foreach($jur as $j){ ?>
                  <option value="<?php echo $j->kode_jurusan ?>"><?php echo $j->nama_jurusan; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="biaya" id="biaya" placeholder="Jumlah Biaya" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" onkeyup="hitungangkatan();" name ="tahun" id="tahun" placeholder="Tahun Ajaran" required>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" style="text-align:center" class="form-control has-feedback-left" value="/" readonly>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" readonly name ="tahun2" id="tahun2" placeholder="Tahun Ajaran">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="status" id="status" required >
                <option value="">-- Pilih Status --</option>
                <option value="LP3I">LP3I</option>
                <option value="DNBS">DNBS</option>
                <option value="UNWIM">UNWIM</option>
                <option value="STT">STT</option>
              </select>
            </div>
          </div>
        </div>
  			<div class="modal-footer">
  			  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
  			  <button class="btn btn-primary" type="submit">Simpan</button>
  			</div>
  		</form>
  	  </div>
  	</div>
  </div>
  <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">EDIT BIAYA</h4>
        </div>
        <div class="modal-bodyedit">

        </div>
      </div>
    </div>
  </div>
  <script>
    var b = document.getElementById('biaya');
    b.addEventListener('keyup', function(e){
      b.value = formatRupiah(this.value, '');
      //alert(b);
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
    function convertToRupiah(angka){
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');
    }

    function hitungangkatan()
    {
      angkatan=eval(input_data.tahun.value)
      angkatani=angkatan+1
      angkatani = angkatani || 0
      input_data.tahun2.value = angkatani
    }
  </script>
  <script type="text/javascript">
    $(function(){
      $('#add').click(function(e){
        e.preventDefault();
        $("#modal").modal("show");
      });

      $('.edit').click(function(e){
        e.preventDefault();
        var kode_biaya = $(this).attr('data-kodebiaya');
        $.ajax
        ({
          type    : 'POST',
          url     : '<?php echo base_url();?>keuangan/editbiaya',
          data    : {kode_biaya:kode_biaya},
          cache   : false,
          success : function(respond)
          {
            $("#modaledit").modal("show");
            $(".modal-bodyedit").html(respond);
          }
        });

      });

      $('#frmbayar').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          tingkat: {
            validators: {
              notEmpty: {
                message: 'Tingkat Harus Diisi !'
              },
            }
          },

          jurusan: {
            validators: {
              notEmpty: {
                message: 'Jurusan Harus Diisi !'
              },
            }
          },

          biaya: {
            validators: {
              notEmpty: {
                message: 'Biaya Harus Diisi !'
              },
            }
          },

          tahun: {
            validators: {
              notEmpty: {
                message: 'Tahun Harus Diisi !'
              },
              regexp: {
                  regexp: /^[0-9]+$/,
                  message: 'Harus Angka !'
              },
              stringLength: {
                min: 4,
                max: 4,
                message: 'Tahun Akademik Harus 4 Karakter ex. 2020'
              },
            }
          },

          status: {
            validators: {
              notEmpty: {
                message: 'Status Harus Diisi !'
              },
            }
          },
        }
      });

      $('.hapus').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                title             : 'Yakin di Hapus ?',
                text              : '',
                html              : true,
                confirmButtonColor: '#d43737',
                showCancelButton  : true,
                },function(){
                window.location.href = getLink
              });
          return false;
      });

    });
  </script>
