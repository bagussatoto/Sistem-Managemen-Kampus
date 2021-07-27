<?php

class Model_marketing extends CI_Model
{
  function getPresenter($ta)
  {
    $this->db->where('ta_mkt',$ta);
    return $this->db->get('konfigurasi_presenter');
  }

  function getPersyaratan($ta)
  {
    $this->db->where('ta_mkt',$ta);
    return $this->db->get('konfigurasi_persyaratan');
  }
  function inputmasterpresenter(){
    $kodepresenter  = $this->input->post('kodepresenter');
    $namapresenter  = $this->input->post('namapresenter');
    $data = array(
      'kode_presenter' => $kodepresenter,
      'nama_presenter' => $namapresenter
    );
    $cek = $this->db->get_where('master_presenter',array('kode_presenter'=>$kodepresenter))->num_rows();
    if(!empty($cek)){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-na"></i> Data Found</h6>
            </div>
        </div>');
    	redirect('marketing/masterpresenter');
    }else{
      $simpan = $this->db->insert('master_presenter',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
  	        '<div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
                </div>
            </div>');
  	    	redirect('marketing/masterpresenter');
      }
    }
  }

  function listMasterpresenter()
  {
    return $this->db->get('master_presenter');
  }

  function hapusmasterpresenter($kodepresenter)
  {
    $hapus = $this->db->delete('master_presenter',array('kode_presenter'=>$kodepresenter));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/masterpresenter');
    }
  }

  function getmasterPresenter($kodepresenter)
  {
    return $this->db->get_where('master_presenter',array('kode_presenter'=>$kodepresenter));
  }

  function updatemasterpresenter(){
    $kodepresenter  = $this->input->post('kodepresenter');
    $namapresenter  = $this->input->post('namapresenter');
    $data = array(
      'nama_presenter' => $namapresenter
    );
    $simpan = $this->db->update('master_presenter',$data,array('kode_presenter'=>$kodepresenter));
    if($simpan){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
              </div>
          </div>');
	    	redirect('marketing/masterpresenter');
    }
  }

  function listPresenter($ta_mkt)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('konfigurasi_presenter.kode_presenter',$kodepresenter);
    }
    $this->db->select('id,ta_mkt,konfigurasi_presenter.kode_presenter,nama_presenter');
    $this->db->from('konfigurasi_presenter');
    $this->db->join('master_presenter','konfigurasi_presenter.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('ta_mkt',$ta_mkt);
    return $this->db->get();
  }

  function inputpresenter()
  {
    $kodepresenter  = $this->input->post('kodepresenter');
    $ta_mkt         = $this->input->post('ta_mkt');
    $data = array(
      'kode_presenter' => $kodepresenter,
      'ta_mkt'         => $ta_mkt
    );

    $cek = $this->db->get_where('konfigurasi_presenter',array('kode_presenter'=>$kodepresenter,'ta_mkt'=>$ta_mkt))->num_rows();
    if(!empty($cek)){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-na"></i> Data Allready Exist</h6>
            </div>
        </div>');
    	redirect('marketing/presenter');
    }else{
      $simpan = $this->db->insert('konfigurasi_presenter',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
  	        '<div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
                </div>
            </div>');
  	    	redirect('marketing/presenter');
      }
    }
  }

  function hapuspresenter($id)
  {
    $hapus = $this->db->delete('konfigurasi_presenter',array('id'=>$id));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/presenter');
    }
  }

  function listMasterPersyaratan()
  {
    return $this->db->get('master_persyaratan');
  }


  function inputmasterpersyaratan(){
    $kodepersyaratan  = $this->input->post('kodepersyaratan');
    $namapersyaratan  = $this->input->post('namapersyaratan');
    $data = array(
      'kode_persyaratan'  => $kodepersyaratan,
      'nama_persyaratan'  => $namapersyaratan
    );
    $cek = $this->db->get_where('master_persyaratan',array('kode_persyaratan'=>$kodepersyaratan))->num_rows();
    if(!empty($cek)){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-na"></i> Data Allready Exist</h6>
            </div>
        </div>');
    	redirect('marketing/masterpersyaratan');
    }else{
      $simpan = $this->db->insert('master_persyaratan',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
  	        '<div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
                </div>
            </div>');
  	    	redirect('marketing/masterpersyaratan');
      }
    }
  }

  function hapusmasterpersyaratan($kodepersyaratan)
  {
    $hapus = $this->db->delete('master_persyaratan',array('kode_persyaratan'=>$kodepersyaratan));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/masterpersyaratan');
    }
  }

  function listPersyaratan($ta_mkt,$kode)
  {


    $this->db->select('id,ta_mkt,konfigurasi_persyaratan.kode_persyaratan,nama_persyaratan');
    $this->db->from('konfigurasi_persyaratan');
    $this->db->join('master_persyaratan','konfigurasi_persyaratan.kode_persyaratan = master_persyaratan.kode_persyaratan');
    $this->db->where('ta_mkt',$ta_mkt);
    if($kode!="")
    {
      $this->db->where_not_in('konfigurasi_persyaratan.kode_persyaratan',$kode);
    }
    return $this->db->get();
  }
  function inputpersyaratan()
  {
    $kodepersyaratan  = $this->input->post('kodepersyaratan');
    $ta_mkt           = $this->input->post('ta_mkt');
    $data = array(
      'kode_persyaratan' => $kodepersyaratan,
      'ta_mkt'           => $ta_mkt
    );

    $cek = $this->db->get_where('konfigurasi_persyaratan',array('kode_persyaratan'=>$kodepersyaratan,'ta_mkt'=>$ta_mkt))->num_rows();
    if(!empty($cek)){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-na"></i> Data Allready Exist</h6>
            </div>
        </div>');
    	redirect('marketing/persyaratan');
    }else{
      $simpan = $this->db->insert('konfigurasi_persyaratan',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
  	        '<div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
                </div>
            </div>');
  	    	redirect('marketing/persyaratan');
      }
    }
  }

  function hapuspersyaratan($id)
  {
    $hapus = $this->db->delete('konfigurasi_persyaratan',array('id'=>$id));
    if($hapus){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
          </div>
        </div>');
	    redirect('marketing/persyaratan');
    }
  }

  function insert_aplikan()
  {

    $ta_mkt           = $this->input->post('ta_mkt');
    $ta_aktif         = substr($ta_mkt,2,2);
    $aplikan          = "SELECT kode_aplikan FROM aplikan WHERE tahun_akademik ='$ta_mkt' ORDER BY kode_aplikan DESC LIMIT 1 ";
    $ceknolast        = $this->db->query($aplikan)->row_array();
    $kodeterakhir     = $ceknolast['kode_aplikan'];
    $kode_aplikan     = buatkode($kodeterakhir,$ta_aktif,4);
    $nama_lengkap     = $this->input->post('namalengkap');
    $tempat_lahir     = $this->input->post('tempatlahir');
    $tgl_lahir        = $this->input->post('tahunlahir')."-".$this->input->post('bulanlahir')."-".$this->input->post('tgllahir');
    $jenis_kelamin    = $this->input->post('jk');
    $dusun            = $this->input->post('dusun');
    $rtrw             = $this->input->post('rtrw');
    $kelurahan        = $this->input->post('kelurahan');
    $kecamatan        = $this->input->post('kecamatan');
    $kota             = $this->input->post('kota');
    $kode_pos         = $this->input->post('kodepos');
    $no_hp            = $this->input->post('nohp');
    $whatsapp         = $this->input->post('whatsapp');
    $facebook         = $this->input->post('facebook');
    $instagram        = $this->input->post('ig');
    $pdd_terakhir     = $this->input->post('pendidikanterakhir');
    $asal_sekolah     = $this->input->post('asalsekolah');
    $jurusan_sekolah  = $this->input->post('jurusansekolah');
    $tahun_lulus      = $this->input->post('tahunlulus');
    $email            = $this->input->post('email');
    $nama_ortu        = $this->input->post('namaortu');
    $pekerjaan_ortu   = $this->input->post('pekerjaanortu');
    $penghasilan_ortu = $this->input->post('penghasilanortu');
    $nohp_ortu        = $this->input->post('nohportu');
    $jurusan          = $this->input->post('jurusan');
    $sumber_informasi = $this->input->post('sumberinformasi');
    $sumber_aplikan   = $this->input->post('sumberaplikan');
    $presenter        = $this->input->post('presenter');
    $gelombang        = $this->input->post('gelombang');
    $tgldatang        = $this->input->post('tahundatang')."-".$this->input->post('bulandatang')."-".$this->input->post('tgldatang');
    $kode_siswa       = $this->input->post('kode_siswa');

    $data = array
    (
      'kode_aplikan'        => $kode_aplikan,
      'nama_lengkap'        => $nama_lengkap,
      'tempat_lahir'        => $tempat_lahir,
      'tgl_lahir'           => $tgl_lahir,
      'jenis_kelamin'       => $jenis_kelamin,
      'dusun'               => $dusun,
      'rtrw'                => $rtrw,
      'kelurahan'           => $kelurahan,
      'kecamatan'           => $kecamatan,
      'kota'                => $kota,
      'kode_pos'            => $kode_pos,
      'no_hp'               => $no_hp,
      'whatsapp'            => $whatsapp,
      'facebook'            => $facebook,
      'instagram'           => $instagram,
      'pendidikan_terakhir' => $pdd_terakhir,
      'asal_sekolah'        => $asal_sekolah,
      'jurusan_sekolah'     => $jurusan_sekolah,
      'tahun_lulus'         => $tahun_lulus,
      'email'               => $email,
      'nama_ortu'           => $nama_ortu,
      'pekerjaan_ortu'      => $pekerjaan_ortu,
      'penghasilan_ortu'    => $penghasilan_ortu,
      'nohp_ortu'           => $nohp_ortu,
      'kode_jurusan'        => $jurusan,
      'sumber_informasi'    => $sumber_informasi,
      'sumber_aplikan'      => $sumber_aplikan,
      'kode_presenter'      => $presenter,
      'gelombang'           => $gelombang,
      'tahun_akademik'      => $ta_mkt,
      'tgl_datang'          => $tgldatang,
      'kode_siswa'          => $kode_siswa
    );

    $simpan = $this->db->insert('aplikan',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('marketing/aplikandatang');
    }
  }

  function listSekolah()
  {
    return $this->db->get('siswa_dbsekolah');
  }

  function insert_dbsekolah()
  {
    $namasekolah = $this->input->post('namasekolah');
    $data = array
    (
      'nama_sekolah' => $namasekolah
    );
    $simpan = $this->db->insert('siswa_dbsekolah',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('marketing/dbsekolah');
    }
  }

  function getdbSekolah($id)
  {
    return $this->db->get_where('siswa_dbsekolah',array('id'=>$id));
  }

  function update_dbsekolah()
  {
    $id          = $this->input->post('id');
    $namasekolah = $this->input->post('namasekolah');
    $data = array
    (
      'nama_sekolah' => $namasekolah
    );
    $simpan = $this->db->update('siswa_dbsekolah',$data,array('id'=>$id));
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Updated Succesfully</h6>
          </div>
        </div>');
      redirect('marketing/dbsekolah');
    }
  }

  public function getDataAplikan($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('kode_aplikan,nama_lengkap,nama_jurusan,nama_presenter,no_hp,tgl_datang');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->order_by('tgl_datang','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordAplikan($nama_aplikan="",$tahun_akademik="")
  {
      $level = $this->access->get_level();
      $kodepresenter = $this->access->get_username();
      if($level =='presenter')
      {
        $this->db->where('aplikan.kode_presenter',$kodepresenter);
      }
      $this->db->select('count(*) as allcount');
      $this->db->from('aplikan');
      $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
      $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
      if($nama_aplikan != ''){
      	$this->db->like('nama_lengkap', $nama_aplikan);
    	}
      if($tahun_akademik != ''){
      	$this->db->where('tahun_akademik', $tahun_akademik);
    	}
      $query 	= $this->db->get();
	    $result = $query->result_array();
   		return $result[0]['allcount'];
  }

  public function getDataSiswa($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('siswa.kode_siswa,siswa.nama_lengkap,siswa.asal_sekolah,nama_presenter,siswa.no_hp,kode_aplikan');
    $this->db->from('siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan','siswa.kode_siswa = aplikan.kode_siswa','left');
    if($nama_aplikan != ''){
    	$this->db->like('siswa.nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('siswa.tahun_akademik', $tahun_akademik);
  	}
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordSiswa($nama_aplikan="",$tahun_akademik="")
  {
      $level = $this->access->get_level();
      $kodepresenter = $this->access->get_username();
      if($level =='presenter')
      {
        $this->db->where('siswa.kode_presenter',$kodepresenter);
      }
      $this->db->select('count(*) as allcount');
      $this->db->from('siswa');
      $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
      $this->db->join('aplikan','siswa.kode_siswa = aplikan.kode_siswa','left');
      if($nama_aplikan != ''){
      	$this->db->like('siswa.nama_lengkap', $nama_aplikan);
    	}
      if($tahun_akademik != ''){
      	$this->db->where('siswa.tahun_akademik', $tahun_akademik);
    	}
      $query 	= $this->db->get();
	    $result = $query->result_array();
   		return $result[0]['allcount'];
  }
  
  /***start riju
  public function getrecordSiswaFolder($nama_aplikan="",$tahun_akademik="")
  {
      $level = $this->access->get_level();
      $kodepresenter = $this->access->get_username();
      if($level =='presenter')
      {
        $this->db->where('siswa.kode_presenter',$kodepresenter);
      }
      $this->db->select('count(*) as allcount, folder');
      $this->db->from('siswa');
      $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
      $this->db->join('aplikan','siswa.kode_siswa = aplikan.kode_siswa','left');
      if($nama_aplikan != ''){
      	$this->db->like('siswa.nama_lengkap', $nama_aplikan);
    	}
      if($tahun_akademik != ''){
      	$this->db->where('siswa.tahun_akademik', $tahun_akademik);
    	}
	  $this->db->group_by('siswa.folder');
      $query 	= $this->db->get();
   		return $this->db->get();
  }
  //end riju
***/
  function listTahunakademik($tahun_akademik="",$tingkat=""){
    if($tingkat != 1)
    {
      if($tahun_akademik !=''){
        $this->db->where('LEFT(ta_mkt,4) <',$tahun_akademik);
      }
    }
    $this->db->select('ta_mkt as tahun_akademik');
    $this->db->from('konfigurasi_presenter');
    $this->db->distinct('ta_mkt');
    return $this->db->get();
  }

  function getAplikan($kode_aplikan)
  {
    $this->db->select('aplikan.kode_aplikan,nama_lengkap,aplikan.kode_jurusan,nama_jurusan,tempat_lahir,tgl_lahir,jenis_kelamin,
                      dusun,rtrw,kelurahan,kecamatan,kota,kode_pos,no_hp,pendidikan_terakhir,asal_sekolah,jurusan_sekolah,
                      tahun_lulus,whatsapp,facebook,instagram,nama_ortu,pekerjaan_ortu,penghasilan_ortu,nohp_ortu,
                      sumber_informasi,sumber_daftar,sumber_aplikan,aplikan.kode_presenter,nama_presenter,tgl_datang,gelombang,
                      tgl_daftar,tgl_ujian,gelombang_daftar,gelombang_ujian,tahun_akademik,email,tgl_wawancara,gelombang_wawancara,pewawancara,
                      nim
                    ');
    $this->db->from('aplikan');
    $this->db->join('mahasiswa','aplikan.kode_aplikan = mahasiswa.kode_aplikan','LEFT');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    $this->db->join('aplikan_ujian','aplikan.kode_aplikan = aplikan_ujian.kode_aplikan','left');
    $this->db->join('aplikan_wawancara','aplikan.kode_aplikan = aplikan_wawancara.kode_aplikan','left');
    $this->db->where('aplikan.kode_aplikan',$kode_aplikan);
    return $this->db->get();
  }

  function getKelasMhs($kode_aplikan)
  {
    return $this->db->query("SELECT kelas FROM registrasi WHERE kode_aplikan='$kode_aplikan' ORDER BY kode_registrasi DESC limit 1");
  }

  function getSiswa($kode_siswa)
  {
    $this->db->select('*');
    $this->db->from('siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('kode_siswa',$kode_siswa);
    return $this->db->get();

  }

  function update_aplikan()
  {

    $kode_aplikan     = $this->input->post('kode_aplikan');
    $nama_lengkap     = $this->input->post('namalengkap');
    $tempat_lahir     = $this->input->post('tempatlahir');
    $tgl_lahir        = $this->input->post('tahunlahir')."-".$this->input->post('bulanlahir')."-".$this->input->post('tgllahir');
    $jenis_kelamin    = $this->input->post('jk');
    $dusun            = $this->input->post('dusun');
    $rtrw             = $this->input->post('rtrw');
    $kelurahan        = $this->input->post('kelurahan');
    $kecamatan        = $this->input->post('kecamatan');
    $kota             = $this->input->post('kota');
    $kode_pos         = $this->input->post('kodepos');
    $no_hp            = $this->input->post('nohp');
    $whatsapp         = $this->input->post('whatsapp');
    $facebook         = $this->input->post('facebook');
    $instagram        = $this->input->post('ig');
    $pdd_terakhir     = $this->input->post('pendidikanterakhir');
    $asal_sekolah     = $this->input->post('asalsekolah');
    $jurusan_sekolah  = $this->input->post('jurusansekolah');
    $tahun_lulus      = $this->input->post('tahunlulus');
    $email            = $this->input->post('email');
    $nama_ortu        = $this->input->post('namaortu');
    $pekerjaan_ortu   = $this->input->post('pekerjaanortu');
    $penghasilan_ortu = $this->input->post('penghasilanortu');
    $nohp_ortu        = $this->input->post('nohportu');
    $jurusan          = $this->input->post('jurusan');
    $sumber_informasi = $this->input->post('sumberinformasi');
    $sumber_aplikan   = $this->input->post('sumberaplikan');
    $presenter        = $this->input->post('presenter');
    $gelombang        = $this->input->post('gelombang');
    $tgldatang        = $this->input->post('tahundatang')."-".$this->input->post('bulandatang')."-".$this->input->post('tgldatang');

    $data = array
    (
      'nama_lengkap'        => $nama_lengkap,
      'tempat_lahir'        => $tempat_lahir,
      'tgl_lahir'           => $tgl_lahir,
      'jenis_kelamin'       => $jenis_kelamin,
      'dusun'               => $dusun,
      'rtrw'                => $rtrw,
      'kelurahan'           => $kelurahan,
      'kecamatan'           => $kecamatan,
      'kota'                => $kota,
      'kode_pos'            => $kode_pos,
      'no_hp'               => $no_hp,
      'whatsapp'            => $whatsapp,
      'facebook'            => $facebook,
      'instagram'           => $instagram,
      'pendidikan_terakhir' => $pdd_terakhir,
      'asal_sekolah'        => $asal_sekolah,
      'jurusan_sekolah'     => $jurusan_sekolah,
      'tahun_lulus'         => $tahun_lulus,
      'email'               => $email,
      'nama_ortu'           => $nama_ortu,
      'pekerjaan_ortu'      => $pekerjaan_ortu,
      'penghasilan_ortu'    => $penghasilan_ortu,
      'nohp_ortu'           => $nohp_ortu,
      'kode_jurusan'        => $jurusan,
      'sumber_informasi'    => $sumber_informasi,
      'sumber_aplikan'      => $sumber_aplikan,
      'kode_presenter'      => $presenter,
      'gelombang'           => $gelombang,
      'tgl_datang'          => $tgldatang
    );

    $update = $this->db->update('aplikan',$data,array('kode_aplikan'=>$kode_aplikan));
    if($update){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Updated</h6>
          </div>
        </div>');
	    redirect('marketing/detailaplikan/'.$kode_aplikan);
    }
  }

  public function getDataUpdatedaftar($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('aplikan.kode_aplikan,nama_lengkap,nama_jurusan,nama_presenter,tgl_datang');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_daftar IS NULL');
    $this->db->order_by('tgl_datang','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordUpdatedaftar($nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_daftar IS NULL');
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function insert_aplikandaftar()
  {
    $kode_aplikan       = $this->input->post('kode_aplikan');
    $ket_daftar         = $this->input->post('ketdaftar');
    $tgl_daftar         = $this->input->post('tahundaftar')."-".$this->input->post('bulandaftar')."-".$this->input->post('tgldaftar');
    $gelombang_daftar   = $this->input->post('gelombangdaftar');
    $nomor_ujian        = $this->input->post('nomorujian');
    $nomor_bukti        = $this->input->post('nomorbukti');
    $biaya_pendaftaran  = str_replace(".","",$this->input->post('biayapendaftaran'));
    $diskon             = str_replace(".","",$this->input->post('diskon'));
    $sumber             = $this->input->post('sumber');
    $keterangan         = $this->input->post('keterangan');
    $data = array
    (
      'kode_aplikan'        => $kode_aplikan,
      'tgl_daftar'          => $tgl_daftar,
      'gelombang_daftar'    => $gelombang_daftar,
      'nomor_ujian'         => $nomor_ujian,
      'nomor_bukti'         => $nomor_bukti,
      'biaya_pendaftaran'   => $biaya_pendaftaran,
      'diskon'              => $diskon,
      'sumber_daftar'       => $sumber,
      'keterangan'          => $keterangan,
      'ket_daftar'          => $ket_daftar
    );
    $simpan = $this->db->insert('aplikan_daftar',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('marketing/updatedaftar');
    }
  }

  public function getDataAplikandaftar($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('*');
    $this->db->from('aplikan_daftar');
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');

    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->order_by('tgl_daftar','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordAplikandaftar($nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan_daftar');
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}

    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function getAplikandaftar($kode_aplikan)
  {
    $this->db->select('*');
    $this->db->from('aplikan_daftar');
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('aplikan_daftar.kode_aplikan',$kode_aplikan);
    return $this->db->get();
  }



  function update_aplikandaftar()
  {
    $kode_aplikan       = $this->input->post('kode_aplikan');
    $tgl_daftar         = $this->input->post('tahundaftar')."-".$this->input->post('bulandaftar')."-".$this->input->post('tgldaftar');
    $gelombang_daftar   = $this->input->post('gelombangdaftar');
    $nomor_ujian        = $this->input->post('nomorujian');
    $nomor_bukti        = $this->input->post('nomorbukti');
    $biaya_pendaftaran  = str_replace(".","",$this->input->post('biayapendaftaran'));
    $diskon             = str_replace(".","",$this->input->post('diskon'));
    $sumber             = $this->input->post('sumber');
    $keterangan         = $this->input->post('keterangan');
    $data = array
    (

      'tgl_daftar'          => $tgl_daftar,
      'gelombang_daftar'    => $gelombang_daftar,
      'nomor_ujian'         => $nomor_ujian,
      'nomor_bukti'         => $nomor_bukti,
      'biaya_pendaftaran'   => $biaya_pendaftaran,
      'diskon'              => $diskon,
      'sumber_daftar'       => $sumber,
      'keterangan'          => $keterangan
    );
    $simpan = $this->db->update('aplikan_daftar',$data,array('kode_aplikan'=>$kode_aplikan));
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Updated</h6>
          </div>
        </div>');
	    redirect('marketing/aplikandaftar');
    }
  }

  function hapusaplikandaftar($kode_aplikan)
  {
    $hapus = $this->db->delete('aplikan_daftar',array('kode_aplikan'=>$kode_aplikan));
    if($hapus){
      $hapusujian     = $this->db->delete('aplikan_ujian',array('kode_aplikan'=>$kode_aplikan));
      $hapuswawancara = $this->db->delete('aplikan_wawancara',array('kode_aplikan'=>$kode_aplikan));
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/aplikandaftar');
    }
  }


  public function getDataUpdateujian($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('aplikan.kode_aplikan,nama_lengkap,nama_jurusan,nama_presenter');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    $this->db->join('aplikan_ujian','aplikan.kode_aplikan = aplikan_ujian.kode_aplikan','left');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_daftar IS NOT NULL');
    $this->db->where('tgl_ujian IS NULL');
    $this->db->order_by('tgl_daftar','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordUpdateujian($nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    $this->db->join('aplikan_ujian','aplikan.kode_aplikan = aplikan_ujian.kode_aplikan','left');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_daftar IS NOT NULL');
    $this->db->where('tgl_ujian IS NULL');
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }


  function insert_aplikanujian()
  {
    $kode_aplikan       = $this->input->post('kode_aplikan');
    $tgl_ujian          = $this->input->post('tgl_ujian');
    $gelombang_ujian    = $this->input->post('gelombangujian');
    $data = array
    (
      'kode_aplikan'        => $kode_aplikan,
      'tgl_ujian'           => $tgl_ujian,
      'gelombang_ujian'     => $gelombang_ujian
    );
    $simpan = $this->db->insert('aplikan_ujian',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('marketing/updateujian');
    }
  }

  public function getDataAplikanujian($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('*');
    $this->db->from('aplikan_ujian');
    $this->db->join('aplikan','aplikan_ujian.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');

    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->order_by('tgl_ujian','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordAplikanujian($nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan_ujian');
    $this->db->join('aplikan','aplikan_ujian.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}

    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function update_aplikanujian()
  {
    $kode_aplikan       = $this->input->post('kode_aplikan');
    $tgl_ujian          = $this->input->post('tgl_ujian');
    $gelombang_ujian    = $this->input->post('gelombangujian');
    $data = array
    (

      'tgl_ujian'          => $tgl_ujian,
      'gelombang_ujian'    => $gelombang_ujian
    );
    $simpan = $this->db->update('aplikan_ujian',$data,array('kode_aplikan'=>$kode_aplikan));
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Updated</h6>
          </div>
        </div>');
	    redirect('marketing/aplikanujian');
    }
  }

  function hapusaplikanujian($kode_aplikan)
  {
    $hapus = $this->db->delete('aplikan_ujian',array('kode_aplikan'=>$kode_aplikan));
    if($hapus){
      $hapuswawancara = $this->db->delete('aplikan_wawancara',array('kode_aplikan'=>$kode_aplikan));
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/aplikanujian');
    }
  }

  public function getDataUpdatewawancara($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('aplikan.kode_aplikan,nama_lengkap,nama_jurusan,nama_presenter');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    $this->db->join('aplikan_ujian','aplikan.kode_aplikan = aplikan_ujian.kode_aplikan','left');
    $this->db->join('aplikan_wawancara','aplikan.kode_aplikan = aplikan_wawancara.kode_aplikan','left');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_daftar IS NOT NULL');
    $this->db->where('tgl_ujian IS NOT NULL');
    $this->db->where('tgl_wawancara IS NULL');
    $this->db->order_by('tgl_daftar','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordUpdatewawancara($nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','left');
    $this->db->join('aplikan_ujian','aplikan.kode_aplikan = aplikan_ujian.kode_aplikan','left');
    $this->db->join('aplikan_wawancara','aplikan.kode_aplikan = aplikan_wawancara.kode_aplikan','left');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_daftar IS NOT NULL');
    $this->db->where('tgl_ujian IS NOT NULL');
    $this->db->where('tgl_wawancara IS NULL');
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function insert_aplikanwawancara()
  {
    $kode_aplikan           = $this->input->post('kode_aplikan');
    $tgl_wawancara          = $this->input->post('tgl_wawancara');
    $gelombang_wawancara    = $this->input->post('gelombangwawancara');
    $pewawancara            = $this->input->post('pewawancara');
    $data = array
    (
      'kode_aplikan'            => $kode_aplikan,
      'tgl_wawancara'           => $tgl_wawancara,
      'gelombang_wawancara'     => $gelombang_wawancara,
      'pewawancara'             => $pewawancara
    );
    $simpan = $this->db->insert('aplikan_wawancara',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('marketing/updatewawancara');
    }
  }

  public function getDataAplikanwawancara($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('*');
    $this->db->from('aplikan_wawancara');
    $this->db->join('aplikan','aplikan_wawancara.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');

    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->order_by('tgl_wawancara','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordAplikanwawancara($nama_aplikan="",$tahun_akademik="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan_wawancara');
    $this->db->join('aplikan','aplikan_wawancara.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}

    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }


  function update_aplikanwawancara()
  {
    $kode_aplikan           = $this->input->post('kode_aplikan');
    $tgl_wawancara          = $this->input->post('tgl_wawancara');
    $gelombang_wawancara    = $this->input->post('gelombangwawancara');
    $pewawancara            = $this->input->post('pewawancara');
    $data = array
    (

      'tgl_wawancara'           => $tgl_wawancara,
      'gelombang_wawancara'     => $gelombang_wawancara,
      'pewawancara'             => $pewawancara
    );
    $simpan = $this->db->update('aplikan_wawancara',$data,array('kode_aplikan'=>$kode_aplikan));
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Updated</h6>
          </div>
        </div>');
	    redirect('marketing/aplikanwawancara');
    }
  }


  function hapusaplikanwawancara($kode_aplikan)
  {
    $hapus = $this->db->delete('aplikan_wawancara',array('kode_aplikan'=>$kode_aplikan));
    if($hapus){

      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/aplikanwawancara');
    }
  }

  // Fungsi untuk melakukan proses upload file
  public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    $config['upload_path']      = './excel/';
    $config['allowed_types']    = 'xlsx';
    $config['max_size']         = '2048';
    $config['overwrite']        = true;
    $config['file_name']        = $filename;
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
  public function insert_multiple($data){
    $this->db->insert_batch('siswa', $data);
  }


  function update_siswa()
  {

    $kode_siswa       = $this->input->post('kode_siswa');
    $nama_lengkap     = $this->input->post('namalengkap');
    $tempat_lahir     = $this->input->post('tempatlahir');
    $tgl_lahir        = $this->input->post('tahunlahir')."-".$this->input->post('bulanlahir')."-".$this->input->post('tgllahir');
    $jenis_kelamin    = $this->input->post('jk');
    $dusun            = $this->input->post('dusun');
    $rtrw             = $this->input->post('rtrw');
    $kelurahan        = $this->input->post('kelurahan');
    $kecamatan        = $this->input->post('kecamatan');
    $kota             = $this->input->post('kota');
    $kode_pos         = $this->input->post('kodepos');
    $no_hp            = $this->input->post('nohp');
    $whatsapp         = $this->input->post('whatsapp');
    $facebook         = $this->input->post('facebook');
    $instagram        = $this->input->post('ig');
    $pdd_terakhir     = $this->input->post('pendidikanterakhir');
    $asal_sekolah     = $this->input->post('asalsekolah');
    $jurusan_sekolah  = $this->input->post('jurusansekolah');
    $tahun_lulus      = $this->input->post('tahunlulus');
    $email            = $this->input->post('email');
    $nama_ortu        = $this->input->post('namaortu');
    $pekerjaan_ortu   = $this->input->post('pekerjaanortu');
    $penghasilan_ortu = $this->input->post('penghasilanortu');
    $nohp_ortu        = $this->input->post('nohportu');
    $presenter        = $this->input->post('presenter');
    $minat            = $this->input->post('minat');
    $jurusanlp3i      = $this->input->post('jurusanlp3i');
    $ranking          = $this->input->post('ranking');
    $kelas            = $this->input->post('kelas');
    $prestasi         = $this->input->post('prestasi');
    $pengentri        = $this->input->post('pengentri');
    $folder           = $this->input->post('folder');
    $keterangan       = $this->input->post('keterangan');
    $kesan            = $this->input->post('kesan');
    $namafolder       = $this->input->post('namafolder');

    $data = array
    (
      'nama_lengkap'        => $nama_lengkap,
      'tempat_lahir'        => $tempat_lahir,
      'tgl_lahir'           => $tgl_lahir,
      'jenis_kelamin'       => $jenis_kelamin,
      'dusun'               => $dusun,
      'rtrw'                => $rtrw,
      'kelurahan'           => $kelurahan,
      'kecamatan'           => $kecamatan,
      'kota'                => $kota,
      'kode_pos'            => $kode_pos,
      'no_hp'               => $no_hp,
      'whatsapp'            => $whatsapp,
      'facebook'            => $facebook,
      'instagram'           => $instagram,
      'pendidikan_terakhir' => $pdd_terakhir,
      'asal_sekolah'        => $asal_sekolah,
      'jurusan_sekolah'     => $jurusan_sekolah,
      'kelas'               => $kelas,
      'ranking'             => $ranking,
      'prestasi'            => $prestasi,
      'kode_jurusan'        => $jurusanlp3i,
      'tahun_lulus'         => $tahun_lulus,
      'email'               => $email,
      'nama_ortu'           => $nama_ortu,
      'pekerjaan_ortu'      => $pekerjaan_ortu,
      'penghasilan_ortu'    => $penghasilan_ortu,
      'nohp_ortu'           => $nohp_ortu,
      'kode_presenter'      => $presenter,
      'operator'            => $pengentri,
      'folder'              => $folder,
      'minat'               => $minat,
      'tahun_akademik'      => $ta,
      'operator'            => $operator,
      'ket_minat'           => $keterangan,
      'kesan'               => $kesan,
      'namafolder'          => $namafolder
    );
    $update = $this->db->update('siswa',$data,array('kode_siswa'=>$kode_siswa));
    if($update){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Updated</h6>
          </div>
        </div>');
	    redirect('marketing/detailsiswa/'.$kode_siswa);
    }
  }


  function insert_siswa()
  {
    $ta               = $this->input->post('ta');
    $tahun_akademik   = substr($ta,2,2);
    $siswa            = $this->db->query("SELECT kode_siswa FROM siswa WHERE tahun_akademik='$ta' ORDER BY kode_siswa DESC LIMIT 1")->row_array();
    $lastkode         = $siswa['kode_siswa'];
    $operator         = $this->access->get_username();
    $kode_siswa       = buatkode($lastkode,"S".$tahun_akademik,4);
    $nama_lengkap     = $this->input->post('namalengkap');
    $tempat_lahir     = $this->input->post('tempatlahir');
    $tgl_lahir        = $this->input->post('tahunlahir')."-".$this->input->post('bulanlahir')."-".$this->input->post('tgllahir');
    $jenis_kelamin    = $this->input->post('jk');
    $dusun            = $this->input->post('dusun');
    $rtrw             = $this->input->post('rtrw');
    $kelurahan        = $this->input->post('kelurahan');
    $kecamatan        = $this->input->post('kecamatan');
    $kota             = $this->input->post('kota');
    $kode_pos         = $this->input->post('kodepos');
    $no_hp            = $this->input->post('nohp');
    $whatsapp         = $this->input->post('whatsapp');
    $facebook         = $this->input->post('facebook');
    $instagram        = $this->input->post('ig');
    $pdd_terakhir     = $this->input->post('pendidikanterakhir');
    $asal_sekolah     = $this->input->post('asalsekolah');
    $jurusan_sekolah  = $this->input->post('jurusansekolah');
    $tahun_lulus      = $this->input->post('tahunlulus');
    $email            = $this->input->post('email');
    $nama_ortu        = $this->input->post('namaortu');
    $pekerjaan_ortu   = $this->input->post('pekerjaanortu');
    $penghasilan_ortu = $this->input->post('penghasilanortu');
    $nohp_ortu        = $this->input->post('nohportu');
    $presenter        = $this->input->post('presenter');
    $minat            = $this->input->post('minat');
    $jurusanlp3i      = $this->input->post('jurusanlp3i');
    $ranking          = $this->input->post('ranking');
    $kelas            = $this->input->post('kelas');
    $prestasi         = $this->input->post('prestasi');
    $pengentri        = $this->input->post('pengentri');
    $folder           = $this->input->post('folder');
    $keterangan       = $this->input->post('keterangan');
    $kesan            = $this->input->post('kesan');
    $namafolder       = $this->input->post('namafolder');
    $data = array
    (
      'kode_siswa'          => $kode_siswa,
      'nama_lengkap'        => $nama_lengkap,
      'tempat_lahir'        => $tempat_lahir,
      'tgl_lahir'           => $tgl_lahir,
      'jenis_kelamin'       => $jenis_kelamin,
      'dusun'               => $dusun,
      'rtrw'                => $rtrw,
      'kelurahan'           => $kelurahan,
      'kecamatan'           => $kecamatan,
      'kota'                => $kota,
      'kode_pos'            => $kode_pos,
      'no_hp'               => $no_hp,
      'whatsapp'            => $whatsapp,
      'facebook'            => $facebook,
      'instagram'           => $instagram,
      'pendidikan_terakhir' => $pdd_terakhir,
      'asal_sekolah'        => $asal_sekolah,
      'jurusan_sekolah'     => $jurusan_sekolah,
      'kelas'               => $kelas,
      'ranking'             => $ranking,
      'prestasi'            => $prestasi,
      'kode_jurusan'        => $jurusanlp3i,
      'tahun_lulus'         => $tahun_lulus,
      'email'               => $email,
      'nama_ortu'           => $nama_ortu,
      'pekerjaan_ortu'      => $pekerjaan_ortu,
      'penghasilan_ortu'    => $penghasilan_ortu,
      'nohp_ortu'           => $nohp_ortu,
      'kode_presenter'      => $presenter,
      'operator'            => $pengentri,
      'folder'              => $folder,
      'minat'               => $minat,
      'tahun_akademik'      => $ta,
      'operator'            => $operator,
      'ket_minat'           => $keterangan,
      'kesan'               => $kesan,
      'namafolder'          => $namafolder
    );

    $update = $this->db->insert('siswa',$data);
    if($update){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Saved</h6>
          </div>
        </div>');
	    redirect('marketing/dbsiswa');
    }
  }

  function hapussiswa($kode_siswa)
  {
    $hapus = $this->db->delete('siswa',array('kode_siswa'=>$kode_siswa));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('marketing/dbsiswa');
    }
  }

  function getStatAp($ta){
    $level       = $this->access->get_level();
    $username    = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$username);
    }
    $this->db->where('tahun_akademik',$ta);
    return $this->db->get('aplikan');
  }

  function getStatApDaftar($ta){
    $level       = $this->access->get_level();
    $username    = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$username);
    }
    $this->db->where('tahun_akademik',$ta);
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    return $this->db->get('aplikan_daftar');
  }

  function getStatApRegis($ta){
    $level       = $this->access->get_level();
    $username    = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$username);
    }
    $this->db->where('biaya.tahun_akademik',$ta);
    $this->db->where('biaya.tingkat',1);
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    return $this->db->get('registrasi');
  }

  function getRasiopresenter($ta)
  {
    $level       = $this->access->get_level();
    $username    = $this->access->get_username();
    if($level=='presenter')
    {
      $presenter  = "AND kp.kode_presenter = '".$username."'";
    }else{
      $presenter = "";
    }
    $query = "SELECT kp.kode_presenter,nama_presenter,aplikandatang,aplikandaftar,aplikanregistrasi,regisunder30
              FROM konfigurasi_presenter kp
              INNER JOIN master_presenter mp ON kp.kode_presenter = mp.kode_presenter
              LEFT JOIN (
                SELECT kode_presenter,
                COUNT(*) as aplikandatang,
                COUNT(IF(tgl_daftar !='',1,NULL)) as aplikandaftar
                FROM aplikan
                LEFT JOIN aplikan_daftar ON aplikan.kode_aplikan = aplikan_daftar.kode_aplikan
                WHERE tahun_akademik = '$ta'
                GROUP BY kode_presenter
              ) apk ON (kp.kode_presenter = apk.kode_presenter)
              LEFT JOIN (
                SELECT kode_presenter,
                COUNT(*) as aplikanregistrasi
                FROM registrasi
                INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
                INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                WHERE biaya.tahun_akademik = '$ta' AND tingkat='1'
                GROUP BY kode_presenter
              ) reg ON (kp.kode_presenter = reg.kode_presenter)
              LEFT JOIN (
                SELECT kode_presenter,
                COUNT(*) as regisunder30
                FROM detailrencana
                INNER JOIN registrasi ON detailrencana.kode_registrasi = registrasi.kode_registrasi
                INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
                INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                WHERE biaya.tahun_akademik = '$ta' AND tingkat='1' AND cicilanke='0' AND realisasi < round((30/100)*harga_deal)
                GROUP BY kode_presenter
              ) regunder30 ON (kp.kode_presenter = regunder30.kode_presenter) WHERE kp.ta_mkt='$ta'".$presenter;
    return $this->db->query($query);
  }

  function getRasiomedia($ta)
  {
    $query = "SELECT sumber_informasi,COUNT(kode_aplikan) as jumlah
             FROM aplikan
             WHERE tahun_akademik='$ta'
             GROUP BY sumber_informasi";
    return $this->db->query($query);
  }

  function lapApgel($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
			$periodedatang = "AND aplikan.tgl_datang BETWEEN '".$dari."' AND '".$sampai."'";
      $periodedaftar = "AND aplikan_daftar.tgl_daftar BETWEEN '".$dari."' AND '".$sampai."'";
      $periodeujian  = "AND aplikan_ujian.tgl_ujian BETWEEN '".$dari."' AND '".$sampai."'";
      $periodelulus  = "AND aplikan_wawancara.tgl_wawancara BETWEEN '".$dari."' AND '".$sampai."'";
      $perioderegis  = "AND registrasi.tgl_registrasi BETWEEN '".$dari."' AND '".$sampai."'";
		}else{
      $periodedatang = "";
      $periodedaftar = "";
      $periodeujian  = "";
      $periodelulus  = "";
      $perioderegis  = "";
    }
    $query = "SELECT konfigurasi_jurusan.kode_jurusan,nama_jurusan,jml_aplikandatang,jml_aplikanonline,jml_aplikandaftar,
              jml_aplikandaftaronline,jml_ujian,jml_lulus,jml_regisjunior,jml_regisjunioronline,jml_regissenior
              FROM konfigurasi_jurusan
              INNER JOIN master_jurusan ON konfigurasi_jurusan.kode_jurusan = master_jurusan.kode_jurusan
              LEFT JOIN(
                SELECT kode_jurusan,
                  SUM(IF(sumber_aplikan != 'online',1,NULL)) as jml_aplikandatang,
                  SUM(IF(sumber_aplikan ='online',1,NULL)) as jml_aplikanonline
                FROM aplikan
                WHERE tahun_akademik = '$tahun_akademik'".
                $periodedatang.
                "
                GROUP BY kode_jurusan
              ) ap ON (konfigurasi_jurusan.kode_jurusan = ap.kode_jurusan)

              LEFT JOIN(
                SELECT kode_jurusan,
                  SUM(IF(sumber_aplikan != 'online',1,NULL)) as jml_aplikandaftar,
                  SUM(IF(sumber_aplikan ='online',1,NULL)) as jml_aplikandaftaronline
                FROM aplikan_daftar
                INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan
                WHERE tahun_akademik = '$tahun_akademik'".
                $periodedaftar.
                "
                GROUP BY kode_jurusan
              ) apdaftar ON (konfigurasi_jurusan.kode_jurusan = apdaftar.kode_jurusan)

              LEFT JOIN(
                SELECT kode_jurusan,
                COUNT(aplikan_ujian.kode_aplikan) jml_ujian
                FROM aplikan_ujian
                INNER JOIN aplikan ON aplikan_ujian.kode_aplikan = aplikan.kode_aplikan
                WHERE tahun_akademik = '$tahun_akademik'".
                $periodeujian.
                "
                GROUP BY kode_jurusan
              ) apujian ON (konfigurasi_jurusan.kode_jurusan = apujian.kode_jurusan)

              LEFT JOIN(
                SELECT kode_jurusan,
                COUNT(aplikan_wawancara.kode_aplikan) jml_lulus
                FROM aplikan_wawancara
                INNER JOIN aplikan ON aplikan_wawancara.kode_aplikan = aplikan.kode_aplikan
                WHERE tahun_akademik = '$tahun_akademik'".
                $periodelulus.
                "
                GROUP BY kode_jurusan
              ) apwawancara ON (konfigurasi_jurusan.kode_jurusan = apwawancara.kode_jurusan)

              LEFT JOIN(
                SELECT biaya.kode_jurusan,
                SUM(IF(biaya.tingkat = '1' AND sumber_aplikan ='online',1,NULL)) as jml_regisjunioronline,
                SUM(IF(biaya.tingkat = '1' AND sumber_aplikan !='online',1,NULL)) as jml_regisjunior,
                SUM(IF(biaya.tingkat ='2',1,NULL)) as jml_regissenior
                FROM registrasi
                INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
                INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                WHERE biaya.tahun_akademik = '$tahun_akademik'".
                $perioderegis.
                "
                GROUP BY kode_jurusan
              ) apregis ON (konfigurasi_jurusan.kode_jurusan = apregis.kode_jurusan)
              WHERE konfigurasi_jurusan.ta_mkt = '$tahun_akademik' ORDER BY konfigurasi_jurusan.kode_jurusan ASC";
    return $this->db->query($query);
  }

  function lapRasiopresenter($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
			$periodedatang = "AND aplikan.tgl_datang BETWEEN '".$dari."' AND '".$sampai."'";
      $periodedaftar = "AND aplikan_daftar.tgl_daftar BETWEEN '".$dari."' AND '".$sampai."'";
      $periodeujian  = "AND aplikan_ujian.tgl_ujian BETWEEN '".$dari."' AND '".$sampai."'";
      $periodelulus  = "AND aplikan_wawancara.tgl_wawancara BETWEEN '".$dari."' AND '".$sampai."'";
      $perioderegis  = "AND registrasi.tgl_registrasi BETWEEN '".$dari."' AND '".$sampai."'";
		}else{
      $periodedatang = "";
      $periodedaftar = "";
      $periodeujian  = "";
      $periodelulus  = "";
      $perioderegis  = "";
    }
    $query = "SELECT konfigurasi_presenter.kode_presenter,nama_presenter,jml_aplikandatang,jml_aplikandaftar,jml_aplikanregisjunior
              FROM konfigurasi_presenter
              INNER JOIN master_presenter ON konfigurasi_presenter.kode_presenter = master_presenter.kode_presenter
              LEFT JOIN(
                SELECT kode_presenter,
                  COUNT(aplikan.kode_aplikan) as jml_aplikandatang
                FROM aplikan
                WHERE tahun_akademik = '$tahun_akademik'".
                $periodedatang.
                "
                GROUP BY kode_presenter
              ) ap ON (konfigurasi_presenter.kode_presenter = ap.kode_presenter)

              LEFT JOIN(
                SELECT kode_presenter,
                  COUNT(aplikan_daftar.kode_aplikan) as jml_aplikandaftar
                FROM aplikan_daftar
                INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan
                WHERE tahun_akademik = '$tahun_akademik'".
                $periodedaftar.
                "
                GROUP BY kode_presenter
              ) apdaftar ON (konfigurasi_presenter.kode_presenter = apdaftar.kode_presenter)

              LEFT JOIN(
                SELECT kode_presenter,
                  COUNT(registrasi.kode_aplikan) as jml_aplikanregisjunior
                FROM registrasi
                INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
                INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                WHERE biaya.tahun_akademik = '$tahun_akademik' AND biaya.tingkat='1'".
                $perioderegis.
                "
                GROUP BY kode_presenter
              ) apregis ON (konfigurasi_presenter.kode_presenter = apregis.kode_presenter)
              WHERE konfigurasi_presenter.ta_mkt = '$tahun_akademik' ORDER BY konfigurasi_presenter.kode_presenter ASC";
    return $this->db->query($query);
  }

  function lapRasiomedia($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
			$periodedatang = "AND aplikan.tgl_datang BETWEEN '".$dari."' AND '".$sampai."'";
		}else{
      $periodedatang = "";
    }
    $query = "SELECT sumber_informasi,COUNT(kode_aplikan) as jml_aplikandatang
             FROM aplikan
             WHERE tahun_akademik='$tahun_akademik'".
             $periodedatang
             ."
             GROUP BY sumber_informasi";
    return $this->db->query($query);
  }

  function lapRasiomediaregis($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
			$perioderegis  = "AND registrasi.tgl_registrasi BETWEEN '".$dari."' AND '".$sampai."'";
		}else{
      $perioderegis  = "";
    }
    $query = "SELECT sumber_informasi,COUNT(registrasi.kode_aplikan) as jml_aplikanregis
             FROM registrasi
             INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
             WHERE tahun_akademik='$tahun_akademik'".
             $perioderegis
             ."
             GROUP BY sumber_informasi";
    return $this->db->query($query);
  }

  public function getrecordAplikan2($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
      $this->db->where('tgl_datang >=',$dari);
      $this->db->where('tgl_datang <=',$sampai);
    }

    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan');
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  public function getrecordAplikanregis2($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
      $this->db->where('tgl_registrasi >=',$dari);
      $this->db->where('tgl_registrasi <=',$sampai);
    }

    $this->db->select('count(*) as allcount');
    $this->db->from('registrasi');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function AplikanTidakDaftar($tahun_akademik="",$presenter="")
  {
    if($presenter !=""){
      $this->db->where('aplikan.kode_presenter',$presenter);
    }
    $this->db->select('nama_lengkap,nama_jurusan,kota,no_hp,whatsapp,aplikan.kode_presenter,nama_presenter');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_daftar','aplikan.kode_aplikan = aplikan_daftar.kode_aplikan','LEFT');
    $this->db->where('aplikan.tahun_akademik',$tahun_akademik);
    $this->db->where('tgl_daftar IS NULL');
    $this->db->order_by('aplikan.kode_presenter','ASC');
    return $this->db->get();
  }

  function AplikanTidakUjian($tahun_akademik="",$presenter="")
  {
    if($presenter !=""){
      $this->db->where('aplikan.kode_presenter',$presenter);
    }
    $this->db->select('nama_lengkap,nama_jurusan,kota,no_hp,whatsapp,aplikan.kode_presenter,nama_presenter');
    $this->db->from('aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan_ujian','aplikan.kode_aplikan = aplikan_ujian.kode_aplikan','LEFT');
    $this->db->where('aplikan.tahun_akademik',$tahun_akademik);
    $this->db->where('tgl_ujian IS NULL');
    $this->db->order_by('aplikan.kode_presenter','ASC');
    return $this->db->get();
  }

  function lapRekapdaftar($tahun_akademik="",$dari="",$sampai="")
  {
    if($dari 	!= "" AND $sampai !=""){
			$periodedaftar = "AND aplikan_daftar.tgl_daftar BETWEEN '".$dari."' AND '".$sampai."'";
		}else{
      $periodedaftar = "";
    }
    $query = "SELECT nomor_bukti,tgl_daftar,gelombang_daftar,nama_lengkap,nama_presenter,pewawancara,biaya_pendaftaran-diskon as biaya_pendaftaran,ket_daftar
             FROM aplikan_daftar
             INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan
             INNER JOIN master_presenter ON aplikan.kode_presenter = master_presenter.kode_presenter
             LEFT JOIN aplikan_wawancara ON aplikan_daftar.kode_aplikan = aplikan_wawancara.kode_aplikan
             WHERE aplikan.tahun_akademik ='$tahun_akademik'".$periodedaftar;
    return $this->db->query($query);
  }

  function input_target()
  {
    $kodetarget = $this->input->post('kodetarget');
    $namatarget = $this->input->post('namatarget');

    $data = array(
      'kode_target' => $kodetarget,
      'nama_target' => $namatarget

    );

    $cek = $this->db->get_where('konfigurasi_target',array('kode_target'=>$kodetarget))->num_rows();
    if(empty($cek)){
      $simpan = $this->db->insert('konfigurasi_target',$data);
      if($simpan)
      {
        $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Saved </h6>
              </div>
          </div>');
	    	redirect('marketing/target');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Kode Target '.$kodetarget.' Allready Exist </h6>
            </div>
        </div>');
      redirect('marketing/target');
    }
  }


  function listTarget()
  {
    return $this->db->get('konfigurasi_target');
  }

  function getTarget($kodetarget)
  {
    return $this->db->get_where('konfigurasi_target',array('kode_target'=>$kodetarget));
  }

  function update_target()
  {
    $kodetarget = $this->input->post('kodetarget');
    $namatarget = $this->input->post('namatarget');

    $data = array(
      'nama_target' => $namatarget
    );


    $simpan = $this->db->update('konfigurasi_target',$data,array('kode_target'=>$kodetarget));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Has Been Updated </h6>
            </div>
        </div>');
    	redirect('marketing/target');
    }
  }

  function hapus_target($kodetarget)
  {
    $hapus = $this->db->delete('konfigurasi_target',array('kode_target'=>$kodetarget));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Has Been Deleted </h6>
            </div>
        </div>');
    	redirect('marketing/target');
    }
  }

  function hapus_settarget($kode_presenter,$kode_target)
  {
    $hapus = $this->db->delete('konfigurasi_targetpresenter',array('kode_presenter'=>$kode_presenter,'kode_target'=>$kode_target));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Has Been Deleted </h6>
            </div>
        </div>');
    	redirect('marketing/settarget');
    }
  }

  function getBulanTarget()
  {
    $this->db->order_by('order','ASC');
    return $this->db->get('bulan');
  }

  function insert_targetpresenter()
  {
    $presenter = $this->input->post('presenter');
    $target    = $this->input->post('target');
    $jum       = $this->input->post('jum');
    $ta_mkt    = $this->input->post('ta_mkt');
    $tahun     = substr($ta_mkt,2,2);

    $cek       = $this->db->get_where('konfigurasi_targetpresenter',array('kode_presenter'=>$presenter,'kode_target'=>$target,'ta_mkt'=>$ta_mkt))->num_rows();
    if(!empty($cek))
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Allready Exist </h6>
            </div>
        </div>');
    	redirect('marketing/settarget');
    }else{
      for($i=1; $i<=$jum; $i++)
      {
        $bulan        = $this->input->post('bulan'.$i);
        $jumlahtarget = $this->input->post('jumlahtarget'.$i);
        $jmltarget    = $this->input->post('jumlahtarget'.$i);
        $kode         = $presenter.$target.$tahun.$bulan;

        $data = array(
          'kode_targetpresenter'  => $kode,
          'kode_target'           => $target,
          'kode_presenter'        => $presenter,
          'ta_mkt'                => $ta_mkt,
          'bulan'                 => $bulan,
          'jumlah'                => $jmltarget
        );
        $this->db->insert('konfigurasi_targetpresenter',$data);
      }

      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Saved Succesfully </h6>
            </div>
        </div>');
    	redirect('marketing/settarget');
    }
  }

  function update_targetpresenter()
  {
    $presenter = $this->input->post('presenter');
    $target    = $this->input->post('target');
    $jum       = $this->input->post('jum');
    $ta_mkt    = $this->input->post('ta_mkt');
    $tahun     = substr($ta_mkt,2,2);

    for($i=1; $i<=$jum; $i++)
    {
      $kode         = $this->input->post('kode'.$i);
      $bulan        = $this->input->post('bulan'.$i);
      $jumlahtarget = $this->input->post('jumlahtarget'.$i);
      $jmltarget    = $this->input->post('jumlahtarget'.$i);
      $data = array(
        'jumlah'                => $jmltarget
      );
      $this->db->update('konfigurasi_targetpresenter',$data,array('kode_targetpresenter'=>$kode));
    }

    $this->session->set_flashdata('msg',
      '<div class="card bg-c-green order-card">
          <div class="card-block">
              <h6><i class="ti-check"></i> Data Updated Succesfully </h6>
          </div>
      </div>');
    redirect('marketing/settarget');
  }

  public function getDataTargetPresenter($rowno,$rowperpage,$presenter="",$tahun_akademik="",$target="")
  {
    $this->db->select('konfigurasi_targetpresenter.kode_presenter,nama_presenter,konfigurasi_targetpresenter.kode_target,
                       nama_target,konfigurasi_targetpresenter.ta_mkt');
    $this->db->from('konfigurasi_targetpresenter');
    $this->db->join('master_presenter','konfigurasi_targetpresenter.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('konfigurasi_target','konfigurasi_targetpresenter.kode_target = konfigurasi_target.kode_target');
    if($presenter != ''){
    	$this->db->where('konfigurasi_targetpresenter.kode_presenter', $presenter);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('konfigurasi_targetpresenter.ta_mkt', $tahun_akademik);
  	}

    if($target != ''){
    	$this->db->where('konfigurasi_targetpresenter.kode_target', $target);
  	}
    $this->db->group_by('konfigurasi_targetpresenter.kode_presenter,nama_presenter,konfigurasi_targetpresenter.kode_target,
                       nama_target,konfigurasi_targetpresenter.ta_mkt');
    $this->db->order_by('kode_presenter','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordTargetPresenter($presenter="",$tahun_akademik="",$target="")
  {
    error_reporting(0);

    if($presenter != "")
    {
      $presenter = "AND kode_presenter = '".$presenter."'";
    }

    if($tahun_akademik != "")
    {
      $tahun_akademik = "AND ta_mkt = '".$tahun_akademik."'";
    }

    if($target != "")
    {
      $target = "AND kode_target = '".$target."'";
    }
    $query = "SELECT COUNT(*) as allcount FROM (
              SELECT COUNT(*) as allcount FROM konfigurasi_targetpresenter
              WHERE kode_presenter !=''"
              .$presenter
              .$tahun_akademik
              .$target
          ."GROUP BY kode_presenter,kode_target,ta_mkt) groups";


    $query 	= $this->db->query($query);
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function getTargetPresenter($kode_presenter,$kode_target)
  {
    $this->db->group_by('konfigurasi_targetpresenter.kode_presenter');
    $this->db->join('master_presenter','konfigurasi_targetpresenter.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('konfigurasi_target','konfigurasi_targetpresenter.kode_target = konfigurasi_target.kode_target');
    return $this->db->get_where('konfigurasi_targetpresenter',array('konfigurasi_targetpresenter.kode_presenter'=>$kode_presenter,'konfigurasi_targetpresenter.kode_target'=>$kode_target));
  }

  function getDetailTargetPresenter($kode_presenter,$kode_target)
  {

    $this->db->join('bulan','konfigurasi_targetpresenter.bulan = bulan.id_bulan');
    $this->db->join('master_presenter','konfigurasi_targetpresenter.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('konfigurasi_target','konfigurasi_targetpresenter.kode_target = konfigurasi_target.kode_target');
    $this->db->order_by('order','ASC');
    return $this->db->get_where('konfigurasi_targetpresenter',array('konfigurasi_targetpresenter.kode_presenter'=>$kode_presenter,'konfigurasi_targetpresenter.kode_target'=>$kode_target));
  }



  function input_aktivitas()
  {
    $kodeaktivitas = $this->input->post('kodeaktivitas');
    $namaaktivitas = $this->input->post('namaaktivitas');
    $ta_mkt     = $this->input->post('ta_mkt');

    $data = array(
      'kode_aktivitas' => $kodeaktivitas,
      'nama_aktivitas' => $namaaktivitas,
      'ta_mkt'        => $ta_mkt
    );

    $cek = $this->db->get_where('konfigurasi_aktivitas',array('kode_aktivitas'=>$kodeaktivitas))->num_rows();
    if(empty($cek)){
      $simpan = $this->db->insert('konfigurasi_aktivitas',$data);
      if($simpan)
      {
        $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Saved </h6>
              </div>
          </div>');
	    	redirect('marketing/masteraktivitas');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Kode Aktivitas '.$kodeaktivitas.' Allready Exist </h6>
            </div>
        </div>');
      redirect('marketing/masteraktivitas');
    }
  }

  function getAktivitas($kodeaktivitas)
  {
    return $this->db->get_where('konfigurasi_aktivitas',array('kode_aktivitas'=>$kodeaktivitas));
  }

  function update_aktivitas()
  {
    $kodeaktivitas = $this->input->post('kodeaktivitas');
    $namaaktivitas = $this->input->post('namaaktivitas');
    $ta_mkt     = $this->input->post('ta_mkt');

    $data = array(
      'nama_aktivitas' => $namaaktivitas,
      'ta_mkt'        => $ta_mkt
    );


    $simpan = $this->db->update('konfigurasi_aktivitas',$data,array('kode_aktivitas'=>$kodeaktivitas));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Has Been Updated </h6>
            </div>
        </div>');
    	redirect('marketing/masteraktivitas');
    }
  }

  function hapus_aktivitas($kodeaktivitas)
  {
    $hapus = $this->db->delete('konfigurasi_aktivitas',array('kode_aktivitas'=>$kodeaktivitas));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Has Been Deleted </h6>
            </div>
        </div>');
    	redirect('marketing/masteraktivitas');
    }
  }

  public function getDataAktivitas($rowno,$rowperpage,$dari="",$sampai="",$presenter="",$tahun_akademik="",$aktivitas="",$namasiswa="",$status="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('kode_actpresenter,tgl_act,aktivitas_presenter.kode_aktivitas,nama_aktivitas,aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,
                      nama_presenter,keterangan,hasilfollowup,status');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }
    if($presenter != ''){
    	$this->db->where('siswa.kode_presenter', $presenter);
  	}

    if($namasiswa != ''){
    	$this->db->like('siswa.nama_lengkap', $namasiswa);
  	}

    if($tahun_akademik != ''){
    	$this->db->where('konfigurasi_aktivitas.ta_mkt', $tahun_akademik);
  	}
    if($aktivitas != ''){
    	$this->db->where('aktivitas_presenter.kode_aktivitas', $aktivitas);
  	}

    if($status != ''){
    	$this->db->where('aktivitas_presenter.status', $status);
  	}
    $this->db->order_by('tgl_act','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordAktivitas($dari="",$sampai="",$presenter="",$tahun_akademik="",$aktivitas="",$namasiswa="",$status="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('COUNT(*) as allcount');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }
    if($presenter != ''){
    	$this->db->where('siswa.kode_presenter', $presenter);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('konfigurasi_aktivitas.ta_mkt', $tahun_akademik);
  	}
    if($aktivitas != ''){
    	$this->db->where('aktivitas_presenter.kode_aktivitas', $aktivitas);
  	}

    if($namasiswa != ''){
    	$this->db->like('siswa.nama_lengkap', $namasiswa);
  	}

    if($status != ''){
    	$this->db->where('aktivitas_presenter.status', $status);
  	}
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function listAktivitas($ta_mkt)
  {
    return $this->db->get_where('konfigurasi_aktivitas',array('ta_mkt'=>$ta_mkt));
  }

  function listSiswa($ta)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    return $this->db->get_where('siswa',array('tahun_akademik'=>$ta));
  }

  function insert_aktivitaspresenter()
  {
    $tanggal        = $this->input->post('tanggal');
    $kodesiswa      = $this->input->post('kodesiswa');
    $keterangan     = $this->input->post('keterangan');
    $hasilfollowup  = $this->input->post('hasilfollowup');
    $status         = $this->input->post('status');
    $aktivitas      = $this->input->post('aktivitas');
    $ta_mkt         = $this->input->post('ta_mkt');
    $ta_aktif       = substr($ta_mkt,2,2);
    $actpre         = "SELECT kode_actpresenter FROM aktivitas_presenter  INNER JOIN siswa ON aktivitas_presenter.kode_siswa = siswa.kode_siswa
                      WHERE tahun_akademik ='$ta_mkt' ORDER BY kode_actpresenter DESC LIMIT 1 ";
    $ceknolast      = $this->db->query($actpre)->row_array();
    $kodeterakhir   = $ceknolast['kode_actpresenter'];
    $kode_actpre    = buatkode($kodeterakhir,"KA".$ta_aktif,4);
    $data = array(
      'kode_actpresenter' => $kode_actpre,
      'kode_aktivitas'    => $aktivitas,
      'kode_siswa'        => $kodesiswa,
      'keterangan'        => $keterangan,
      'tgl_act'           => $tanggal,
      'hasilfollowup'     => $hasilfollowup,
      'status'            => $status

    );

    $simpan = $this->db->insert('aktivitas_presenter',$data);
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Has Been Saved </h6>
            </div>
        </div>');
    	redirect('marketing/aktivitas');
    }
  }

  function getAktivitasPresenter($kode)
  {
    $this->db->select('kode_actpresenter,tgl_act,aktivitas_presenter.kode_aktivitas,nama_aktivitas,aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,
                      nama_presenter,keterangan,hasilfollowup,status');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('kode_actpresenter',$kode);
    return $this->db->get();
  }

  function update_aktivitaspresenter()
  {
    $kode           = $this->input->post('kode');
    $tanggal        = $this->input->post('tanggal');
    $kodesiswa      = $this->input->post('kodesiswa');
    $keterangan     = $this->input->post('keterangan');
    $hasilfollowup  = $this->input->post('hasilfollowup');
    $status         = $this->input->post('status');
    $aktivitas      = $this->input->post('aktivitas');
    $ta_mkt         = $this->input->post('ta_mkt');
    $ta_aktif       = substr($ta_mkt,2,2);
    $data = array(
      'kode_aktivitas'    => $aktivitas,
      'kode_siswa'        => $kodesiswa,
      'keterangan'        => $keterangan,
      'tgl_act'           => $tanggal,
      'hasilfollowup'     => $hasilfollowup,
      'status'            => $status

    );

    $simpan = $this->db->update('aktivitas_presenter',$data,array('kode_actpresenter'=>$kode));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Has Been Updated </h6>
            </div>
        </div>');
    	redirect('marketing/aktivitas');
    }
  }

  function hapusaktivitaspresenter($kode)
  {
    $hapus = $this->db->delete('aktivitas_presenter',array('kode_actpresenter'=>$kode));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Deleted </h6>
          </div>
        </div>');
    	redirect('marketing/aktivitas');
    }
  }

  public function getRekapAktivitas($dari="",$sampai="",$tahun_akademik="",$aktivitas="")
  {
    $this->db->select('siswa.kode_presenter,nama_presenter,
      SUM(IF( status = "1",1, 0)) AS hotprospek,
      SUM(IF( status = "2",1, 0)) AS prospek,
      SUM(IF( status = "3",1, 0)) AS belumprospek,
      SUM(IF( status = "4",1, 0)) AS batal,
      COUNT(aktivitas_presenter.kode_siswa) as total');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->group_by('siswa.kode_presenter,nama_presenter');
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }

    if($tahun_akademik != ''){
    	$this->db->where('konfigurasi_aktivitas.ta_mkt', $tahun_akademik);
  	}
    if($aktivitas != ''){
    	$this->db->where('aktivitas_presenter.kode_aktivitas', $aktivitas);
  	}
  	$query = $this->db->get();
    return $query;
 	}

  public function getRekapAktivitaspresenter($dari="",$sampai="",$tahun_akademik="")
  {
    $this->db->select('siswa.kode_presenter,nama_presenter,
      SUM(IF( kode_aktivitas = "K2002",1, 0)) AS teleselling,
      SUM(IF( kode_aktivitas = "K2003",1, 0)) AS hunting');
    $this->db->from('aktivitas_presenter');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->group_by('siswa.kode_presenter,nama_presenter');
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }

    if($tahun_akademik != ''){
    	$this->db->where('siswa.tahun_akademik', $tahun_akademik);
  	}
  	$query = $this->db->get();
    return $query;
 	}

  function getDetailstatusAktivitas($kodepresenter,$status,$aktivitas="",$dari="",$sampai="")
  {

    $this->db->select('kode_actpresenter,tgl_act,aktivitas_presenter.kode_aktivitas,nama_aktivitas,aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,
                      nama_presenter,keterangan,hasilfollowup,status');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('siswa.kode_presenter',$kodepresenter);
    $this->db->where('status',$status);
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }
    if($aktivitas != ''){
    	$this->db->where('aktivitas_presenter.kode_aktivitas', $aktivitas);
  	}
    return $this->db->get();
  }

  function getDetailRekapAktivitas($kodepresenter,$dari="",$sampai="")
  {

    $this->db->select('kode_actpresenter,tgl_act,aktivitas_presenter.kode_aktivitas,nama_aktivitas,aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,
                      nama_presenter,keterangan,hasilfollowup,status');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('siswa.kode_presenter',$kodepresenter);
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }

    return $this->db->get();
  }

  public function getDataRekapAktivitas($rowno,$rowperpage,$dari="",$sampai="",$presenter="",$tahun_akademik="",$aktivitas="",$namasiswa="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('aktivitas_presenter.kode_siswa,nama_lengkap,no_hp,asal_sekolah,siswa.kode_presenter,nama_presenter,
               COUNT(aktivitas_presenter.kode_siswa) as totalfollowup,
               (SELECT tgl_act FROM aktivitas_presenter act WHERE act.kode_siswa = aktivitas_presenter.kode_siswa ORDER BY tgl_act DESC LIMIT 1) as tglact');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->group_by('aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,nama_presenter,no_hp,asal_sekolah');
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai !="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }
    if($presenter != ''){
    	$this->db->where('siswa.kode_presenter', $presenter);
  	}

    if($namasiswa != ''){
    	$this->db->like('siswa.nama_lengkap', $namasiswa);
  	}

    if($tahun_akademik != ''){
    	$this->db->where('konfigurasi_aktivitas.ta_mkt', $tahun_akademik);
  	}
    if($aktivitas != ''){
    	$this->db->where('aktivitas_presenter.kode_aktivitas', $aktivitas);
  	}

    if($status != ''){
    	$this->db->where('aktivitas_presenter.status', $status);
  	}
    $this->db->order_by('tgl_act','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordRekapAktivitas($dari="",$sampai="",$presenter="",$tahun_akademik="",$aktivitas="",$namasiswa="",$status="")
  {
    error_reporting(0);
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $pre = "AND siswa.kode_presenter = '".$kodepresenter."' ";
    }
    if($dari != "")
    {
      $dari = "AND tgl_act >= '".$dari."'";
    }
    if($sampai != "")
    {
      $sampai = "AND tgl_act <= '".$sampai."'";
    }
    if($tahun_akademik != "")
    {
      $tahun_akademik = "AND konfigurasi_aktivitas.ta_mkt = '".$tahun_akademik."'";
    }
    if($presenter !="")
    {
      $pre = "AND siswa.kode_presenter = '".$presenter."' ";
    }

    if($aktivitas != "")
    {
      $aktivitas = "AND aktivitas_presenter.kode_aktivitas = '".$aktivitas."'";
    }

    $query = "SELECT COUNT(*) as allcount FROM (
              SELECT COUNT(*) as allcount FROM aktivitas_presenter
              INNER JOIN konfigurasi_aktivitas ON aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas
              INNER JOIN siswa ON aktivitas_presenter.kode_siswa = siswa.kode_siswa
              INNER JOIN master_presenter ON siswa.kode_presenter = master_presenter.kode_presenter
              WHERE aktivitas_presenter.kode_siswa !=''"
              .$dari
              .$sampai
              .$tahun_akademik
              .$aktivitas
              .$pre
          ."GROUP BY aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,nama_presenter,no_hp,asal_sekolah) groups";


    $query 	= $this->db->query($query);
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function getDetailFollowup($kode,$dari="",$sampai="")
  {
    if($dari !="")
    {
      $this->db->where('tgl_act >=',$dari);
    }

    if($sampai!="")
    {
      $this->db->where('tgl_act <=',$sampai);
    }
    $this->db->select('kode_actpresenter,tgl_act,aktivitas_presenter.kode_aktivitas,nama_aktivitas,aktivitas_presenter.kode_siswa,nama_lengkap,siswa.kode_presenter,
                      nama_presenter,keterangan,hasilfollowup,status');
    $this->db->from('aktivitas_presenter');
    $this->db->join('konfigurasi_aktivitas','aktivitas_presenter.kode_aktivitas = konfigurasi_aktivitas.kode_aktivitas');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->where('aktivitas_presenter.kode_siswa',$kode);
    return $this->db->get();
  }

  function getRekapHasilFollowup($tahun_akademik)
  {
    $query = "SELECT kp.kode_presenter,nama_presenter,jmldata,hotprospek,prospek,belumprospek,batal
            FROM konfigurasi_presenter kp
            INNER JOIN master_presenter ON kp.kode_presenter = master_presenter.kode_presenter
            LEFT JOIN
            	(SELECT kode_presenter,COUNT(kode_siswa)  as jmldata FROM siswa WHERE tahun_akademik = '$tahun_akademik' GROUP BY siswa.kode_presenter) sw
            ON (kp.kode_presenter = sw.kode_presenter)
            LEFT JOIN
            	(SELECT siswa.kode_presenter,
            		SUM(IF( status = '1',1, 0)) AS hotprospek,
            		SUM(IF( status = '2',1, 0)) AS prospek,
            		SUM(IF( status = '3',1, 0)) AS belumprospek,
                SUM(IF( status = '4',1, 0)) AS batal
            		FROM aktivitas_presenter
            		INNER JOIN siswa ON aktivitas_presenter.kode_siswa = siswa.kode_siswa
            		WHERE
            		tgl_act IN (
            		SELECT MAX(tgl_act) FROM aktivitas_presenter
            		GROUP BY kode_siswa
            		) AND siswa.tahun_akademik = '$tahun_akademik'
            		GROUP BY siswa.kode_presenter
            		) ap ON kp.kode_presenter = ap.kode_presenter
            		WHERE kp.ta_mkt = '$tahun_akademik' ";
    return $this->db->query($query);
  }

  function getrekaptargetpresenter($kodetarget,$kodepresenter,$tahunakademik)
  {
    $query = "SELECT kp.kode_presenter,kp.bulan,`order`,ta_mkt,nama_bulan,jumlah, totalregis,omset
              FROM konfigurasi_targetpresenter kp
              INNER JOIN bulan ON kp.bulan = bulan.id_bulan
              LEFT JOIN (SELECT kode_presenter,MONTH(tgl_registrasi) as bulan,COUNT(registrasi.kode_aplikan) as totalregis,
              SUM(harga_deal) as omset
              FROM registrasi
              INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
              INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
              WHERE biaya.tahun_akademik = '$tahunakademik' AND biaya.tingkat='1'
              GROUP BY kode_presenter,MONTH(tgl_registrasi) ) reg
              ON (kp.kode_presenter = reg.kode_presenter AND kp.bulan = reg.bulan)
              WHERE kode_target ='$kodetarget' AND kp.kode_presenter='$kodepresenter' AND ta_mkt='$tahunakademik' ORDER BY `order` ASC";
    return $this->db->query($query);
  }

  function getListTargetRegsiter($bulan,$ta,$presenter)
  {
    $query = "SELECT aplikan.nama_lengkap,asal_sekolah,no_hp,harga_deal
    FROM registrasi
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    WHERE biaya.tahun_akademik = '$ta' AND aplikan.kode_presenter = '$presenter' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tingkat='1'";
    return $this->db->query($query);
  }

  function getrecorddbSiswa($tahun_akademik)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    return $this->db->get_where('siswa',array('tahun_akademik'=>$tahun_akademik));
  }

  function getrecordAktifitas($tahun_akademik)
  {
    $this->db->select('distinct(aktivitas_presenter.kode_siswa)');
    $this->db->from('aktivitas_presenter');
    $this->db->join('siswa','aktivitas_presenter.kode_siswa = siswa.kode_siswa');
    $this->db->where('tahun_akademik',$tahun_akademik);
    return $this->db->get();
  }

  function getrecordDaftar($tahun_akademik)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    return $this->db->get_where('aplikan_daftar',array('tahun_akademik'=>$tahun_akademik));
  }

  function getrecordregis($tahun_akademik)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    return $this->db->get_where('registrasi',array('biaya.tahun_akademik'=>$tahun_akademik,'biaya.tingkat'=>1));
  }

  function getlisttreg($tahun_akademik)
  {
    $query = "SELECT kp.kode_presenter,nama_presenter,foto,SUM(jumlah) jmltarget,IFNULL(realisasi,0) as realisasi
    FROM konfigurasi_targetpresenter kp
    INNER JOIN master_presenter ON kp.kode_presenter = master_presenter.kode_presenter
    LEFT JOIN (SELECT kode_presenter,COUNT(registrasi.kode_aplikan) as realisasi FROM registrasi
    					 INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    					 INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    					 WHERE biaya.tahun_akademik = '$tahun_akademik' AND biaya.tingkat='1' GROUP BY kode_presenter) reg ON kp.kode_presenter = reg.kode_presenter
    WHERE ta_mkt ='$tahun_akademik' AND kode_target='T00001'  GROUP BY kp.kode_presenter,nama_presenter,realisasi ORDER BY realisasi DESC";
    return $this->db->query($query);
  }

  function getGrafikReg($tahun_akademik,$ta_last)
  {

    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $presenter = "AND aplikan.kode_presenter = '".$kodepresenter."'";
    }else{
      $presenter = "";
    }
    $query = "SELECT bulan.id_bulan,nama_bulan,jmlregisnow,jmlregislast
    FROM bulan
    LEFT JOIN ( SELECT MONTH(tgl_registrasi) as id_bulan,
    						SUM(IF(biaya.tahun_akademik  = '$tahun_akademik',1,0)) as jmlregisnow,
    						SUM(IF(biaya.tahun_akademik  = '$ta_last',1,0)) as jmlregislast
    						FROM registrasi
    						INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                INNER JOIN aplikan On registrasi.kode_aplikan = aplikan.kode_aplikan
    						WHERE biaya.tingkat ='1'".
                $presenter.
                "GROUP BY id_bulan) reg ON (bulan.id_bulan = reg.id_bulan)
    ORDER BY `order`";
    return $this->db->query($query);
  }

  function getAllTarget($tahun_akademik,$kodetarget)
  {
    $level          = $this->access->get_level();
    $kodepresenter  = $this->access->get_username();
    if($level=='presenter')
    {
      $presenter  = "AND konfigurasi_targetpresenter.kode_presenter = '".$kodepresenter."'";
    }else{

      $presenter = "";
    }
    $query = "SELECT kode_target,SUM(jumlah) as jmltarget
    FROM konfigurasi_targetpresenter WHERE ta_mkt='$tahun_akademik' AND kode_target='$kodetarget'".
    $presenter."
    GROUP BY kode_target";
    return $this->db->query($query);
  }

  function getOmset($tahun_akademik)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('SUM(harga_deal) as omset');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->where('biaya.tingkat','1');
    return $this->db->get();
  }

  function getMinat($tahun_akademik)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('minat,COUNT(kode_siswa) as jumlah');
    $this->db->from('siswa');
    $this->db->where('tahun_akademik',$tahun_akademik);
    $this->db->group_by('minat');
    return $this->db->get();
  }

  function upload_persyaratan()
  {
    $kode_aplikan             = $this->input->post('kodeaplikan');
    $nama_aplikan             = $this->input->post('namaaplikan');
    $jenis                    = $this->input->post('jenispersyaratan');
    $config['upload_path']    = './persyaratan/';
    $config['allowed_types']  = 'jpg|png|jpeg|pdf';
    $config['max_size']       = '2048';
    $config['overwrite']      = TRUE;
    $config['file_name']      = $kode_aplikan."_".$nama_aplikan."_".$jenis;
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  function insert_persyartanaplikan($upload)
  {
    $kode_aplikan = $this->input->post('kodeaplikan');
    $jenis        = $this->input->post('jenispersyaratan');
    $file         = $upload['file']['file_name'];

    $data = array(
      'kode_aplikan'      => $kode_aplikan,
      'kode_persyaratan'  => $jenis,
      'file'              => $file
    );

    $simpan = $this->db->insert('persyaratan_aplikan',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
            </div>
        </div>');
      redirect('marketing/inputpersyaratanaplikan');
    }

  }

  function getPersyaratanAplikan($kodeaplikan)
  {
    $this->db->select('kode_persyaratan');
    $this->db->from('persyaratan_aplikan');
    $this->db->where('kode_aplikan',$kodeaplikan);
    return $this->db->get();
  }

  function getListPersyaratanAplikan($tahun_akademik,$kode_aplikan)
  {
    $query = "SELECT kp.kode_persyaratan,nama_persyaratan,pa.file
    FROM konfigurasi_persyaratan kp
    INNER JOIN master_persyaratan mp
    ON kp.kode_persyaratan = mp.kode_persyaratan
    LEFT JOIN (SELECT kode_persyaratan,file FROM persyaratan_aplikan
    WHERE kode_aplikan = '$kode_aplikan') pa ON (kp.kode_persyaratan = pa.kode_persyaratan)
    WHERE kp.ta_mkt = '$tahun_akademik'";
    return $this->db->query($query);
  }

  function hapuspersyaratanaplikan($kodeaplikan,$kodepersyaratan)
  {
    $foto  = $this->db->get_where('persyaratan_aplikan',array('kode_aplikan'=>$kodeaplikan,'kode_persyaratan'=>$kodepersyaratan))->row_array();
    $file  = $foto['file'];
    $hapus = $this->db->delete('persyaratan_aplikan',array('kode_aplikan'=>$kodeaplikan,'kode_persyaratan'=>$kodepersyaratan));
    if($hapus)
    {
      unlink("./persyaratan/$file");
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
            <div class="card-block">
                <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
            </div>
        </div>');
      redirect('marketing/inputpersyaratanaplikan');
    }
  }

  public function getDataPersyaratanAplikan($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="",$tingkat="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('kode_registrasi,registrasi.kode_aplikan,
    (SELECT COUNT(kode_aplikan) as jmlsyarat FROM persyaratan_aplikan WHERE kode_aplikan = registrasi.kode_aplikan GROUP BY kode_aplikan) as jmlsyarat,
    nama_lengkap,registrasi.kelas,nama_jurusan,registrasi.kode_biaya,biaya.tingkat,biaya.tahun_akademik,nim,no_hp,biaya.status,status_akademik');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('biaya.tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->order_by('nama_lengkap,registrasi.kelas','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordPersyaratanAplikan($nama_aplikan="",$tahun_akademik="",$tingkat)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('biaya.tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('biaya.tingkat',$tingkat);
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function exportWaBlast($ta="",$presenter="",$minat="",$penghasilanortu="",$asalsekolah="",$ranking="",$tgllahir="")
  {
    $this->db->select('nama_lengkap,asal_sekolah,no_hp,nama_ortu,nohp_ortu,penghasilan_ortu,minat');
    $this->db->from('siswa');
    $this->db->where('tahun_akademik',$ta);
    if($presenter !="")
    {
      $this->db->where('kode_presenter',$presenter);
    }

    if($minat !="")
    {
      $this->db->where('minat',$minat);
    }

    if($penghasilanortu !="")
    {
      $this->db->where('penghasilan_ortu',$penghasilanortu);
    }

    if($asalsekolah !="")
    {
      $this->db->where('asal_sekolah',$asalsekolah);
    }

    if($ranking !="")
    {
      $this->db->where('ranking',$ranking);
    }

    if($tgllahir !="")
    {
      $this->db->where('tgl_lahir',$tgllahir);
    }

    return $this->db->get();
  }

  function getRekapDetailstatusAktivitas($kodepresenter,$status,$ta)
  {
    $query = "SELECT nama_lengkap,asal_sekolah,tgl_act,keterangan,aktivitas_presenter.status
              FROM aktivitas_presenter
              INNER JOIN siswa ON aktivitas_presenter.kode_siswa = siswa.kode_siswa
              WHERE
              tgl_act IN (
              SELECT MAX(tgl_act) FROM aktivitas_presenter
              GROUP BY kode_siswa
            ) AND siswa.tahun_akademik = '$ta' AND aktivitas_presenter.status ='$status' AND siswa.kode_presenter='$kodepresenter'";
    return $this->db->query($query);
  }

  function AplikanTidakRegis($tahun_akademik="",$presenter="")
  {
    if($presenter !=""){
      $presenter  = "AND aplikan.kode_presenter WHERE '".$presenter."'";
    }
    $query = "SELECT aplikan.kode_aplikan,nama_lengkap,nama_jurusan,kota,no_hp,whatsapp,aplikan.kode_presenter,nama_presenter,tgl_registrasi
    FROM aplikan
    INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
    INNER JOIN master_presenter ON aplikan.kode_presenter = master_presenter.kode_presenter
    LEFT JOIN (
    SELECT kode_aplikan,tgl_registrasi FROM registrasi
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    WHERE biaya.tingkat ='1' AND tahun_akademik ='$tahun_akademik'
    ) apregis ON (aplikan.kode_aplikan = apregis.kode_aplikan)
    WHERE aplikan.tahun_akademik ='$tahun_akademik' AND tgl_registrasi IS NULL".
    $presenter."";
    return $this->db->query($query);
  }

  function PotensiOmset($tahun_akademik)
  {
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->select('biaya.kode_jurusan,nama_jurusan,biaya.tingkat,SUM(harga_deal) as omset');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya=biaya.kode_biaya');
    $this->db->join('master_jurusan','biaya.kode_jurusan=master_jurusan.kode_jurusan');
    $this->db->group_by('biaya.kode_jurusan,nama_jurusan,biaya.tingkat');
    $this->db->order_by('biaya.tingkat,biaya.kode_jurusan','asc');
    return $this->db->get();
  }

  function getSiswadt() {
    $this->datatables->select('kode_siswa,nama_lengkap,no_hp,nama_ortu,nohp_ortu,asal_sekolah,kelas,tgl_lahir');
    $this->datatables->from('siswa');
    $this->datatables->add_column('view', '<a href="#"  class="btn bg-danger btn-mini  pilih">Pilih</a>', 'kode_siswa');
    return $this->datatables->generate();
  }

  public function getDataPilihSiswa($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="",$presenter="",$asalsekolah="",$minat="",$tgllahir="",$ranking="",$penghasilanortu="")
  {


    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('siswa.kode_siswa,siswa.nama_lengkap,siswa.tgl_lahir,siswa.asal_sekolah,nama_presenter,siswa.no_hp,kode_aplikan');
    $this->db->from('siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan','siswa.kode_siswa = aplikan.kode_siswa','left');
    if($nama_aplikan != ''){
    	$this->db->like('siswa.nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('siswa.tahun_akademik', $tahun_akademik);
  	}

    if($presenter != ''){
    	$this->db->where('siswa.kode_presenter', $presenter);
  	}

    if($asalsekolah != ''){
    	$this->db->where('siswa.asal_sekolah', $asalsekolah);
  	}

    if($minat != ''){
    	$this->db->where('siswa.minat', $minat);
  	}

    if($ranking != ''){
    	$this->db->where('siswa.ranking', $ranking);
  	}

    if($penghasilanortu != ''){
    	$this->db->where('siswa.penghasilan_ortu', $penghasilanortu);
  	}

    if($tgllahir != ''){
      $tgl  = explode("-",$tgllahir);
      $hari = $tgl[2];
      $bln  = $tgl[1];
    	$this->db->where('MONTH(siswa.tgl_lahir)', $bln);
      $this->db->where('DAY(siswa.tgl_lahir)',$hari);
  	}
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordPilihSiswa($nama_aplikan="",$tahun_akademik="",$presenter="",$asalsekolah="",$minat="",$tgllahir="",$ranking="",$penghasilanortu="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('siswa.kode_presenter',$kodepresenter);
    }
    $this->db->select('count(*) as allcount');
    $this->db->from('siswa');
    $this->db->join('master_presenter','siswa.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('aplikan','siswa.kode_siswa = aplikan.kode_siswa','left');
    if($nama_aplikan != ''){
    	$this->db->like('siswa.nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('siswa.tahun_akademik', $tahun_akademik);
  	}
    if($presenter != ''){
    	$this->db->where('siswa.kode_presenter', $presenter);
  	}
    if($asalsekolah != ''){
    	$this->db->where('siswa.asal_sekolah', $asalsekolah);
  	}

    if($minat != ''){
    	$this->db->where('siswa.minat', $minat);
  	}

    if($ranking != ''){
    	$this->db->where('siswa.ranking', $ranking);
  	}

    if($tgllahir != ''){
      $tgl  = explode("-",$tgllahir);
      $hari = $tgl[2];
      $bln  = $tgl[1];
    	$this->db->where('MONTH(siswa.tgl_lahir)', $bln);
      $this->db->where('DAY(siswa.tgl_lahir)',$hari);
  	}

    if($penghasilanortu != ''){
    	$this->db->where('siswa.penghasilan_ortu', $penghasilanortu);
  	}
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function DataSekolah()
  {
    $this->db->select('asal_sekolah');
    $this->db->from('siswa');
    $this->db->group_by('asal_sekolah');
    return $this->db->get();
  }

  function LapCheckeraplikan($tahun_akademik,$bulan)
  {
    $query = "SELECT kp.kode_presenter,nama_presenter,
    datang1,datang2,datang3,datang4,datang5,datang6,datang7,datang8,datang9,datang10,datang11,datang12,datang13,datang14,datang15,datang16,datang17,datang18,datang19,datang20,datang21,datang22,datang23,datang24,datang25,datang26,datang27,datang28,datang29,datang30,datang31,
    daftar1,daftar2,daftar3,daftar4,daftar5,daftar6,daftar7,daftar8,daftar9,daftar10,daftar11,daftar12,daftar13,daftar14,daftar15,daftar16,daftar17,daftar18,daftar19,daftar20,daftar21,daftar22,daftar23,daftar24,daftar25,daftar26,daftar27,daftar28,daftar29,daftar30,daftar31,
    registrasi1,registrasi2,registrasi3,registrasi4,registrasi5,registrasi6,registrasi7,registrasi8,registrasi9,registrasi10,registrasi11,registrasi12,registrasi13,registrasi14,registrasi15,registrasi16,registrasi17,registrasi18,registrasi19,registrasi20,registrasi21,registrasi22,registrasi23,registrasi24,registrasi25,registrasi26,registrasi27,registrasi28,registrasi29,registrasi30,registrasi31
    FROM konfigurasi_presenter kp
    INNER JOIN master_presenter mp ON kp.kode_presenter = mp.kode_presenter
    LEFT JOIN (
      SELECT kode_presenter,
      SUM(IF(DAY(tgl_datang)='1' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang1,
      SUM(IF(DAY(tgl_datang)='2' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang2,
      SUM(IF(DAY(tgl_datang)='3' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang3,
      SUM(IF(DAY(tgl_datang)='4' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang4,
      SUM(IF(DAY(tgl_datang)='5' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang5,
      SUM(IF(DAY(tgl_datang)='6' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang6,
      SUM(IF(DAY(tgl_datang)='7' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang7,
      SUM(IF(DAY(tgl_datang)='8' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang8,
      SUM(IF(DAY(tgl_datang)='9' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang9,
      SUM(IF(DAY(tgl_datang)='10' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang10,
      SUM(IF(DAY(tgl_datang)='11' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang11,
      SUM(IF(DAY(tgl_datang)='12' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang12,
      SUM(IF(DAY(tgl_datang)='13' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang13,
      SUM(IF(DAY(tgl_datang)='14' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang14,
      SUM(IF(DAY(tgl_datang)='15' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang15,
      SUM(IF(DAY(tgl_datang)='16' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang16,
      SUM(IF(DAY(tgl_datang)='17' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang17,
      SUM(IF(DAY(tgl_datang)='18' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang18,
      SUM(IF(DAY(tgl_datang)='19' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang19,
      SUM(IF(DAY(tgl_datang)='20' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang20,
      SUM(IF(DAY(tgl_datang)='21' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang21,
      SUM(IF(DAY(tgl_datang)='22' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang22,
      SUM(IF(DAY(tgl_datang)='23' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang23,
      SUM(IF(DAY(tgl_datang)='24' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang24,
      SUM(IF(DAY(tgl_datang)='25' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang25,
      SUM(IF(DAY(tgl_datang)='26' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang26,
      SUM(IF(DAY(tgl_datang)='27' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang27,
      SUM(IF(DAY(tgl_datang)='28' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang28,
      SUM(IF(DAY(tgl_datang)='29' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang29,
      SUM(IF(DAY(tgl_datang)='30' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang30,
      SUM(IF(DAY(tgl_datang)='31' AND MONTH(tgl_datang)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as datang31
      FROM aplikan
      GROUP BY kode_presenter
    ) apdatang ON (kp.kode_presenter = apdatang.kode_presenter)

    LEFT JOIN (
      SELECT kode_presenter,
      SUM(IF(DAY(tgl_daftar)='1' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar1,
      SUM(IF(DAY(tgl_daftar)='2' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar2,
      SUM(IF(DAY(tgl_daftar)='3' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar3,
      SUM(IF(DAY(tgl_daftar)='4' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar4,
      SUM(IF(DAY(tgl_daftar)='5' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar5,
      SUM(IF(DAY(tgl_daftar)='6' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar6,
      SUM(IF(DAY(tgl_daftar)='7' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar7,
      SUM(IF(DAY(tgl_daftar)='8' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar8,
      SUM(IF(DAY(tgl_daftar)='9' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar9,
      SUM(IF(DAY(tgl_daftar)='10' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar10,
      SUM(IF(DAY(tgl_daftar)='11' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar11,
      SUM(IF(DAY(tgl_daftar)='12' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar12,
      SUM(IF(DAY(tgl_daftar)='13' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar13,
      SUM(IF(DAY(tgl_daftar)='14' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar14,
      SUM(IF(DAY(tgl_daftar)='15' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar15,
      SUM(IF(DAY(tgl_daftar)='16' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar16,
      SUM(IF(DAY(tgl_daftar)='17' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar17,
      SUM(IF(DAY(tgl_daftar)='18' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar18,
      SUM(IF(DAY(tgl_daftar)='19' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar19,
      SUM(IF(DAY(tgl_daftar)='20' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar20,
      SUM(IF(DAY(tgl_daftar)='21' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar21,
      SUM(IF(DAY(tgl_daftar)='22' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar22,
      SUM(IF(DAY(tgl_daftar)='23' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar23,
      SUM(IF(DAY(tgl_daftar)='24' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar24,
      SUM(IF(DAY(tgl_daftar)='25' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar25,
      SUM(IF(DAY(tgl_daftar)='26' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar26,
      SUM(IF(DAY(tgl_daftar)='27' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar27,
      SUM(IF(DAY(tgl_daftar)='28' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar28,
      SUM(IF(DAY(tgl_daftar)='29' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar29,
      SUM(IF(DAY(tgl_daftar)='30' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar30,
      SUM(IF(DAY(tgl_daftar)='31' AND MONTH(tgl_daftar)='$bulan' AND tahun_akademik='$tahun_akademik',1,NULL)) as daftar31
      FROM aplikan_daftar
      INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan
      GROUP BY kode_presenter
    ) apdaftar ON (kp.kode_presenter = apdaftar.kode_presenter)

    LEFT JOIN (
      SELECT kode_presenter,
      SUM(IF(DAY(tgl_registrasi)='1' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi1,
      SUM(IF(DAY(tgl_registrasi)='2' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi2,
      SUM(IF(DAY(tgl_registrasi)='3' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi3,
      SUM(IF(DAY(tgl_registrasi)='4' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi4,
      SUM(IF(DAY(tgl_registrasi)='5' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi5,
      SUM(IF(DAY(tgl_registrasi)='6' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi6,
      SUM(IF(DAY(tgl_registrasi)='7' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi7,
      SUM(IF(DAY(tgl_registrasi)='8' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi8,
      SUM(IF(DAY(tgl_registrasi)='9' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik' AND tingkat='1',1,NULL)) as registrasi9,
      SUM(IF(DAY(tgl_registrasi)='10' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi10,
      SUM(IF(DAY(tgl_registrasi)='11' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi11,
      SUM(IF(DAY(tgl_registrasi)='12' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi12,
      SUM(IF(DAY(tgl_registrasi)='13' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi13,
      SUM(IF(DAY(tgl_registrasi)='14' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi14,
      SUM(IF(DAY(tgl_registrasi)='15' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi15,
      SUM(IF(DAY(tgl_registrasi)='16' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi16,
      SUM(IF(DAY(tgl_registrasi)='17' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi17,
      SUM(IF(DAY(tgl_registrasi)='18' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi18,
      SUM(IF(DAY(tgl_registrasi)='19' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi19,
      SUM(IF(DAY(tgl_registrasi)='20' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi20,
      SUM(IF(DAY(tgl_registrasi)='21' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi21,
      SUM(IF(DAY(tgl_registrasi)='22' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi22,
      SUM(IF(DAY(tgl_registrasi)='23' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi23,
      SUM(IF(DAY(tgl_registrasi)='24' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi24,
      SUM(IF(DAY(tgl_registrasi)='25' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi25,
      SUM(IF(DAY(tgl_registrasi)='26' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi26,
      SUM(IF(DAY(tgl_registrasi)='27' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi27,
      SUM(IF(DAY(tgl_registrasi)='28' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi28,
      SUM(IF(DAY(tgl_registrasi)='29' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi29,
      SUM(IF(DAY(tgl_registrasi)='30' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi30,
      SUM(IF(DAY(tgl_registrasi)='31' AND MONTH(tgl_registrasi)='$bulan' AND biaya.tahun_akademik='$tahun_akademik'  AND tingkat='1',1,NULL)) as registrasi31
      FROM registrasi
      INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
      INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
      GROUP BY kode_presenter
    ) apregistrasi ON (kp.kode_presenter = apregistrasi.kode_presenter)";

    return $this->db->query($query);
  }

  function LapRekapCheckeraplikan($dari,$sampai,$tahun_akademik)
  {
    $a = $dari;
    $b = $sampai;
    $presenter = $this->db->query("SELECT * FROM konfigurasi_presenter INNER JOIN master_presenter ON konfigurasi_presenter.kode_presenter = master_presenter.kode_presenter WHERE ta_mkt='$tahun_akademik'");
    foreach($presenter->result() as $p)
    {
      while (strtotime($a) <= strtotime($b)) {
        //$pre        = $p->kode_presenter;
        $datang     = $this->db->query("SELECT SUM(IF(tgl_datang <= '$a' AND kode_presenter='$p->kode_presenter' AND aplikan.tahun_akademik='$tahun_akademik',1,0)) as datang FROM aplikan")->row_array();
        $daftar     = $this->db->query("SELECT SUM(IF(tgl_daftar <= '$a' AND kode_presenter='$p->kode_presenter' AND aplikan.tahun_akademik='$tahun_akademik',1,0)) as daftar FROM aplikan_daftar
                      INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan")->row_array();
        $regis      = $this->db->query("SELECT SUM(IF(tgl_registrasi <= '$a' AND kode_presenter='$p->kode_presenter' AND aplikan.tahun_akademik='$tahun_akademik' AND biaya.tingkat='1',1,0)) as regis FROM registrasi
                      INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
                      INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya")->row_array();
        //echo $p->kode_presenter."-".$a."-".$datang['datang']."<br>";
        $apdatang[] = $datang['datang'];
        $apdaftar[] = $daftar['daftar'];
        $apregis[]  = $regis['regis'];
        $a       = date ("Y-m-d", strtotime("+1 day", strtotime($a)));//looping tambah 1 date

      }
      $a = $dari;
      $pr[] = [
        'kode_presenter' => $p->kode_presenter,
        'nama_presenter' => $p->nama_presenter,
        'datang'         => $apdatang,
        'daftar'         => $apdaftar,
        'regis'          => $apregis
      ];

      unset($apdatang);
      $apdatang = array();

      unset($apdaftar);
      $apdaftar = array();

      unset($apregis);
      $apregis = array();
    }

    //return json_encode($pr);
    return $pr;

  }


  function LapRekapCheckerjurusan($dari,$sampai,$tahun_akademik)
  {
    $a = $dari;
    $b = $sampai;
    $jurusan = $this->db->query("SELECT * FROM konfigurasi_jurusan INNER JOIN master_jurusan ON konfigurasi_jurusan.kode_jurusan = master_jurusan.kode_jurusan WHERE ta_mkt='$tahun_akademik'");
    foreach($jurusan->result() as $p)
    {
      while (strtotime($a) <= strtotime($b)) {
        //$pre        = $p->kode_presenter;
        $datang     = $this->db->query("SELECT SUM(IF(tgl_datang <= '$a' AND kode_jurusan='$p->kode_jurusan' AND aplikan.tahun_akademik='$tahun_akademik',1,0)) as datang FROM aplikan")->row_array();
        $daftar     = $this->db->query("SELECT SUM(IF(tgl_daftar <= '$a' AND kode_jurusan='$p->kode_jurusan' AND aplikan.tahun_akademik='$tahun_akademik',1,0)) as daftar FROM aplikan_daftar
                      INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan")->row_array();
        $regis      = $this->db->query("SELECT SUM(IF(tgl_registrasi <= '$a' AND aplikan.kode_jurusan='$p->kode_jurusan' AND aplikan.tahun_akademik='$tahun_akademik' AND biaya.tingkat='1',1,0)) as regis FROM registrasi
                      INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
                      INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya")->row_array();
        //echo $p->kode_presenter."-".$a."-".$datang['datang']."<br>";
        $apdatang[] = $datang['datang'];
        $apdaftar[] = $daftar['daftar'];
        $apregis[]  = $regis['regis'];
        $a       = date ("Y-m-d", strtotime("+1 day", strtotime($a)));//looping tambah 1 date

      }
      $a = $dari;
      $pr[] = [
        'kode_jurusan'   => $p->kode_jurusan,
        'nama_jurusan'   => $p->nama_jurusan,
        'datang'         => $apdatang,
        'daftar'         => $apdaftar,
        'regis'          => $apregis
      ];

      unset($apdatang);
      $apdatang = array();

      unset($apdaftar);
      $apdaftar = array();

      unset($apregis);
      $apregis = array();
    }

    //return json_encode($pr);
    return $pr;

  }

  function rekapsekolah($tahun_akademik)
  {
    $query ="SELECT aplikan.asal_sekolah,COUNT(aplikan.kode_aplikan) as apdatang ,apdaftar,apregis
    FROM aplikan
    LEFT JOIN (
    SELECT asal_sekolah,COUNT(aplikan_daftar.kode_aplikan) as apdaftar
    FROM aplikan_daftar
    INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan WHERE tahun_akademik ='$tahun_akademik' GROUP BY asal_sekolah) apdaftar ON (apdaftar.asal_sekolah = aplikan.asal_sekolah)
    LEFT JOIN (
    SELECT asal_sekolah,COUNT(registrasi.kode_aplikan) as apregis
    FROM registrasi
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan WHERE tahun_akademik ='$tahun_akademik' GROUP BY asal_sekolah) apregis ON (apregis.asal_sekolah = aplikan.asal_sekolah)
    WHERE tahun_akademik = '$tahun_akademik'
    GROUP BY asal_sekolah";
    return $this->db->query($query);
  }

  function getListApdatang($kodepresenter,$ta)
  {
    if($kodepresenter!="")
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->where('aplikan.tahun_akademik',$ta);
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    return $this->db->get('aplikan');

  }

  function getListApdaftar($kodepresenter,$ta)
  {
    if($kodepresenter!="")
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->where('aplikan.tahun_akademik',$ta);
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    return $this->db->get('aplikan_daftar');

  }

  function getListApregis($kodepresenter,$ta)
  {
    if($kodepresenter!="")
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->where('aplikan.tahun_akademik',$ta);
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    return $this->db->get('registrasi');

  }
}
