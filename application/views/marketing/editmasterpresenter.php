<form action="<?php echo base_url(); ?>marketing/updatemasterpresenter" id="masterpresenteredit" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Presenter</label>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <input type="text" name="kodepresenter" required value="<?php echo $presenter['kode_presenter'] ?>" readonly id="kodepresenter" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Jurusan</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
      <input type="text" name="namapresenter" required value="<?php echo $presenter['nama_presenter'] ?>" id="namapresenter" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Update</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ti-back-left"></i>  Batal</button>
    </div>
  </div>
</form>
