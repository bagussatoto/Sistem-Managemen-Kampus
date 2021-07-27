<form action="<?php echo base_url(); ?>marketing/update_aktivitas" id="target" method="post" autocomplete="off">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Kode Aktivitas</label>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <input type="text" value="<?php echo $aktivitas['kode_aktivitas']; ?>" readonly name="kodeaktivitas" id="kodeaktivitas" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Nama Target</label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <input type="text" value="<?php echo $aktivitas['nama_aktivitas']; ?>" name="namaaktivitas" id="namaaktivitas" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Tahun Akademik</label>
    <div class="col-sm-3 col-md-3 col-xs-12">
      <input type="text" readonly name="ta_mkt" id="ta_mkt" value="<?php echo $aktivitas['ta_mkt']; ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label"></label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
      <button type="submit" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</button>
    </div>
  </div>
</form>
<script type="text/javascript">
$(function(){
  $('#target').bootstrapValidator({
  // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
  feedbackIcons: {
    valid      : 'glyphicon glyphicon-ok',
    invalid    : 'glyphicon glyphicon-remove',
    validating : 'glyphicon glyphicon-refresh'
  },
  fields: {
      kodeaktivitas: {
        validators: {
          notEmpty: {
            message: 'Kode Aktivitas Harus Diisi !'
          },
          stringLength: {
            min: 5,
            max: 5,
            message: 'Kode Target Harus 6 Karakter ex. K2001'
          }
        }
      },

      namaaktivitas: {
        validators: {
          notEmpty: {
            message: 'Nama Aktivitas Harus Diisi !'
          }
        }
      },

    }
  });
});
</script>
