<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style media="screen">
    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      font-family: Tahoma;
      }

      .table th,
      .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #eceeef;
      }

      .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #eceeef;
      }

      .table tbody + tbody {
      border-top: 2px solid #eceeef;
      }

      .table .table {
      background-color: #fff;
      }

      .table-sm th,
      .table-sm td {
      padding: 0.3rem;
      }

      .table-bordered {
      border: 1px solid #eceeef;
      }

      .table-bordered th,
      .table-bordered td {
      border: 1px solid #eceeef;
      }

      .table-bordered thead th,
      .table-bordered thead td {
      border-bottom-width: 2px;
      }

      .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0, 0, 0, 0.05);
      }

      .table-hover tbody tr:hover {
      background-color: rgba(0, 0, 0, 0.075);
      }

      .table-active,
      .table-active > th,
      .table-active > td {
      background-color: rgba(0, 0, 0, 0.075);
      }

      .table-hover .table-active:hover {
      background-color: rgba(0, 0, 0, 0.075);
      }

      .table-hover .table-active:hover > td,
      .table-hover .table-active:hover > th {
      background-color: rgba(0, 0, 0, 0.075);
      }

      .table-success,
      .table-success > th,
      .table-success > td {
      background-color: #dff0d8;
      }

      .table-hover .table-success:hover {
      background-color: #d0e9c6;
      }

      .table-hover .table-success:hover > td,
      .table-hover .table-success:hover > th {
      background-color: #d0e9c6;
      }

      .table-info,
      .table-info > th,
      .table-info > td {
      background-color: #d9edf7;
      }

      .table-hover .table-info:hover {
      background-color: #c4e3f3;
      }

      .table-hover .table-info:hover > td,
      .table-hover .table-info:hover > th {
      background-color: #c4e3f3;
      }

      .table-warning,
      .table-warning > th,
      .table-warning > td {
      background-color: #fcf8e3;
      }

      .table-hover .table-warning:hover {
      background-color: #faf2cc;
      }

      .table-hover .table-warning:hover > td,
      .table-hover .table-warning:hover > th {
      background-color: #faf2cc;
      }

      .table-danger,
      .table-danger > th,
      .table-danger > td {
      background-color: #f2dede;
      }

      .table-hover .table-danger:hover {
      background-color: #ebcccc;
      }

      .table-hover .table-danger:hover > td,
      .table-hover .table-danger:hover > th {
      background-color: #ebcccc;
      }

      .thead-inverse th {
      color: #fff;
      background-color: #292b2c;
      }

      .thead-default th {
      color: #464a4c;
      background-color: #eceeef;
      }

      .table-inverse {
      color: #fff;
      background-color: #292b2c;
      }

      .table-inverse th,
      .table-inverse td,
      .table-inverse thead th {
      border-color: #fff;
      }

      .table-inverse.table-bordered {
      border: 0;
      }

      .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -ms-overflow-style: -ms-autohiding-scrollbar;
      }

      .table-responsive.table-bordered {
      border: 0;
      }

      .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;

      }

      .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
      }

      .closebtn:hover {
        color: black;
      }
    </style>
  </head>
  <body>
    <table class="table" >
      <thead>
        <tr>
          <th colspan="2" style="background-color:#06377b; color:white" align="left">
            <img src="https://i.ibb.co/VpG4CKV/logoputihlp3i.png" width="50px" height="50px" style="float:left; margin-right:30px" alt="">
              KWITANSI PEMBAYARAN <br>
              LP3I TASIKMALAYA<br>
              <small>Jln. Ir. H. Djuanda No. 106 KM 2 Tasikmalaya Telp. (0265) 311766 </small>

          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>No Kwitansi</td>
          <td><?php echo $kw['nobukti']; ?></td>
        </tr>
        <tr>
          <td>No BTK</td>
          <td><?php echo $kw['nobtk']; ?></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td><?php echo DateToIndo2($kw['tgl']); ?></td>
        </tr>
        <tr>
          <td>Terima Dari</td>
          <td><?php echo $kw['terimadari']; ?></td>
        </tr>
        <tr>
          <td>Jumlah</td>
          <td><?php echo 'Rp. '. number_format($kw['bayar'],'0','','.'); ?></td>
        </tr>
        <tr>
          <td>Terbilang</td>
          <td><?php echo strtoupper(terbilang($kw['bayar'])) . ' RUPIAH'; ?></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          
          <td><?php if($kw['jenis']=='REGULER'){
          if($kw['tingkat']=="3"){
            $konelo="Pembayaran ". $kw['nama_jurusan']. " untuk ". $kw['keterangan'];
          }else{
            $konelo="Pembayaran tingkat ". $kw['nama_tingkat']. " untuk ". $kw['keterangan'];
          }
          //$konelo="Pembayaran $namatingkat untuk $keterangan";

        }else{
          $konelo=$kw['keterangan'];
        }
        
        echo  $konelo?></td>
        </tr>
        <tr>
          <td></td>
          <td align="center">
            Staff Keuangan <br><br><br>
            <?php echo $kw['kasir']; ?>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="alert">
      <strong>Informasi !</strong> Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini..
    </div>
  </body>
</html>
