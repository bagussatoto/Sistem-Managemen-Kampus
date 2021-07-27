<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatebayar" method="POST">
  <input id="tahun_akademikinput" type="hidden" name="tahun_akademikinput" value="<?php echo $tahun_akademik;?>" readonly="readonly" >
  <input id="jurusaninput" type="hidden" name="jurusaninput" value="<?php echo $jurusan;?>" readonly="readonly" >
  <input id="semesterinput" type="hidden" name="semesterinput" value="<?php echo $semester;?>" readonly="readonly" >
  <input id="kelasinput" type="hidden" name="kelasinput" value="<?php echo $kelas;?>" readonly="readonly" >
  <div class="modal-body">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12 form-group has-feedback">
        <select id="matakuliah" class="form-control" name="matakuliah">
          <option value="">Matakuliah</option>
          <?php
            foreach ($matkul as $m){
          ?>
            <option value="<?php echo $m->kode_matakuliah; ?>"><?php echo $m->matakuliah; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="sks" name ="sks"  placeholder="SKS" >
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12 form-group has-feedback">
        <select id="hari" class="form-control" name="hari">
          <option value="">Hari</option>
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>
          <option value="Sabtu">Sabtu</option>
          <option value="Minggu">Minggu</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="waktu" name ="waktu"  placeholder="00:00-00:00" >
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12 form-group has-feedback">
        <select id="dosen" class="form-control" name="dosen">
          <option value="">Dosen</option>
          <?php
            foreach ($dosen as $d){
          ?>
            <option value="<?php echo $d->kodedosen; ?>"><?php echo $d->nama_lengkap; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12 form-group has-feedback">
        <select id="ruangan" class="form-control" name="ruangan">
          <option value="">Ruangan</option>
          <?php
            foreach ($ruangan as $d){
          ?>
            <option value="<?php echo $d->ruangan; ?>"><?php echo $d->ruangan; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
  </div>
  
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <a class="btn btn-success" href="#" id="simpanjadwal">Simpan</a>
  </div>
 </form>

 <script>
  $(function(){

    function loadjadwal()
    {
      var tahun_akademik = $("#tahun_akademik").val();
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      var kelas = $("#kelas").val();
      $.ajax({
        type : 'POST',
        url  : '<?php echo base_url(); ?>pendidikan/loadjadwal',
        data : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester,kelas:kelas},
        cache : false,
        success : function(respond)
        {
          $("#loadjadwal").html(respond);
        }
      });

    }
    $("#simpanjadwal").click(function(e){
      e.preventDefault();
      var tahun_akademik = $("#tahun_akademikinput").val();
      var jurusan = $("#jurusaninput").val();
      var semester = $("#semesterinput").val();
      var kelas = $("#kelasinput").val();
      var matakuliah = $("#matakuliah").val();
      var sks = $("#sks").val();
      var hari = $("#hari").val();
      var waktu = $("#waktu").val();
      var dosen = $("#dosen").val();
      var ruangan = $("#ruangan").val();
      if(matakuliah=="")
      {
       alert("Matakuliah Harus Dipilih");
      }else if(sks=="")
      {
        alert("SKS Harus Di isi !");
      }else if(hari=="")
      {
        alert("Hari Harus Dipilih");
      }else if(waktu=="")
      {
        alert("Waktu Harus Diisi");
      }else if(dosen=="")
      {
        alert("Dosen Harus Dipilih");
      }else if(waktu=="")
      {
        alert("Ruangan Harus Dipilih");
      }else{
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/insertjadwal',
          data  : {tahun_akademik:tahun_akademik,jurusan:jurusan,semester:semester,kelas:kelas,
                   matakuliah:matakuliah,sks:sks,hari:hari,waktu:waktu,dosen:dosen,ruangan:ruangan
                  },
          cache : false,
          success : function(respond)
          {
            $("#modaljadwal").modal("hide");
            loadjadwal();
          }
        });
      }

    });
  });
 
 </script>