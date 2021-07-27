<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/updatebayar" method="POST">
  <input id="jurusaninput" type="hidden" name="jurusaninput" value="<?php echo $jurusan;?>" readonly="readonly" >
  <input id="semesterinput" type="hidden" name="semesterinput" value="<?php echo $semester;?>" readonly="readonly" >
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="kodematakuliah" name ="kodematakuliah"  placeholder="Kode Matakuliah" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text"  class="form-control has-feedback-left" id="namamatakuliah" name ="namamatakuliah"  placeholder="Nama Matakuliah" >
      </div>
    </div>
  
    
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <a class="btn btn-success" href="#" id="simpanmatakuliah">Simpan</a>
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
    $("#simpanmatakuliah").click(function(e){
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
          url   : '<?php echo base_url(); ?>pendidikan/insertmatakuliah',
          data  : {kodematakuliah:kodematakuliah,namamatakuliah:namamatakuliah,jurusan:jurusan,semester:semester},
          cache : false,
          success : function(respond)
          {
            if(respond==1)
            {
              alert("Kode Matakuliah Sudah Ada !");
            }else{
              $("#modalmatakuliah").modal("hide");
              loadmatkul();
            }
            
          }
        });
      }

    });
  });
 
 </script>