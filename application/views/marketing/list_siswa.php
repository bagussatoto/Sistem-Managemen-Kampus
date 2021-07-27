<div class="table-responsive">
  <table class="table  table-striped table-sm tabelsiswa">
    <thead>
      <tr class="table-inverse">
        <th>Kode Siswa</th>
        <th>Nama Siswa</th>
        <th>No HP</th>
        <th>Nama Ortu</th>
        <th>No HP Ortu</th>
        <th>Asal sekolah</th>
        <th>Kelas</th>
        <th>Tgl Lahir</th>
        <th>Aksi</th>
      </tr>
    </thead>

</div>
<script>
var oTable;
$(document).ready(function () {
"use strict";
 //  $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
 //  {
 //    return {
 //      "iStart": oSettings._iDisplayStart,
 //      "iEnd": oSettings.fnDisplayEnd(),
 //      "iLength": oSettings._iDisplayLength,
 //      "iTotal": oSettings.fnRecordsTotal(),
 //      "iFilteredTotal": oSettings.fnRecordsDisplay(),
 //      "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
 //      "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
 //    };
 //  };
 //
 //  var oTable  = $(".tabelsiswa").dataTable({
 //    initComplete: function() {
 //      var api = this.api();
 //      $('#tabelsiswar_filter input')
 //          .off('.DT')
 //          .on('keyup.DT', function(e) {
 //            if (e.keyCode == 13) {
 //              api.search(this.value).draw();
 //        }
 //      });
 //    },
 //    oLanguage: {
 //      sProcessing: "loading..."
 //    },
 //    processing		: true,
 //    serverSide		: true,
 //    bLengthChange	: false,
 //    stateSave     :  true,
 //    ajax: {"url": "get_siswa", "type": "POST"},
 //    columns: [
 //      {
 //        "data"        : "kode_siswa",
 //        "orderable"   : true
 //      },
 //
 //      {"data": "kode_siswa"},
 //      {"data": "nama_lengkap"},
 //      {"data": "no_hp"},
 //      {"data": "nama_ortu"},
 //      {"data": "nohp_ortu"},
 //      {"data": "asal_sekolah"},
 //      {"data": "kelas"},
 //      {"data": "tgl_lahir"},
 //      {"data": "view"}
 //    ],
 //
 //    order: [[1, 'asc']],
 //    rowCallback: function(row, data, iDisplayIndex) {
 //      var info = this.fnPagingInfo();
 //      var page = info.iPage;
 //      var length = info.iLength;
 //      var index = page * length + (iDisplayIndex + 1);
 //      $('td:eq(0)', row).html(index);
 //    }
 //  });
 //  yadcf.init(oTable,[
 //
 //     {column_number : 2,  filter_type: "text"},
 //
 //  ]);
 // $('#tabelsiswa tbody').on('click', '.hapus', function () {
 //      var getLink = $(this).attr('href');
 //      swal({
 //              title             : 'Alert',
 //              text              : 'Hapus Data?',
 //              html              : true,
 //              confirmButtonColor: '#d9534f',
 //              showCancelButton  : true,
 //              },function(){
 //              window.location.href = getLink
 //          });
 //      return false;
 //  });

 $.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
 {
     if ( typeof sNewSource != 'undefined' && sNewSource != null ) {
         oSettings.sAjaxSource = sNewSource;
     }

     // Server-side processing should just call fnDraw
     if ( oSettings.oFeatures.bServerSide ) {
         this.fnDraw();
         return;
     }

     this.oApi._fnProcessingDisplay( oSettings, true );
     var that = this;
     var iStart = oSettings._iDisplayStart;
     var aData = [];

     this.oApi._fnServerParams( oSettings, aData );

     oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
         /* Clear the old information from the table */
         that.oApi._fnClearTable( oSettings );

         /* Got the data - add it to the table */
         var aData =  (oSettings.sAjaxDataProp !== "") ?
             that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

         for ( var i=0 ; i<aData.length ; i++ )
         {
             that.oApi._fnAddData( oSettings, aData[i] );
         }

         oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

         if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true )
         {
             oSettings._iDisplayStart = iStart;
             that.fnDraw( false );
         }
         else
         {
             that.fnDraw();
         }

         that.oApi._fnProcessingDisplay( oSettings, false );

         /* Callback user function - for event handlers etc */
         if ( typeof fnCallback == 'function' && fnCallback != null )
         {
             fnCallback( oSettings );
         }
     }, oSettings );
 };
 oTable = $('.tabelsiswa').DataTable({
  "colReorder": true,
  "processing": true,
  "serverSide": true,
  "ajax": {
    "url": "get_siswa",
    "type": "POST"
  },
  "language": {
      "infoFiltered": " - filtered from _MAX_ records"
  },
  "columns": [
     {data: "kode_siswa"},
     {data: "nama_lengkap"},
     {data: "no_hp"},
     {data: "nama_ortu"},
     {data: "nohp_ortu"},
     {data: "asal_sekolah"},
     {data: "kelas"},
     {data: "tgl_lahir"},
     {data: "view"}
],
"stateSave":  true
})
yadcf.init(oTable, [

{
   column_number: 2,
   filter_type: "text"
},

]);

});
</script>
