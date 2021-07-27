<?php 

class Model_pendidikan extends CI_Model
{
  public function getDataMahasiswa($rowno,$rowperpage,$nama_mhs,$tahun_angkatan,$jurusan)
  {
    $tingkat = 1;
    $this->db->select('kode_registrasi,registrasi.kode_aplikan,tgl_registrasi,nama_lengkap,nama_presenter,registrasi.kelas,nama_jurusan,registrasi.kode_biaya,biaya.tingkat,biaya.tahun_akademik,nim,no_hp,biaya.status,status_akademik');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    if($nama_mhs != ''){
    	$this->db->like('nama_lengkap', $nama_mhs);
  	}
    if($tahun_angkatan != ''){
    	$this->db->where('biaya.tahun_akademik', $tahun_angkatan);
    }
    
    if($jurusan !="")
    {
      $this->db->where('biaya.kode_jurusan',$jurusan);
    }
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->order_by('registrasi.tgl_registrasi','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordMahasiswa($nama_mhs,$tahun_angkatan,$jurusan)
  {
    $tingkat = 1;
    $this->db->select('count(*) as allcount');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    if($nama_mhs != ''){
    	$this->db->like('nama_lengkap', $nama_mhs);
  	}
    if($tahun_angkatan != ''){
    	$this->db->where('biaya.tahun_akademik', $tahun_angkatan);
    }
    if($jurusan !="")
    {
      $this->db->where('biaya.kode_jurusan',$jurusan);
    }
    $this->db->where('biaya.tingkat',$tingkat);
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }


  

  function update_mahasiswa()
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
      
    );

    $update = $this->db->update('aplikan',$data,array('kode_aplikan'=>$kode_aplikan));
    if($update){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Updated</h6>
          </div>
        </div>');
	    redirect('pendidikan/detailmahasiswa/'.$kode_aplikan);
    }
  }

