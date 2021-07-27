<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="#" method="POST">
  <input id="jurusaninput" type="hidden" name="jurusaninput" value="<?php echo $matkul['kode_jurusan'];?>" readonly="readonly" >
  <input id="semesterinput" type="hidden" name="semesterinput" value="<?php echo $matkul['semester'];?>" readonly="readonly" >
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" readonly  class="form-control has-feedback-left" id="kodematakuliah" name ="kodematakuliah" value="<?php echo $matkul['kode_matakuliah'];?>"   placeholder="Kode Matakuliah" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="namamatakuliah" name ="namamatakuliah" value="<?php echo $matkul['matakuliah'];?>"  placeholder="Nama Matakuliah" >
      </div>
    </div>
  
    
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <a class="btn btn-success" href="#" id="updatematakuliah">Simpan</a>
  </div>
 </form>

 <script>
  $(function(){

    function loadmatkul()
    {
      var jurusan = $("#jurusan").val();
      var semester = $("#semester").val();
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>pendidikan/getmatakuliah',
        data  : {jurusan:jurusan,semester:semester},
        cache : false,
        success : function(respond)
        {
          $("#loadmatkul").html(respond);
        }
      });
    }
    $("#updatematakuliah").click(function(e){
      e.preventDefault();
      var jurusan = $("#jurusaninput").val();
      var semester = $("#semesterinput").val();
      var kodematakuliah = $("#kodematakuliah").val();
      var namamatakuliah = $("#namamatakuliah").val();
      //alert(namamatakuliah);

      if(kodematakuliah=="")
      {
        alert("Kode Matakuliah Harus Diisi !");
      }else if(namamatakuliah=="")
      {
        alert("Matakuliah Harus Diisi !");
      }else{
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url(); ?>pendidikan/updatematakuliah',
          data  : {kodematakuliah:kodematakuliah,namamatakuliah:namamatakuliah,jurusan:jurusan,semester:semester},
          cache : false,
          success : function(respond)
          {
            $("#modalmatakuliah").modal("hide");
              loadmatkul();
            
          }
        });
      }

    });
  });
 
 </script>