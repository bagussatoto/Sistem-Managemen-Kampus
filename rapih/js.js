$(function() {



  function ceksetoran() {
    var tgllhp = $("#tgllhpkb").val();
    var salesman = $("#salesmankb").val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>penjualan/ceksetoran',
      data: {
        tgllhp: tgllhp,
        salesman: salesman
      },
      cache: false,
      success: function(respond) {

        $("#ceksetoran").val(respond);
      }

    });
  }

  function hidekuranglebih() {
    $("#kuranglebih").hide();
  }

  function showlhp() {
    var tanggallhp = $("#tgllhpkb").val();
    var salesman = $("#salesmankb").val();
    var cabang = $("#cabangkb").val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>penjualan/get_setoran',
      data: {
        tanggallhp: tanggallhp,
        salesman: salesman
      },
      cache: false,
      success: function(respond) {
        console.log(respond);
        datasetoran = respond.split("|");
        totallhp = parseInt(datasetoran[0]) + parseInt(datasetoran[1]);
        $("#tunai").val(datasetoran[0]);
        $("#tagihan").val(datasetoran[1]);
        $("#bgcek").val(datasetoran[2]);
        $("#totalsetoran").val(datasetoran[2]);
        $("#girotocash").val(datasetoran[3]);
        $("#totallhp").val(totallhp);
        terbilang(datasetoran[0], 'tunai');
        terbilang(datasetoran[1], 'tagihan');
        terbilang(totallhp, 'totallhp');
        terbilang(datasetoran[2], 'bgcek');
        terbilang(datasetoran[2], 'totalsetoran');
        terbilang(datasetoran[3], 'girotocash');
        $("#detaillhp").attr('href', '<?php echo base_url(); ?>laporanpenjualan/cekkasbesar/' + cabang + '/' + tanggallhp + '/' + salesman);
        ceksetoran();
      }


    });
  }


  function terbilang(angka, jenis) {

    $.ajax({

      type: 'POST',
      url: '<?php echo base_url(); ?>penjualan/terbilang',
      data: {
        angka: angka
      },
      cache: false,
      success: function(respond) {
        if (jenis == 'tunai') {
          $("#terbilang").html(respond);
        } else if (jenis == 'tagihan') {
          $("#terbilangtagihan").html(respond);
        } else if (jenis == 'totallhp') {
          $("#terbilangtotallhp").html(respond);
        } else if (jenis == 'uangkertaslogam') {
          // $("#terbilanguangkertaslogam").html(respond);
        } else if (jenis == 'bgcek') {
          $("#terbilangbg").html(respond);
        } else if (jenis == 'uanglogam') {
          //$("#terbilanguanglogam").html(respond);
        } else if (jenis == 'kurangsetor') {
          //$("#terbilangkurangsetor").html(respond);
        } else if (jenis == 'lebihsetor') {
          //$("#terbilanglebihsetor").html(respond);
        } else if (jenis == 'lainnya') {
          //$("#terbilanglainnya").html(respond);
        } else if (jenis == 'totalsetoran') {
          $("#terbilangtotalsetoran").html(respond);
        } else if (jenis == 'girotocash') {
          $("#terbilanggirotocash").html(respond);
        }

      }

    });

  }
  ceksetoran();
  hidekuranglebih();
  $("#detailtunai").click(function(e) {
    $("#panel").slideToggle("slow");

  });

  $("#tgllhpkb").change(function() {
    ceksetoran();
    showlhp();
  });
  $("#cabangkb").selectpicker("refresh");
  $("#cabangkb").change(function() {
    var tgllhp = $("#tgllhpkb").val();
    var cabang = $("#cabangkb").val();

    if (tgllhp != "") {


      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>laporanpenjualan/get_salesman',
        data: {
          cabang: cabang
        },
        cache: false,
        success: function(respond) {

          $("#salesmankb").html(respond);
          $("#salesmankb").selectpicker("refresh");

        }

      });
    } else {
      $('#cabangkb').prop('selectedIndex', 0);
      $("#cabangkb").selectpicker("refresh");
      swal("Oops!", "Silahkan Isi Tanggal LHP Dulu.. !", "warning");
    }
  });

  $("#salesmankb").change(function(e) {

    e.preventDefault();
    showlhp();


  });


  $("#uangkertas").on('keyup keydown change', function() {

    var uangkertas = $("#uangkertas").val();
    terbilang(uangkertas, 'uangkertaslogam');

  });

  $("#uanglogam").on('keyup keydown change', function() {

    var uanglogam = $("#uanglogam").val();
    terbilang(uanglogam, 'uanglogam');

  });
  $("#kurangsetor").on('keyup keydown change', function() {

    var kurangsetor = $("#kurangsetor").val();
    terbilang(kurangsetor, 'kurangsetor');

  });

  $("#lebihsetor").on('keyup keydown change', function() {

    var lebihsetor = $("#lebihsetor").val();
    terbilang(lebihsetor, 'lebihsetor');

  });

  $("#lainnya").on('keyup keydown change', function() {

    var lebihsetor = $("#lainnya").val();
    terbilang(lebihsetor, 'lainnya');

  });

  $("#totalsetoran").on('keyup keydown change', function() {

    var totalsetoran = $("#totalsetoran").val();
    terbilang(totalsetoran, 'totalsetoran');

  });

  $('.datepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    clearButton: true,
    weekStart: 1,
    time: false
  });


  $("#formValidate").submit(function() {
    var tgllhp = $("#tgllhpkb").val();
    var cabang = $("#cabangkb").val();
    var salesman = $("#salesmankb").val();
    var ceksetoran = $("#ceksetoran").val();

    if (tgllhp == "") {
      swal("Oops!", "Tanggal LHP Harus Diisi.. !", "warning");
      return false;
    } else if (cabang == "") {
      swal("Oops!", "Cabang Harus Diisi!", "warning");
      return false;
    } else if (salesman == "") {
      swal("Oops!", "Salesman Harus Diisi!", "warning");
      return false;
    } else if (ceksetoran > 0) {
      swal("Oops!", "Data ini Sudah Ada!", "warning");
      return false;
    } else {
      return true;
    }

  });

});
