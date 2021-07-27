<form action="<?php echo base_url(); ?>konfigurasi/updateuser" id="masterjurusanedit" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
    <input type="hidden" name="usernameawal" required value="<?php echo $datauser['username'] ?>"  readonly id="usernameawal" class="form-control">
      <input type="text" name="username" required value="<?php echo $datauser['username'] ?>" readonly id="username" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
      <input type="password" name="password" required value="" id="password" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Lengkap</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
      <input type="text" name="fullname" required value="<?php echo $datauser['fullname'] ?>"  id="fullname" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Level</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
    <input type="text" name="level" required value="<?php echo $datauser['level'] ?>" readonly id="level" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Jabatan</label>
    <div class="col-sm-9 col-md-9 col-xs-12">
      <input type="text" name="jabatan" required value="<?php echo $datauser['jabatan'] ?>"  id="jabatan" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Update</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ti-back-left"></i> Batal</button>
    </div>
  </div>
</form>