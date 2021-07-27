<?php
error_reporting(0);
class Dashboard extends MY_Core{
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_dashboard','Model_marketing','Model_keuangan'));
  }

	function index(){
		$conf 						= $this->users_model->get_conf()->row_array();
		$tahun_akademik 	= $conf['ta_mkt'];
		$ta_pdd 					= $conf['ta_pdd'];

		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['ta'] 			= $ta_pdd;
		$data['ta_mkt'] 	= $tahun_akademik;
		if($data['level']=='marketing')
		{
			$ta 							= explode("/",$tahun_akademik);
			$talast1 					= $ta[0]-1;
			$talast2					= $ta[1]-1;
			$kodereg 					= 'T00001';
			$kodeomset 				= 'T00002';
			$data['ta_last']  = $talast1."/".$talast2;
			$data['ta_mkt']		= $tahun_akademik;
			$data['user']			= $this->Model_dashboard->getUser($data['username'])->row_array();
			$data['presenter']= $this->Model_dashboard->getListPresenter($tahun_akademik)->result();
			$data['grafikreg']= $this->Model_marketing->getGrafikReg($tahun_akademik,$data['ta_last'])->result();
			$this->template->display('marketing/dashboard_marketing',$data);
		}else if($data['level']=='presenter'){
			error_reporting(0);
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
			$data['user']			= $this->Model_dashboard->getUser($data['username'])->row_array();
			$data['presenter']= $this->Model_dashboard->getListPresenter($tahun_akademik)->result();
			$data['grafikreg']= $this->Model_marketing->getGrafikReg($tahun_akademik,$data['ta_last'])->result();
			$data['regis']		= $this->Model_marketing->getrecordregis($tahun_akademik)->num_rows();
			$data['omset']		= $this->Model_marketing->getOmset($tahun_akademik)->row_array();
			$data['treg']			= $this->Model_marketing->getAllTarget($tahun_akademik,$kodereg)->row_array();
			$data['tomset']		= $this->Model_marketing->getAllTarget($tahun_akademik,$kodeomset)->row_array();
			$this->template->displaypresenter('marketing/dashboard_presenter',$data);
		}else if($data['level']=='admin'){
			$this->template->display('dashboard',$data);
		}else if($data['level']=='kasir'){
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
			$data['junior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=1)->num_rows();
			$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($tahun_akademik)->num_rows();
			$data['njunior']  = $this->Model_keuangan->getJmlregis($tahun_akademik,$tingkat=1)->num_rows();
			$data['senior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=2)->num_rows();
			$data['t3']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=3)->num_rows();
			$data['t4']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=4)->num_rows();
			$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$ta_pdd);
			$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
			$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
			$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
			$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
			$data['listkasir']  = $this->Model_keuangan->listkasir()->result();
			//rpt
			$data['rencana'] 			= $this->Model_keuangan->getRencana($ta_pdd)->result_array();
			$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($ta_pdd)->result_array();
			$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($ta_pdd)->result_array();
			$this->template->display('keuangan/dashboard_kasir',$data);
		}else if($data['level']=='keuangan'){
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
			$data['junior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=1)->num_rows();
			$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($tahun_akademik)->num_rows();
			$data['njunior']  = $this->Model_keuangan->getJmlregis($tahun_akademik,$tingkat=1)->num_rows();
			$data['senior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=2)->num_rows();
			$data['t3']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=3)->num_rows();
			$data['t4']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=4)->num_rows();
			$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$ta_pdd);
			$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
			$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
			$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
			$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
			$data['listkasir']  = $this->Model_keuangan->listkasir()->result();
			//rpt
			$data['rencana'] 			= $this->Model_keuangan->getRencana($ta_pdd)->result_array();
			$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($ta_pdd)->result_array();
			$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($ta_pdd)->result_array();
			$this->template->display('keuangan/dashboard_kasir',$data);
		}else if($data['level']=='cnp'){
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
			$data['junior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=1)->num_rows();
			$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($tahun_akademik)->num_rows();
			$data['njunior']  = $this->Model_keuangan->getJmlregis($tahun_akademik,$tingkat=1)->num_rows();
			$data['senior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=2)->num_rows();
			$data['t3']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=3)->num_rows();
			$data['t4']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=4)->num_rows();
			$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$ta_pdd);
			$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
			$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
			$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
			$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
			$data['listkasir']  = $this->Model_keuangan->listkasir()->result();
			//rpt
			$data['rencana'] 			= $this->Model_keuangan->getRencana($ta_pdd)->result_array();
			$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($ta_pdd)->result_array();
			$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($ta_pdd)->result_array();
			$this->template->display('cnp/dashboard_cnp',$data);
		}else if($data['level']=='pendidikan'){
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
			$data['junior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=1)->num_rows();
			$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($tahun_akademik)->num_rows();
			$data['njunior']  = $this->Model_keuangan->getJmlregis($tahun_akademik,$tingkat=1)->num_rows();
			$data['senior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=2)->num_rows();
			$data['t3']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=3)->num_rows();
			$data['t4']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=4)->num_rows();
			$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$ta_pdd);
			$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
			$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
			$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
			$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
			$data['listkasir']  = $this->Model_keuangan->listkasir()->result();
			//rpt
			$data['rencana'] 			= $this->Model_keuangan->getRencana($ta_pdd)->result_array();
			$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($ta_pdd)->result_array();
			$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($ta_pdd)->result_array();
			$this->template->display('cnp/dashboard_cnp',$data);
		}else if($data['level']=='ict'){
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
			$data['junior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=1)->num_rows();
			$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($tahun_akademik)->num_rows();
			$data['njunior']  = $this->Model_keuangan->getJmlregis($tahun_akademik,$tingkat=1)->num_rows();
			$data['senior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=2)->num_rows();
			$data['t3']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=3)->num_rows();
			$data['t4']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=4)->num_rows();
			$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$ta_pdd);
			$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
			$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
			$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
			$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
			$data['listkasir']  = $this->Model_keuangan->listkasir()->result();
			//rpt
			$data['rencana'] 			= $this->Model_keuangan->getRencana($ta_pdd)->result_array();
			$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($ta_pdd)->result_array();
			$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($ta_pdd)->result_array();
			$this->template->display('cnp/dashboard_cnp',$data);
		}else if($data['level']=='bm'){
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
			$data['junior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=1)->num_rows();
			$data['apdaftar'] = $this->Model_marketing->getStatApDaftar($tahun_akademik)->num_rows();
			$data['njunior']  = $this->Model_keuangan->getJmlregis($tahun_akademik,$tingkat=1)->num_rows();
			$data['senior']   = $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=2)->num_rows();
			$data['t3']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=3)->num_rows();
			$data['t4']   		= $this->Model_keuangan->getJmlregis($ta_pdd,$tingkat=4)->num_rows();
			$data['bjunior']  = $this->Model_keuangan->getrecordBelumRegisJunior($nama_aplikan="",$ta_pdd);
			$data['bsenior']  = $this->Model_keuangan->getrecordBelumRegisSenior($nama_aplikan="",$ta_senior);
			$data['bt3']  		= $this->Model_keuangan->getrecordBelumRegisT3($nama_aplikan="",$ta_t3);
			$data['bt4']  		= $this->Model_keuangan->getrecordBelumRegisT4($nama_aplikan="",$ta_t4);
			$data['rekapkasir'] = $this->Model_keuangan->getrekapkasir();
			$data['listkasir']  = $this->Model_keuangan->listkasir()->result();
			//rpt
			$data['rencana'] 			= $this->Model_keuangan->getRencana($ta_pdd)->result_array();
			$data['realisasi'] 	  = $this->Model_keuangan->getRealisasi($ta_pdd)->result_array();
			$data['tunggakan'] 	  = $this->Model_keuangan->getTunggakan($ta_pdd)->result_array();
			$this->template->display('cnp/dashboard_cnp',$data);
		}

	}



}
