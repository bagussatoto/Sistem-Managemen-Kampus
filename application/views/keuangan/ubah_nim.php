<div class="modal-body">
  <form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatenim" method="POST">
    <input type="hidden" name="kodeaplikan" value="<?php echo $mhs['kode_aplikan']; ?>">
    <input type="hidden" name="tingkat" value="<?php echo $tingkat; ?>">
    <input type="hidden" name="halaman" value="<?php echo $halaman; ?>">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" readonly  class="form-control has-feedback-left" id="namalengkap" name ="namalengkap" value="<?php echo $mhs['nama_lengkap']; ?>" placeholder="Nama Lengkap" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"   class="form-control has-feedback-left" id="nim" name ="nim" value="<?php echo $mhs['nim']; ?>" placeholder="NIM" >
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form>
</div>
