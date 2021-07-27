<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Pilih Data Siswa</h4>
            <span>Pilih Data Siswa</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Target & Kegiatan</a></li>
            <li class="breadcrumb-item"><a href="#!">Pilih Siswa</a></li>
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
            <h5>Pilih Siswa </h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url();?>marketing/pilihsiswa" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <select id="hello-single" class="form-control tahunakademik" name="tahun_akademik">
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
                <input type="hidden" name="pr" id="presenter" value="<?php echo $presenter;  ?>">
                <label class="col-sm-2 col-form-label">Presenter</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="hello-single" class="form-control presenter" name="presenter" >
                    <option value="">Semua Presenter</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Asal Sekolah</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control asalsekolah" name="asalsekolah">
                    <option  value="">Asal Sekolah</option>
                    <?php foreach($sekolah as $s){ ?>
                      <option <?php if($asalsekolah==$s->asal_sekolah){echo "selected";} ?> value="<?php echo $s->asal_sekolah; ?>"><?php echo $s->asal_sekolah; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Minat</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control minat" name="minat">
                    <option  value="">Minat</option>
                    <option <?php if($minat=='LP3I'){echo "selected";} ?> value="LP3I">LP3I</option>
                    <option <?php if($minat=='KAMPUS LAIN'){echo "selected";} ?> value="KAMPUS LAIN">KAMPUS LAIN</option>
                    <option <?php if($minat=='KERJA'){echo "selected";} ?> value="KERJA">KERJA</option>
                    <option <?php if($minat=='NIKAH'){echo "selected";} ?> value="NIKAH">NIKAH</option>
                    <option <?php if($minat=='WIRASWASTA'){echo "selected";} ?> value="WIRASWASTA">WIRASWASTA</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ranking</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control ranking" name="ranking">
                    <option  value="">Ranking</option>
                    <option  <?php if($ranking=='1'){echo "selected";} ?> value="1">1</option>
                    <option  <?php if($ranking=='2'){echo "selected";} ?> value="2">2</option>
                    <option  <?php if($ranking=='3'){echo "selected";} ?> value="3">3</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $tgllahir; ?>"  placeholder="Tanggal Lahir"  name="tgllahir" id="tgllahir" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penghasilan Orangtua</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control penghasilanortu" name="penghasilanortu">
                    <option value=""><?php echo $penghasilanortu; ?></option>
                    <option <?php if($penghasilanortu=='< 1.000.000'){echo "selected";} ?>  value="< 1.000.000">< 1.000.000</option>
                    <option <?php if($penghasilanortu=='1.000.000 - 2.000.000'){echo "selected";} ?> value="1.000.000 - 2.000.000">1.000.000 - 2.000.000</option>
                    <option <?php if($penghasilanortu=='2.000.000 - 4.000.000'){echo "selected";} ?> value="2.000.000 - 4.000.000">2.000.000 - 4.000.000 </option>
                    <option <?php if($penghasilanortu=='> 5.000.000'){echo "selected";} ?> value="> 5.000.000">> 5.000.000</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value="<?php echo $nama_aplikan; ?>" autocomplete="off" name="nama_aplikan" id="nama_aplikan" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari Siswa</button>
                </div>
              </div>
            </form>

            <p>Terdapat [ <b><?php echo $totaldata; ?></b> ] Siswa Tahun Akademik <b><?php echo $tahun_akademik; ?></b></p>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Tgl Lahir</th>
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
                      <td><?php echo $d['tgl_lahir'] ?></td>
                      <td><?php echo $d['asal_sekolah']; ?></td>
                      <td><?php echo $d['no_hp']; ?></td>
                      <td><?php echo $d['nama_presenter']; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>marketing/inputaktivitaspresenter/<?php echo $d['kode_siswa']; ?>"  class="btn btn-mini btn-primary btn-xlg edit">Pilih</a>
                        <a href="#" data-kodesiswa="<?php echo $d['kode_siswa']; ?>" class="btn btn-mini btn-success btn-xlg detail">Detail</a>
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
  <div class="modal fade" id="modaldetailsiswa" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width:1000px !important"  role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Data Siswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="loaddetailsiswa">
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">

    $(function(){

      function loadPresenter()
      {
        var tahunakademik = $('.tahunakademik').val();
        var kodepresenter = $("#presenter").val();
        $.ajax({
          type      : 'POST',
          url       : '<?php echo base_url(); ?>marketing/listPresenter',
          data      : {ta:tahunakademik,kodepresenter:kodepresenter},
          cache     : false,
          success   : function(respond)
          {
            $(".presenter").html(respond);
          }
        });
      }

      $('#tgllahir').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });

      $('.detail').on('click',function(e){
        e.preventDefault();
        var kodesiswa = $(this).attr("data-kodesiswa");
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>marketing/detailmodalsiswa',
          data  : {kodesiswa:kodesiswa},
          cache : false,
          success : function(respond)
          {
            $("#loaddetailsiswa").html(respond);
            $("#modaldetailsiswa").modal("show");
          }
        });
      });
      loadPresenter();

    });
  </script>
