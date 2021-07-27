<form class="form-horizontal form-label-left" id="cust_form" enctype="multipart/form-data" autocomplete="off"  action="<?php echo base_url(); ?>marketing/insert_persyartanaplikan" method="POST">
  <div class="col-md-12">
    <div class="row">
      <div class="col-sm-3 bg-c-lite-green user-profile">
        <div class="card-block text-center text-white">
          <div class="m-b-25">
            <img src="<?php echo base_url(); ?>assets/images/user-profile/user-img.jpg" class="img-radius" alt="User-Profile-Image">
          </div>
          <h6 class="f-w-600"><?php echo $aplikan['nama_lengkap']; ?></h6>
          <input type="hidden"  name="kodeaplikan" value="<?php echo $aplikan['kode_aplikan']; ?>">
          <input type="hidden"  name="namaaplikan" value="<?php echo $aplikan['nama_lengkap']; ?>">
          <p><?php echo $aplikan['nama_jurusan']; ?></p>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="card-block">
          <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Upload Persyaratan</h6>
          <div class="form-group row">
            <div class="col-sm-12 col-md-12 col-xs-12">
              <select id="hello-single" class="form-control" name="jenispersyaratan" required>
                <option value="">Persyaratan</option>
                <?php
                  foreach ($persyaratan as $m){
                ?>
                  <option value="<?php echo $m->kode_persyaratan; ?>"><?php echo $m->nama_persyaratan; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 col-md-12 col-xs-12">
              <input type="file" value="" placeholder="Upload File"  name="file" id="file" class="form-control" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-8 col-md-8 col-xs-12">
              <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</form>
