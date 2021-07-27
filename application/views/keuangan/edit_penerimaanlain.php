<form class="form-horizontal form-label-left" id="payment-form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatelainlain" method="POST">
  <input id="nobukti" name="nobukti" value="<?php echo $hb['nobukti'];?>" type="hidden" >
  <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
   <div class="modal-body">
    <div class="row">
      <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
        <select class="form-control" name="pilih">
          <option <?php  if($hb['nobtk'] != ""){echo "selected"; }?> value="btk">BTK</option>
          <option <?php  if($hb['nobtb'] != ""){echo "selected"; }?> value="btb">BTB</option>
        </select>
      </div>
      <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
        <?php
         if(!empty($hb['nobtk'])){
           $nobtkbtb = $hb['nobtk'];
         }else{
           $nobtkbtb = $hb['nobtb'];
         }
        ?>
        <input type="text" class="form-control has-feedback-left" name ="nobtkbtb" value="<?php echo $nobtkbtb;  ?>" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <?php if($jenis =='DANAPINJAMAN'){ ?>
          <input type="hidden" name="kode_transaksi" value="<?php echo $hb['kode_transaksi']; ?>">
          <input type="hidden"  class="form-control has-feedback-left" id="terimadari" value="<?php echo $hb['terimadari']; ?>" name ="terimadari"  placeholder="Terima Dari" required>
        <?php }else{ ?>
          <input type="text"  class="form-control has-feedback-left" id="terimadari" value="" name ="terimadari"  placeholder="Terima Dari" required>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <?php if($jenis =='DANAPINJAMAN'){ ?>
          <input type="hidden" name="pilihjenis" value="DANA PINJAMAN">
        <?php }else{ ?>
        <select class="form-control" name="pilihjenis" required>
          <option value="">-- Pilih Jenis Pembayaran --</option>
          <option <?php if($hb['jenis']=="SEWA"){ echo "selected"; } ?> value="SEWA">Sewa</option>
          <option <?php if($hb['jenis']=="KARYAWAN"){ echo "selected"; } ?> value="KARYAWAN">Kelas Karyawan</option>
          <option <?php if($hb['jenis']=="PARKIR"){ echo "selected"; } ?> value="PARKIR">Parkir</option>
          <option <?php if($hb['jenis']=="IHT"){ echo "selected"; } ?> value="IHT">IHT</option>
          <option <?php if($hb['jenis']=="KURSUS"){ echo "selected"; } ?> value="KURSUS">Kursus</option>
          <option <?php if($hb['jenis']=="LAINLAIN"){ echo "selected"; } ?> value="LAINLAIN">Lain-lain</option>
        </select>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="tglbayar" value="<?php echo $hb['tgl']; ?>" name ="tglbayar" placeholder="Tanggal Bayar" >

      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" style="text-align:right" class="form-control has-feedback-left" value="<?php echo number_format($hb['bayar'],'0','','.');?>" name ="bayar" id="byredit" placeholder="Masukan Nominal Bayar" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" value="<?php echo $hb['keterangan']; ?>"  class="form-control" placeholder="Keterangan" name="ket">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-primary" type="submit" id="pay-button">Save changes</button>
  </div>
</form>
