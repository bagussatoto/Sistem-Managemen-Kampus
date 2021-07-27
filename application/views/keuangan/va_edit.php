<form action="<?php echo base_url(); ?>keuangan/updateva" id="" method="post" >
  <input type="hidden" name="koderegistrasi" value="<?php echo $va['kode_registrasi']; ?>">
  <input type="hidden" name="expiredate" value="<?php echo $va['expiredate']; ?>">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">VA</label>
    <div class="col-sm-10 col-md-10 col-xs-12">
      <input type="text" readonly name="va" value="<?php echo $va['va']; ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">NIM</label>
    <div class="col-sm-10 col-md-10 col-xs-12">
      <input type="text" readonly name="nim" value="<?php echo $va['nim']; ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10 col-md-10 col-xs-12">
      <input type="text" readonly name="nama" value="<?php echo $va['nama_lengkap']; ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">No HP</label>
    <div class="col-sm-10 col-md-10 col-xs-12">
      <input type="text" readonly name="nohp" value="<?php echo $va['no_hp']; ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tagihan</label>
    <div class="col-sm-10 col-md-10 col-xs-12">
      <input type="text" style="text-align:right" id="tagihan" name="tagihan" value="<?php echo number_format($va['tagihan'],'0','','.'); ?>" class="form-control">
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">Simpan</button>
  </div>
</form>

<script>
  var b = document.getElementById('tagihan');
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
