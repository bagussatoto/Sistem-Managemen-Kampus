<?php

class Keuangan extends MY_Core
{
	function __construct()
	{
  	parent:: __construct();
		$this->load->model(array('Model_menu','Model_marketing','Model_keuangan'));
		$this->load->model('user/Model','users_model');
  }

	function index()
	{
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$this->template->display('keuangan/dashboard_master',$data);
	}
	function transaksi()
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		$t 								= $conf['ta_pdd'];
		$ta 							= explode("/",$t);
		$ta1 							= $ta[0]-1;
		$ta2 							= $ta[1]-1;
		$ta_senior 				= $ta1."/".$ta2;
		$ta1 							= $ta[0]-2;
		$ta2 							= $ta[1]-2;
		$ta_t3 						= $ta1."/".$ta2;
		$ta1 							= $ta[0]-3;
		$ta2 							= $ta[1]-3;
		$ta_t4 						= $ta1."/".$ta2;
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$menu1 						= "registrasi";
		$data['mn1']			= $this->Model_menu->get_menu($menu1)->result();
		$data['junior']   = $this->Model_keuangan->getJmlregis($t,$tingkat=1)->num_rows();
		$data['senior']   = $this->Model_keuangan->getJmlregis($t,$tingkat=2)->num_rows();
		$data['t3']   		= $this->Model_keuangan->getJmlregis($t,$tingkat=3)->num_rows();
		$data['t4']   		= $this->Model_keuangan->getJmlregis($t,$tingkat=4)->num_rows();