  public function getDataDosen($rowno,$rowperpage,$nama="")
  {
    $this->db->select('*');
    $this->db->from('dosen');
    if($nama !="")
    {
      $this->db->like('nama_lengkap',$nama);
    }
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordDosen($nama="")
  {
    $tingkat = 1;
    $this->db->select('count(*) as allcount');
    $this->db->from('dosen');
    if($nama !="")
    {
      $this->db->like('nama_lengkap',$nama);
    }
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function insertdosen()
  {
    $kodedosen        = $this->input->post('kodedosen');
    $nama_lengkap     = $this->input->post('namalengkap');
    $tempat_lahir     = $this->input->post('tempatlahir');
    $tgl_lahir        = $this->input->post('tahunlahir')."-".$this->input->post('bulanlahir')."-".$this->input->post('tgllahir');
    $jenis_kelamin    = $this->input->post('jk');
    $alamat           = $this->input->post('alamat');
    $no_hp            = $this->input->post('nohp');
    $email            = $this->input->post('email');
    $statusdosen      = $this->input->post('statusdosen');
    $pai              = $this->input->post('pai');
    $npwp             = $this->input->post('npwp');
    $honor            = $this->input->post('honor');
    $kewajiban        = $this->input->post('kewajiban');
    
    $data = [
      'kodedosen' => $kodedosen,
      'nama_lengkap' => $nama_lengkap,
      'alamat' => $alamat,
      'tempat_lahir' => $tempat_lahir,
      'tgl_lahir' => $tgl_lahir,
      'jenis_kelamin' => $jenis_kelamin,
      'no_telp' => $no_hp,
      'email' => $email,
      'status_dosen' => $statusdosen,
      'honor' => $honor,
      'npwp' => $npwp,
      'pai' => $pai,
      'kewajiban' => $kewajiban

    ];

    $cekdosen = $this->db->get_where('dosen',array('kodedosen'=>$kodedosen))->num_rows();
    if(empty($cekdosen))
    {
      $simpan = $this->db->insert('dosen',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
            </div>
          </div>');
        redirect('pendidikan/dosen');
      }else{
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-red order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Error</h6>
            </div>
          </div>');
        redirect('pendidikan/dosen');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-warning order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Found !</h6>
          </div>
        </div>');
      redirect('pendidikan/dosen');
    }
  }

  function getDosen($kodedosen)
  {
    return $this->db->get_where('dosen',array('kodedosen'=>$kodedosen));
  }

  function updatedosen()
  {
    $kodedosen        = $this->input->post('kodedosen');
    $nama_lengkap     = $this->input->post('namalengkap');
    $tempat_lahir     = $this->input->post('tempatlahir');
    $tgl_lahir        = $this->input->post('tahunlahir')."-".$this->input->post('bulanlahir')."-".$this->input->post('tgllahir');
    $jenis_kelamin    = $this->input->post('jk');
    $alamat           = $this->input->post('alamat');
    $no_hp            = $this->input->post('nohp');
    $email            = $this->input->post('email');
    $statusdosen      = $this->input->post('statusdosen');
    $pai              = $this->input->post('pai');
    $npwp             = $this->input->post('npwp');
    $honor            = $this->input->post('honor');
    $kewajiban        = $this->input->post('kewajiban');
    
    $data = [
      
      'nama_lengkap' => $nama_lengkap,
      'alamat' => $alamat,
      'tempat_lahir' => $tempat_lahir,
      'tgl_lahir' => $tgl_lahir,
      'jenis_kelamin' => $jenis_kelamin,
      'no_telp' => $no_hp,
      'email' => $email,
      'status_dosen' => $statusdosen,
      'honor' => $honor,
      'npwp' => $npwp,
      'pai' => $pai,
      'kewajiban' => $kewajiban

    ];

    $simpan = $this->db->update('dosen',$data,array('kodedosen'=>$kodedosen));
    if($simpan){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Updated Succesfully</h6>
          </div>
        </div>');
      redirect('pendidikan/dosen');
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-red order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Error</h6>
          </div>
        </div>');
      redirect('pendidikan/dosen');
    }

  }

  function hapusdosen($kodedosen)
  {
    $hapus = $this->db->delete('dosen',array('kodedosen'=>$kodedosen));
    if($hapus){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Deleted Succesfully</h6>
          </div>
        </div>');
      redirect('pendidikan/dosen');
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-red order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Error</h6>
          </div>
        </div>');
      redirect('pendidikan/dosen');
    }
  }

  function getKelas($tahun_angkatan){
    $this->db->select('kodekelas,namakelas,nama_lengkap,nama_jurusan');
    $this->db->from('master_kelas');
    $this->db->join('dosen','master_kelas.kode_pa = dosen.kodedosen','left');
    $this->db->join('master_jurusan','master_kelas.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('tahun_akademik',$tahun_angkatan);
    return $this->db->get();
  }

  function listAllJurusan()
  {
    return $this->db->get('master_jurusan');
  }

  function listAlldosen()
  {
    return $this->db->get('dosen');
  }

  function insertkelas()
  {
    $tahun_angkatan = $this->input->post('tahun_angkatan');
		$namakelas = $this->input->post('namakelas');
		$jurusan = $this->input->post('jurusan');
    $pa = $this->input->post('pa');
    
    $data = [
      'tahun_akademik' => $tahun_angkatan,
      'namakelas' => $namakelas,
      'kode_jurusan' => $jurusan,
      'kode_pa' => $pa
    ];

    $cek = $this->db->get_where('master_kelas',array('namakelas'=>$namakelas))->num_rows();
    if(!empty($cek)){
      return 1;
    }else{
      $simpan = $this->db->insert('master_kelas',$data);
      return 0;
    }
  }

  function hapuskelas($kodekelas)
  {
    $this->db->delete('master_kelas',array('kodekelas'=>$kodekelas));
  }

  function getKelasID($kodekelas)
  {
    return $this->db->get_where('master_kelas',array('kodekelas'=>$kodekelas));
  }

  function updatekelas()
  {
    $kodekelas = $this->input->post('kodekelas');
    $tahun_angkatan = $this->input->post('tahun_angkatan');
		$namakelas = $this->input->post('namakelas');
		$jurusan = $this->input->post('jurusan');
    $pa = $this->input->post('pa');
    
    $data = [
      'tahun_akademik' => $tahun_angkatan,
      'namakelas' => $namakelas,
      'kode_jurusan' => $jurusan,
      'kode_pa' => $pa
    ];

    $simpan = $this->db->update('master_kelas',$data,array('kodekelas'=>$kodekelas));
  }

  function getmatakuliah($jurusan,$semester)
  {
    $this->db->join('master_jurusan','master_matakuliah.kode_jurusan = master_jurusan.kode_jurusan');
    return $this->db->get_where('master_matakuliah',array('master_matakuliah.kode_jurusan'=>$jurusan,'semester'=>$semester));
  }

  function insertmatakuliah()
  {
    $kodematakuliah = $this->input->post('kodematakuliah');
    $namamatakuliah = $this->input->post('namamatakuliah');
    $jurusan = $this->input->post('jurusan');
    $semester = $this->input->post('semester');
    $data = [
      'kode_matakuliah' => $kodematakuliah,
      'matakuliah' => $namamatakuliah,
      'kode_jurusan' => $jurusan,
      'semester' => $semester
    ];

    $cek = $this->db->get_where('master_matakuliah',array('kode_matakuliah'=>$kodematakuliah))->num_rows();
    if(!empty($cek)){
      return 1;
    }else{
      $simpan = $this->db->insert('master_matakuliah',$data);
      return 0;
    }
  }

  function hapusmatakuliah($kodematakuliah)
  {
    $this->db->delete('master_matakuliah',array('kode_matakuliah'=>$kodematakuliah));
  }

  function getMatakuliahID($kodematakuliah)
  {
    return $this->db->get_where('master_matakuliah',array('kode_matakuliah'=>$kodematakuliah));
  }

  function updatematakuliah()
  {
    $kodematakuliah = $this->input->post('kodematakuliah');
    $namamatakuliah = $this->input->post('namamatakuliah');
    $jurusan = $this->input->post('jurusan');
    $semester = $this->input->post('semester');
    $data = [
      'matakuliah' => $namamatakuliah
    ];
    $simpan = $this->db->update('master_matakuliah',$data,array('kode_matakuliah'=>$kodematakuliah));
      
  }

  function listRuangan()
  {
    return $this->db->get('master_ruangan');
  }

  function insertruangan(){
    $ruangan = $this->input->post('namaruangan');
		$data = [
			'ruangan' => $ruangan
		];
		$simpanruangan = $this->db->insert('master_ruangan',$data);
		if($simpanruangan){
			$this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('pendidikan/ruangan');
		}
  }

  function hapusruangan($idruangan){
    $hapus =  $this->db->delete('master_ruangan',array('id_ruangan'=>$idruangan));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Deleted Succesfully</h6>
          </div>
        </div>');
	    redirect('pendidikan/ruangan'); 
    }
  }

  function getjurusan($tahun_akademik)
  {
    $this->db->select('biaya.kode_jurusan,nama_jurusan');
    $this->db->from('biaya');
    $this->db->join('master_jurusan','biaya.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('tahun_akademik',$tahun_akademik);
    $this->db->group_by('biaya.kode_jurusan,nama_jurusan');
    return $this->db->get();
  }

  
  function gettingkat($tahun_akademik,$jurusan)
  {
    $this->db->select('tingkat');
    $this->db->from('biaya');
    $this->db->where('tahun_akademik',$tahun_akademik);
    $this->db->where('kode_jurusan',$jurusan);
    return $this->db->get();
  }

  function getkelaslama($tahun_akademik,$jurusan,$tingkat)
  {
    $this->db->select('kelas');
    $this->db->from('registrasi');
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->where('biaya.kode_jurusan',$jurusan);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->group_by('kelas');
    return $this->db->get();
  }

  function getmhskelas($tahun_akademik,$jurusan,$tingkat,$kelaslama)
  {
    $this->db->select('registrasi.kode_registrasi,registrasi.kode_aplikan,nim,nama_lengkap,no_hp,registrasi.kelas,status_akademik,foto_mhs');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->where('biaya.kode_jurusan',$jurusan);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->where('registrasi.kelas',$kelaslama);
    $this->db->order_by('nama_lengkap','asc');
    return $this->db->get();
  }

  function getAllkelasjurusan($jurusan)
  {
    return $this->db->get_where('master_kelas',array('kode_jurusan'=>$jurusan));
  }

  function updatekelasbaru()
  {
    $koderegis = $this->input->post('koderegis');
    $kelasbaru = $this->input->post('kelasbaru');
    $data = [
      'kelas' => $kelasbaru
    ];

    $this->db->update('registrasi',$data,array('kode_registrasi'=>$koderegis));
  }

  function getmatakuliahjurusan($tahun_akademik,$jurusan,$semester)
  {

    return $this->db->query("SELECT
    kode_matakuliah,
    matakuliah,
    semester 
  FROM
    master_matakuliah 
  WHERE
    kode_matakuliah NOT IN(SELECT kode_matakuliah FROM konfigurasi_matakuliah WHERE tahun_akademik='$tahun_akademik') AND kode_jurusan='$jurusan' AND semester='$semester'");
  }

  function insertkonfmatkul()
  {
    $kodematkul = $this->input->post('kodematkul');
    $tahun_akademik = $this->input->post('tahun_akademik');
    $data = [
      'kode_matakuliah' => $kodematkul,
      'tahun_akademik' => $tahun_akademik
    ];

    $this->db->insert('konfigurasi_matakuliah',$data);
  }

  function getmatkulaktif($tahun_akademik,$jurusan,$semester)
  {
    $this->db->select('konfigurasi_matakuliah.kode_matakuliah,matakuliah,semester,tahun_akademik');
    $this->db->from('konfigurasi_matakuliah');
    $this->db->join('master_matakuliah','konfigurasi_matakuliah.kode_matakuliah = master_matakuliah.kode_matakuliah');
    $this->db->where('tahun_akademik',$tahun_akademik);
    $this->db->where('kode_jurusan',$jurusan);
    $this->db->where('semester',$semester);
    return $this->db->get();
  }

  function hapusmatkulaktif()
  {
    $kodematkul = $this->input->post('kodematkul');
    $tahun_akademik = $this->input->post('tahun_akademik');
    $this->db->delete('konfigurasi_matakuliah',array('kode_matakuliah'=>$kodematkul,'tahun_akademik'=>$tahun_akademik));
  }

  function listTahunakademik($tahun_akademik=""){
    $tapdd = substr($tahun_akademik,0,4);
    $this->db->where('LEFT(ta_mkt,4) <=',$tapdd);
    $this->db->select('ta_mkt as tahun_akademik');
    $this->db->from('konfigurasi_presenter');
    $this->db->distinct('ta_mkt');
    return $this->db->get();
  }


  function getmatkuljadwal($tahun_akademik,$jurusan,$semester,$kelas)
  {
    $query = "SELECT konfigurasi_matakuliah.kode_matakuliah,matakuliah
    FROM konfigurasi_matakuliah
    INNER JOIN master_matakuliah ON konfigurasi_matakuliah.kode_matakuliah = master_matakuliah.kode_matakuliah
    WHERE konfigurasi_matakuliah.kode_matakuliah NOT IN(SELECT kode_matakuliah FROM konfigurasi_jadwal WHERE tahun_akademik ='$tahun_akademik' AND kelas='$kelas') AND 
     tahun_akademik ='$tahun_akademik' AND kode_jurusan ='$jurusan' AND semester ='$semester' 
    ";

    return $this->db->query($query);
  }

 function insertjadwal()
 {
   $tahun_akademik = $this->input->post('tahun_akademik');
   $jurusan = $this->input->post('jurusan');
   $semester = $this->input->post('semester');
   $kelas = $this->input->post('kelas');
   $matakuliah = $this->input->post('matakuliah');
   $sks = $this->input->post('sks');
   $hari = $this->input->post('hari');
   $waktu = $this->input->post('waktu');
   $dosen = $this->input->post('dosen');
   $ruangan = $this->input->post('ruangan');

   $jadwal = $this->db->query("SELECT kode_jadwal FROM konfigurasi_jadwal 
   INNER JOIN master_matakuliah ON konfigurasi_jadwal.kode_matakuliah = master_matakuliah.kode_matakuliah
   WHERE tahun_akademik ='$tahun_akademik' AND semester='$semester' ORDER BY kode_jadwal DESC LIMIT 1")->row_array();
   $kodeterakhir = $jadwal['kode_jadwal'];
   $ta = substr($tahun_akademik,2,2);
   $kode_jadwal = buatkode($kodeterakhir,$ta.$semester,3);
   

   $data = [
    'kode_jadwal' => $kode_jadwal,
    'kode_matakuliah' => $matakuliah,
    'sks' => $sks,
    'tahun_akademik' => $tahun_akademik,
    'kelas' => $kelas,
    'hari' => $hari,
    'waktu' => $waktu,
    'kode_dosen' => $dosen,
    'ruangan' => $ruangan
   ];

   $this->db->insert('konfigurasi_jadwal',$data);
 }

 function getJadwal($tahun_akademik,$semester,$kelas)
 {
   $this->db->select('kode_jadwal,konfigurasi_jadwal.kode_matakuliah,matakuliah,sks,hari,waktu,konfigurasi_jadwal.kode_dosen,nama_lengkap,ruangan,tahun_akademik');
   $this->db->from('konfigurasi_jadwal');
   $this->db->join('master_matakuliah','konfigurasi_jadwal.kode_matakuliah = master_matakuliah.kode_matakuliah');
   $this->db->join('dosen','konfigurasi_jadwal.kode_dosen = dosen.kodedosen');
   $this->db->where('semester',$semester);
   $this->db->where('kelas',$kelas);
   $this->db->where('tahun_akademik',$tahun_akademik);
   return $this->db->get();
 }

 function hapusjadwal($tahun_akademik,$kodematkul,$kelas)
 {
   $this->db->delete('konfigurasi_jadwal',array('tahun_akademik'=>$tahun_akademik,'kode_matakuliah'=>$kodematkul,'kelas'=>$kelas));
 }

 function getJadwalkelas($kode_jadwal)
 {
  $this->db->select('kode_jadwal,konfigurasi_jadwal.kode_matakuliah,matakuliah,master_matakuliah.kode_jurusan,nama_jurusan,sks,hari,waktu,konfigurasi_jadwal.kode_dosen,nama_lengkap,ruangan,tahun_akademik,kelas,semester');
  $this->db->from('konfigurasi_jadwal');
  $this->db->join('master_matakuliah','konfigurasi_jadwal.kode_matakuliah = master_matakuliah.kode_matakuliah');
  $this->db->join('dosen','konfigurasi_jadwal.kode_dosen = dosen.kodedosen');
  $this->db->join('master_jurusan','master_matakuliah.kode_jurusan = master_jurusan.kode_jurusan');
  $this->db->where('kode_jadwal',$kode_jadwal);
  return $this->db->get();
 }

 function simpanpresensi()
 {
   $tahun_akademik = $this->input->post('tahun_akademik');
   $semester = $this->input->post('semester');
   $qpresensi = "SELECT kode_presensi FROM presensi 
   INNER JOIN konfigurasi_jadwal ON presensi.kode_jadwal = konfigurasi_jadwal.kode_jadwal
   INNER JOIN master_matakuliah ON konfigurasi_jadwal.kode_matakuliah = master_matakuliah.kode_matakuliah
   WHERE konfigurasi_jadwal.tahun_akademik = '$tahun_akademik' AND semester ='$semester' ORDER BY kode_presensi DESC LIMIT 1
   ";
   $presensi = $this->db->query($qpresensi)->row_array();
   $lastkode = $presensi['kode_presensi'];
  //  var_dump($presensi);
  //  die;
   $ta = substr($tahun_akademik,2,2);
   $kode_presensi = buatkode($lastkode,"PR".$ta.$semester,4);
   $kodejadwal = $this->input->post('kodejadwal');
   $tglpresensi = $this->input->post('tglpresensi');
   $pertemuan = $this->input->post('pertemuan');
   $penginput = $this->access->get_username();
   $jumlahmhs = $this->input->post('jumlahmhs');
  //  echo $jumlahmhs;
  //  die;
   $data = [
     'kode_presensi' => $kode_presensi,
     'kode_jadwal' => $kodejadwal,
     'tgl_presensi' => $tglpresensi,
     'pertemuan' => $pertemuan,
     'penginput' => $penginput
   ];
   $cekpresensi = $this->db->get_where('presensi',array('pertemuan'=>$pertemuan,'kode_jadwal'=>$kodejadwal))->num_rows();
   if($cekpresensi > 0){
      $this->session->set_flashdata('msg',
      '<div class="card bg-c-pink order-card">
        <div class="card-block">
          <h6><i class="ti-check"></i> Data Presensi Untuk Pertemuan ke '.$pertemuan.' Sudah Ada !</h6>
        </div>
      </div>');
      redirect('pendidikan/inputpresensi/'.$kodejadwal); 
   }else{
    $simpanpresensi = $this->db->insert('presensi',$data);
    if($simpanpresensi){
      for($i=1; $i<=$jumlahmhs; $i++)
      {
        $kodeaplikan = $this->input->post('kodeaplikan'.$i);
        $keterangan = $this->input->post('ket'.$i);
        $datapresensi = [
          'kode_presensi' => $kode_presensi,
          'kode_aplikan' => $kodeaplikan,
          'keterangan' => $keterangan
        ];

        $simpandetailpresensi = $this->db->insert('presensi_detail',$datapresensi);
      }
        $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Deleted Succesfully</h6>
          </div>
        </div>');
      redirect('pendidikan/inputpresensi/'.$kodejadwal);      
    }
  } 
  }

  function listPertemuan($kodejadwal,$sks)
  {
    if($sks==2)
    {
      $limit = "AND pertemuan <='14'";
    }else{
      $limit = "";
    }
    $query = "SELECT pertemuan FROM presensi_pertemuan WHERE pertemuan NOT IN (SELECT pertemuan FROM presensi WHERE kode_jadwal='$kodejadwal') $limit";
    return $this->db->query($query);
  }

  function pertemuanpresensi($kodejadwal)
  {
    $this->db->order_by('pertemuan','ASC');
    $this->db->join('sys_users','presensi.penginput = sys_users.username');
    return $this->db->get_where('presensi',array('kode_jadwal'=>$kodejadwal));
  }
}




