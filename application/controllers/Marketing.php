<?php

class Marketing extends MY_Core{
	private $filename = "import_data"; // Kita tentukan nama filenya
	public function __construct() {
    parent:: __construct();
    $this->load->model('Model_menu');
		$this->load->model('Model_marketing');
		$this->load->model('Model_konfigurasi');
		$this->load->model('Model_keuangan');
		$this->load->model('user/Model','users_model');

  }

	function importdata()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		// Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel 	 = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet 			 = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = array();
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        array_push($data, array(
					'kode_siswa'          => $row['A'],
					'nama_lengkap'        => $row['B'],
					'tempat_lahir'   		  => $row['C'],
					'tgl_lahir'      			=> $row['D'],
					'jenis_kelamin'       => $row['E'],
					'dusun'         			=> $row['F'],
					'rtrw'          			=> $row['G'],
					'kelurahan'     			=> $row['H'],
					'kecamatan'     			=> $row['I'],
					'kota'          			=> $row['J'],
					'kode_pos'       			=> $row['K'],
					'no_hp'         			=> $row['L'],
					'whatsapp'      			=> $row['M'],
					'facebook'      			=> $row['N'],
					'instagram'     			=> $row['O'],
					'pendidikan_terakhir' => $row['P'],
					'asal_sekolah'   			=> $row['Q'],
					'tahun_lulus'    			=> $row['S'],
					'jurusan_sekolah'     => $row['R'],
					'email'         			=> $row['T'],
					'nama_ortu'      			=> $row['U'],
					'pekerjaan_ortu'     	=> $row['V'],
					'penghasilan_ortu'   	=> $row['W'],
					'nohp_ortu'      			=> $row['X'],
					'kode_presenter'     	=> $row['Y'],
					'folder'        			=> $row['Z'],
					'tahun_akademik'			=> $tahun_akademik
        ));
      }
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->Model_marketing->insert_multiple($data);

      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Imported</h6>
          </div>
        </div>');
	    redirect('marketing/dbsiswa');

	}

	function index()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$ta 							= $conf['ta_mkt'];
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$menu1 						= "presenter";
		$menu2 						= "persyaratan";
		$data['pr']			  = $this->Model_menu->get_menu($menu1)->result();
		$data['ps']			  = $this->Model_menu->get_menu($menu2)->result();
		$data['presenter']= $this->Model_marketing->getPresenter($ta)->num_rows();
		$data['jmlsyarat']= $this->Model_marketing->getPersyaratan($ta)->num_rows();
		$this->template->display('marketing/dashboard_master',$data);
	}

	function masterpresenter()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "presenter";
		$menu2 							= "persyaratan";
		$data['pr']			  	= $this->Model_menu->get_menu($menu1)->result();
		$data['ps']			  	= $this->Model_menu->get_menu($menu2)->result();
		$data['presenter']	= $this->Model_marketing->listMasterpresenter()->result();
		$this->template->display('marketing/masterpresenter',$data);
	}

	function inputmasterpresenter()
	{
		$this->Model_marketing->inputmasterpresenter();
	}

	function hapusmasterpresenter(){
		$kodepresenter = $this->uri->segment(3);
		$this->Model_marketing->hapusmasterpresenter($kodepresenter);
	}

	function editmasterpresenter()
	{
		$kodepresenter 			=	 $this->input->post('kodepresenter');
		$data['presenter']	=  $this->Model_marketing->getmasterPresenter($kodepresenter)->row_array();
		$this->load->view('marketing/editmasterpresenter',$data);
	}

	function updatemasterpresenter()
	{
		$this->Model_marketing->updatemasterpresenter();
	}

	function presenter()
	{

		$conf 										= $this->users_model->get_conf()->row_array();
		$data['ta'] 							= $conf['ta_mkt'];
		$data['username'] 				= $this->access->get_username();
		$data['fullname'] 				= $this->access->get_fullname();
		$data['level']	  				= $this->access->get_level();
		$data['presenter']				= $this->Model_marketing->listMasterpresenter()->result();
		$data['presenteraktif']		= $this->Model_marketing->listPresenter($conf['ta_mkt'])->result();
		$menu1 										= "presenter";
		$menu2 										= "persyaratan";
		$data['pr']			  				= $this->Model_menu->get_menu($menu1)->result();
		$data['ps']			  				= $this->Model_menu->get_menu($menu2)->result();
		$this->template->display('marketing/presenter', $data);
	}

	function inputpresenter()
	{
		$this->Model_marketing->inputpresenter();
	}

	function hapuspresenter(){
		$id = $this->uri->segment(3);
		$this->Model_marketing->hapuspresenter($id);
	}

	function masterpersyaratan()
	{
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "presenter";
		$menu2 							= "persyaratan";
		$data['pr']			  	= $this->Model_menu->get_menu($menu1)->result();
		$data['ps']			  	= $this->Model_menu->get_menu($menu2)->result();
		$data['syarat']			= $this->Model_marketing->listMasterPersyaratan()->result();
		$this->template->display('marketing/masterpersyaratan',$data);
	}

	function inputmasterpersyaratan()
	{
		$this->Model_marketing->inputmasterpersyaratan();
	}

	function hapusmasterpersyaratan(){
		$kodepersyaratan = $this->uri->segment(3);
		$this->Model_marketing->hapusmasterpersyaratan($kodepersyaratan);
	}

	function persyaratan()
	{

		$conf 										= $this->users_model->get_conf()->row_array();
		$data['ta'] 							= $conf['ta_mkt'];
		$data['username'] 				= $this->access->get_username();
		$data['fullname'] 				= $this->access->get_fullname();
		$data['level']	  				= $this->access->get_level();
		$data['syarat']						= $this->Model_marketing->listMasterPersyaratan()->result();
		$data['syarat_aktif']			= $this->Model_marketing->listPersyaratan($conf['ta_mkt'],$kode="")->result();
		$menu1 										= "presenter";
		$menu2 										= "persyaratan";
		$data['pr']			  				= $this->Model_menu->get_menu($menu1)->result();
		$data['ps']			  				= $this->Model_menu->get_menu($menu2)->result();
		$this->template->display('marketing/persyaratan', $data);
	}

	function inputpersyaratan()
	{
		$this->Model_marketing->inputpersyaratan();
	}

	function hapuspersyaratan(){
		$id = $this->uri->segment(3);
		$this->Model_marketing->hapuspersyaratan($id);
	}

	function aplikan()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$ta 							=	$conf['ta_mkt'];
		$data['ta']       = $ta;
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$menu1 						= "aplikan";
		$menu2 						= "siswa";
		$menu3 						= "updateaplikan";
		$data['mn1']			= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']			= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']			= $this->Model_menu->get_menu($menu3)->result();
		$data['apdatang'] = $this->Model_marketing->getStatAp($ta)->num_rows();
		$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($ta)->num_rows();
		$data['apregis']	= $this->Model_marketing->getStatApRegis($ta)->num_rows();
		$data['rasiopresenter'] = $this->Model_marketing->getRasiopresenter($ta)->result();
		$data['minat']		= $this->Model_marketing->getMinat($ta)->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/dashboard_aplikan',$data);
		}else{
			$this->template->display('marketing/dashboard_aplikan',$data);
		}

	}

	function aplikandatang($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordAplikan($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataAplikan($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/aplikandatang';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$menu3 									= "updateaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;

		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();


		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aplikandatang',$data);
		}else{
			$this->template->display('marketing/view_aplikandatang',$data);
		}
	}

	function inputaplikan()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$data['ta'] 			= $conf['ta_mkt'];
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$menu1 						= "aplikan";
		$menu2 						= "siswa";
		$data['sekolah']	= $this->Model_marketing->listSekolah()->result();
		$data['bulan']		= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['jurusan']	= $this->Model_konfigurasi->listJurusan($conf['ta_mkt'])->result();
		$data['presenter']= $this->Model_marketing->listPresenter($conf['ta_mkt'])->result();
		$data['mn1']			= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']			= $this->Model_menu->get_menu($menu2)->result();
		$menu3 						= "updateaplikan";
		$data['mn3']			= $this->Model_menu->get_menu($menu3)->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/input_aplikan',$data);
		}else{
			$this->template->display('marketing/input_aplikan',$data);
		}

	}

	function insert_aplikan()
	{
		$this->Model_marketing->insert_aplikan();
	}


	function dbsekolah(){
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$menu3 							= "updateaplikan";
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['sekolah']		= $this->Model_marketing->listSekolah()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/siswa_dbsekolah',$data);
		}else{
			$this->template->display('marketing/siswa_dbsekolah',$data);
		}

	}

	function insert_dbsekolah()
	{
		$this->Model_marketing->insert_dbsekolah();
	}

	function editdbsekolah()
	{
		$id 								=	 $this->input->post('id');
		$data['sekolah']		=  $this->Model_marketing->getdbSekolah($id)->row_array();
		$this->load->view('marketing/editdbsekolah',$data);
	}

	function update_dbsekolah()
	{
		$this->Model_marketing->update_dbsekolah();
	}

	function detailaplikan()
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
		$this->template->display('marketing/detail_aplikan',$data);
	}

	function editaplikan()
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
		$this->template->display('marketing/edit_aplikan',$data);
	}

	function update_aplikan()
	{
		$this->Model_marketing->update_aplikan();
	}

	function updatedaftar($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordUpdatedaftar($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataUpdatedaftar($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/updatedaftar';
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
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/update_aplikandaftar',$data);
		}else{
			$this->template->display('marketing/update_aplikandaftar',$data);
		}

	}

	function inputaplikandaftar()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['biayadaftar']= $conf['biaya_pendaftaran'];
		$kode_aplikan 			= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$aplikan 						= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$daftar_nu          = "SELECT nomor_ujian FROM aplikan_daftar
													 INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan
													 WHERE tahun_akademik ='$aplikan[tahun_akademik]' ORDER BY nomor_ujian DESC LIMIT 1 ";
    $ceknolast_nu       = $this->db->query($daftar_nu)->row_array();
    $nomor_ujianlast    = $ceknolast_nu['nomor_ujian'];

		$daftar_nb          = "SELECT nomor_bukti FROM aplikan_daftar
													 INNER JOIN aplikan ON aplikan_daftar.kode_aplikan = aplikan.kode_aplikan
													 WHERE tahun_akademik ='$aplikan[tahun_akademik]' ORDER BY nomor_bukti DESC LIMIT 1 ";
    $ceknolast_nb       = $this->db->query($daftar_nb)->row_array();
    $nomor_buktilast    = $ceknolast_nb['nomor_bukti'];

		$ta_aktif         	= substr($aplikan['tahun_akademik'],2,2);
    $data['nomor_ujian']= buatkode($nomor_ujianlast,$ta_aktif.$aplikan['kode_jurusan'],4);
		$data['nomor_bukti']= buatkode($nomor_buktilast,"D-".$ta_aktif,4);
	  $data['bulan']			= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/input_aplikandaftar',$data);
		}else{
			$this->template->display('marketing/input_aplikandaftar',$data);
		}

	}

	function insert_aplikandaftar()
	{
		$this->Model_marketing->insert_aplikandaftar();
	}

	function aplikandaftar($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordAplikandaftar($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataAplikandaftar($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/aplikandaftar';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aplikandaftar',$data);
		}else{
			$this->template->display('marketing/view_aplikandaftar',$data);
		}

	}

	function editaplikandaftar()
	{

		$kode_aplikan 			= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikandaftar($kode_aplikan)->row_array();
		$data['bulan']			= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$this->template->display('marketing/edit_aplikandaftar',$data);
	}

	function update_aplikandaftar()
	{
		$this->Model_marketing->update_aplikandaftar();
	}

	function update_aplikanujian()
	{
		$this->Model_marketing->update_aplikanujian();
	}

	function hapusaplikandaftar(){
		$kode_aplikan = $this->uri->segment(3);
		$this->Model_marketing->hapusaplikandaftar($kode_aplikan);
	}

	function updateujian($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordUpdateujian($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataUpdateujian($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/updateujian';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/update_aplikanujian',$data);
		}else{
			$this->template->display('marketing/update_aplikanujian',$data);
		}

	}

	function inputaplikanujian()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['biayadaftar']= $conf['biaya_pendaftaran'];
		$kode_aplikan 			= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/input_aplikanujian',$data);
		}else{
			$this->template->display('marketing/input_aplikanujian',$data);
		}

	}

	function insert_aplikanujian()
	{
		$this->Model_marketing->insert_aplikanujian();
	}

	function aplikanujian($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordAplikanujian($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataAplikanujian($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/aplikanujian';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aplikanujian',$data);
		}else{
			$this->template->display('marketing/view_aplikanujian',$data);
		}


	}


	function editaplikanujian()
	{

		$kode_aplikan 			= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$this->template->display('marketing/edit_aplikanujian',$data);
	}

	function hapusaplikanujian(){
		$kode_aplikan = $this->uri->segment(3);
		$this->Model_marketing->hapusaplikanujian($kode_aplikan);
	}

	function updatewawancara($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordUpdatewawancara($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataUpdatewawancara($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/updatewawancara';
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
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/update_aplikanwawancara',$data);
		}else{
			$this->template->display('marketing/update_aplikanwawancara',$data);
		}

	}

	function inputaplikanwawancara()
	{

		$kode_aplikan 			= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/input_aplikanwawancara',$data);
		}else{
			$this->template->display('marketing/input_aplikanwawancara',$data);
		}

	}

	function insert_aplikanwawancara()
	{
		$this->Model_marketing->insert_aplikanwawancara();
	}

	function aplikanwawancara($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordAplikanwawancara($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataAplikanwawancara($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/aplikanwawancara';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();

		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aplikanwawancara',$data);
		}else{
			$this->template->display('marketing/view_aplikanwawancara',$data);
		}
	}

	function editaplikanwawancara()
	{

		$kode_aplikan 			= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$this->template->display('marketing/edit_aplikanwawancara',$data);
	}

	function update_aplikanwawancara()
	{
		$this->Model_marketing->update_aplikanwawancara();
	}

	function hapusaplikanwawancara(){
		$kode_aplikan = $this->uri->segment(3);
		$this->Model_marketing->hapusaplikanwawancara($kode_aplikan);
	}

	function importsiswa(){
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			$upload = $this->Model_marketing->upload_file($this->filename);
			if($upload['result'] == "success"){ // Jika proses upload sukses
	      // Load plugin PHPExcel nya
	      include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	      $excelreader 	= new PHPExcel_Reader_Excel2007();
	      $loadexcel 	 	= $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
	      $sheet 			 	= $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	      // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
	      // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
	      $data['sheet'] = $sheet;
	    }else{ // Jika proses upload gagal
	      $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
	    }
		}
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$menu3 							= "updateaplikan";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/siswa_import',$data);
		}else{
			$this->template->display('marketing/siswa_import',$data);
		}

	}


	function dbsiswa($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }
		//start riju
		// All records count per Folder 
    $foldercount 	  						= $this->Model_marketing->getrecordSiswaFolder($nama_aplikan,$tahun_akademik);
		//end riju
		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordSiswa($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_marketing->getDataSiswa($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/dbsiswa';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		//start riju
		//$data['totaldatafolder']			= $foldercount;
		//end riju
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_dbsiswa',$data);
		}else{
			$this->template->display('marketing/view_dbsiswa',$data);
		}

	}

	function detailsiswa()
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
		$kode_siswa 				= $this->uri->segment(3);
		$data['aplikan']		= $this->Model_marketing->getSiswa($kode_siswa)->row_array();
		$this->template->display('marketing/detail_siswa',$data);
	}

	function detailmodalsiswa()
	{

		$kode_siswa 				= $this->input->post('kodesiswa');
		$data['siswa']			= $this->Model_marketing->getSiswa($kode_siswa)->row_array();
		$this->load->view('marketing/detail_modalsiswa',$data);
	}

	function editsiswa()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['sekolah']		= $this->Model_marketing->listSekolah()->result();
		$data['jurusan']		= $this->Model_konfigurasi->listJurusan($conf['ta_mkt'])->result();
		$data['bulan']			= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$menu3 							= "updateaplikan";
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();

		$kode_siswa 				= $this->uri->segment(3);
		$data['aplikan']		= $this->Model_marketing->getSiswa($kode_siswa)->row_array();
		$aplikan 						= $this->Model_marketing->getSiswa($kode_siswa)->row_array();
		$data['presenter']	= $this->Model_marketing->listPresenter($aplikan['tahun_akademik'])->result();
		$this->template->display('marketing/edit_siswa',$data);
	}

	function inputsiswa()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['sekolah']		= $this->Model_marketing->listSekolah()->result();
		$data['jurusan']		= $this->Model_konfigurasi->listJurusan($conf['ta_mkt'])->result();
		$data['bulan']			= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$menu1 							= "aplikan";
		$menu2 							= "siswa";
		$data['mn1']				= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']				= $this->Model_menu->get_menu($menu2)->result();
		$menu3 							= "updateaplikan";
		$data['mn3']				= $this->Model_menu->get_menu($menu3)->result();
		$data['presenter']	= $this->Model_marketing->listPresenter($tahun_akademik)->result();
		$data['ta']					= $tahun_akademik;
		$this->template->display('marketing/input_siswa',$data);
	}


	function update_siswa()
	{
		$this->Model_marketing->update_siswa();
	}

	function insert_siswa()
	{
		$this->Model_marketing->insert_siswa();
	}

	function hapussiswa(){
		$kode_siswa = $this->uri->segment(3);
		$this->Model_marketing->hapussiswa($kode_siswa);
	}

	function jadikanaplikan()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
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

		$kode_siswa 				= $this->uri->segment(3);
		$data['aplikan']		= $this->Model_marketing->getSiswa($kode_siswa)->row_array();
		$aplikan 						= $this->Model_marketing->getSiswa($kode_siswa)->row_array();
		$data['jurusan']		= $this->Model_konfigurasi->listJurusan($aplikan['tahun_akademik'])->result();
		$data['presenter']	= $this->Model_marketing->listPresenter($aplikan['tahun_akademik'])->result();
		$this->template->display('marketing/siswa_to_aplikan',$data);
	}

	function laporan()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$ta 							=	$conf['ta_mkt'];
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$menu1 						= "laporanaplikan";
		$menu2 						= "";
		$menu3 						= "rekapaplikan";
		$data['mn1']			= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']			= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']			= $this->Model_menu->get_menu($menu3)->result();
		$data['apdatang'] = $this->Model_marketing->getStatAp($ta)->num_rows();
		$data['apregis']	= $this->Model_marketing->getStatApRegis($ta)->num_rows();
		$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($ta)->num_rows();
		$data['rasiopresenter'] = $this->Model_marketing->getRasiopresenter($ta)->result();
		$data['rasiomedia'] 		= $this->Model_marketing->getRasiomedia($ta)->result();
		$data['allcount'] 	  	= $this->Model_marketing->getrecordAplikan($nama_aplikan="",$ta);
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/dashboard_laporan',$data);
		}else{
			$this->template->display('marketing/dashboard_laporan',$data);
		}

	}

	function laporanaplikangel()
	{
		// $conf 						= $this->users_model->get_conf()->row_array();
		// $dari 						= "";
		// $sampai 					= "";
		// $tahun_akademik 	= $conf['ta_mkt'];
		// if(isset($_POST['submit'])){
    //   $dari 						= $this->input->post('dari');
		// 	$sampai 					= $this->input->post('sampai');
		// 	$tahun_akademik 	= $this->input->post('tahun_akademik');
		// 	$data = array
		// 	(
		// 		'dari' 						=> $dari,
		// 		'sampai'					=> $sampai,
		// 		'tahun_akademik'	=> $tahun_akademik
		// 	);
    //   $this->session->set_userdata($data);
    // }else{
    //   if($this->session->userdata('dari') != NULL){
    //     $dari = $this->session->userdata('dari');
    //   }
		//
		// 	if($this->session->userdata('sampai') != NULL){
    //     $sampai = $this->session->userdata('sampai');
    //   }
		//
		// 	if($this->session->userdata('tahun_akademik') != NULL){
    //     $tahun_akademik = $this->session->userdata('tahun_akademik');
    //   }
    // }
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['tahun_akademik']	= $ta;
		// $data['dari']						= $dari;
		// $data['sampai']					= $sampai;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_lapaplikangel',$data);
		}else{
			$this->template->display('marketing/frm_lapaplikangel',$data);
		}

	}

	function cetak_lapaplikangel()
	{
		$data['conf'] 	= $this->users_model->get_conf()->row_array();
		$tahun_akademik = $this->input->post('tahun_akademik');
		if(isset($_POST['submit'])){
			$dari 				= $this->input->post('dari');
			$sampai 			= $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/laporanaplikangel');
			}
		}else{
			$dari 						= "";
			$sampai 					= "";
		}
		$data['dari'] 	= $dari;
		$data['sampai']	= $sampai;
		$data['ta']			= $tahun_akademik;
		$data['apgel']	= $this->Model_marketing->lapApgel($tahun_akademik,$dari,$sampai)->result();
		$this->load->view('marketing/cetak_lapaplikangel',$data);
	}

	function laporanrasiopresenter()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_laprasiopresenter',$data);
		}else{
			$this->template->display('marketing/frm_laprasiopresenter',$data);
		}

	}


	function cetak_laprasiopresenter()
	{
		$data['conf'] 	= $this->users_model->get_conf()->row_array();
		$tahun_akademik = $this->input->post('tahun_akademik');
		if(isset($_POST['submit'])){
			$dari 				= $this->input->post('dari');
			$sampai 			= $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/lapRasiopresenter');
			}
		}else{
			$dari 						= "";
			$sampai 					= "";
		}
		$data['dari'] 	= $dari;
		$data['sampai']	= $sampai;
		$data['ta']			= $tahun_akademik;
		$data['apgel']	= $this->Model_marketing->lapRasiopresenter($tahun_akademik,$dari,$sampai)->result();
		$this->load->view('marketing/cetak_laprasiopresenter',$data);
	}

	function laporanrasiomedia()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_laprasiomedia',$data);
		}else{
			$this->template->display('marketing/frm_laprasiomedia',$data);
		}

	}

	function cetak_laprasiomedia()
	{
		$data['conf'] 		= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $this->input->post('tahun_akademik');

		if(isset($_POST['submit'])){
			$dari 				= $this->input->post('dari');
			$sampai 			= $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/laprasiomedia');
			}
		}else{
			$dari 						= "";
			$sampai 					= "";
		}
		$data['dari'] 		= $dari;
		$data['sampai']		= $sampai;
		$data['ta']				= $tahun_akademik;
		$data['allcount'] = $this->Model_marketing->getrecordAplikan2($tahun_akademik,$dari,$sampai);
		$data['allcount2']= $this->Model_marketing->getrecordAplikanregis2($tahun_akademik,$dari,$sampai);
		$data['apgel']		= $this->Model_marketing->lapRasiomedia($tahun_akademik,$dari,$sampai)->result();
		$data['apreg']		= $this->Model_marketing->lapRasiomediaregis($tahun_akademik,$dari,$sampai)->result();
		$this->load->view('marketing/cetak_laprasiomedia',$data);
	}

	function aplikantidakdaftar()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_aplikantidakdaftar',$data);
		}else{
			$this->template->display('marketing/frm_aplikantidakdaftar',$data);
		}

	}

	function getPresenter()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$presenter 			= $this->Model_marketing->listPresenter($tahun_akademik)->result();
		echo "<option value=''>Semua Presenter</option>";
		foreach($presenter as $p)
		{
			echo "<option value='$p->kode_presenter'>$p->nama_presenter</option>";
		}
	}

	function cetak_lapaplikantidakdaftar()
	{
		$data['conf'] 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 						= $this->input->post('tahun_akademik');
		$presenter 									= $this->input->post('presenter');
		$data['aplikantidakdaftar']	= $this->Model_marketing->AplikanTidakDaftar($tahun_akademik,$presenter)->result();
		$data['ta']									= $tahun_akademik;
		$this->load->view('marketing/cetak_lapaplikantidakdaftar',$data);
	}

	function cetak_lapaplikantidakregis()
	{
		$data['conf'] 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 						= $this->input->post('tahun_akademik');
		$presenter 									= $this->input->post('presenter');
		$data['aplikantidakdaftar']	= $this->Model_marketing->AplikanTidakRegis($tahun_akademik,$presenter)->result();
		$data['ta']									= $tahun_akademik;
		$this->load->view('marketing/cetak_lapaplikantidakregis',$data);
	}

	function aplikantidakujian()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_aplikantidakujian',$data);
		}else{
			$this->template->display('marketing/frm_aplikantidakujian',$data);
		}

	}

	function cetak_lapaplikantidakujian()
	{
		$data['conf'] 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 						= $this->input->post('tahun_akademik');
		$presenter 									= $this->input->post('presenter');
		$data['aplikantidakujian']	= $this->Model_marketing->AplikanTidakUjian($tahun_akademik,$presenter)->result();
		$data['ta']									= $tahun_akademik;
		$this->load->view('marketing/cetak_lapaplikantidakujian',$data);
	}

	function rekapdaftar()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_laprekapdaftar',$data);
		}else{
			$this->template->display('marketing/frm_laprekapdaftar',$data);
		}

	}



	function aplikantidakregis()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_aplikantidakregis',$data);
		}else{
			$this->template->display('marketing/frm_aplikantidakregis',$data);
		}

	}

	function cetak_laprekapdaftar()
	{
		$data['conf'] 		= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $this->input->post('tahun_akademik');

		if(isset($_POST['submit'])){
			$dari 				= $this->input->post('dari');
			$sampai 			= $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/rekapdaftar');
			}
		}else{
			$dari 								= "";
			$sampai 							= "";
		}
		$data['dari'] 					= $dari;
		$data['sampai']					= $sampai;
		$data['ta']							= $tahun_akademik;
		$data['rekapdaftar']		= $this->Model_marketing->lapRekapdaftar($tahun_akademik,$dari,$sampai)->result();
		if(isset($_POST['export'])){
			// Fungsi header dengan mengirimkan raw data excel
			header("Content-type: application/vnd-ms-excel");
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=Laporan RPT.xls");
			$this->load->view('marketing/cetak_laprekapdaftar',$data);
		}else{
			$this->load->view('marketing/cetak_laprekapdaftar',$data);
		}

	}


	function aplikanregis($rowno=0)
	{
		$t 								= "Junior";
		$tingkat 					= 1;
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		$asalsekolah      = "";
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$asalsekolah      = $this->input->post('asalsekolah');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik,
				'asalsekolah'     => $asalsekolah
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }

			if($this->session->userdata('asalsekolah') != NULL){
        $asalsekolah = $this->session->userdata('asalsekolah');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordPembayaran($nama_aplikan,$tahun_akademik,$tingkat,$asalsekolah);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataPembayaran($rowno,$rowperpage,$nama_aplikan,$tahun_akademik,$tingkat,$asalsekolah);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/aplikanregis/';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;

		$data['tingkat']				= $t;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$menu3 									= "updateaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['sekolah']				= $this->Model_marketing->listSekolah()->result();
		$data['asalsekolah']    = $asalsekolah;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aplikanregistrasi',$data);
		}else{
			$this->template->display('marketing/view_aplikanregistrasi',$data);
		}

	}

	function targetkegiatan()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		$ta 							= explode("/",$tahun_akademik);
		$talast1 					= $ta[0]-1;
		$talast2					= $ta[1]-1;
		$kodereg 					= 'T00001';
		$kodeomset 				= 'T00002';
		$data['ta_last']  = $talast1."/".$talast2;
		$data['ta_mkt']		= $tahun_akademik;
 		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['db']				= $this->Model_marketing->getrecorddbSiswa($tahun_akademik)->num_rows();
		$data['act']			= $this->Model_marketing->getrecordAktifitas($tahun_akademik)->num_rows();
		$data['daftar']		= $this->Model_marketing->getrecordDaftar($tahun_akademik)->num_rows();
		$data['regis']		= $this->Model_marketing->getrecordregis($tahun_akademik)->num_rows();
		$data['listtreg']	= $this->Model_marketing->getlisttreg($tahun_akademik)->result();
		$data['grafikreg']= $this->Model_marketing->getGrafikReg($tahun_akademik,$data['ta_last'])->result();
		$data['treg']			= $this->Model_marketing->getAllTarget($tahun_akademik,$kodereg)->row_array();
		$data['tomset']		= $this->Model_marketing->getAllTarget($tahun_akademik,$kodeomset)->row_array();
		$data['omset']		= $this->Model_marketing->getOmset($tahun_akademik)->row_array();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/dashboard_targetkegiatan',$data);
		}else{
			$this->template->display('marketing/dashboard_targetkegiatan',$data);
		}

	}

	function target()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['target']			= $this->Model_marketing->listTarget($conf['ta_mkt'])->result();
		$this->template->display('marketing/view_target',$data);
	}

	function inputtarget()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$this->load->view('marketing/input_target',$data);
	}

	function edittarget()
	{
		$kodetarget 		= $this->input->post('kodetarget');
		$data['target']	= $this->Model_marketing->getTarget($kodetarget)->row_array();
		$this->load->view('marketing/edit_target',$data);
	}

	function input_target()
	{
		$this->Model_marketing->input_target();
	}

	function update_target()
	{
		$this->Model_marketing->update_target();
	}

	function hapus_target()
	{
		$kodetarget = $this->uri->segment(3);
		$this->Model_marketing->hapus_target($kodetarget);
	}



	function settarget($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$presenter 				= "";
		$target 					= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $presenter 				= $this->input->post('presenter');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$target 					= $this->input->post('target');
			$data = array
			(
				'presenter' 			=> $presenter,
				'tahun_akademik'	=> $tahun_akademik,
				'target'				  => $target
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('presenter') != NULL){
        $presenter = $this->session->userdata('presenter');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }

			if($this->session->userdata('target') != NULL){
        $target = $this->session->userdata('target');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordTargetPresenter($presenter,$tahun_akademik,$target);
    // Get records
    $users_record 							= $this->Model_marketing->getDataTargetPresenter($rowno,$rowperpage,$presenter,$tahun_akademik,$target);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/settarget';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['pr']							= $presenter;
		$data['tgt']						= $target;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['presenter']			= $this->Model_marketing->listPresenter($conf['ta_mkt'])->result();
		$data['target']					= $this->Model_marketing->listTarget($conf['ta_mkt'])->result();
		$this->template->display('marketing/view_settarget',$data);
	}

	function hapus_settarget()
	{
		$kode_presenter 			= $this->uri->segment(3);
		$kode_target 					= $this->uri->segment(4);
		$this->Model_marketing->hapus_settarget($kode_presenter,$kode_target);
	}
	function inputtargetpresenter()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['bulan']			= $this->Model_marketing->getBulanTarget()->result();
		$data['presenter']	= $this->Model_marketing->listPresenter($conf['ta_mkt'])->result();
		$data['target']			= $this->Model_marketing->listTarget($conf['ta_mkt'])->result();

		$this->template->display('marketing/input_targetpresenter',$data);
	}



	function edittargetpresenter()
	{

		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$kode_target				= $this->uri->segment(4);
		$kode_presenter 		= $this->uri->segment(3);
		$data['target']			= $this->Model_marketing->getTargetPresenter($kode_presenter,$kode_target)->row_array();
		$data['detail']			= $this->Model_marketing->getDetailTargetPresenter($kode_presenter,$kode_target)->result();
		$this->template->display('marketing/edit_targetpresenter',$data);
	}

	function detailtargetpresenter()
	{
		$kode_target				= $this->input->post('kodetarget');
		$kode_presenter 		= $this->input->post('kodepresenter');
		$data['target']			= $this->Model_marketing->getTargetPresenter($kode_presenter,$kode_target)->row_array();
		$data['detail']			= $this->Model_marketing->getDetailTargetPresenter($kode_presenter,$kode_target)->result();
		$this->load->view('marketing/detail_targetpresenter',$data);
	}

	function insert_targetpresenter()
	{
		$this->Model_marketing->insert_targetpresenter();
	}

	function update_targetpresenter()
	{
		$this->Model_marketing->update_targetpresenter();
	}

	function masteraktivitas()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aktivitas']  = $this->Model_marketing->listAktivitas($conf['ta_mkt'])->result();
		$this->template->display('marketing/view_aktivitas',$data);
	}

	function inputaktivitas()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$this->load->view('marketing/input_aktivitas',$data);
	}

	function input_aktivitas()
	{
		$this->Model_marketing->input_aktivitas();
	}

	function editaktivitas()
	{
		$kodeaktivitas 			= $this->input->post('kodeaktivitas');
		$data['aktivitas']	= $this->Model_marketing->getAktivitas($kodeaktivitas)->row_array();
		$this->load->view('marketing/edit_aktivitas',$data);
	}

	function update_aktivitas()
	{
		$this->Model_marketing->update_aktivitas();
	}

	function hapus_aktivitas()
	{
		$kodeaktivitas = $this->uri->segment(3);
		$this->Model_marketing->hapus_aktivitas($kodeaktivitas);
	}

	function aktivitas($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$dari							= "";
		$sampai 					= "";
		$presenter 				= "";
		$aktivitas 				= "";
		$namasiswa				= "";
		$status 					= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $dari 						= $this->input->post('dari');
			$sampai 					= $this->input->post('sampai');
			$presenter 				= $this->input->post('presenter');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$aktivitas 				= $this->input->post('aktivitas');
			$namasiswa 				= $this->input->post('namasiswa');
			$status 					= $this->input->post('status');
			$data = array
			(
				'dari'						=> $dari,
				'sampai'					=> $sampai,
				'presenter' 			=> $presenter,
				'tahun_akademik'	=> $tahun_akademik,
				'aktivitas'				=> $aktivitas,
				'namasiswa'				=> $namasiswa,
				'status'					=> $status
			);
      $this->session->set_userdata($data);
    }else{
			if($this->session->userdata('dari') != NULL){
        $dari = $this->session->userdata('dari');
      }
			if($this->session->userdata('sampai') != NULL){
        $sampai = $this->session->userdata('sampai');
      }
      if($this->session->userdata('presenter') != NULL){
        $presenter = $this->session->userdata('presenter');
      }
			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
			if($this->session->userdata('aktivitas') != NULL){
        $aktivitas = $this->session->userdata('aktivitas');
      }
			if($this->session->userdata('namasiswa') != NULL){
        $namasiswa = $this->session->userdata('namasiswa');
      }
			if($this->session->userdata('status') != NULL){
        $status = $this->session->userdata('status');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordAktivitas($dari,$sampai,$presenter,$tahun_akademik,$aktivitas,$namasiswa,$status);
    // Get records
    $users_record 							= $this->Model_marketing->getDataAktivitas($rowno,$rowperpage,$dari,$sampai,$presenter,$tahun_akademik,$aktivitas,$namasiswa,$status);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/aktivitas';
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
		$data['pr']							= $presenter;
		$data['act']						= $aktivitas;
		$data['namasiswa']			= $namasiswa;
		$data['dari']						= $dari;
		$data['sampai']					= $sampai;
		$data['status']					= $status;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aktivitaspresenter',$data);
		}else{
			$this->template->display('marketing/view_aktivitaspresenter',$data);
		}
	}

	function inputaktivitaspresenter()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$kodesiswa          = $this->uri->segment(3);
		$data['siswa']      = $this->Model_marketing->getSiswa($kodesiswa)->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aktivitas']	= $this->Model_marketing->listAktivitas($conf['ta_mkt'])->result();

		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/input_aktivitaspresenter',$data);
		}else{
			$this->template->display('marketing/input_aktivitaspresenter',$data);
		}

	}

	function editaktivitaspresenter()
	{
		$conf 							= $this->users_model->get_conf()->row_array();
		$data['ta'] 				= $conf['ta_mkt'];
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$kode 							= $this->uri->segment(3);
		$data['actpre']			= $this->Model_marketing->getAktivitasPresenter($kode)->row_array();
		$data['aktivitas']	= $this->Model_marketing->listAktivitas($conf['ta_mkt'])->result();
		$this->template->display('marketing/edit_aktivitaspresenter',$data);
	}

	function listSiswa()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$data['ta'] 			= $conf['ta_mkt'];
		$data['siswa']		= $this->Model_marketing->listSiswa($data['ta']);
		$this->load->view('marketing/list_siswa',$data);
	}

	function insert_aktivitaspresenter()
	{
		$this->Model_marketing->insert_aktivitaspresenter();
	}

	function update_aktivitaspresenter()
	{
		$this->Model_marketing->update_aktivitaspresenter();
	}

	function detailaktivitas()
	{
		$kode = $this->input->post('kode');
		$data['actpre'] = $this->Model_marketing->getAktivitasPresenter($kode)->row_array();
		$this->load->view('marketing/detail_aktivitas',$data);
	}

	function hapusaktivitaspresenter()
	{
		$kode = $this->uri->segment(3);
		$this->Model_marketing->hapusaktivitaspresenter($kode);
	}


	function rekapaktivitas()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/rekap_aktivitaspresenter',$data);
		}else{
			$this->template->display('marketing/rekap_aktivitaspresenter',$data);
		}

	}

	function loadrekapaktivitas()
	{
		$dari 					= $this->input->post('dari');
		$sampai   			= $this->input->post('sampai');
		$tahun_akademik	= $this->input->post('ta');
		$aktivitas 			= $this->input->post('act');
		$data['result'] = $this->Model_marketing->getRekapAktivitas($dari,$sampai,$tahun_akademik,$aktivitas)->result();
		$this->load->view('marketing/load_rekapaktivitas',$data);
	}

	function loadrekapaktivitaspresenter()
	{
		$dari 					= $this->input->post('dari');
		$sampai   			= $this->input->post('sampai');
		$tahun_akademik	= $this->input->post('ta');
		$aktivitas 			= $this->input->post('act');
		$data['result'] = $this->Model_marketing->getRekapAktivitaspresenter($dari,$sampai,$tahun_akademik)->result();
		$this->load->view('marketing/load_rekapaktivitaspresenter',$data);
	}

	function detailstatusaktivitas()
	{
		$kodepresenter 	= $this->input->post('kode');
		$status 			 	= $this->input->post('status');
		$act 						= $this->input->post('act');
		$dari 					= $this->input->post('dari');
		$sampai 				= $this->input->post('sampai');
		$data['detail']	= $this->Model_marketing->getDetailstatusAktivitas($kodepresenter,$status,$act,$dari,$sampai)->result();
		$this->load->view('marketing/detail_statusaktivitas',$data);
	}

	function detailrekapaktivitas()
	{
		$kodepresenter 	= $this->input->post('kode');
		$kodeact 			 	= $this->input->post('kodeact');
		$dari 					= $this->input->post('dari');
		$sampai 				= $this->input->post('sampai');
		$data['detail']	= $this->Model_marketing->getDetailRekapAktivitas($kodepresenter,$dari,$sampai)->result();
		$this->load->view('marketing/detail_rekapaktivitas',$data);
	}

	function listPresenter()
	{
		$tahun_akademik  = $this->input->post('ta');
		$kodepresenter 	 = $this->input->post('kodepresenter');
		// echo $tahun_akademik;
		$ta 						 = $this->Model_marketing->listPresenter($tahun_akademik)->result();
		// print_r($ta);
		echo "<option value=''>Semua Presenter</option>";
		foreach ($ta as $t){
			if($kodepresenter == $t->kode_presenter){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option $selected value='$t->kode_presenter'>$t->nama_presenter</option>";
		}

	}

	function listAktivitas()
	{
		$tahun_akademik  = $this->input->post('ta');
		$kodeaktivitas 	 = $this->input->post('kodeaktivitas');
		// echo $tahun_akademik;
		$act 						 = $this->Model_marketing->listAktivitas($tahun_akademik)->result();
		// print_r($ta);
		echo "<option value=''>Semua Aktivitas</option>";
		foreach ($act as $t){
			if($kodeaktivitas == $t->kode_aktivitas){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option $selected value='$t->kode_aktivitas'>$t->nama_aktivitas</option>";
		}
	}

	function rekapfollowup($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$dari							= "";
		$sampai 					= "";
		$presenter 				= "";
		$aktivitas 				= "";
		$namasiswa				= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $dari 						= $this->input->post('dari');
			$sampai 					= $this->input->post('sampai');
			$presenter 				= $this->input->post('presenter');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$aktivitas 				= $this->input->post('aktivitas');
			$namasiswa 				= $this->input->post('namasiswa');
			$data = array
			(
				'dari'						=> $dari,
				'sampai'					=> $sampai,
				'presenter' 			=> $presenter,
				'tahun_akademik'	=> $tahun_akademik,
				'aktivitas'				=> $aktivitas,
				'namasiswa'				=> $namasiswa,
			);
      $this->session->set_userdata($data);
    }else{
			if($this->session->userdata('dari') != NULL){
        $dari = $this->session->userdata('dari');
      }
			if($this->session->userdata('sampai') != NULL){
        $sampai = $this->session->userdata('sampai');
      }
      if($this->session->userdata('presenter') != NULL){
        $presenter = $this->session->userdata('presenter');
      }
			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
			if($this->session->userdata('aktivitas') != NULL){
        $aktivitas = $this->session->userdata('aktivitas');
      }
			if($this->session->userdata('namasiswa') != NULL){
        $namasiswa = $this->session->userdata('namasiswa');
      }

    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordRekapAktivitas($dari,$sampai,$presenter,$tahun_akademik,$aktivitas,$namasiswa);
    // Get records
    $users_record 							= $this->Model_marketing->getDataRekapAktivitas($rowno,$rowperpage,$dari,$sampai,$presenter,$tahun_akademik,$aktivitas,$namasiswa);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/rekapfollowup';
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
		$data['pr']							= $presenter;
		$data['act']						= $aktivitas;
		$data['namasiswa']			= $namasiswa;
		$data['dari']						= $dari;
		$data['sampai']					= $sampai;
		$data['status']					= $status;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();

		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/rekap_followup',$data);
		}else{
			$this->template->display('marketing/rekap_followup',$data);
		}

	}

	function detailfollowup()
	{
		$kode	 	= $this->input->post('kode');
		$dari 	= $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$data['detail'] = $this->Model_marketing->getDetailFollowup($kode,$dari,$sampai)->result();
		$this->load->view('marketing/detail_followup',$data);
	}

	function rekaphasilfollowup()
	{
		$conf 									= $this->users_model->get_conf()->row_array();
		$tahun_akademik 				= $conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/rekap_hasilfollowup',$data);
		}else{
			$this->template->display('marketing/rekap_hasilfollowup',$data);
		}

	}

	function loadrekapfollowup()
	{

		$tahun_akademik	= $this->input->post('ta');
		$data['result'] = $this->Model_marketing->getRekapAktivitas($dari,$sampai,$tahun_akademik,$aktivitas)->result();
		$this->load->view('marketing/load_rekapaktivitas',$data);
	}

	function loadrekaphasilfollowup()
	{
		$tahun_akademik	= $this->input->post('ta');
		$conf = $this->users_model->get_conf()->row_array();
		if(empty($tahun_akademik)){
			$tahun_akademik = $conf['ta_mkt'];
		}else{
			$tahun_akademik	= $this->input->post('ta');
		}
		$data['result'] = $this->Model_marketing->getRekapHasilFollowup($tahun_akademik)->result();
		$this->load->view('marketing/load_rekaphasilfollowup',$data);
	}

	function rekaptargetpresenter()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/rekap_targetpresenter',$data);
		}else{
			$this->template->display('marketing/rekap_targetpresenter',$data);
		}

	}



	function listTargetPresenter()
	{
		$tahun_akademik = $this->input->post('ta');
		// echo $tahun_akademik;
		$ta = $this->Model_marketing->listTarget($tahun_akademik)->result();
		// print_r($ta);
		echo "<option value=''>Semua Presenter</option>";
		foreach ($ta as $t){
			echo "<option  value='$t->kode_target'>$t->nama_target</option>";
		}

	}

	function getrekaptargetpresenter()
	{
		$kodetarget 	 = $this->input->post('kodetarget');
		$kodepresenter = $this->input->post('kodepresenter');
		$tahunakademik = $this->input->post('tahunakademik');
		$data['rekap'] = $this->Model_marketing->getrekaptargetpresenter($kodetarget,$kodepresenter,$tahunakademik)->result();
		$this->load->view('marketing/load_rekaptargetpresenter',$data);
	}

	function getrekaptargetomsetpresenter()
	{
		$kodetarget 	 = $this->input->post('kodetarget');
		$kodepresenter = $this->input->post('kodepresenter');
		$tahunakademik = $this->input->post('tahunakademik');
		$data['rekap'] = $this->Model_marketing->getrekaptargetpresenter($kodetarget,$kodepresenter,$tahunakademik)->result();
		$this->load->view('marketing/load_rekaptargetomsetpresenter',$data);
	}

	function listtargetregister()
	{
		$bulan  			= $this->input->post('bulan');
		$ta 					= $this->input->post('ta');
		$presenter 		= $this->input->post('presenter');
		$data['list'] = $this->Model_marketing->getListTargetRegsiter($bulan,$ta,$presenter)->result();
		$this->load->view('marketing/list_targetregister',$data);
	}

	function inputpersyaratanaplikan($rowno=0)
	{
		$t 								= "Junior";
		$tingkat 					= 1;
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordPersyaratanAplikan($nama_aplikan,$tahun_akademik,$tingkat);
    // Get records
    $users_record 							= $this->Model_marketing->getDataPersyaratanAplikan($rowno,$rowperpage,$nama_aplikan,$tahun_akademik,$tingkat);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/inputpersyaratanaplikan/';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['jmlsyarat']			= $this->Model_marketing->listPersyaratan($tahun_akademik,$kode="")->num_rows();
		$data['tingkat']				= $t;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$menu3 									= "updateaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_inputpersyaratan',$data);
		}else{
			$this->template->display('marketing/view_inputpersyaratan',$data);
		}

	}

	function inputpersyaratanaplikanfrm()
	{
		$kode 							= array('');
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$kodeaplikan 				= $this->input->post('kode');
		$persyaratanaplikan = $this->Model_marketing->getPersyaratanAplikan($kodeaplikan)->result();
		foreach ($persyaratanaplikan as $p) {
			$kode[] = $p->kode_persyaratan;
		}
		// print_r($kode);
		// die;
		$data['aplikan']		= $this->Model_marketing->getAplikan($kodeaplikan)->row_array();
		$data['persyaratan']= $this->Model_marketing->listPersyaratan($tahun_akademik,$kode)->result();


		$this->load->view('marketing/input_persyaratanaplikan',$data);
	}

	function detailpersyaratanaplikan()
	{
		$kode 							= array('');
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$kodeaplikan 				= $this->input->post('kode');
		$data['pa'] 				= $this->Model_marketing->getListPersyaratanAplikan($tahun_akademik,$kodeaplikan)->result();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kodeaplikan)->row_array();
		$this->load->view('marketing/detail_persyaratanaplikan',$data);
	}

	function insert_persyartanaplikan()
	{
		$data = array();
		$upload = $this->Model_marketing->upload_persyaratan();
		if($upload['result'] == "success"){
			// Jika proses upload sukses
			// Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
			$this->Model_marketing->insert_persyartanaplikan($upload);
			redirect('inputpersyaratanaplikan'); // Redirect kembali ke halaman awal / halaman view data
		}else{ // Jika proses upload gagal
			$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
		}
	}

	function hapuspersyaratanaplikan()
	{
		$kodeaplikan 			=	$this->uri->segment(3);
		$kodepersyaratan 	= $this->uri->segment(4);
		$this->Model_marketing->hapuspersyaratanaplikan($kodeaplikan,$kodepersyaratan);
	}

	function wablast()
	{
		$conf 									= $this->users_model->get_conf()->row_array();
		$tahun_akademik 				= $conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['sekolah'] 			  = $this->Model_marketing->listSekolah()->result();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$menu3 									= "updateaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/wablast',$data);
		}else{
			$this->template->display('marketing/wablast',$data);
		}

	}

	function exportexcel()
	{
		$ta 						 = $this->input->post('tahun_akademik');
		$presenter 			 = $this->input->post('presenter');
		$minat 					 = $this->input->post('minat');
		$penghasilanortu = $this->input->post('penghasilanortu');
		$asalsekolah     = $this->input->post('asalsekolah');
		$ranking 			   = $this->input->post('ranking');
		$tgllahir      	 = $this->input->post('tgllahir');
		$data['wablast'] = $this->Model_marketing->exportWaBlast($ta,$presenter,$minat,$penghasilanortu,$asalsekolah,$ranking,$tgllahir)->result();
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		header("Content-Disposition: attachment; filename=export_wablast.xls");
		$this->load->view('marketing/export_wablast',$data);
	}

	function rekapdetailstatusaktivitas()
	{
		$kodepresenter 	= $this->input->post('kode');
		$status 			 	= $this->input->post('status');
		$ta 						= $this->input->post('ta');
		$data['detail']	= $this->Model_marketing->getRekapDetailstatusAktivitas($kodepresenter,$status,$ta)->result();
		$this->load->view('marketing/detail_rekapstatusaktivitas',$data);
	}

	function lappotensiomset()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_lappotensiomset',$data);
		}else{
			$this->template->display('marketing/frm_lappotensiomset',$data);
		}
	}

	function cetak_lappotensiomset()
	{
		$data['conf'] 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 						= $this->input->post('tahun_akademik');
		$data['potensiomset']				= $this->Model_marketing->PotensiOmset($tahun_akademik)->result();
		$data['ta']									= $tahun_akademik;
		$this->load->view('marketing/cetak_lappotensiomset',$data);
	}



	function get_siswa() {
		header('Content-Type: application/json');
		echo $this->Model_marketing->getSiswadt();
	}



	function pilihsiswa($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		$presenter 				= "";
		$asalsekolah 	    = "";
		$ranking 					= "";
		$minat  					= "";
		$tgllahir  				= "";
		$penghasilanortu  = "";


		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$presenter        = $this->input->post('presenter');
			$asalsekolah 			= $this->input->post('asalsekolah');
			$minat 						= $this->input->post('minat');
			$tgllahir   			= $this->input->post('tgllahir');
			$ranking          = $this->input->post('ranking');
			$penghasilanortu  = $this->input->post('penghasilanortu');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik,
				'presenter'       => $presenter,
				'asalsekolah'     => $asalsekolah,
				'minat'           => $minat,
				'tgllahir'        => $tgllahir,
				'ranking'         => $ranking,
				'penghasilanortu' => $penghasilanortu
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }

			if($this->session->userdata('presenter') != NULL){
        $presenter = $this->session->userdata('presenter');
      }

			if($this->session->userdata('asalsekolah') != NULL){
        $asalsekolah = $this->session->userdata('asalsekolah');
      }

			if($this->session->userdata('minat') != NULL){
        $minat = $this->session->userdata('minat');
      }

			if($this->session->userdata('tgllahir') != NULL){
        $tgllahir = $this->session->userdata('tgllahir');
      }

			if($this->session->userdata('ranking') != NULL){
        $ranking = $this->session->userdata('ranking');
      }

			if($this->session->userdata('penghasilanortu') != NULL){
        $penghasilanortu = $this->session->userdata('penghasilanortu');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_marketing->getrecordPilihSiswa($nama_aplikan,$tahun_akademik,$presenter,$asalsekolah,$minat,$tgllahir,$ranking,$penghasilanortu);
    // Get records
    $users_record 							= $this->Model_marketing->getDataPilihSiswa($rowno,$rowperpage,$nama_aplikan,$tahun_akademik,$presenter,$asalsekolah,$minat,$tgllahir,$ranking,$penghasilanortu);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/pilihsiswa';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['presenter']      = $presenter;
		$data['asalsekolah']    = $asalsekolah;
		$data['minat']          = $minat;
		$data['tgllahir']       = $tgllahir;
		$data['ranking']        = $ranking;
		$data['penghasilanortu']= $penghasilanortu;
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$menu3 									= "updateaplikan";
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['sekolah'] 			  = $this->Model_marketing->DataSekolah()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/pilih_siswa',$data);
		}else{
			$this->template->display('marketing/pilih_siswa',$data);
		}

	}

	function checkeraplikan()
	{
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['bulan']					= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['tahun_akademik']	= $ta;
		// $data['dari']						= $dari;
		// $data['sampai']					= $sampai;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_checkeraplikan',$data);
		}else{
			$this->template->display('marketing/frm_checkeraplikan',$data);
		}
	}

	function rekapcheckeraplikan()
	{
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['bulan']					= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['tahun_akademik']	= $ta;
		// $data['dari']						= $dari;
		// $data['sampai']					= $sampai;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_checkeraplikan',$data);
		}else{
			$this->template->display('marketing/frm_rekapcheckeraplikan',$data);
		}
	}

	function rekapsekolah()
	{
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['tahun_akademik']	= $ta;
		// $data['dari']						= $dari;
		// $data['sampai']					= $sampai;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_rekapsekolah',$data);
		}else{
			$this->template->display('marketing/frm_rekapsekolah',$data);
		}
	}
	function cetakcheckeraplikan()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$bulan  				= $this->input->post('bulan');
		if(isset($_POST['submit'])){
			$dari 	= $this->input->post('dari');
			$sampai = $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/checkeraplikan');
			}
		}else{
			$dari 						= "";
			$sampai 					= "";
		}
		$data['dari'] 		= $dari;
		$data['sampai']		= $sampai;
		$data['ta']				= $tahun_akademik;
		$data['bulan']	  = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['bln'] 			= $bulan;
		$data['checker']	= $this->Model_marketing->LapCheckeraplikan($tahun_akademik,$bulan)->result_array();

		$this->load->view('marketing/cetak_lapcheckeraplikan',$data);
	}

	function cetak_rekapcheckeraplikan()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		if(isset($_POST['submit'])){
			$dari 	= $this->input->post('dari');
			$sampai = $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/rekapcheckeraplikan');
			}
		}else{
			$dari 						= "";
			$sampai 					= "";
		}
		$data['dari'] 		   = $dari;
		$data['sampai']		   = $sampai;


		$data['ta']				   = $tahun_akademik;
		$data['bulan']	     = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$datetime1 					 = new DateTime($dari);
  	$datetime2 					 = new DateTime($sampai);
  	$difference          = $datetime1->diff($datetime2);
  	$data['selisih'] 		 = $difference->days;
		$data['checker']	   = $this->Model_marketing->LapRekapCheckeraplikan($dari,$sampai,$tahun_akademik);
		// echo $data['checker'];
		// die;
		$this->load->view('marketing/cetak_laprekapcheckeraplikan',$data);
	}


	function regisunder30($rowno=0)
	{
		$tingkat 				  = 1;
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordRegisunder30($nama_aplikan,$tahun_akademik,$tingkat);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataRegisunder30($rowno,$rowperpage,$nama_aplikan,$tahun_akademik,$tingkat);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'marketing/regisunder30/';
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

    $data['pagination']			 = $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$menu1 									= "aplikan";
		$menu2 									= "siswa";
		$menu3 									= "updateaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/view_aplikanregistrasiunder30',$data);
		}else{
			$this->template->display('marketing/view_aplikanregistrasiunder30',$data);
		}

	}


	function cetak_rekapsekolah()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		$data['ta']     = $tahun_akademik;
		$data['rekapsekolah'] = $this->Model_marketing->rekapsekolah($tahun_akademik)->result();
		$this->load->view('marketing/cetak_rekapsekolah',$data);
	}


	function rekapcheckerjurusan()
	{
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$menu1 									= "laporanaplikan";
		$menu2 									= "";
		$menu3 									= "rekapaplikan";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['mn2']						= $this->Model_menu->get_menu($menu2)->result();
		$data['mn3']						= $this->Model_menu->get_menu($menu3)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['bulan']					= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$data['tahun_akademik']	= $ta;
		// $data['dari']						= $dari;
		// $data['sampai']					= $sampai;
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/frm_checkrekapjurusan',$data);
		}else{
			$this->template->display('marketing/frm_checkrekapjurusan',$data);
		}
	}


	function cetak_rekapchekerjurusan()
	{
		$tahun_akademik = $this->input->post('tahun_akademik');
		if(isset($_POST['submit'])){
			$dari 	= $this->input->post('dari');
			$sampai = $this->input->post('sampai');
			if($dari == "" AND $sampai ==""){
				$this->session->set_flashdata('msg',
	        '<div class="card bg-c-pink order-card">
	            <div class="card-block">
	                <h6><i class="ti-na"></i> Tanggal Tidak Valid !</h6>
	            </div>
	        </div>');
	    	redirect('marketing/rekapcheckerjurusan');
			}
		}else{
			$dari 						= "";
			$sampai 					= "";
		}
		$data['dari'] 		   = $dari;
		$data['sampai']		   = $sampai;


		$data['ta']				   = $tahun_akademik;
		$data['bulan']	     = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$datetime1 					 = new DateTime($dari);
  	$datetime2 					 = new DateTime($sampai);
  	$difference          = $datetime1->diff($datetime2);
  	$data['selisih'] 		 = $difference->days;
		$data['checker']	   = $this->Model_marketing->LapRekapCheckerjurusan($dari,$sampai,$tahun_akademik);
		// echo $data['checker'];
		// die;
		$this->load->view('marketing/cetak_lapcheckerjurusan',$data);
	}


	function listunder30()
	{
		$kodepresenter 	 = $this->input->post('kodepresenter');
		$ta 					 	 = $this->input->post('ta');
		$data['under30'] = $this->Model_keuangan->getListUnder30($kodepresenter,$ta)->result();
		$this->load->view('marketing/view_listregisunder30',$data);
	}

	function listapdatang()
	{
		$kodepresenter 	 = $this->input->post('kodepresenter');
		$ta 					 	 = $this->input->post('ta');
		$data['apdatang']= $this->Model_marketing->getListApdatang($kodepresenter,$ta)->result();
		$this->load->view('marketing/view_listapdatang',$data);
	}

	function listapdaftar()
	{
		$kodepresenter 	 = $this->input->post('kodepresenter');
		$ta 					 	 = $this->input->post('ta');
		$data['apdaftar']= $this->Model_marketing->getListApdaftar($kodepresenter,$ta)->result();
		$this->load->view('marketing/view_listapdaftar',$data);
	}

	function listapregis()
	{
		$kodepresenter 	 = $this->input->post('kodepresenter');
		$ta 					 	 = $this->input->post('ta');
		$data['apregis']= $this->Model_marketing->getListApregis($kodepresenter,$ta)->result();
		$this->load->view('marketing/view_listapregis',$data);
	}

	function rekapaktivitaspresenter()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		if($data['level']=='presenter')
		{
			$this->template->displaypresenter('marketing/rekap_aktivitas',$data);
		}else{
			$this->template->display('marketing/rekap_aktivitas',$data);
		}

	}








}
