
<form class="form-horizontal form-label-left" name="edit_data" id="frmeditbayar" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatetarget" method="POST">
  <input type="hidden" name="kode_target" value="<?php echo $target['kode_target']; ?>">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <select disabled class="form-control" name="tingkat" id="tingkat" required>
          <option value="">-- Pilih Tingkat --</option>
          <?php foreach($tk as $t){ ?>
            <option <?php if($target['tingkat']==$t->kode_tingkat){echo "selected"; } ?> value="<?php echo $t->kode_tingkat ?>"><?php echo $t->nama_tingkat; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="jmlmhs" value="<?php echo $target['jmlmhs'] ?>" id="jmlmhs" placeholder="Target Mahasiswa" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="omset" value="<?php echo number_format($target['omset'],'0','','.'); ?>" id="omset" placeholder="Target Omset" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="hargaratarata" value="<?php echo number_format($target['hargaratarata'],'0','','.'); ?>" id="hargaratarata" placeholder="Target Harga Rata Rata" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 col-sm-12 col-xs-12 form-group has-feedback">
        <input readonly type="text" value="<?php echo substr($target['tahun_akademik'],0,4); ?>" class="form-control has-feedback-left" onkeyup="hitungangkatan();" name ="tahun" id="tahunedit" placeholder="Tahun Ajaran" required>
      </div>
      <div class="col-md-2 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" style="text-align:center" class="form-control has-feedback-left" value="/" readonly>
      </div>
      <div class="col-md-5 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" value="<?php echo substr($target['tahun_akademik'],5,4); ?>" class="form-control has-feedback-left" readonly name ="tahun2" id="tahun2edit" placeholder="Tahun Ajaran">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <select class="form-control" name="status" id="status" required >
          <option  value="">-- Pilih Status --</option>
          <option <?php if($target['status']=='LP3I'){echo "selected"; } ?> value="LP3I">LP3I</option>
          <option <?php if($target['status']=='DNBS'){echo "selected"; } ?> value="DNBS">DNBS</option>
          <option <?php if($target['status']=='UNWIM'){echo "selected"; } ?> value="UNWIM">UNWIM</option>
          <option <?php if($target['status']=='STT'){echo "selected"; } ?>>STT</option>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
  </div>
</form>

<script>
  var b = document.getElementById('biayaedit');
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

  function hitungangkatan()
  {
    angkatan=eval(edit_data.tahun.value)
    angkatani=angkatan+1
    angkatani = angkatani || 0
    edit_data.tahun2.value = angkatani
  }
</script>
<script type="text/javascript">
  $(function(){
    $('#frmeditbayar').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        tingkat: {
          validators: {
            notEmpty: {
              message: 'Tingkat Harus Diisi !'
            },
          }
        },

        jurusan: {
          validators: {
            notEmpty: {
              message: 'Jurusan Harus Diisi !'
            },
          }
        },

        biaya: {
          validators: {
            notEmpty: {
              message: 'Biaya Harus Diisi !'
            },
          }
        },

        tahun: {
          validators: {
            notEmpty: {
              message: 'Tahun Harus Diisi !'
            },
            regexp: {
                regexp: /^[0-9]+$/,
                message: 'Harus Angka !'
            },
            stringLength: {
              min: 4,
              max: 4,
              message: 'Tahun Akademik Harus 4 Karakter ex. 2020'
            },
          }
        },

        status: {
          validators: {
            notEmpty: {
              message: 'Status Harus Diisi !'
            },
          }
        },
      }
    });

  });
</script>
