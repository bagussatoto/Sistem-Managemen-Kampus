<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Export WA BLAST</h4>
            <span>Export WA Blast</span>
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
            <li class="breadcrumb-item"><a href="#!">Aplikan & Siswa</a></li>
            <li class="breadcrumb-item"><a href="#!">WA Blast</a></li>
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
            <h5>Export WA Blast</h5>
          </div>
          <div class="card-block">
            <form action="<?php echo base_url(); ?>marketing/exportexcel" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
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
                      <option value="<?php echo $s->nama_sekolah; ?>"><?php echo $s->nama_sekolah; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Minat</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control minat" name="minat">
                    <option  value="">Minat</option>
                    <option  value="LP3I">LP3I</option>
                    <option value="KAMPUS LAIN">KAMPUS LAIN</option>
                    <option value="KERJA">KERJA</option>
                    <option value="NIKAH">NIKAH</option>
                    <option value="WIRASWASTA">WIRASWASTA</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ranking</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control ranking" name="ranking">
                    <option  value="">Ranking</option>
                    <option  value="1">1</option>
                    <option  value="2">2</option>
                    <option  value="3">3</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <input type="text" value=""  placeholder="Tanggal Lahir"  name="tgllahir" id="tgllahir" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penghasilan Orangtua</label>
                <div class="col-sm-6 col-md-6 col-xs-12">
                  <select id="hello-single" class="form-control penghasilanortu" name="penghasilanortu">
                    <option value="">Penghasilan Ortu</option>
                    <option  value="< 1.000.0000">< 1.000.000</option>
                    <option value="1.0000.0000 - 2.000.000">1.000.000 - 2.000.000</option>
                    <option value="2.000.000 - 4.000.000">2.000.000 - 4.000.000 </option>
                    <option value="> 5.000.000">> 5.000.000</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-success"><i class="ti-export"></i>  Export Excel</button>
                </div>
              </div>
            </form>
            <hr>

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

    function loadPresenter()
    {
      var tahunakademik = $('.tahunakademik').val();
      var kodepresenter = $("#kodepresenter").val();
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
    loadPresenter();



  });

</script>
