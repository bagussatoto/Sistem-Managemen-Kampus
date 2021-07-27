<form action="<?php echo base_url(); ?>marketing/update_dbsekolah" id="frmsekolah" method="post">
  <input type="hidden"  name="id" value="<?php echo $sekolah['id']; ?>">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Nama Sekolah</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
      <input type="text" name="namasekolah" value="<?php echo $sekolah['nama_sekolah']; ?>" placeholder="Nama Sekolah" id="namasekolah" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label"></label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
    </div>
  </div>
</form>
