<form action="<?php echo base_url(); ?>marketing/update_target" id="target" method="post" autocomplete="off">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Kode Target</label>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <input type="text" value="<?php echo $target['kode_target']; ?>" readonly name="kodetarget" id="kodetarget" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Nama Target</label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <input type="text" value="<?php echo $target['nama_target']; ?>" name="namatarget" id="namatarget" class="form-control">
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
        kodetarget: {
          validators: {
            notEmpty: {
              message: 'Kode Targt Harus Diisi !'
            },
            stringLength: {
              min: 6,
              max: 6,
              message: 'Kode Target Harus 6 Karakter ex. TR2001'
            }
          }
        },

        namatarget: {
          validators: {
            notEmpty: {
              message: 'Nama Target Harus Diisi !'
            }
          }
        },

      }
    });
  });
</script>