		$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$t);
		$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
		$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
		$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
		$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
		$data['listkasir']  = $this->Model_keuangan->listkasir()->result();

		$this->template->display('keuangan/dashboard_transaksi',$data);
	}

	function regisjunior($rowno=0)
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
    $allcount 	  							= $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan,$tahun_akademik);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataBelumRegisJunior($rowno,$rowperpage,$nama_aplikan,$tahun_akademik);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/regisjunior';
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
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$menu1 									= "registrasi";
		$data['mn1']						= $this->Model_menu->get_menu($menu1)->result();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$this->template->display('keuangan/view_regisjunior',$data);
	}

	function databiaya()
	{
		$conf 										= $this->users_model->get_conf()->row_array();
		$tahun_akademik 					= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{


			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }


		$data['username'] 				= $this->access->get_username();
		$data['fullname'] 				= $this->access->get_fullname();
		$data['level']	  				= $this->access->get_level();
		$data['tk']								= $this->Model_keuangan->getTingkat()->result();
		$data['jur']							= $this->Model_keuangan->getJurusan()->result();
		$data['tahun_akademik']		= $tahun_akademik;
		$data['ta']								= $this->Model_keuangan->listTahunakademik()->result();
		$data['biaya']						= $this->Model_keuangan->getBiaya($tahun_akademik)->result();
		$this->template->display('keuangan/view_biaya',$data);
	}

	function insertbiaya()
	{
		$this->Model_keuangan->insertbiaya();
	}

	function hapusbiaya()
	{
		$kode_biaya = $this->uri->segment(3);
		$this->Model_keuangan->hapusbiaya($kode_biaya);
	}

	function hapustarget()
	{
		$kode_target = $this->uri->segment(3);
		$this->Model_keuangan->hapustarget($kode_target);
	}

	function editbiaya()
	{
		$kode_biaya 		= $this->input->post('kode_biaya');
		$data['biaya']  = $this->Model_keuangan->getDataBiaya($kode_biaya)->row_array();
		$data['tk']			= $this->Model_keuangan->getTingkat()->result();
		$data['jur']		= $this->Model_keuangan->getJurusan()->result();
		$this->load->view('keuangan/edit_biaya',$data);
	}

	function edittarget()
	{
		$kode_target 		= $this->input->post('kode_target');
		$data['target'] = $this->Model_keuangan->getDataTarget($kode_target)->row_array();
		$data['tk']			= $this->Model_keuangan->getTingkat()->result();
		$this->load->view('keuangan/edit_target',$data);
	}

	function updatebiaya()
	{
		$this->Model_keuangan->updatebiaya();
	}

	function updatetarget()
	{
		$this->Model_keuangan->updatetarget();
	}


	function inputregisjunior()
	{

		$kode_aplikan 			= $this->uri->segment(3);
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['ta']					= $tahun_akademik;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$aplikan						= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$kode_jurusan 			= $aplikan['kode_jurusan'];
		$tingkat 						= 1;
		$status 						= "LP3I";
		$data['biaya']			= $this->Model_keuangan->get_biaya($kode_jurusan,$tingkat,$tahun_akademik,$status)->row_array();
		$this->template->display('keuangan/input_regisjunior',$data);
	}

	function getselisih()
	{
		$tglmulai = $this->input->post('tglmulai');
		$tglreg		= date($tglmulai);
		$tahun		= substr($tglreg,0,4);
		$bulan		= substr($tglreg,5,2);
		//$hari=substr($tglregis,8,2);
		$a 				= mktime(0,0,0,date($bulan),0,date($tahun));
		$b 				= mktime(0,0,0,date(07),0,date($tahun+1));
		$selisih	= round(($b-$a) / 60 / 60 / 24 / 30);

		echo $selisih;
	}

	function insert_regisjunior(){
		$this->Model_keuangan->insert_regisjunior();
	}

	function editrencana()
	{
		$kode_registrasi 		= $this->uri->segment(3);
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['ta']					= $tahun_akademik;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aplikan']		= $this->Model_keuangan->get_reg($kode_registrasi)->row_array();
		$data['ren']				= $this->Model_keuangan->get_ren2($kode_registrasi)->result();
		$this->template->display('keuangan/edit_rencana',$data);
	}

	function updaterencana(){
		$this->Model_keuangan->updaterencana();
	}

	function detail()
	{
		$kodereg 						= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['reg']				= $this->Model_keuangan->get_reg($kodereg)->row_array();
		$data['hb']					= $this->Model_keuangan->getJmlbayar($kodereg)->row_array();
		$data['ren']				= $this->Model_keuangan->get_ren($kodereg)->result();
		$data['allren']			= $this->Model_keuangan->get_ren2($kodereg)->result();
		$data['jmlcicilan']	= $this->Model_keuangan->get_jmlcicilan($kodereg)->num_rows();
		$data['hbayar']			= $this->Model_keuangan->get_historibayar($kodereg);
		$data['nobtk']      = $this->Model_keuangan->getNobtklast()->row_array();
		$jam 								= date("H:i:s");
	//$jam = "15:00:01";
		$jam2 							= "15:00:00";
		$tglnyunyu 					= date("Y-m-d");
		$tglnyonyo 					= date('Y-m-d', strtotime('+1 days', strtotime($tglnyunyu)));
		if($jam > $jam2){
			$tglmeng = $tglnyonyo;
		}else{
			$tglmeng = $tglnyunyu;
		}

		$data['tglmeng']		= $tglmeng;
		$this->template->display('keuangan/detail_registrasi',$data);
	}

	function bayar()
	{
		$this->Model_keuangan->bayar();
	}

	function editbayar(){
		$nobukti 						= $this->uri->segment(3);
		$data['fullname'] 	= $this->access->get_fullname();
		$data['hb']					= $this->Model_keuangan->getHB($nobukti)->row_array();
		$this->load->view('keuangan/edit_bayar',$data);
	}

	function updatebayar(){
		$this->Model_keuangan->updatebayar();
	}

	function updatebayar_validasi(){
		$this->Model_keuangan->updatebayar_validasi();
	}

	function hapusbayar(){
		$nobukti 	= $this->uri->segment(3);
		$kodereg  = $this->uri->segment(4);
		$this->Model_keuangan->hapusbayar($nobukti,$kodereg);
	}

	function cetakkwitansi()
	{
		$nobukti  	= $this->uri->segment(3);
		$jn 				= $this->uri->segment(4);
		$data['jn']	= $jn;
		if($jn ==""){
			$data['kw'] = $this->Model_keuangan->cetakkwitansi1($nobukti)->row_array();
		}else if($jn=="II"){
			$data['kw'] = $this->Model_keuangan->cetakkwitansi2($nobukti)->row_array();
			//echo "2";
		}

		$this->load->view('keuangan/kwitansi',$data);
	}

	function hapusregistrasi()
	{
		$kodereg 				= $this->uri->segment(3);
		$kode_aplikan		= $this->uri->segment(4);
		$this->Model_keuangan->hapusregistrasi($kodereg,$kode_aplikan);
	}

	function hapusregis()
	{
		$kodereg 				= $this->uri->segment(3);
		$kode_aplikan		= $this->uri->segment(4);
		$this->Model_keuangan->hapusregis($kodereg,$kode_aplikan);
	}

	function pembayaran($tk,$rowno=0)
	{
		$sync = "";
		$tk 	= $this->uri->segment(3);
		if($tk =="junior"){
			$t 			 = "Junior";
			$tingkat = 1;
		}else if($tk == "senior"){
			$t			 = "Senior";
			$tingkat = 2;
		}else if($tk == "t3"){
			$t 			 = "t3";
			$tingkat = 3;

		}else if($tk == "t4"){
			$t 			 = "t4";
			$tingkat = 4;
		}
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

		if(isset($_POST['sync'])){

			$sync = $this->Model_keuangan->sync($tahun_akademik,$tingkat);
			//unset($_POST['sync']);
		}
		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordPembayaran($nama_aplikan,$tahun_akademik,$tingkat);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataPembayaran($rowno,$rowperpage,$nama_aplikan,$tahun_akademik,$tingkat);

		$data['ceksync'] 						= $this->Model_keuangan->ceksync($tahun_akademik,$tingkat)->row_array();
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/pembayaran/'.$tk;
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
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;

		$data['tingkat']				= $t;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['sync'] 					= $sync;
		$this->template->display('keuangan/view_pembayaran',$data);
	}

	function regissenior($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$t 								= $conf['ta_mkt'];


		$ta 							= explode("/",$t);
		$ta1 							= $ta[0]-1;
		$ta2 							= $ta[1]-1;
		$ta_senior 				= $ta1."/".$ta2;
		//die;
		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$ta_senior 				= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'ta_senior'				=> $ta_senior
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('ta_senior') != NULL){
        $ta_senior = $this->session->userdata('ta_senior');
      }
    }

		//echo $ta_senior;
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan,$ta_senior);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataBelumRegisSenior($rowno,$rowperpage,$nama_aplikan,$ta_senior);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/regissenior';
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
		$data['tahun_akademik']	= $ta_senior;
		$tingkat 								= 2;
		$data['ta']							= $this->Model_marketing->listTahunakademik($ta2,$tingkat)->result();
		$this->template->display('keuangan/view_regissenior',$data);
	}

	function inputregissenior()
	{

		$kode_aplikan 			= $this->uri->segment(3);
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['ta']					= $tahun_akademik;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$aplikan						= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$data['kelas'] 			= $this->Model_marketing->getKelasMhs($kode_aplikan)->row_array();
		$kode_jurusan 			= $aplikan['kode_jurusan'];
		$tingkat 						= 2;
		$status 						= "LP3I";
		$data['biaya']			= $this->Model_keuangan->get_biaya($kode_jurusan,$tingkat,$tahun_akademik,$status)->row_array();
		$this->template->display('keuangan/input_regissenior',$data);
	}

	function insert_regissenior(){
		$this->Model_keuangan->insert_regissenior();
	}

	function regist3($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$t 								= $conf['ta_mkt'];
		$ta 							= explode("/",$t);
		$ta1 							= $ta[0]-2;
		$ta2 							= $ta[1]-2;
		$ta_t3 				= $ta1."/".$ta2;

		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$ta_t3 						= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'ta_t3'						=> $ta_t3
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('ta_t3') != NULL){
        $ta_t3 = $this->session->userdata('ta_t3');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan,$ta_t3);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataBelumRegisT3($rowno,$rowperpage,$nama_aplikan,$ta_t3);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/regist3';
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
		$data['tahun_akademik']	= $ta_t3;
		$tingkat 								= 3;
		$data['ta']							= $this->Model_marketing->listTahunakademik($ta2,$tingkat)->result();
		$this->template->display('keuangan/view_regist3',$data);
	}

	function regist4($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$nama_aplikan 		= "";
		$t 								= $conf['ta_mkt'];
		$ta 							= explode("/",$t);
		$ta1 							= $ta[0]-3;
		$ta2 							= $ta[1]-3;
		$ta_t4 						= $ta1."/".$ta2;

		if(isset($_POST['submit'])){
      $nama_aplikan 		= $this->input->post('nama_aplikan');
			$ta_t4 						= $this->input->post('tahun_akademik');
			$data = array
			(
				'nama_aplikan' 		=> $nama_aplikan,
				'ta_t4'						=> $ta_t4
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_aplikan') != NULL){
        $nama_aplikan = $this->session->userdata('nama_aplikan');
      }

			if($this->session->userdata('ta_t4') != NULL){
        $ta_t4 = $this->session->userdata('ta_t4');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan,$ta_t4);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataBelumRegisT4($rowno,$rowperpage,$nama_aplikan,$ta_t4);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/regisjunior';
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
		$data['tahun_akademik']	= $ta_t4;
		$tingkat 								= 4;
		$data['ta']							= $this->Model_marketing->listTahunakademik($ta2,$tingkat)->result();
		$this->template->display('keuangan/view_regist4',$data);
	}

	function inputregist3()
	{
		$kode_aplikan 			= $this->uri->segment(3);
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['ta']					= $tahun_akademik;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$aplikan						= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$data['kelas'] 			= $this->Model_marketing->getKelasMhs($kode_aplikan)->row_array();
		$kode_jurusan 			= $aplikan['kode_jurusan'];
		$tingkat 						= 3;
		$data['tingkat']		= $tingkat;
		$data['status']			= $this->Model_keuangan->get_status()->result();
		$this->template->display('keuangan/input_regist3',$data);
	}

	function inputregist4()
	{
		$kode_aplikan 			= $this->uri->segment(3);
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['ta']					= $tahun_akademik;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aplikan']		= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$aplikan						= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$data['kelas'] 			= $this->Model_marketing->getKelasMhs($kode_aplikan)->row_array();
		$kode_jurusan 			= $aplikan['kode_jurusan'];
		$tingkat 						= 4;
		$data['tingkat']		= $tingkat;
		$data['status']			= $this->Model_keuangan->get_status()->result();
		$this->template->display('keuangan/input_regist3',$data);
	}

	function get_jurusan()
	{
		$status 		=	$this->input->post('status');
		$tingkat 		= $this->input->post('tingkat');
		$ta 				= $this->input->post('ta');
		$jurusan		= $this->Model_keuangan->get_jurusan($status,$tingkat,$ta)->result();
		echo "<option value=''>Pilih Jurusan</option>";
		foreach($jurusan as $j)
		{
				echo "<option value='$j->kode_jurusan'>".$j->nama_jurusan."</option>";
		}
	}

	function get_biaya()
	{
		$kode_jurusan  = $this->input->post('jurusan');
		$tingkat 			 = $this->input->post('tingkat');
		$ta 					 = $this->input->post('ta');
		$status 			 = $this->input->post('status');
		$biaya 				 = $this->Model_keuangan->get_biaya($kode_jurusan,$tingkat,$ta,$status)->row_array();
		echo number_format($biaya['biaya'],'0','','.')."|".$biaya['kode_biaya'];
	}

	function laporankelas()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		$this->template->display('keuangan/frm_laporankelas',$data);
	}

	function gettingkat(){
		$tingkat = $this->db->get('tingkat')->result();
		echo "<option value=''>-- Tingkat --</option>";
		foreach ($tingkat as $t ) {
			echo "<option   value='$t->kode_tingkat'>".$t->nama_tingkat."</option>";
		}
	}

	function getjur(){
		$ta 			= $this->input->post('ta');
		$tingkat	= $this->input->post('tingkat');
		$jurusan  = $this->Model_keuangan->getjur($ta,$tingkat)->result();
		echo "<option value=''>-- Jurusan --</option>";
		foreach ($jurusan as $j ) {
			echo "<option value='$j->kode_jurusan'>".$j->nama_jurusan."</option>";
		}
	}

	function getKelas(){
		$ta 			= $this->input->post('ta');
		$tingkat	= $this->input->post('tingkat');
		$jurusan	= $this->input->post('jurusan');
		$kelas  	= $this->Model_keuangan->getKelas($ta,$tingkat,$jurusan)->result();
		echo "<option value=''>-- Kelas --</option>";
		foreach ($kelas as $k ) {
			echo "<option value='$k->kelas'>".$k->kelas."</option>";
		}
	}

	function getjenislaporan(){
		echo '
		<option value="">-- Jenis Laporan --</option>
		<option value="0">Laporan Tunggakan Biasa (dengan No. HP)</option>
		<option value="1">Laporan Tunggakan Secara Rinci</option>
		<option value="2">Laporan Tunggakan Sampai Akhir Periode</option>
		<option value="4">Laporan Tunggakan Keterangan Lunas</option>
		<option value="5">Laporan Harga Deal dan Tunggakan</option>
		';
	}

	function cetaklaporankelas()
	{
		$data['ta']			 			= $this->input->post('tahun_akademik');
		$data['tingkat']			= $this->input->post('tingkat');
		$data['kelas']				= $this->input->post('kelas');
		$data['batas'] 			  = $this->input->post('batastgl');
		$data['kode_jurusan'] = $this->input->post('jurusan');
		$data['fullname'] 		= $this->access->get_fullname();
		$data['biaya'] 				= $this->Model_keuangan->getBiayaTingkat($data['ta'],$data['kode_jurusan'],$data['tingkat'])->row_array();
		$laporan							= $this->input->post('jenislaporan');

		if ($laporan=='0'){
			$data['cetak0'] 		= $this->Model_keuangan->cetaklaporankelas_hp($data['ta'],$data['tingkat'],$data['kelas'],$data['batas'])->result();
			$this->load->view('keuangan/cetak_laporankelas',$data);
		}else if ($laporan=='1'){
			$data['cetak0']     = $this->Model_keuangan->cetaklaporankelas_rinci($data['ta'],$data['tingkat'],$data['kelas'],$data['batas'])->result();
			$this->load->view('keuangan/cetaklaporankelas_rinci',$data);
		}else if ($laporan=='2'){
			$data['cetak0'] 			= $this->Model_keuangan->cetaklaporankelas_akhirperiode($data['ta'],$data['tingkat'],$data['kelas'],$data['batas'])->result();
			$this->load->view('keuangan/cetak_laporanakhirperiode',$data);
		}else if ($laporan=='3'){
		}else if ($laporan=='4'){
			$data['cetak0'] 			= $this->Model_keuangan->cetaklaporankelas_akhirperiode($data['ta'],$data['tingkat'],$data['kelas'],$data['batas'])->result();
			$this->load->view('keuangan/cetak_laporanlunas',$data);
		}else if ($laporan=='5'){
			$data['cetak0'] 			= $this->Model_keuangan->cetaklaporankelas_hp($data['ta'],$data['tingkat'],$data['kelas'],$data['batas'])->result();
			$this->load->view('keuangan/cetak_laporanhargadeal',$data);
		}

	}


	function laphistoribayar()
	{
		$dari 						= "";
    $sampai 					= "";
    $jenis    				= "";
		$kasir 						= "";
		if(isset($_POST['submit']) ){
			$dari 		= $this->input->post('dari');
			$sampai 	= $this->input->post('sampai');
			$jenis  	= $this->input->post('jenis');
			$kasir  	= $this->input->post('kasir');
			$data 	= array(
				'dari'	 			=> $dari,
				'sampai'	 		=> $sampai,
				'jenis'     	=> $jenis,
				'kasir'				=> $kasir
			);
			$this->session->set_userdata($data);
		}else{
			if($this->session->userdata('dari') != NULL){
				$dari = $this->session->userdata('dari');
			}

			if($this->session->userdata('sampai') != NULL){
				$sampai = $this->session->userdata('sampai');
			}
			if($this->session->userdata('jenis') != NULL){
				$jenis = $this->session->userdata('jenis');
			}
			if($this->session->userdata('kasir') != NULL){
				$kasir  = $this->session->userdata('kasir');
			}
		}

		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$data['kasir'] 					= $this->Model_keuangan->getKasir()->result();
		$data['profesi']				= $this->Model_keuangan->get_profesi($dari,$sampai,$jenis,$kasir);
		$data['tingkat3']				= $this->Model_keuangan->get_tingkat3($dari,$sampai,$jenis,$kasir);
		$data['tingkat4']				= $this->Model_keuangan->get_tingkat4($dari,$sampai,$jenis,$kasir);
		$data['karyawan']				= $this->Model_keuangan->get_karyawan($dari,$sampai,$jenis,$kasir);
		$data['sewa']						= $this->Model_keuangan->get_sewa($dari,$sampai,$jenis,$kasir);
		$data['parkir']					= $this->Model_keuangan->get_parkir($dari,$sampai,$jenis,$kasir);
		$data['iht']						= $this->Model_keuangan->get_iht($dari,$sampai,$jenis,$kasir);
		$data['kursus']					= $this->Model_keuangan->get_kursus($dari,$sampai,$jenis,$kasir);
		$data['lainlain']				= $this->Model_keuangan->get_lainlain($dari,$sampai,$jenis,$kasir);
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];

		$data['tahun_akademik']	= $ta;
		$data['dari']						= $dari;
		$data['sampai']					= $sampai;
		$data['jenis']					= $jenis;
		$data['ksr']						= $kasir;

		$this->template->display('keuangan/frm_laphistoribayar',$data);
	}

	function cetakbtk(){
		$nobukti  			= $this->uri->segment(3);
		$cek 						= $this->db->get_where('historibayar',array('nobukti'=>$nobukti))->row_array();
		if($cek['kode_registrasi']==""){
			$data['data'] = $cek;
		}else{
			$data['data'] = $this->Model_keuangan->get_btk($nobukti)->row_array();
		}
		$this->load->view('keuangan/btk',$data);
	}

	function surattagihan()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		$this->template->display('keuangan/frm_surattagihan',$data);
	}

	function loaddatatunggakan(){
		$ang 		 							= $this->input->post('ang');
		$tingkat 							= $this->input->post('tingkat');
		$kelas	 							= $this->input->post('kelas');
		$batastgl 						= $this->input->post('batastgl');
		$data['surat'] 				= $this->input->post('surat');
		$data['cetak0'] 			= $this->Model_keuangan->cetaklaporankelas_hp($ang,$tingkat,$kelas,$batastgl)->result();
		$this->load->view('keuangan/loaddatatunggakan',$data);
	}



	function cetaksurattagihan(){
		$koderegistrasi 		= $this->input->post('kodekontrak');
		$batastgl 					= $this->input->post('batastgl');
		$data['batas']			= $batastgl;
		$data['fullname'] 	= $this->access->get_fullname();
		$data['pilihsurat'] = $this->input->post('surat');
		$data['surat'] 			= $this->Model_keuangan->getSurat($data['pilihsurat'])->row_array();
		foreach ($koderegistrasi as $kode) {
			$tagihan[] = $this->Model_keuangan->cetaktagihanmhs($kode,$batastgl)->result_array();
		}
		$data['tagihan'] 		= $tagihan;
		if(isset($_POST['submit'])){
			$this->load->view('keuangan/cetak_surattagihan',$data);
		}
	}

	function rpt()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		$this->template->display('keuangan/frm_rpt',$data);
	}

	function cetakrpt()
	{
		$data['ta']			 			= $this->input->post('tahun_akademik');
		$data['rencana'] 			= $this->Model_keuangan->getRencana($data['ta'])->result_array();
		$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($data['ta'])->result_array();
		$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($data['ta'])->result_array();
		if(isset($_POST['export'])){
			// Fungsi header dengan mengirimkan raw data excel
			header("Content-type: application/vnd-ms-excel");
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=Laporan RPT.xls");
			$this->load->view('keuangan/cetak_rpt',$data);
		}else{
			$this->load->view('keuangan/cetak_rpt',$data);
		}

	}

	function rincianpembayaran($rowno=0)
	{
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
    $allcount 	  							= $this->Model_keuangan->getrecordPembayaran($nama_aplikan,$tahun_akademik,$tingkat);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataPembayaran($rowno,$rowperpage,$nama_aplikan,$tahun_akademik,$tingkat);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/pembayaran/';
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
		$data['nama_aplikan']		= $nama_aplikan;
		$data['tahun_akademik']	= $tahun_akademik;
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$this->template->display('keuangan/view_rincianpembayaran',$data);
	}

	function cetakrincianpmb()
	{
		$kodeaplikan  = $this->uri->segment(3);
		$data['ren1'] = $this->Model_keuangan->getren($kodeaplikan,1)->result();
		$data['hb1']  = $this->Model_keuangan->get_historibayartk($kodeaplikan,1)->result();
		$data['ren2'] = $this->Model_keuangan->getren($kodeaplikan,2)->result();
		$data['hb2']  = $this->Model_keuangan->get_historibayartk($kodeaplikan,2)->result();
		$data['ren3'] = $this->Model_keuangan->getren($kodeaplikan,3)->result();
		$data['hb3']  = $this->Model_keuangan->get_historibayartk($kodeaplikan,3)->result();
		$data['ren4'] = $this->Model_keuangan->getren($kodeaplikan,4)->result();
		$data['hb4']  = $this->Model_keuangan->get_historibayartk($kodeaplikan,4)->result();
		$data['mhs']  = $this->Model_keuangan->getMhs($kodeaplikan)->row_array();
		$this->load->view('keuangan/cetak_rincianpmb',$data);
	}

	function surat(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['surat']		= $this->Model_keuangan->getredaksisurat()->result();
		$this->template->display('keuangan/view_surat', $data);
	}

	function editsurat(){
		$kode 						= $this->uri->segment(3);
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['surat']		= $this->Model_keuangan->getsurat($kode)->row_array();
		$this->template->display('keuangan/edit_surat',$data);
	}

	function updatesurat(){
		$kode_surat = $this->input->post('kode_surat');
		$this->Model_keuangan->updatesurat($kode_surat);
	}

	function editregistrasi()
	{
		$kodereg 						= $this->uri->segment(3);
		$data['id']					= $kodereg;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$reg 								= $this->Model_keuangan->getreg($kodereg)->row_array();
		$data['reg']				= $reg;
		$this->template->display('keuangan/edit_registrasi',$data);
	}

	function updateregis()
	{
		$this->Model_keuangan->update_regis();
	}

	function editrencana2(){
		$kode_registrasi 		= $this->uri->segment(3);
		$conf 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 		= $conf['ta_mkt'];
		$data['ta']					= $tahun_akademik;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['aplikan']		= $this->Model_keuangan->get_reg($kode_registrasi)->row_array();
		$data['ren']				= $this->Model_keuangan->get_ren2($kode_registrasi)->result();
		// echo json_encode($data['ren']);
		// die;
		$data['ren2']				= $this->Model_keuangan->get_rentemp($kode_registrasi)->result();
		$this->template->display('keuangan/edit_rencana2',$data);
	}

	function updaterencana2(){
		$this->Model_keuangan->updaterencana2();
	}

	function pembayaranlain($rowno=0)
	{

		$dari					= "";
		$sampai 			= "";
    $terimadari 	= "";
		if(isset($_POST['submit'])){
      $dari 						= $this->input->post('dari');
			$sampai 					= $this->input->post('sampai');
			$terimadari   		= $this->input->post('terimadari');
			$data = array
			(
				'dari'						=> $dari,
				'sampai'					=> $sampai,
				'terimadari' 			=> $terimadari
			);
      	$this->session->set_userdata($data);
    }else{
			if($this->session->userdata('dari') != NULL){
      	$dari = $this->session->userdata('dari');
    	}
			if($this->session->userdata('sampai') != NULL){
      	$sampai = $this->session->userdata('sampai');
    	}

			if($this->session->userdata('terimadari') != NULL){
      	$terimadari = $this->session->userdata('terimadari');
    	}
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordPenerimaanlain($dari,$sampai,$terimadari);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataPenerimaanlain($rowno,$rowperpage,$dari,$sampai,$terimadari);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/penerimaanlain';
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
		$jam 									= date("H:i:s");
		//$jam = "15:00:01";
		$jam2 								= "15:00:00";
		$tglnyunyu 						= date("Y-m-d");
		$tglnyonyo 						= date('Y-m-d', strtotime('+1 days', strtotime($tglnyunyu)));
		if($jam > $jam2){
			$tglmeng = $tglnyonyo;
		}else{
			$tglmeng = $tglnyunyu;
		}

		$data['tglmeng']				= $tglmeng;
		$data['pagination']			= $this->pagination->create_links();
		$data['result'] 				= $users_record;
		$data['row'] 						= $rowno;
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['totaldata']			= $allcount;
		$data['dari']						= $dari;
		$data['sampai']					= $sampai;
		$data['terimadari']     = $terimadari;
		$this->template->display('keuangan/view_penerimaanlain',$data);
	}
	function insertlainlain()
	{
		$this->Model_keuangan->insertlainlain();
	}

	function editpenerimanlain()
	{
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$nobukti  				= $this->uri->segment(3);
		$data['jenis']    = $this->uri->segment(4);
		$data['hb']				= $this->Model_keuangan->getHB($nobukti)->row_array();
		$this->load->view('keuangan/edit_penerimaanlain',$data);
	}

	function updatelainlain()
	{
		$this->Model_keuangan->updatelainlain();
	}

	function hapuspenerimaanlain(){
		$nobukti 	= $this->uri->segment(3);
		$this->Model_keuangan->hapuspenerimaanlain($nobukti);
	}

	function inqVA()
	{
		$data['inqva'] = $this->Model_keuangan->inqVA();
		$this->load->view('keuangan/va_inquiry',$data);
	}

	function createva()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		$this->template->display('keuangan/frm_createva',$data);
	}

	function loadtunggakanva(){
		$ang 		 							= $this->input->post('ang');
		$tingkat 							= $this->input->post('tingkat');
		$kelas	 							= $this->input->post('kelas');
		$batastgl 						= $this->input->post('batastgl');
		$data['surat'] 				= $this->input->post('surat');
		$data['cetak0'] 			= $this->Model_keuangan->getTagihanVA($ang,$tingkat,$kelas,$batastgl)->result();
		$this->load->view('keuangan/loadtunggakanva',$data);
	}

	function insertcreateva()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['va'] 					  = $this->Model_keuangan->createva();
		$this->template->display('keuangan/va_cek',$data);
		// var_dump($data['va']);
	}

	function valist()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$data['ta']							= $this->Model_marketing->listTahunakademik()->result();
		$conf 									= $this->users_model->get_conf()->row_array();
		$ta 										=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		$this->template->display('keuangan/va_list',$data);
	}

	function loadlistva(){
		$ang 		 							= $this->input->post('ang');
		$tingkat 							= $this->input->post('tingkat');
		$kelas	 							= $this->input->post('kelas');
		$data['cetak0'] 			= $this->Model_keuangan->listva($ang,$tingkat,$kelas)->result();
		$this->load->view('keuangan/va_loadlist',$data);
	}

	function editva()
	{
		$kodereg = $this->input->post('kodereg');
		$data['va'] = $this->Model_keuangan->getVA($kodereg)->row_array();
		$this->load->view('keuangan/va_edit',$data);
	}

	function updateva()
  	{
    	$updateva = $this->Model_keuangan->updateva();
		echo $updateva;
  	}

	function hapusva()
	{
		$va = $this->uri->segment(3);
		$hapus = $this->Model_keuangan->hapusva($va);
		echo $hapus;
	}

	function pembayaranva()
	{
		// $idbtn    = 'LP3IWS';
		// $key      = 'iJFIBfdfAk4wEt8rFkTl2swQfiNxnUSl';
		// $secret   = '4buAMLwFUy';
		// $body     = "";
		// $string   = $idbtn.":".$body.":".$key;
		// $sig      = hash_hmac('sha256', $string, $secret);

		//echo $sig;
		//die;
		//$tanggal    = "";
		// if(isset($_POST['submit'])){
    //   $tanggal = $this->input->post('tanggal');
		// 	$data = array
		// 	(
		// 		'tanggal'					=> $tanggal
		// 	);
    //   $this->session->set_userdata($data);
    // }else{
		// 	if($this->session->userdata('tanggal') != NULL){
    //   	$tanggal = $this->session->userdata('tanggal');
    // 	}
    // }
		//$data['tanggal'] 	= $tanggal;
		$data['va'] 			= $this->Model_keuangan->getpembayaranVA();
		var_dump($data['va']);

	}

	function danapinjaman($rowno=0)
	{
		$conf 						= $this->users_model->get_conf()->row_array();
		$namamhs 					= "";
		$tahun_akademik 	= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
      $namamhs 					= $this->input->post('namamhs');
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'namamhs' 				=> $namamhs,
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('namamhs') != NULL){
        $namamhs = $this->session->userdata('namamhs');
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
    $allcount 	  							= $this->Model_keuangan->getrecordDanapinjaman($namamhs);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataDanapinjaman($rowno,$rowperpage,$namamhs);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/regisjunior';
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

    $data['pagination']				= $this->pagination->create_links();
    $data['result'] 				= $users_record;
    $data['row'] 					= $rowno;
	$data['username'] 				= $this->access->get_username();
	$data['fullname'] 				= $this->access->get_fullname();
	$data['level']	  				= $this->access->get_level();
	$data['totaldata']				= $allcount;
	$data['namamhs']				= $namamhs;
	$data['tahun_akademik']			= $tahun_akademik;
	$menu1 							= "registrasi";
	$data['mn1']					= $this->Model_menu->get_menu($menu1)->result();
	$data['ta']						= $this->Model_marketing->listTahunakademik()->result();
	$this->template->display('keuangan/danapinjaman_view',$data);
	}

	function cekmail()
	{
		$nobukti  	= $this->uri->segment(3);
		$noregis    = $this->uri->segment(4);
		$data['kw'] = $this->Model_keuangan->cetakkwitansi1($nobukti)->row_array();
		$this->load->view('keuangan/sendMail',$data);
	}
	function sendMail() {
	//$this->load->view('keuangan/sendMail');
	$nobukti  	= $this->uri->segment(3);
	$data['kw'] = $this->Model_keuangan->cetakkwitansi1($nobukti)->row_array();
	$kodekontrak= $this->uri->segment(4);
	$reg        = $this->Model_keuangan->get_reg($kodekontrak)->row_array();
	$emailtujuan= $reg['email'];
    $ci = get_instance();
    $ci->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = '465';//465
    $config['smtp_user'] = 'orienpsd@gmail.com';
    $config['smtp_pass'] = 'Egieramdan1';
    $config['charset'] = 'utf-8';
    $config['mailtype'] = 'html';
    // $config['newline'] = "\r\n";
		$ci->email->initialize($config);
		$ci->email->set_newline("\r\n");
		$body = $ci->load->view('keuangan/sendmail',$data,TRUE);
    $ci->email->from('orienpsd@gmail.com', 'FINANCE LP3I');
    $list = array($emailtujuan);
    $ci->email->to($list);
    $ci->email->subject('Kwitansi Pembayaran');
    $ci->email->message($body);
    if ($this->email->send()) {
			$this->session->set_flashdata('msg',
     '<div class="card bg-c-green order-card">
       <div class="card-block">
         <h6><i class="ti-check"></i>Email Has Been Sent !</h6>
       </div>
     </div>');
      redirect('keuangan/detail/'.$kodekontrak);
    } else {
      show_error($this->email->print_debugger());
    }
  }

	function sendMail2() {
		$config = Array(
      'protocol' 			=> 'sendmail',
      'smtp_host' 		=> 'your domain SMTP host',
      'smtp_port' 		=> 25,
      'smtp_user' 		=> 'SMTP Username',
      'smtp_pass' 		=> 'SMTP Password',
      'smtp_timeout' 	=> '4',
      'mailtype' 			=> 'html',
      'charset' 			=> 'iso-8859-1'
    );

    $this->load->library('email', $config);
  	$this->email->set_newline("\r\n");
    $this->email->from('your mail id', 'Anil Labs');
    $data = array(
      'userName'=> 'Anil Kumar Panigrahi'
    );
    $this->email->to($userEmail); // replace it with receiver mail id
  	$this->email->subject($subject); // replace it with relevant subject
    $body = $this->load->view('emails/anillabs.php',$data,TRUE);
  	$this->email->message($body);
    $this->email->send();
  }

	// function send() {
	// 	/* panggil library PHPMailerAutoload.php */
	// 	$this->load->library("PHPMailerAutoload.php");
	//
	// 	$mail = new PHPMailer();
	//
	// 	/* setting SMTP */
	// 	$mail->isSMTP();
	// 	$mail->Host = "mx.dapurhosting.com"; //sesuaikan dengan host email anda
	// 	$mail-Port = "2525"; //sesuaikan port
	// 	$mail->SMTPAuth = true;
	// 	$mail->Username = "admin@andiaditya.com"; //sesuai dengan username yang digunakan
	// 	$mail->Password = "password-anda";
	// 	$mail->WordWrap = 50;
	//
	// 	$mail->setFrom("freelancer.andi@gmail.com", "Andi Aditya"); //setting pengirim email
	// 	$mail->addAdress("admin@andiaditya.net"); //alamat email yang dituju
	// 	$mail->Subject = "Test Kirim email menggunakan PHPMailer"; //subject
	// 	$mail->Body = "Email berhasil "; //isi pesan
	//
	// 	$mail->send();
	// }

	function emailSend(){
		$this->load->library("Phpmailer_lib");
		$mail = $this->phpmailer_lib->load();

		//SMTP configuration
    $mail->isSMTP();
    $mail->Host     	= 'smtp.gmail.com';
    $mail->SMTPAuth 	=  true;
    $mail->Username 	= 'adamabdi.al.a@gmail.com';
    $mail->Password 	= 'multimedia2';
    $mail->SMTPSecure = 'ssl';
    $mail->Port     	= 465;

    $mail->setFrom('adamabdi.al.a@gmail.com', 'CodexWorld');
    //$mail->addReplyTo('info@example.com', 'CodexWorld');

    // Add a recipient
    $mail->addAddress('ganjarramdan92@gmail.com');

    // // Add cc or bcc
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Email subject
    $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
        <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
    $mail->Body = $mailContent;

    // Send email
    if(!$mail->send()){
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        echo 'Message has been sent';
    }

  }

	function ubahnim()
	{
		$kodeaplikan 				= $this->input->post('kodeaplikan');
		$data['tingkat']     		= $this->input->post('tingkat');
		$data['halaman'] 		 	= $this->input->post('halaman');
		$data['mhs']         		= $this->Model_keuangan->getMhs($kodeaplikan)->row_array();
		$this->load->view('keuangan/ubah_nim',$data);
	}


	function updatenim()
	{
		$this->Model_keuangan->updatenim();
	}

	function detaildanapinjaman()
	{
		$data['username'] 			= $this->access->get_username();
		$data['fullname'] 			= $this->access->get_fullname();
		$data['level']	  			= $this->access->get_level();
		$kode_aplikan 				= $this->uri->segment(3);
		$jam 						= date("H:i:s");
		//$jam = "15:00:01";
		$jam2 						= "15:00:00";
		$tglnyunyu 					= date("Y-m-d");
		$tglnyonyo 					= date('Y-m-d', strtotime('+1 days', strtotime($tglnyunyu)));
		if($jam > $jam2){
			$tglmeng = $tglnyonyo;
		}else{
			$tglmeng = $tglnyunyu;
		}

		$data['tglmeng']			= $tglmeng;
		$data['listpinjaman'] 		= $this->Model_keuangan->getListPinjaman($kode_aplikan)->result();
		$data['aplikan']			= $this->Model_marketing->getAplikan($kode_aplikan)->row_array();
		$data['historipnj']  		= $this->Model_keuangan->getHistoribayarpinjaman($kode_aplikan)->result();
		$this->template->display('keuangan/danapinjaman_detail',$data);
	}

	function updateemail()
	{
		$this->Model_keuangan->updateemail();
	}

	function lapomset()
	{
		$data['username'] 				= $this->access->get_username();
		$data['fullname'] 				= $this->access->get_fullname();
		$data['level']	  				= $this->access->get_level();
		$data['tingkat'] 				= $this->Model_keuangan->getTingkat()->result();
		$data['kampus'] 				= $this->Model_keuangan->getKampus()->result();
		$data['kampus'] 				= $this->Model_keuangan->getKampus()->result();
		$data['ta']						= $this->Model_marketing->listTahunakademik()->result();
		$conf 							= $this->users_model->get_conf()->row_array();
		$ta 							=	$conf['ta_mkt'];
		$data['tahun_akademik']	= $ta;
		$this->template->display('keuangan/frm_lapomset',$data);
	}

	function cetak_omsetf5()
	{
		$data['ta']			 			= $this->input->post('tahun_akademik');
		// $tingkat						  = $this->input->post('tingkat');
		// if($tingkat==1)
		// {
		// 	$t = 'Junior';
		// }else if($tingkat==2)
		// {
		// 	$t = 'Senior';
		// }else if($tingkat==3)
		// {
		// 	$t = 'Tingkat III';
		// }else if($tingkat==4)
		// {
		// 	$t = 'Tingkat IV';
		// }
		//
		// $data['tingkat'] 			= $t;
		$kampus	= $this->input->post('kampus');
		if($kampus =='LP3I'){
			$k = 'PROFESI';
		}else{
			$k = $kampus;
		}
		$data['kampus'] = $k;
		$data['registrasi'] = $this->Model_keuangan->getbayarregis($data['ta'],$kampus)->result();

		if($kampus=='LP3I')
		{
			$this->load->view('keuangan/cetak_omsetf5profesi',$data);
		}else if($kampus=='POLTEK'){
			$this->load->view('keuangan/cetak_omsetf5poltek',$data);
		}else{
			$this->load->view('keuangan/cetak_omsetf5tigaempat',$data);
		}

	}

	function form5()
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
		$this->template->display('keuangan/frm_form5',$data);
	}

	function cetak_form5()
	{
		$data['conf'] 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 						= $this->input->post('tahun_akademik');
		$data['potensiomset']				= $this->Model_keuangan->PotensiOmset($tahun_akademik)->result();
		$data['ta']									= $tahun_akademik;
		$this->load->view('keuangan/cetak_form5',$data);
	}

	function potensiomset()
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
		$this->template->display('keuangan/frm_potensiomset',$data);
	}

	function cetak_potensiomset()
	{
		$data['conf'] 							= $this->users_model->get_conf()->row_array();
		$tahun_akademik 						= $this->input->post('tahun_akademik');
		$data['potensiomset']				= $this->Model_keuangan->PotensiOmset2($tahun_akademik)->result();
		$data['ta']									= $tahun_akademik;
		$this->load->view('keuangan/cetak_potensiomset',$data);

	}

	function target()
	{
		$conf 										= $this->users_model->get_conf()->row_array();
		$tahun_akademik 					= $conf['ta_mkt'];
		if(isset($_POST['submit'])){
			$tahun_akademik 	= $this->input->post('tahun_akademik');
			$data = array
			(
				'tahun_akademik'	=> $tahun_akademik
			);
      $this->session->set_userdata($data);
    }else{


			if($this->session->userdata('tahun_akademik') != NULL){
        $tahun_akademik = $this->session->userdata('tahun_akademik');
      }
    }


		$data['username'] 				= $this->access->get_username();
		$data['fullname'] 				= $this->access->get_fullname();
		$data['level']	  				= $this->access->get_level();
		$data['tk']								= $this->Model_keuangan->getTingkat()->result();
		$data['tahun_akademik']		= $tahun_akademik;
		$data['ta']								= $this->Model_keuangan->listTahunakademik()->result();
		$data['target']						= $this->Model_keuangan->getTarget($tahun_akademik)->result();
		$this->template->display('keuangan/view_target',$data);
	}

	function inserttarget()
	{
		$this->Model_keuangan->inserttarget();
	}

	function dp3($rowno=0)
	{
		$namakaryawan 		= "";
		$tahun 						= "";
		$semester 				= "";

		if(isset($_POST['submit'])){
      $namakaryawan 		= $this->input->post('namakaryawan');
			$tahun 						= $this->input->post('tahun');
			$semester 				= $this->input->post('semester');
			$data = array
			(
				'namakaryawan' 		=> $namakaryawan,
				'tahun'						=> $tahun,
				'semester'				=> $semester
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('namakaryawan') != NULL){
        $namakaryawan = $this->session->userdata('namakaryawan');
      }

			if($this->session->userdata('tahun') != NULL){
        $tahun = $this->session->userdata('tahun');
			}

			if($this->session->userdata('semester') != NULL){
        $semester = $this->session->userdata('semester');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordDP3($namakaryawan,$tahun,$semester);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataDP3($rowno,$rowperpage,$namakaryawan,$tahun,$semester);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/dp3';
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
		$data['namakaryawan']		= $namakaryawan;
		$data['tahun']					= $tahun;
		$data['semester']				= $semester;
		$this->template->display('keuangan/view_dp3',$data);

	}

	function inputdp3()
	{
		$data['username'] 				= $this->access->get_username();
		$data['fullname'] 				= $this->access->get_fullname();
		$data['level']	  				= $this->access->get_level();
		$data['setdp3']						= $this->Model_keuangan->getSetDP3()->row_array();
		$this->template->display('keuangan/input_dp3',$data);
	}

	function karyawan($rowno=0)
	{

		$nama_karyawan 		= "";
		if(isset($_POST['submit'])){
      $nama_karyawan 		= $this->input->post('nama_karyawan');
			$data = array
			(
				'nama_karyawan' 		=> $nama_karyawan,
			);
      $this->session->set_userdata($data);
    }else{
      if($this->session->userdata('nama_karyawan') != NULL){
        $nama_karyawan = $this->session->userdata('nama_karyawan');
      }
    }
		// Row per page
    $rowperpage = 10;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }

		// All records count
    $allcount 	  							= $this->Model_keuangan->getrecordKaryawan($nama_karyawan);
    // Get records
    $users_record 							= $this->Model_keuangan->getDataKaryawan($rowno,$rowperpage,$nama_karyawan);
	// Pagination Configuration
    $config['base_url'] 				= base_url().'keuangan/karyawan';
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
		$data['nama_karyawan']	= $nama_karyawan;
		$this->template->display('keuangan/karyawan_view',$data);
	}

	function inputkaryawan()
	{

		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['divisi']		= $this->Model_keuangan->getDivisi()->result();
		$data['bulan']		= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$this->template->display('keuangan/karyawan_input',$data);

	}


	function insert_karyawan()
	{
		$this->Model_keuangan->insert_karyawan();
	}

	function editkaryawan()
	{
		$nik 							= $this->uri->segment(3);
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['karyawan']	= $this->Model_keuangan->getKaryawan($nik)->row_array();
		$data['divisi']		= $this->Model_keuangan->getDivisi()->result();
		$data['bulan']		= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$this->template->display('keuangan/karyawan_edit',$data);

	}

	function update_karyawan()
	{
		$this->Model_keuangan->update_karyawan();
	}


	function hapuskaryawan()
	{
		$nik = $this->uri->segment(3);
		$this->Model_keuangan->hapuskaryawan($nik);
	}

	function listkaryawan()
	{
		$data['karyawan'] = $this->Model_keuangan->listkaryawan()->result();
		$this->load->view('keuangan/karyawan_list',$data);
	}

	function getdp3()
	{
		$simpandp3 = $this->Model_keuangan->simpandp3();
		if($simpandp3==1){
			$nik 		= $this->input->post('nik');
			$smt 		= $this->input->post('smt');
			$tahun 	= $this->input->post('tahun');
			$thn 		= substr($tahun,2,2);
			$data['iddp3'] 	= $thn.$nik.$smt;
			$data['evaluasi'] = $this->Model_keuangan->getEvaluasiDp3($data['iddp3'])->row_array();
			$data['dp3'] 		= $this->Model_keuangan->getPertanyaandp3()->result();
			$this->load->view('keuangan/dp3_penilaian',$data);
		}else{
			echo "1";
		}
	}

	function simpanjawabandp3()
	{
		$simpan = $this->Model_keuangan->simpanjawabandp3();
	}

	function simpanevaluasidp3()
	{
		$this->Model_keuangan->simpanevaluasidp3();
	}

	function cetakdp3()
	{
		$iddp3 = $this->uri->segment(3);
		$data['dp3'] = $this->Model_keuangan->getdp3($iddp3)->row_array();
		$data['evaluasi'] = $this->Model_keuangan->getEvaluasiDp3($iddp3)->row_array();
		$data['q'] 	 = $this->Model_keuangan->getPertanyaandp3()->result();
		$data['iddp3'] = $iddp3;
		$this->load->view('keuangan/cetak_dp3',$data);

	}

	function hapusdp3()
	{
		$iddp3 = $this->uri->segment(3);
		$this->Model_keuangan->hapusdp3($iddp3);
	}

}
