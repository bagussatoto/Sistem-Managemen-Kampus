<div class="page-wrapper">
  <!-- Page-header start -->
  <div class="page-header m-t-50">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Data Keuangan</h4>
            <span>Data Master</span>
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
            <li class="breadcrumb-item"><a href="#!">Data Keuangan</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#!">Data Surat</a></li>
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
            <h5>Data Surat </h5>
          </div>
          <div class="card-block">
            <form  autocomplete="off"   action="<?php echo base_url(); ?>keuangan/updatesurat" method="POST">
              <input type="hidden" name="kode_surat" value="<?php echo $surat['kode_surat']; ?>">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <input type="text"  class="form-control" id="perihal" name ="perihal" value="<?php echo $surat['perihal']; ?>" >
                </div>
              </div>
              <div class="row">
                <textarea name="editor1" id="editor1"><?php echo $surat['isi_surat']; ?></textarea>
              </div>
              <br>
              <div class="row">
                <textarea name="editor2" id="editor2"><?php echo $surat['isi_surat2']; ?></textarea>
              </div>
            	<div class="modal-footer">
            	  <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-upload"></i> Update</button>
            	</div>
            </form>
          </div>
        </div>
        <!-- Default card end -->
      </div>
      <div class="col-md-3">
        <?php
         $this->load->view('keuangan/menu_master');
        ?>
      </div>
    </div>
  </div>
  <script>
      ClassicEditor
      .create( document.querySelector( '#editor1' ) )
      .then( editor1 => {
        console.log( editor1 );
      } )
      .catch( error => {
        console.error( error );
      } );

      ClassicEditor
      .create( document.querySelector( '#editor2' ) )
      .then( editor2 => {
        console.log( editor2 );
      } )
      .catch( error => {
        console.error( error );
      } );
  </script>
