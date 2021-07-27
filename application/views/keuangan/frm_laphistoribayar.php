<style media="screen">
  .info{
    background-color:#d9edf7;
  }
  .success{
    background-color:#dff0d8;
  }
</style>
<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Laporan</h4>
            <span>Laporan</span>
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
            <li class="breadcrumb-item"><a href="#!">Marketing</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Laporan</a></li>
            <li class="breadcrumb-item"><a href="#!">Laporan Histori Bayar</a></li>
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
            <h5>Laporan Data Histori Pembayaran </h5>
          </div>
          <div class="card-block">
            <form action="#" id="frmcariaplikan" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="input-sm form-control" name="dari" value="<?php echo $dari; ?>" id="dari" >
                     <span class="input-group-addon">to</span>
                     <input type="text" class="input-sm form-control" name="sampai" value="<?php echo $sampai; ?>" id="sampai">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Pembayaran</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="jenis" class="form-control" name="jenis">
                    <option value="">-- Semua Pembayaran --</option>
                    <option <?php if($jenis=="REGULER"){ echo "selected"; } ?> value="REGULER">Reguler</option>
                    <option <?php if($jenis=="SEWA"){ echo "selected"; } ?> value="SEWA">Sewa</option>
                    <option <?php if($jenis=="KARYAWAN"){ echo "selected"; } ?> value="KARYAWAN">Kelas Karyawan</option>
                    <option <?php if($jenis=="PARKIR"){ echo "selected"; } ?> value="PARKIR">Parkir</option>
                    <option <?php if($jenis=="IHT"){ echo "selected"; } ?> value="IHT">IHT</option>
                    <option <?php if($jenis=="KURSUS"){ echo "selected"; } ?> value="KURSUS">Kursus</option>
                    <option <?php if($jenis=="LAINLAIN"){ echo "selected"; } ?> value="LAINLAIN">Lain-lain</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kasir</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <select id="kasir" class="form-control" name="kasir">
                    <option value="">-- Semua Kasir --</option>
                    <?php foreach ($kasir as $k){ ?>
                      <option <?php if($ksr==$k->fullname){ echo "selected"; } ?> value="<?php echo $k->fullname; ?>"><?php echo $k->fullname; ?></option>
                    <?php }; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                  <button type="submit" name="submit" class="btn btn-primary"><i class="ti-search"></i>  Cari</button>
                  <button type="submit" name="submit" class="btn btn-success"><i class="ti-export"></i>  Export to Excel</button>
                </div>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table table-bordered table-striped" style="font-size:12px; font-family:Arial">
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN PROFESI </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
        						<th>No.</th>
        						<th>Tanggal</th>
        						<th>BTK</th>
        						<th>BTB</th>
        						<th>Keterangan</th>
        						<th>Kasir</th>
        						<th>Jumlah Bayar</th>
      					  </tr>
                </thead>
                <tbody>
                  <?php
                    $cekprofesi = $profesi->num_rows();
                    //echo $cekprofesi;
                    $noprofesi   = 1;
                    $jmlprofesi  = 0;
                    if($cekprofesi !=0){
                      foreach($profesi->result() as $p){
                        $keterangan  = "Pembayaran ".$p->nama_lengkap." Kelas ".$p->kelas." Untuk ".$p->keterangan;
                        $jmlprofesi  = $jmlprofesi + $p->bayar;
                  ?>
                        <tr>
                          <td><?php echo $noprofesi; ?></td>
                          <td><?php echo $p->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $p->nobukti; ?>" target="_blank" style="color:blue"><?php echo $p->nobtk; ?></a></td>
                          <td><?php echo $p->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $p->kasir; ?></td>
                          <td align="right"><?php echo number_format($p->bayar,'0','','.'); ?></td>
                        </tr>
                  <?php
                        $noprofesi++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                  ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmlprofesi,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead >
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN TINGKAT III </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $cektingkat3 = $tingkat3->num_rows();
                    //echo $cekprofesi;
                    $notingkat3   = 1;
                    $jmltingkat3  = 0;
                    if($cektingkat3 !=0){
                      foreach($tingkat3->result() as $t3){
                        $keterangan = "Pembayaran ".$t3->nama_lengkap." Kelas ".$t3->kelas." Untuk ".$t3->keterangan;
                        $jmltingkat3= $jmltingkat3 + $t3->bayar;
                  ?>
                        <tr>
                          <td><?php echo $notingkat3; ?></td>
                          <td><?php echo $t3->tgl; ?></td>
                            <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $t3->nobukti; ?>" target="_blank" style="color:blue"><?php echo $t3->nobtk; ?></a></td>
                          <td><?php echo $t3->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $t3->kasir; ?></td>
                          <td align="right"><?php echo number_format($t3->bayar,'0','','.'); ?></td>

                        </tr>
                  <?php
                        $notingkat3++;
                        }
                      }else{
                        echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                      }
                  ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmltingkat3,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN TINGKAT IV </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $cektingkat4 = $tingkat4->num_rows();
                    //echo $cekprofesi;
                    $notingkat4   = 1;
                    $jmltingkat4  = 0;
                    if($cektingkat4 !=0){
                      foreach($tingkat4->result() as $t4){
                        $keterangan = "Pembayaran ".$t4->nama_lengkap." Kelas ".$t4->kelas." Untuk ".$t4->keterangan;
                        $jmltingkat4= $jmltingkat4 + $t4->bayar;
                  ?>
                        <tr>
                          <td><?php echo $notingkat4; ?></td>
                          <td><?php echo $t4->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $t4->nobukti; ?>" target="_blank" style="color:blue"><?php echo $t4->nobtk; ?></a></td>
                          <td><?php echo $t4->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $t4->kasir; ?></td>
                          <td align="right"><?php echo number_format($t4->bayar,'0','','.'); ?></td>
                        </tr>
                <?php
                      $notingkat4++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmltingkat4,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN KELAS KARYAWAN </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $cekkaryawan = $karyawan->num_rows();
                    //echo $cekprofesi;
                    $nokaryawan   = 1;
                    $jmlkaryawan  = 0;
                    if($cekkaryawan !=0){
                      foreach($karyawan->result() as $k){

                        $keterangan = $k->keterangan;
                        $jmlkaryawan= $jmlkaryawan + $k->bayar;
                  ?>
                        <tr>
                          <td><?php echo $nokaryawan; ?></td>
                          <td><?php echo $k->tgl; ?></td>
                            <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $k->nobukti; ?>" target="_blank" style="color:blue"><?php echo $k->nobtk; ?></a></td>
                          <td><?php echo $k->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $k->kasir; ?></td>
                          <td align="right"><?php echo number_format($k->bayar,'0','','.'); ?></td>

                        </tr>
                <?php
                      $nokaryawan++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmlkaryawan,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA SEWA </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $ceksewa = $sewa->num_rows();
                    //echo $cekprofesi;
                    $nosewa   = 1;
                    $jmlsewa  = 0;
                    if($ceksewa !=0){
                      foreach($sewa->result() as $s){
                        $keterangan = $s->keterangan;
                        $jmlsewa= $jmlsewa + $s->bayar;
                  ?>
                        <tr>
                          <td><?php echo $nosewa; ?></td>
                          <td><?php echo $s->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $s->nobukti; ?>" style="color:blue"><?php echo $s->nobtk; ?></a></td>
                          <td><?php echo $s->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $s->kasir; ?></td>
                          <td align="right"><?php echo number_format($s->bayar,'0','','.'); ?></td>

                        </tr>
                <?php
                      $nosewa++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmlsewa,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA PARKIR </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $cekparkir = $parkir->num_rows();
                    //echo $cekprofesi;
                    $noparkir     = 1;
                    $jmlparkir    = 0;
                    if($cekparkir !=0){
                      foreach($parkir->result() as $pk){
                        $keterangan = $s->keterangan;
                        $jmlparkir= $jmlparkir + $pk->bayar;
                  ?>
                        <tr>
                          <td><?php echo $noparkir; ?></td>
                          <td><?php echo $pk->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $pk->nobukti; ?>" style="color:blue"><?php echo $pk->nobtk; ?></a></td>
                          <td><?php echo $pk->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $pk->kasir; ?></td>
                          <td align="right"><?php echo number_format($pk->bayar,'0','','.'); ?></td>

                        </tr>
                <?php
                      $noparkir++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmlparkir,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA IHT </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $cekiht    = $iht->num_rows();
                    //echo $cekprofesi;
                    $noiht     = 1;
                    $jmliht    = 0;
                    if($cekiht !=0){
                      foreach($iht->result() as $i){
                        $keterangan = $s->keterangan;
                        $jmliht= $jmliht + $i->bayar;
                  ?>
                        <tr>
                          <td><?php echo $noiht; ?></td>
                          <td><?php echo $i->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $i->nobukti; ?>" style="color:blue"><?php echo $i->nobtk; ?></a></td>
                          <td><?php echo $i->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $i->kasir; ?></td>
                          <td align="right"><?php echo number_format($i->bayar,'0','','.'); ?></td>
                        </tr>
                <?php
                      $noiht++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmliht,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA KURSUS </th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $cekkursus    = $kursus->num_rows();
                    //echo $cekprofesi;
                    $nokursus     = 1;
                    $jmlkursus    = 0;
                    if($cekkursus !=0){
                      foreach($kursus->result() as $kr){
                        $keterangan = $kr->keterangan;
                        $jmlkursus= $jmlkursus + $kr->bayar;
                  ?>
                        <tr>
                          <td><?php echo $nokursus; ?></td>
                          <td><?php echo $kr->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $kr->nobukti; ?>" style="color:blue"><?php echo $kr->nobtk; ?></a></td>
                          <td><?php echo $kr->nobtb; ?></td>
                          <td><?php echo $keterangan; ?></td>
                          <td><?php echo $kr->kasir; ?></td>
                          <td align="right"><?php echo number_format($kr->bayar,'0','','.'); ?></td>
                        </tr>
                <?php
                      $nokursus++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmlkursus,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
                <thead>
                  <tr style="background-color:#dff0d8">
                    <th class="success" colspan="7">PEMBAYARAN BIAYA LAIN LAIN</th>
                  </tr>
                  <tr style="background-color:#d9edf7">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>BTK</th>
                    <th>BTB</th>
                    <th>Keterangan</th>
                    <th>Kasir</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $ceklainlain    = $lainlain->num_rows();
                    //echo $cekprofesi;
                    $nolainlain     = 1;
                    $jmllainlain    = 0;
                    if($ceklainlain !=0){
                      foreach($lainlain->result() as $l){
                        $keterangan = $l->keterangan;
                        $jmllainlain= $jmllainlain + $l->bayar;
                  ?>
                        <tr>
                          <td><?php echo $nolainlain; ?></td>
                          <td><?php echo $l->tgl; ?></td>
                          <td><a href="<?php echo base_url(); ?>keuangan/cetakbtk/<?php echo $l->nobukti; ?>" style="color:blue"><?php echo $l->nobtk; ?></a></td>
                          <td><?php echo $l->nobtb; ?></td>
                          <td><?php echo $keterangan." terima dari ".$l->terimadari; ?></td>
                          <td><?php echo $l->kasir; ?></td>
                          <td align="right"><?php echo number_format($l->bayar,'0','','.'); ?></td>
                        </tr>
                <?php
                      $nolainlain++;
                      }
                    }else{
                      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
                    }
                ?>
                  <tr class="info">
                    <td colspan="6"><b>JUMLAH</b></td>
                    <td align="right"><b><?php echo number_format($jmllainlain,'0','','.'); ?></b></td>
                  </tr>
                  <tr style="background-color:#dff0d8;">
                    <?php
                      $total = $jmlprofesi + $jmltingkat3 + $jmltingkat4 + $jmlkaryawan + $jmlsewa + $jmlparkir + $jmliht + $jmlkursus + $jmllainlain;
                    ?>
                    <td colspan="6"><b>TOTAL</b></td>
                    <td align="right"><b><?php echo number_format($total,'0','','.'); ?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_laporan');
        ?>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(function(){
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

    });
  </script>
