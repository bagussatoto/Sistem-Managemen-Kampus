<div class="col-sm-12">
  <div class="card-block">
    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Data Siswa</h6>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Nama Lengkap</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['nama_lengkap']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">TTL</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['tempat_lahir']."/". $siswa['tgl_lahir']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Alamat</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['dusun'].", RT/RW ". $siswa['rtrw']."Kec. ".$siswa['kecamatan']."Kab. ".$siswa['kota']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">No HP</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['no_hp']; ?></h6>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Asal Sekolah</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['asal_sekolah']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Kelas</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['kelas']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Ranking</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['ranking']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Prestasi</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['prestasi']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Minat</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['minat']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Kesan</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['kesan']; ?></h6>
      </div>
    </div>
    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Data Orangtua</h6>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Nama Ortu</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['nama_ortu']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Pekerjaan</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['pekerjaan_ortu']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">No HP</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['nohp_ortu']; ?></h6>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <p class="m-b-10 f-w-600">Penghasilan</p>
      </div>
      <div class="col-sm-8">
        <h6 class="text-muted f-w-400"><?php echo $siswa['penghasilan_ortu']; ?></h6>
      </div>
    </div>

  </div>
</div>
