<?php
  if($level == 'presenter')
  {
?>
<!-- Menu -->
 <div class="card">
   <div class="card-block">
     <ul class="list-group list-contacts">
        <li class="list-group-item active"><a href="#"><i class="ti-file mr-2"></i> Data Aktivitas</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/aktivitas"> <i class="ti-archive mr-2"></i> Data Aktivitas</a></li>
     </ul>
   </div>
 </div>
 <div class="card">
   <div class="card-block">
     <ul class="list-group list-contacts">
        <li class="list-group-item active"><a href="#"><i class="ti-file mr-2"></i> Rekap Aktivitas</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekapaktivitas"> <i class="ti-archive mr-2"></i> Rekap Aktivitas Presenter</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekapfollowup"> <i class="ti-archive mr-2"></i> Rekap Follow UP</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekaphasilfollowup"> <i class="ti-archive mr-2"></i> Rekap Hasil Follow UP</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekaptargetpresenter"> <i class="ti-archive mr-2"></i> Rekap Pencapaian Target</a></li>
     </ul>
   </div>
 </div>
<?php
}else{
?>
<!-- Menu -->
 <div class="card">
   <div class="card-block">
     <ul class="list-group list-contacts">
        <li class="list-group-item active"><a href="#"><i class="ti-file mr-2"></i> Data Target</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/target"> <i class="ti-archive mr-2"></i> Data Target</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/settarget"> <i class="ti-archive mr-2"></i> Penetapan Target</a></li>
     </ul>
   </div>
 </div>
 <div class="card">
   <div class="card-block">
     <ul class="list-group list-contacts">
        <li class="list-group-item active"><a href="#"><i class="ti-file mr-2"></i> Data Aktivitas</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/masteraktivitas"> <i class="ti-archive mr-2"></i> Data Master Aktivitas</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/aktivitas"> <i class="ti-archive mr-2"></i> Data Aktivitas</a></li>
     </ul>
   </div>
 </div>
 <div class="card">
   <div class="card-block">
     <ul class="list-group list-contacts">
        <li class="list-group-item active"><a href="#"><i class="ti-file mr-2"></i> Rekap Aktivitas</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekapaktivitas"> <i class="ti-archive mr-2"></i> Rekap Hasil Aktivitas Presenter</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekapaktivitaspresenter"> <i class="ti-archive mr-2"></i> Rekap Aktivitas Presenter</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekapfollowup"> <i class="ti-archive mr-2"></i> Rekap Follow UP</a></li>

        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekaphasilfollowup"> <i class="ti-archive mr-2"></i> Rekap Hasil Follow UP</a></li>
        <li class="list-group-item"> <a href="<?php echo base_url(); ?>marketing/rekaptargetpresenter"> <i class="ti-archive mr-2"></i> Rekap Pencapaian Target</a></li>
     </ul>
   </div>
 </div>
<?php } ?>
