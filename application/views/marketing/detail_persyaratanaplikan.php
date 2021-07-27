
<div class="col-md-12">
  <div class="row">
    <div class="col-sm-3 bg-c-lite-green user-profile">
      <div class="card-block text-center text-white">
        <div class="m-b-25">
          <img src="<?php echo base_url(); ?>assets/images/user-profile/user-img.jpg" class="img-radius" alt="User-Profile-Image">
        </div>
        <h6 class="f-w-600"><?php echo $aplikan['nama_lengkap']; ?></h6>
        <p><?php echo $aplikan['nama_jurusan']; ?></p>
      </div>
    </div>
    <div class="col-sm-9">
      <h6 class="sub-title">LIST PERSYARATAN</h6>
      <ul class="list-group">
        <?php foreach($pa as $p){ ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo $p->nama_persyaratan; ?>
            <?php if(!empty($p->file)){ ?>
              <span>
                <a href="<?php echo base_url(); ?>persyaratan/<?php echo $p->file; ?>" target="_blank">
                <span class="badge badge-success badge-pill">
                  Download
                </span>
                </a>
                <a href="<?php echo base_url(); ?>marketing/hapuspersyaratanaplikan/<?php echo $aplikan['kode_aplikan'] ?>/<?php echo $p->kode_persyaratan; ?>" class="hapus" >
                <span class="badge badge-danger badge-pill">
                  <i class="ti-trash"></i>
                </span>
                </a>
              </span>
            <?php }else{ ?>
              <a href="#"><span class="badge badge-danger badge-pill">Belum Mengumppulkan</span></a>
            <?php } ?>

          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
