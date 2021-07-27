<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatebayar" method="POST">
 <input id="kodekontrak" type="hidden" name="kodekontrak" value="<?php echo $hb['kode_registrasi'];?>" readonly="readonly" >
 <input id="nobukti" type="hidden" name="nobukti" value="<?php echo $hb['nobukti'];?>" readonly="readonly" >
 <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
 <input id="terimadari" name="terimadari" value="<?php echo $hb['terimadari'];?>" type="hidden" >
 <input id="keterangan_old" name="keterangan_old" value="<?php echo $hb['keterangan'];?>" type="hidden" >
 <div class="modal-body">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
       <input type="text"  class="form-control has-feedback-left" id="tglbayar" name ="tglbayar" value="<?php echo $hb['tgl']; ?>" placeholder="Tanggal Bayar" >
       <input type="hidden"  class="form-control has-feedback-left" id="tglbayar_old" name ="tglbayar_old" value="<?php echo $hb['tgl']; ?>" placeholder="Tanggal Bayar" >
     </div>
   </div>
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
       <input type="text" style="text-align:right" class="form-control has-feedback-left" value="<?php echo number_format($hb['bayar'],'0',',','.'); ?>" name ="bayar" id="byredit" placeholder="Masukan Nominal Bayar" >
       <input type="hidden" style="text-align:right" class="form-control has-feedback-left" value="<?php echo number_format($hb['bayar'],'0',',','.'); ?>" name ="bayar_old" id="byredit_old" placeholder="Masukan Nominal Bayar" >
     </div>
   </div>
   <div class="row">
     <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
       <select class="form-control" name="pilih">
         <option <?php  if($hb['nobtk'] != ""){echo "selected"; }?> value="btk">BTK</option>
         <option <?php  if($hb['nobtb'] != ""){echo "selected"; }?> value="btb">BTB</option>
       </select>
     </div>
     <?php
      if(!empty($hb['nobtk'])){
        $nobtkbtb = $hb['nobtk'];
      }else{
        $nobtkbtb = $hb['nobtb'];
      }
     ?>
     <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
       <input type="text" class="form-control has-feedback-left" value="<?php echo $nobtkbtb; ?>" name ="nobtkbtb" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
       <input type="hidden" class="form-control has-feedback-left" value="<?php echo $nobtkbtb; ?>" name ="nobtkbtb_old" id="nobtkbtb_old" placeholder="Kosongkan Jika Diisi Otomatis" >
     </div>
   </div>
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   <button class="btn btn-primary" type="submit">Simpan</button>
 </div>
 </form>
<script>
  var b = document.getElementById('byredit');
  b.addEventListener('keyup', function(e){
    b.value = formatRupiah(this.value, '');
    //alert(b);
  });
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }
  function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
  }
</script>
