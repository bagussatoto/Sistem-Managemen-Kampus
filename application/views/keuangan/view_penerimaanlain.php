<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Penerimaan Lain Lain</h4>
            <span>Penerimaan Lain Lain</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="index-1.htm">
                <i class="icofont icofont-home"></i>
              </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
            <li class="breadcrumb-item"><a href="#!">Penerimaan Lain</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page-header end -->
  <!-- Page body start -->
  <div class="page-body">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12">
        <!-- Default card start -->
        <div class="card">
          <div class="card-header">
            <h5>Data Penerimaan Lain</h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Terima Dari</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <input type="text" value="<?php echo $terimadari; ?>" name="terimadari" id="terimadari" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <div class="input-daterange input-group" id="datepicker">
                    <input type="text" value="<?php echo $dari; ?>" class="input-sm form-control" name="dari" id="dari" >
                    <input type="hidden" value="<?php echo $dari; ?>" class="input-sm form-control" name="dr" id="dr" >
                     <span class="input-group-addon">to</span>
                     <input type="text" value="<?php echo $sampai; ?>" class="input-sm form-control" name="sampai" id="sampai">
                     <input type="hidden" value="<?php echo $sampai; ?>" class="input-sm form-control" name="sm" id="sm">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-danger"><i class="ti-search"></i>  Cari</button>
                </div>
              </div>
            </form>
            <a href="#" class="btn btn-sm btn-success" id="inputpenerimaan"><i class="fa fa-plus"></i> Input Penerimaan Lain Lain</a>
            <hr>
            <div class="table-responsive">
              <table class="table  table-striped table-sm table-styling">
                <thead>
                  <tr class="table-inverse">
                    <th>Tgl</th>
                    <th>Terima Dari</th>
                    <th>Jumlah</th>
                    <th>Ket</th>
                    <th>Jenis</th>
                    <th>BTK/BTB</th>
                    <th>Kasir</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d)
                    {
                  ?>
                    <tr>
                      <td><?php echo $d['tgl']; ?></td>
                      <td><?php echo $d['terimadari']; ?></td>
                      <td><?php echo number_format($d['bayar'],'0','','.'); ?></td>
                      <td><?php echo $d['keterangan']; ?></td>
                      <td><?php echo $d['jenis']; ?></td>
                      <td><?php echo $d['nobtk']; ?></td>
                      <td><?php echo $d['kasir']; ?></td>
                      <td>
                        <a href="#" class="btn btn-primary btn-mini edit" data-id="<?php echo $d['nobukti']; ?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $d['nobukti']; ?>/II" class="btn btn-success btn-mini" target="_blank"><i class="fa fa-print"></i></a>
                        <a href="<?php echo base_url(); ?>keuangan/cetakkwitansi/<?php echo $d['nobukti']; ?>/II" class="btn btn-info btn-mini" target="_blank"><i class="fa fa-print"></i></a>
                        <a href="<?php echo base_url(); ?>keuangan/hapuspenerimaanlain/<?php echo $d['nobukti']; ?>" class="btn btn-danger btn-mini hapus"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                  <?php
                      $sno++;
                    }
                  ?>
                </tbody>
              </table>
              <div style='margin-top: 10px;'>
                <?php echo $pagination; ?>
             </div>
            </div>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
       <?php
        $this->load->view('keuangan/menu_transaksi');
       ?>
      </div>
    </div>
  </div>
  <!-- Modal large-->
  <div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">PENERIMAAN LAIN LAIN</h4>
        </div>
        <form class="form-horizontal form-label-left" id="payment-form" autocomplete="off"  action="<?php echo base_url(); ?>keuangan/insertlainlain" method="POST">
          <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
           <div class="modal-body">
            <div class="row">
              <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
                <select class="form-control" name="pilih">
                  <option value="btk">BTK</option>
                  <option value="btb">BTB</option>
                </select>
              </div>
              <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" name ="nobtkbtb" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text"  class="form-control has-feedback-left" id="terimadari" name ="terimadari"  placeholder="Terima Dari" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <select class="form-control" name="pilihjenis" required>
                  <option value="">-- Pilih Jenis Pembayaran --</option>
                  <option value="SEWA">Sewa</option>
                  <option value="KARYAWAN">Kelas Karyawan</option>
                  <option value="PARKIR">Parkir</option>
                  <option value="IHT">IHT</option>
                  <option value="KURSUS">Kursus</option>
                  <option value="LAINLAIN">Lain-lain</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text"  class="form-control has-feedback-left" id="tglbayar" name ="tglbayar" value="<?php echo $tglmeng; ?>" placeholder="Tanggal Bayar" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text"  style="text-align:right" class="form-control has-feedback-left" name ="bayar" id="byr" placeholder="Masukan Nominal Bayar" autofocus>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <input type="text"  class="form-control" placeholder="Keterangan" name="ket">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit" id="pay-button">Save changes</button>
          </div>
        </form>
      </div>
   </div>
  </div>
  <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">EDIT PENERIMAAN LAINLAIN</h4>
        </div>
        <div id="modal-body">
        </div>
      </div>
   </div>
  </div>
</div>
<script>
  var b = document.getElementById('byr');
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
<script type="text/javascript">

  $(document).ready(function() {
    $("#inputpenerimaan").click(function(e){
      e.preventDefault();
      $("#modal").modal("show");
    });

    $(".edit").click(function(e){
      e.preventDefault();
      nobukti  = $(this).attr('data-id');
      $("#modaledit").modal("show");
      $("#modal-body").load("<?php echo base_url(); ?>keuangan/editpenerimanlain/"+nobukti);
    });
    $('#dari').bootstrapMaterialDatePicker
		({
			time: false,
			clearButton: true
		});

    $('#sampai').bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true
    });

    $('.hapus').on('click',function(){
        var getLink = $(this).attr('href');
        swal({
                title             : 'Alert',
                text              : 'Hapus Data?',
                html              : true,
                confirmButtonColor: '#d9534f',
                showCancelButton  : true,
                },function(){
                window.location.href = getLink
            });
        return false;
    });
  });

</script>
