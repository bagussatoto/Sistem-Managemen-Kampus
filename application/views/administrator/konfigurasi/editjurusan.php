<form action="<?php echo base_url(); ?>konfigurasi/updatejurusan" id="masterjurusan" method="post">
  <input type="hidden" name="id" value="<?php echo $jurusan['id']; ?>">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Jurusan</label>
    <div class="col-sm-6 col-md-4 col-xs-12">
      <select id="hello-single" class="form-control" name="kodejurusan" readonly>
        <option value="<?php echo $jurusan['kode_jurusan']; ?>"><?php echo $jurusan['nama_jurusan']; ?></option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Uanga Kuliah Junior</label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <input type="text" name="uangjunior" value="<?php echo number_format($jurusan['uang_junior'],'0','','.'); ?>" style="text-align:right" id="u_junior" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Uanga Kuliah Senior</label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <input type="text" name="uangsenior" id="u_senior" value="<?php echo number_format($jurusan['uang_senior'],'0','','.'); ?>"  class="form-control" style="text-align:right">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-8 col-md-8 col-xs-12">
      <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
      <button type="submit" class="btn btn-danger"><i class="ti-back-left"></i>  Batal</button>
    </div>
  </div>
</form>
<script>
   var uj = document.getElementById('u_junior');
   uj.addEventListener('keyup', function(e){
     uj.value = formatRupiah(this.value, '');
     //alert(b);
   });

   var us = document.getElementById('u_senior');
   us.addEventListener('keyup', function(e){
     us.value = formatRupiah(this.value, '');
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
