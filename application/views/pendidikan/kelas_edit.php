<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatebayar" method="POST">
  <input id="tahun_angkatan2" type="hidden" name="tahun_angkatan2" value="<?php echo $kelas['tahun_akademik']; ?>" readonly="readonly" >
  <input id="kodekelas" type="hidden" name="kodekelas" value="<?php echo $kelas['kodekelas']; ?>" readonly="readonly" >
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="namakelas" name ="namakelas" value="<?php echo $kelas['namakelas']; ?>"  placeholder="Nama Kelas" >
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12 form-group has-feedback">
        <select id="hello-single2" class="form-control jurusan" name="jurusan">
          <option value="">Jurusan</option>
          <?php
            foreach ($jurusan as $m){
          ?>
            <option <?php if($kelas['kode_jurusan']==$m->kode_jurusan){echo "selected";} ?> value="<?php echo $m->kode_jurusan; ?>"><?php echo $m->nama_jurusan; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12 form-group has-feedback">
        <select id="hello-single" class="form-control pa" name="pa">
          <option value="">Pembimbing Akademik</option>
          <?php
            foreach ($dosen as $d){
          ?>
            <option <?php if($kelas['kode_pa']==$d->kodedosen){echo "selected";} ?> value="<?php echo $d->kodedosen; ?>"><?php echo $d->nama_lengkap; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
      
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <a class="btn btn-success" href="#" id="updatekelas">Simpan</a>
  </div>
 </form>

 <script>
  $(function(){

    function loadkelas()
    {
      var tahun_angkatan = $(".tahun_angkatan").val();
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>pendidikan/getkelas',
        data  : {tahun_angkatan:tahun_angkatan},
        cache : false,
        success : function(respond)
        {
          $("#loadkelas").html(respond);
        }
      });
    }
    $("#updatekelas").click(function(e){
      e.preventDefault();
      var kodekelas = $("#kodekelas").val();
      var tahun_angkatan = $("#tahun_angkatan2").val();
      var namakelas = $("#namakelas").val();
      var jurusan = $(".jurusan").val();
      var pa = $(".pa").val();

      if(tahun_angkatan=="")
      {
        swal("Oops !","Tahung Angkatan Harus Diisi !","warning");
      }else if(namakelas=="")
      {
        swal("Oops !","Nama Kelas Harus Diisi !","warning");
      }else if(jurusan=="")
      {
        swal("Oops !","Jurusan Harus Dipilih !","warning");
      }else if(pa=="")
      {
        swal("Oops !","PA Harus Dipilih !","warning");
      }else{
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/updatekelas',
          data  : {kodekelas:kodekelas,tahun_angkatan:tahun_angkatan,namakelas:namakelas,jurusan:jurusan,pa:pa},
          cache : false,
          success : function(respond)
          {
            $("#modalkelas").modal("hide");
            loadkelas();
          }
        });
      }

    });
  });
 
 </script>