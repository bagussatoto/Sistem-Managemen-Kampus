<?php

class Pendidikan extends MY_Core
{
	function __construct()
	{
  	parent:: __construct();
		$this->load->model(array('Model_menu','Model_marketing','Model_pendidikan','Model_konfigurasi'));
		$this->load->model('user/Model','users_model');
  }
	function index()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$this->template->display('pendidikan/dashboard_master',$data);
	}

	function detailmahasiswa()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$menu3 							= "updateaplikan";
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$kode_aplikan 			= $this->uri->segment(3);
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$this->template->display('pendidikan/mahasiswa_detail',$data);
	}

	function mahasiswa($rowno=0)
	{
	
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_mhs 				= "";
		$jurusan 					= "";
		$tahun_angkatan 	= $conf['ta_pdd'];
		if(isset($_POST['submit'])){
      $nama_mhs 				= $this->input->post('nama_mhs');
			$tahun_angkatan 	= $this->input->post('tahun_angkatan');
			$jurusan 					= $this->input->post('jurusan');
			$data = array
			(
				'nama_mhs' 				=> $nama_mhs,
				'tahun_angkatan'	=> $tahun_angkatan,
				'jurusan'					=> $jurusan
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_mhs') != NULL){
        $nama_mhs = $this->session->userdata('nama_mhs');
      }

			if($this->session->userdata('tahun_angkatan') != NULL){
        $tahun_angkatan = $this->session->userdata('tahun_angkatan');
			}
			
			if($this->session->userdata('jurusan') != NULL){
        $jurusan = $this->session->userdata('jurusan');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

	
		// All records count
    $allcount 	  							= $this->Model_pendidikan->getrecordMahasiswa($nama_mhs,$tahun_angkatan,$jurusan);
    // Get records
    $users_record 							= $this->Model_pendidikan->getDataMahasiswa($rowno,$rowperpage,$nama_mhs,$tahun_angkatan,$jurusan);

	// Pagination Configuration
    $config['base_url'] 				= base_url().'pendidikan/mahasiswa/';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] 			= $allcount;
    $config['per_page'] 				= $rowperpage;

  	$config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    // Initialize
    $this->pagination->initialize($config);
    $data['pagination']			= $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['nama_mhs']				= $nama_mhs;
		$data['tahun_angkatan']	= $tahun_angkatan;
		$data['ta']							= $this->Model_pendidikan->listTahunakademik($tahun_angkatan)->result();
		$data['jurusan']				= $this->Model_konfigurasi->listJurusan($conf['ta_mkt'])->result();
		$data['jr']							= $jurusan;
		$this->template->display('pendidikan/mahasiswa_view',$data);
	}

	function dosen($rowno=0)
	{
	
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama 						= "";
		$tahun_angkatan 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama 				= $this->input->post('nama');
			$data = array
			(
				'nama' => $nama
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama') != NULL){
        $nama = $this->session->userdata('nama');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

	
		// All records count
    $allcount 	  							= $this->Model_pendidikan->getrecordDosen($nama);
    // Get records
    $users_record 							= $this->Model_pendidikan->getDataDosen($rowno,$rowperpage,$nama);

	// Pagination Configuration
    $config['base_url'] 				= base_url().'pendidikan/dosen/';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] 			= $allcount;
    $config['per_page'] 				= $rowperpage;

  	$config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    // Initialize
    $this->pagination->initialize($config);
    $data['pagination']			= $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['nama']						= $nama;
		$this->template->display('pendidikan/dosen_view',$data);
	}


	function editmhs()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['sekolah']		= $this->Model_marketing->listSekolah()->result();

		$data['bulan']			= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$menu3 							= "updateaplikan";
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();

		$kode_aplikan 			= $this->uri->segment(3);
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$aplikan 						= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$data['jurusan']		= $this->Model_konfigurasi->listJurusan($aplikan['tahun_akademik'])->result();
		$data['presenter']	= $this->Model_marketing->listPresenter($aplikan['tahun_akademik'])->result();
		$this->template->display('pendidikan/mahasiswa_edit',$data);
	}

	function update_mahasiswa()
	{
		$this->Model_pendidikan->update_mahasiswa();
	}

	function inputdosen()
	{
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['bulan']		= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$this->template->display('pendidikan/dosen_input',$data);
	}

	function insertdosen()
	{
		$this->Model_pendidikan->insertdosen();
	}

	function editdosen()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['bulan']			= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$kodedosen 					=	$this->uri->segment(3);
		$data['dosen']			= $this->Model_pendidikan->getDosen($kodedosen)->row_array();
		//print_r($data['dosen']);
		$this->template->display('pendidikan/dosen_edit',$data);
	}

	function updatedosen()
	{
		$this->Model_pendidikan->updatedosen();
	}

	function hapusdosen()
	{
		$kodedosen = $this->uri->segment(3);
		$this->Model_pendidikan->hapusdosen($kodedosen);
	}

	function kelas()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$conf 							= $this->users_model->get_conf()->row_array();
		$tapdd 							= $conf['ta_pdd'];
		$data['ta']					= $this->Model_pendidikan->listTahunakademik($tapdd)->result();
		$this->template->display('pendidikan/kelas_view',$data);
	}

	function getkelas()
	{
		$tahun_angkatan = $this->input->post('tahun_angkatan');
		$data['kelas'] = $this->Model_pendidikan->getKelas($tahun_angkatan)->result();
		$this->load->view('pendidikan/kelas_list',$data);
	}

	function inputkelas()
	{
		$data['jurusan']	= $this->Model_pendidikan->listAllJurusan()->result();
		$data['dosen']	= $this->Model_pendidikan->listAlldosen()->result();
		$data['tahun_angkatan'] = $this->input->post('tahun_angkatan');
		$this->load->view('pendidikan/kelas_input',$data);
	}

	function insertkelas()
	{
		$simpan = $this->Model_pendidikan->insertkelas();
		if($simpan=="1")
		{
			echo "1";
		}
	}

	function hapuskelas()
	{
		$kodekelas = $this->input->post('kodekelas');
		$this->Model_pendidikan->hapuskelas($kodekelas);
	}

	function editkelas()
	{
		$data['jurusan']	= $this->Model_pendidikan->listAllJurusan()->result();
		$data['dosen']	= $this->Model_pendidikan->listAlldosen()->result();
		$kodekelas = $this->input->post('kodekelas');
		$data['kelas'] = $this->Model_pendidikan->getKelasID($kodekelas)->row_array();
		$this->load->view('pendidikan/kelas_edit',$data);
	}

	function updatekelas()
	{
		$this->Model_pendidikan->updatekelas();
	}

	function matakuliah()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['jurusan']		= $this->Model_pendidikan->listAllJurusan()->result();
		$this->template->display('pendidikan/matakuliah_view',$data);
	}

	function getmatakuliah()
	{
		$jurusan = $this->input->post('jurusan');
		$semester = $this->input->post('semester');
		$data['matkul'] = $this->Model_pendidikan->getmatakuliah($jurusan,$semester)->result();
		$this->load->view('pendidikan/matakuliah_list',$data);
	}

	function inputmatakuliah()
	{
		$data['jurusan'] = $this->input->post('jurusan');
		$data['semester'] = $this->input->post('semester');
		$this->load->view('pendidikan/matakuliah_input',$data);
	}

	function insertmatakuliah()
	{
		$simpan = $this->Model_pendidikan->insertmatakuliah();
		if($simpan=="1")
		{
			echo "1";
		}
	}

	function hapusmatakuliah()
	{
		$kodematakuliah = $this->input->post('kodematkul');
		$this->Model_pendidikan->hapusmatakuliah($kodematakuliah);
	}

	function editmatkul()
	{
		$kodematakuliah = $this->input->post('kodematkul');
		$data['matkul'] = $this->Model_pendidikan->getMatakuliahID($kodematakuliah)->row_array();
		$this->load->view('pendidikan/matakuliah_edit',$data);
	}

	function updatematakuliah()
	{
		$this->Model_pendidikan->updatematakuliah();
	}

	function ruangan()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['ruangan'] 		= $this->Model_pendidikan->listRuangan()->result();
		$this->template->display('pendidikan/ruangan_view',$data);
	}

	function insertruangan(){
		$this->Model_pendidikan->insertruangan();
	}

	function hapusruangan()
	{
		$idruangan = $this->uri->segment(3);
		$this->Model_pendidikan->hapusruangan($idruangan);
	}

	function konfigurasi()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$this->template->display('pendidikan/dashboard_konfigurasi',$data);
	}

	function konfigurasikelas()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$tapdd 							= $conf['ta_pdd'];
		$data['ta']					= $this->Model_pendidikan->listTahunakademik($tapdd)->result();
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		
		$data['jurusan']		= $this->Model_pendidikan->listAllJurusan()->result();
		
		$this->template->display('pendidikan/konfigurasi_kelas',$data);
	}

	function getjurusan()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$jurusan = $this->Model_pendidikan->getjurusan($tahun_akademik)->result();
		echo "<option value=''>Pilih Jurusan</option>";
		foreach($jurusan as $j)
		{
			echo "<option value='$j->kode_jurusan'>$j->nama_jurusan</option>";
		}
	}

	function gettingkat()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$tingkat = $this->Model_pendidikan->gettingkat($tahun_akademik,$jurusan)->result();
		echo "<option value=''>Pilih Tingkat</option>";
		foreach($tingkat as $t)
		{
			echo "<option value='$t->tingkat'>$t->tingkat</option>";
		}
	}


	function getkelaslama()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$tingkat = $this->input->post('tingkat');
		$kelas = $this->Model_pendidikan->getkelaslama($tahun_akademik,$jurusan,$tingkat)->result();
		echo "<option value=''>Pilih Kelas</option>";
		foreach($kelas as $t)
		{
			echo "<option value='$t->kelas'>$t->kelas</option>";
		}
	}

	function loadkelasmhs()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$tingkat = $this->input->post('tingkat');
		$kelas = $this->input->post('kelaslama');
		$data['mhs'] = $this->Model_pendidikan->getmhskelas($tahun_akademik,$jurusan,$tingkat,$kelas)->result();
		$this->load->view('pendidikan/mahasiswa_kelas',$data);
	}

	function getkelasjurusan()
	{
		$jurusan = $this->input->post('jurusan');
		$kelas = $this->Model_pendidikan->getAllkelasjurusan($jurusan)->result();
		echo "<option value=''>Kelas Baru</option>";
		foreach($kelas as $d)
		{
			echo "<option value='$d->namakelas'>$d->namakelas</option>";
		}
	}

	function updatekelasbaru()
	{
		$this->Model_pendidikan->updatekelasbaru();
	}

	function konfigurasimatkul()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$tapdd 							= $conf['ta_pdd'];
		$data['ta']					= $this->Model_pendidikan->listTahunakademik($tapdd)->result();
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['jurusan']		= $this->Model_pendidikan->listAllJurusan()->result();
		
		$this->template->display('pendidikan/konfigurasi_matakuliah',$data);
	}

	function getsemester()
	{
		echo "
			<option value=''>Pilih Semester</option>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
		";
	}

	function loadmatkul()
	{
		$tahun_akademik= $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$semester = $this->input->post('semester');
		$data['matkul'] = $this->Model_pendidikan->getmatakuliahjurusan($tahun_akademik,$jurusan,$semester)->result();
		$this->load->view('pendidikan/matakuliah_jurusan',$data);
	}

	function insertkonfmatkul()
	{
		$this->Model_pendidikan->insertkonfmatkul();
	}

	function loadmatkulaktif()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$semester = $this->input->post('semester');
		$data['matkul'] = $this->Model_pendidikan->getmatkulaktif($tahun_akademik,$jurusan,$semester)->result();
		$this->load->view('pendidikan/matakuliah_aktif',$data);
	}

	function hapusmatkulaktif()
	{
		$this->Model_pendidikan->hapusmatkulaktif();
	}

	function konfigurasijadwal()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$tapdd 							= $conf['ta_pdd'];
		$data['ta']					= $this->Model_pendidikan->listTahunakademik($tapdd)->result();
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['jurusan']		= $this->Model_pendidikan->listAllJurusan()->result();
		
		$this->template->display('pendidikan/konfigurasi_jadwal',$data);
	}

	function inputjadwal()
	{
		$data['tahun_akademik'] = $this->input->post('tahun_akademik');
		$data['jurusan'] = $this->input->post('jurusan');
		$data['semester'] = $this->input->post('semester');
		$data['kelas'] = $this->input->post('kelas');
		$data['matkul'] = $this->Model_pendidikan->getmatkuljadwal($data['tahun_akademik'],$data['jurusan'],$data['semester'],$data['kelas'])->result();
		$data['dosen']	= $this->Model_pendidikan->listAlldosen()->result();
		$data['ruangan']	= $this->Model_pendidikan->listRuangan()->result();
		$this->load->view('pendidikan/jadwal_input',$data);
	}


	function insertjadwal()
	{
		$this->Model_pendidikan->insertjadwal();
	}

	function loadjadwal()
	{
		$tahun_akademik= $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$semester = $this->input->post('semester');
		$kelas = $this->input->post('kelas');
		$data['jadwal'] = $this->Model_pendidikan->getJadwal($tahun_akademik,$semester,$kelas)->result();
		$this->load->view('pendidikan/jadwal_kelas',$data);
	}

	function hapusjadwal()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$kodematkul = $this->input->post('kodematkul');
		$kelas = $this->input->post('kelas');
		$this->Model_pendidikan->hapusjadwal($tahun_akademik,$kodematkul,$kelas);
	}

	function listpresensi()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$tapdd 							= $conf['ta_pdd'];
		$data['ta']					= $this->Model_pendidikan->listTahunakademik($tapdd)->result();
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['jurusan']		= $this->Model_pendidikan->listAllJurusan()->result();
		
		$this->template->display('pendidikan/presensi_list',$data);
	}

	function loadpresensi()
	{
		$tahun_akademik= $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$semester = $this->input->post('semester');
		$kelas = $this->input->post('kelas');
		$data['jadwal'] = $this->Model_pendidikan->getJadwal($tahun_akademik,$semester,$kelas)->result();
		$this->load->view('pendidikan/presensi_kelas',$data);
	}


	function inputpresensi()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$kode_jadwal = $this->uri->segment(3);
		$data['jadwal']			= $this->Model_pendidikan->getJadwalkelas($kode_jadwal)->row_array();
		// echo $data['jadwal']['kode_jadwal'];
		// die;
		$data['prt'] = $this->Model_pendidikan->listPertemuan($data['jadwal']['kode_jadwal'],$data['jadwal']['sks'])->result();
		$data['presensi'] = $this->Model_pendidikan->pertemuanpresensi($data['jadwal']['kode_jadwal'])->result();
		
		// var_dump($data['prt']);
		// die;
		$this->template->display('pendidikan/presensi_input',$data);
	}

	function loadpresensimhs()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$jurusan = $this->input->post('jurusan');
		$tingkat = $this->input->post('tingkat');
		$kelas = $this->input->post('kelas');
		$data['mhs'] = $this->Model_pendidikan->getmhskelas($tahun_akademik,$jurusan,$tingkat,$kelas)->result();
		$this->load->view('pendidikan/presensi_mahasiswa',$data);
	}

	function simpanpresensi()
	{
		$this->Model_pendidikan->simpanpresensi();
	}

}
