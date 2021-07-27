<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Point/Nilai</th>
      <th>Aspek Penilaian <input type="hidden" value="<?php echo $iddp3; ?>" id="iddp3"></th>
    </tr>
  </thead>     
  <tbody>
  <?php $no = 1;
    $kategori = "";
    foreach($dp3 as $d){
      $getpiljawaban = $this->db->get_where('dp3_piljawaban',array('id_pertanyaan'=>$d->id_pertanyaan))->result();
      $jawaban = $this->db->get_where('dp3_detailkaryawan',array('id_dp3'=>$iddp3,'id_pertanyaan'=>$d->id_pertanyaan))->row_array();
      //echo $jawaban['id_piljawaban'];
      if($kategori !=$d->kode_kategori){
        echo "<tr><td colspan='3' style='background-color:#05307b; color:white'><b>$d->nama_kategori</b></td></tr>";
      }
  ?>
    <tr style='background-color:#f3f3f3;'>
      <td colspan="2" style="font-weight:bold; text-align:center"><?php echo $no; ?></td>
      <td style='background-color:#f3f3f3;'><b><?php  echo $d->pertanyaan;?><b></td>
    </tr>
    <?php 
      foreach($getpiljawaban as $j){
    ?>
      <tr>
        <td>
          <input <?php if($jawaban['id_piljawaban']==$j->id_piljawaban){echo "checked"; } ?> value="<?php echo $j->id_piljawaban; ?>" data-soal="<?php echo $d->id_pertanyaan; ?>"  type="radio" name="nilai<?php echo $no; ?>" class="pilihan">
        </td>
        <td style="width:1px"><?php echo $j->nilai; ?></td>
        <td><?php echo $j->pil_jawaban; ?></td>
      </tr>
    <?php 
        $kategori = $d->kode_kategori;
      }
    ?>
  <?php
      $no++; 
    }
  ?>
  </tbody>
</table>
<form action="<?php echo base_url(); ?>keuangan/simpanevaluasidp3" method="POST">
  <input type="hidden" name="iddp3" value="<?php echo $iddp3; ?>">
  <div class="col-sm-12 col-xl-12">
    <h4 class="sub-title">Evaluasi Kualitatif – Wawancara <br>Alasan yang diberikan harus relevan dengan beberapa faktor yang terbaik atau terburuk hasil Penilaian</h4>
  </div>
  <div class="col-sm-12 col-xl-12">
    <p>Nilai Positif</p>
    <textarea class="form-control max-textarea" maxlength="255" rows="4" name="nilaipositif"><?php echo $evaluasi['nilai_positif']; ?></textarea>
  </div>
  <div class="col-sm-12 col-xl-12">
    <p>Nilai Negatif</p>
    <textarea class="form-control max-textarea" maxlength="255" rows="4" name="nilainegatif"><?php echo $evaluasi['nilai_negatif']; ?></textarea>
  </div>
  <div class="col-sm-12 col-xl-12">
    <p>Komentar Karyawan</p>
    <textarea class="form-control max-textarea" maxlength="255" rows="4" name="komentarkaryawan"><?php echo $evaluasi['komentar']; ?></textarea>
  </div>
  <div class="col-sm-12 col-xl-12">
    <p>Rekomendasi</p>
    <textarea class="form-control max-textarea" maxlength="255" rows="4" name="rekomendasi"><?php echo $evaluasi['rekomendasi']; ?></textarea>
  </div>
  <div class="col-sm-12 col-xl-12">
    <p></p>
    <button type="submit" class="btn btn-primary"><i class="ti-save"></i>  Simpan</button>
  </div>
  
</form>

<script>
  $(function(){
    $(".pilihan").click(function(){
      var idpiljawaban   = $(this).val();
      var soal           = $(this).attr("data-soal");
      var iddp3         = $("#iddp3").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>keuangan/simpanjawabandp3',
        data    : {iddp3:iddp3,idpiljawaban:idpiljawaban,soal:soal},
        cache   : false,
        success : function(respond)
        {

        }
      });
    });
  });
</script>