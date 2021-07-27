<?php
use GuzzleHttp\Client;
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_keuangan extends CI_Model
{

  private $_client;

  public function __construct()
  {
    $this->_client = new Client([
      'base_uri' => 'https://vabtn.btn.co.id:9022/v1/lp3i/',
      'verify'   => false
    ]);

  }

  function inqva()
  {
    $va    = $this->input->post('va');
    $ref   = rand(0,1000000000000);
    $data = array(
      'ref' => "$ref",
      'va'  => $va
    );
    $idbtn    = 'LP3IWS';
    $key      = 'iJFIBfdfAk4wEt8rFkTl2swQfiNxnUSl';
    $secret   = '4buAMLwFUy';
    $body     = json_encode($data);
    $string   = $idbtn.":".$body.":".$key;
    $sig      = hash_hmac('sha256', $string, $secret);
    $response = $this->_client->request('POST','inqva',[
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded',
        'id'           => $idbtn,
        'key'          => $key,
        'signature'    => $sig
      ],
      'form_params' => $data


    ]);
    $result = json_decode($response->getBody()->getContents(),true);
    //$result = $response->getBody()->getContents();
    return $result;
  }

  function getpembayaranVA()
  {
    //https://vabtn-dev.btn.co.id:9021/v1/lp3i/report
    $tanggal  = array('ref'=>'1233311122','va'=>'948279022010030004');
    $idbtn    = 'LP3IWS';
    $key      = 'iJFIBfdfAk4wEt8rFkTl2swQfiNxnUSl';
    $secret   = '4buAMLwFUy';
    $body     = json_encode($tanggal);
    $string   = $idbtn.":".$body.":".$key;
    $sig      = hash_hmac('sha256', $string, $secret);
    $response = $this->_client->request('GET','report/31012020',[
      'headers' => [
        'Content-Type' => 'application/json',
        'id'           => $idbtn,
        'key'          => $key,
        'signature'    => $sig
      ],



    ]);
    //$result = json_decode($response->getBody()->getContents(),true);
    $result = $response->getBody()->getContents();
    return $result;
  }
  function createva()
  {
    $data            = $this->input->post('data');
    $koderegistrasi  = $this->input->post('kodekontrak');
    $nim             = $this->input->post('nim');
    $va              = $this->input->post('va');
    $namamhs         = $this->input->post('namamhs');
    $nohp            = $this->input->post('nohp');
    $sisatunggakan   = $this->input->post('sisatunggakan');
    $date            = $this->input->post('expiredate');
    $hariini         = date("Y-m-d");
    $createdate      = date("dmY", strtotime($hariini));
    $jamsekarang     = date("Hi");
    $ref             = rand(0,1000000000000);

    $idbtn            = 'LP3IWS';
    $key              = 'iJFIBfdfAk4wEt8rFkTl2swQfiNxnUSl';
    $secret           = '4buAMLwFUy';

    $success          = 0;
    $found            = 0;
    $error            = 0;

    foreach ($data as $index) {
      $expire  = date("ymd", strtotime($date[$index]));
      $kodereg = substr($koderegistrasi[$index],1,10);
      // echo $date[$index]."=>".$expire."2359";


      $data = array(

        "ref"         => "$ref",
        "va"          => $va[$index],
        "nama"        => $namamhs[$index],
        "layanan"     => "PEMBAYARAN",
        "kodelayanan" => $kodereg,
        "jenisbayar"  => "CICILAN",
        "kodejenisbyr"=> "920",
        "noid"        => $nohp[$index],
        "tagihan"     => $sisatunggakan[$index],
        "flag"        => "P",
        "reserve"     => "",
        "angkatan"    => "",
        "expired"     => $expire."2359",
        "description" => ""

        // "ref"           => $ref,
        // "rsp"           => "000",
        // "rspdesc"       => "Transaction Success.",
        // "va"            => $va[$index],
        // "nama"          => $namamhs[$index],
        // "layanan"       => "PEMBAYARAN",
        // "kodelayanan"   => "100001",
        // "jenisbayar"    => "CICILAN",
        // "kodejenisbyr"  => $koderegistrasi[$index],
        // "noid"          => $nohp[$index],
        // "tagihan"       => $sisatunggakan[$index],
        // "flag"          => "F",
        // "description"   => "Pembayaran Cicilan",
        // "terbayar"      => 0,
        // "expired"       => $expire,
        // "reserve"       => "",
        // "angkatan"      => "",
        // "createdate"    => $createdate,
        // "createtime"    => $jamsekarang
      );




      $body     = json_encode($data);
      $string   = $idbtn.":".$body.":".$key;
      $sig      = hash_hmac('sha256',$string,$secret);
      $response = $this->_client->request('POST','createVA',[

        'headers' => [
          'Content-Type' => 'application/x-www-form-urlencoded',
          'id'           => $idbtn,
          'key'          => $key,
          'signature'    => $sig
        ],

        'form_params' => $data


      ]);

      // echo $va[$index];
      //$result = json_decode($response->getBody()->getContents(),true);




      $result = $response->getBody()->getContents();
      $r      = json_decode($result,true);
      $rsp    = $r['rsp'];
      if($rsp === '006')
      {
        $ket   = "Data Sudah Ada";
        $cek     = $this->db->get_where('va',array('kode_registrasi'=>$koderegistrasi[$index]))->num_rows();
        if(empty($cek)){
          $datava = array(
            'kode_registrasi' => $koderegistrasi[$index],
            'va'              => $va[$index],
            'tagihan'         => $sisatunggakan[$index],
            'expiredate'      => $date[$index]." 23:59:59"
          );

          $simpanva = $this->db->insert('va',$datava);
          if($simpanva)
          {
            //$success = $success + 1;
          }
        }
        $found = $found + 1;
      }else if($rsp === '000')
      {
        $ket     = "VA Berhasil Dibuat";
        $cek     = $this->db->get_where('va',array('kode_registrasi'=>$koderegistrasi[$index]))->num_rows();
        if(empty($cek)){
          $datava = array(
            'kode_registrasi' => $koderegistrasi[$index],
            'va'              => $va[$index],
            'tagihan'         => $sisatunggakan[$index],
            'expiredate'      => $date[$index]." 23:59:59"
          );

          $simpanva = $this->db->insert('va',$datava);
          if($simpanva)
          {
            $success = $success + 1;
          }
        }

      }else{
        $ket   = "Error";
        $error = $error + 1;
      }

      $rspn[] = array(
        'va'               => $va[$index],
        'kode_registrasi'  => $koderegistrasi[$index],
        'nama'             => $namamhs[$index],
        'sisatunggakan'    => $sisatunggakan[$index],
        'expire'           => $date[$index]." 23.59.59",
        'ket'              => $ket
      );

      //return $result;
		}

    return $rspn;



  }
  function getJurusan()
  {
    return $this->db->get('master_jurusan');
  }

  function getTingkat()
  {
    return $this->db->get('tingkat');
  }

  function insertbiaya()
  {
    $tingkat        = $this->input->post('tingkat');
    $jurusan        = $this->input->post('jurusan');
    $biaya          = str_replace(".","",$this->input->post('biaya'));
    $tahun_akademik = $this->input->post('tahun')."/".$this->input->post('tahun2');
    $status         = $this->input->post('status');
    $ta_aktif       = substr($tahun_akademik,2,2);
    $cek            = $this->db->get_where('biaya',array('kode_jurusan'=>$jurusan,'tingkat'=>$tingkat,'tahun_akademik'=>$tahun_akademik,'status'=>$status))->num_rows();
    $kode_biaya     = $ta_aktif.$jurusan.'0'.$tingkat;
    // echo $kode_biaya;
    // die;
    $data = array
    (
      'kode_biaya'      => $kode_biaya,
      'tingkat'         => $tingkat,
      'kode_jurusan'    => $jurusan,
      'tahun_akademik'  => $tahun_akademik,
      'status'          => $status,
      'biaya'           => $biaya
    );
    if(empty($cek))
    {
      $simpan = $this->db->insert('biaya',$data);
      if($simpan)
      {
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
            </div>
          </div>');
  	    redirect('keuangan/databiaya');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Data Allready Exist !</h6>
          </div>
        </div>');
      redirect('keuangan/databiaya');
    }
  }

  function listTahunakademik()
  {
    $this->db->select('tahun_akademik');
    $this->db->from('biaya');
    $this->db->distinct('tahun_akademik');
    $this->db->order_by('tahun_akademik','DESC');
    return $this->db->get();
  }

  function getBiaya($tahun_akademik)
  {
    $this->db->select('kode_biaya,nama_jurusan,tingkat,biaya,tahun_akademik,status');
    $this->db->from('biaya');
    $this->db->join('master_jurusan','biaya.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('tahun_akademik',$tahun_akademik);
    $this->db->order_by('tingkat,biaya.kode_jurusan','ASC');
    return $this->db->get();
  }

  function getBiayaTingkat($ta,$jurusan,$tingkat)
  {
    $this->db->select('biaya,nama_tingkat');
    $this->db->from('biaya');
    $this->db->where('tahun_akademik',$ta);
    $this->db->where('biaya.kode_jurusan',$jurusan);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->join('tingkat','biaya.tingkat = tingkat.kode_tingkat');
    return $this->db->get();
  }

  function hapusbiaya($kode_biaya)
  {
    $hapus = $this->db->delete('biaya',array('kode_biaya'=>$kode_biaya));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Deleted !</h6>
          </div>
        </div>');
      redirect('keuangan/databiaya');
    }

  }

  function hapustarget($kode_target)
  {
    $hapus = $this->db->delete('konfigurasi_targetkeuangan',array('kode_target'=>$kode_target));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Has Been Deleted !</h6>
          </div>
        </div>');
      redirect('keuangan/target');
    }

  }

  function getDataBiaya($kode_biaya)
  {
    return $this->db->get_where('biaya',array('kode_biaya'=>$kode_biaya));
  }

  function updatebiaya()
  {


    $biaya          = str_replace(".","",$this->input->post('biaya'));
    $status         = $this->input->post('status');
    $kode_biaya     = $this->input->post('kode_biaya');
    // echo $kode_biaya;
    // die;
    $data = array
    (

      'status'          => $status,
      'biaya'           => $biaya
    );

    $simpan = $this->db->update('biaya',$data,array('kode_biaya'=>$kode_biaya));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/databiaya');
    }

  }

  public function getDataBelumRegisJunior($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    $this->db->select('aplikan_daftar.kode_aplikan,nama_lengkap,nama_jurusan,nama_presenter');
    $this->db->from('aplikan_daftar');
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('registrasi','aplikan_daftar.kode_aplikan = registrasi.kode_aplikan','LEFT');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_registrasi IS NULL');
    $this->db->order_by('tgl_daftar','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordBelumRegisJunior($nama_aplikan="",$tahun_akademik="")
  {
    $this->db->select('count(*) as allcount');
    $this->db->from('aplikan_daftar');
    $this->db->join('aplikan','aplikan_daftar.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    $this->db->join('registrasi','aplikan_daftar.kode_aplikan = registrasi.kode_aplikan','LEFT');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('tahun_akademik', $tahun_akademik);
  	}
    $this->db->where('tgl_registrasi IS NULL');
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }


  public function getDataBelumRegisSenior($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    if($nama_aplikan != ''){
    	$aplikan = " AND aplikan.nama_lengkap LIKE '%".$nama_aplikan."%' ";
  	}else{
      $aplikan = "";
    }
    if($tahun_akademik != ''){
      $ta = "AND aplikan.tahun_akademik = '".$tahun_akademik."' ";
  	}
    $q = "SELECT nim,mahasiswa.kode_aplikan,nama_lengkap,nama_jurusan,no_hp
          FROM mahasiswa
          INNER JOIN aplikan ON mahasiswa.kode_aplikan = aplikan.kode_aplikan
          INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
          WHERE NOT EXISTS
          (SELECT registrasi.kode_biaya,biaya.tingkat FROM registrasi
          INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
          WHERE registrasi.kode_aplikan = aplikan.kode_aplikan AND biaya.tingkat = '2')".$aplikan.$ta."ORDER BY nama_lengkap ASC LIMIT $rowno,$rowperpage";
 		//$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->query($q);
    return $query->result_array();
 	}

  public function getrecordBelumRegisSenior($nama_aplikan="",$tahun_akademik="")
  {
    if($nama_aplikan != ''){
    	$aplikan = " AND aplikan.nama_lengkap LIKE '%".$nama_aplikan."%' ";
  	}else{
      $aplikan = "";
    }
    if($tahun_akademik != ''){
      $ta = "AND aplikan.tahun_akademik = '".$tahun_akademik."' ";
  	}
    $q = "SELECT COUNT(*) as allcount
          FROM mahasiswa
          INNER JOIN aplikan ON mahasiswa.kode_aplikan = aplikan.kode_aplikan
          INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
          WHERE NOT EXISTS
          (SELECT registrasi.kode_biaya,biaya.tingkat FROM registrasi
          INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
          WHERE registrasi.kode_aplikan = aplikan.kode_aplikan AND biaya.tingkat = '2')".$aplikan.$ta;

    $query 	= $this->db->query($q);
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function get_biaya($kode_jurusan,$tingkat,$tahun_akademik,$status){
    return $this->db->get_where('biaya',array('kode_jurusan'=>$kode_jurusan,'tingkat'=>$tingkat,'tahun_akademik'=>$tahun_akademik,'status'=>$status));
  }

  function get_jurusan($status,$tingkat,$tahun_akademik){
    $this->db->select('biaya.kode_jurusan,nama_jurusan');
    $this->db->from('biaya');
    $this->db->join('master_jurusan','biaya.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('biaya.status',$status);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    return $this->db->get();
  }

  function insert_regisjunior(){
    $ta_mkt               = $this->input->post('ta_mkt');
    $kode_jurusan         = $this->input->post('kode_jurusan');
    $ta_aktif             = substr($ta_mkt,2,2);
    $regis                = "SELECT kode_registrasi FROM registrasi
                            INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                            WHERE tahun_akademik ='$ta_mkt' AND biaya.kode_jurusan = '$kode_jurusan' ORDER BY kode_registrasi DESC LIMIT 1 ";
                  
    $ceknolast            = $this->db->query($regis)->row_array();
    $kodeterakhir         = $ceknolast['kode_registrasi'];
    $kode_registrasi      = buatkode($kodeterakhir,'RE'.$ta_aktif.$kode_jurusan,3);
    //tambah xoxo
    $cekkoderegis  = $this->db->get_where('registrasi',array('kode_registrasi'=>$kode_registrasi))->num_rows();
    if(  $cekkoderegis != 0){
      $kode_registrasi  = buatkode($kode_registrasi ,'RE'.$ta_aktif.$kode_jurusan,3);
    }
    // echo    $kode_registrasi ;
    // die;
    //tambah xoxo
    $kode_aplikan         = $this->input->post('kode_aplikan');
  	$kodebiaya            = $this->input->post('kodebiaya');
  	$tglregis             = $this->input->post('tglregis');
  	$gelombang            = $this->input->post('gelombangregis');
  	$diskongelombang      = str_replace(".","",$this->input->post('potgel'));
  	$diskonprestasi       = str_replace(".","",$this->input->post('potpres'));
  	$diskoncash           = str_replace(".","",$this->input->post('potcash'));
  	$diskonlain           = str_replace(".","",$this->input->post('potlainlain'));
    $penyesuaian          = str_replace(".","",$this->input->post('penyesuaian'));
    // echo $penyesuaian;
    // die;
    $danapinjaman         = str_replace(".","",$this->input->post('danapinjaman'));
  	$hargadeal            = str_replace(".","",$this->input->post('hargadeal'));
  	$registrasi           = str_replace(".","",$this->input->post('jmlregis'));
  	$keterangan           = $this->input->post('keterangan');
    if(empty($dp)){
      $jenisregis           = 'REGULER';
    }else{
      $jenisregis           = "DANAPINJAMAN";
    }

    $rencanacicilan       = $this->input->post('jmlcicilan');
  	$cicilanper           = str_replace(".","",$this->input->post('cicilanper'));
  	$tglmulai             = $this->input->post('mulaicicilan');
    $tglreg               = date($tglmulai);
  	$tahun                = substr($tglreg,0,4);
  	$bulan                = substr($tglreg,5,2);
    $krg                  = mktime(0,0,0,date($bulan-1),date(10),date($tahun));
    $tglr                 = date("Y-m-d", $krg);
    $kelas                = $kode_jurusan."-01";
    $nim                  = $this->input->post('nim');

    $datareg  = array(
      'kode_registrasi'       => $kode_registrasi,
      'kode_aplikan'          => $kode_aplikan,
      'tgl_registrasi'        => $tglregis,
      'gelombang_registrasi'  => $gelombang,
      'kode_biaya'            => $kodebiaya,
      'pot_gelombang'         => $diskongelombang,
      'pot_prestasi'          => $diskonprestasi,
      'pot_cash'              => $diskoncash,
      'pot_lainlain'          => $diskonlain,
      'penyesuaian'           => $penyesuaian,
      'danapinjaman'          => $danapinjaman,
      'harga_deal'            => $hargadeal,
      'biaya_registrasi'      => $registrasi,
      'jml_cicilan'           => $rencanacicilan,
      'cicilanper'            => $cicilanper,
      'keterangan'            => $keterangan,
      'jenis_regis'           => $jenisregis,
      'kelas'                 => $kelas

    );

    $datadetailrencana = array(

      'kode_registrasi' => $kode_registrasi,
      'cicilanke'       => 0,
      'jatuh_tempo'     => $tglr,
      'wajib_bayar'     => $registrasi

    );

    $datamhs = array
    (
      'kode_aplikan'           => $kode_aplikan,
      'nim'                    => $nim,
      'status_akademik'        => 'Aktif'
    );

    $cekaplikanreg  = $this->db->get_where('registrasi',array('kode_aplikan'=>$kode_aplikan,'kode_biaya'=>$kodebiaya))->num_rows();
    if(empty($cekaplikanreg)){
      $simpanreg      = $this->db->insert('registrasi',$datareg);
      $simpanrencana  = $this->db->insert('detailrencana',$datadetailrencana);
      $simpanmhs      = $this->db->insert('mahasiswa',$datamhs);
      for ($i=1; $i<=$rencanacicilan; $i++)
      {

        $tambah = mktime(0,0,0,date($bulan),date(10),date($tahun));
        $tglkem = date("Y-m-d", $tambah);

        $datadetailrencana2 = array(

          'kode_registrasi' => $kode_registrasi,
          'cicilanke'       => $i,
          'jatuh_tempo'     => $tglkem,
          'wajib_bayar'     => $cicilanper
        );
        $simpanrencana2 = $this->db->insert('detailrencana',$datadetailrencana2);
        $bulan++;
      }

      if($simpanreg && $simpanrencana && $simpanmhs){
        redirect('keuangan/editrencana/'.$kode_registrasi);
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Data Sudah Ada !</h6>
          </div>
        </div>');
	    redirect('keuangan/regisjunior');
    }
  }

  function get_reg($id){
    $query = "SELECT kode_registrasi,registrasi.kode_aplikan,nama_lengkap,tempat_lahir,tgl_lahir,jenis_kelamin,asal_sekolah,email,
              nama_jurusan,nama_presenter,whatsapp,facebook,instagram,jenis_kelamin,gelombang_registrasi,tgl_registrasi,biaya,
              pot_gelombang,pot_prestasi,pot_cash,pot_lainlain,penyesuaian,danapinjaman,harga_deal,
              biaya_registrasi,jml_cicilan,cicilanper,keterangan,jenis_regis,registrasi.kelas,nim,biaya.tingkat
              FROM registrasi
              INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
              INNER JOIN mahasiswa ON registrasi.kode_aplikan = mahasiswa.kode_aplikan
              INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
              INNER JOIN master_presenter ON aplikan.kode_presenter = master_presenter.kode_presenter
              INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
              WHERE kode_registrasi = '$id'";
    return $this->db->query($query);
  }

  function get_ren($kodereg){
    $this->db->where('kode_registrasi',$kodereg);
    $this->db->where('cicilanke >',0);
    return $this->db->get('detailrencana');
  }
  function get_ren2($kodereg){
    $this->db->where('kode_registrasi',$kodereg);
    return $this->db->get('detailrencana');
  }


  function updaterencana()
  {
    $id     = $this->input->post('id');
    $kodekontrak = $id;
    $n      = $this->input->post('jml_cicilan');
    $total  = $this->input->post('total');
    $dp     = $this->input->post('danapinjaman');
    //echo $id;
    $tot  = 0;
    for ($i=0; $i<=$n; $i++)
  	{
  		$wajibbayar   = $this->input->post('wajibbayar'.$i);
  		$tot          = $tot  + $wajibbayar;
  		//echo "cic ke $i = $tot <br>";
      //echo "1";
  	}
    // echo $n;
    // die;
    if($tot + $dp != $total){
    	//echo "total : $tot <br>";
    	//echo "deal : $total";
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Jumlah Rencana Tidak Sesuai Dengan Total Pembayaran !</h6>
          </div>
        </div>');
	    redirect('keuangan/editrencana/'.$id);
    }else{
      //echo "total : $tot <br>";
    	//echo "deal : $total";
    	$ce    = "select count(cicilanke) as jmlcicilan from detailrencana where kode_registrasi='$id'";
    	$cek   = $this->db->query($ce);
    	$cekk  = $cek->row_array();
    	$cekkk = $cekk['jmlcicilan'];
      // echo $cekkk;
      // die;
      if($cekkk>1){
    		for ($i=1; $i<=$n; $i++)
    		{
    			$cicilanke   = $this->input->post('cicilanke'.$i);
    			$jatuhtempo  = $this->input->post('jatuhtempo'.$i);
    			$wajibbayar  = $this->input->post('wajibbayar'.$i);

          $data = array(
            'jatuh_tempo'  => $jatuhtempo,
            'wajib_bayar'  => $wajibbayar
          );
          //echo $cicilanke;
         $simpan =  $this->db->update('detailrencana',$data,array('kode_registrasi'=>$id,'cicilanke'=>$cicilanke));
    		}

    		//header("Location: admin-home.php?page=rincian&id=$id");
    		if ($simpan) {
          $cekbayar = $this->db->query("SELECT SUM(bayar) as totalbayar FROM historibayar WHERE kode_registrasi ='$kodekontrak'")->row_array();
          $jmlbayar = $cekbayar['totalbayar'];
          $dataupdate = array(
            'realisasi' => 0
          );
          $updaterealisasi = $this->db->update('detailrencana',$dataupdate,array('kode_registrasi'=>$kodekontrak));
          $detailrencana   = $this->db->get_where('detailrencana',array('kode_registrasi'=>$kodekontrak))->result_array();
          foreach($detailrencana as $r){
            if($r['wajib_bayar'] != $r['realisasi']  AND $jmlbayar  >= $r['wajib_bayar']){
              $data1 = array(
                'realisasi' => $r['wajib_bayar']
              );
              $this->db->update('detailrencana',$data1,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
            }else{
              if($jmlbayar>0 AND $r['wajib_bayar'] !=0){
                $data2 = array(
                  'realisasi' => $jmlbayar
                );
                $this->db->update('detailrencana',$data2,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
                echo "perintah2";
              }else{
                $data3 = array(
                  'realisasi' => 0
                );
                $this->db->update('detailrencana',$data3,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
              }
            }
            $jmlbayar = $jmlbayar - $r['wajib_bayar'];
          }
          $this->session->set_flashdata('msg',
         '<div class="card bg-c-green order-card">
           <div class="card-block">
             <h6><i class="ti-check"></i> Data Has Been Updated !</h6>
           </div>
         </div>');
          redirect('keuangan/detail/'.$id);

    		}
    	}else if($cekkk<=1){

    		redirect('keuangan/detail/'.$id);

    	}else{
    		echo "Data Error";
    	}
    }
  }

  function getJmlbayar($kodereg)
  {
    $query = "SELECT IFNULL(SUM(bayar),0) as jumlah FROM historibayar WHERE kode_registrasi ='$kodereg' AND jenis='REGULER' GROUP BY kode_registrasi";
    return $this->db->query($query);
  }

  function get_jmlcicilan($kodereg)
  {
    $this->db->where('kode_registrasi',$kodereg);
    return $this->db->get('detailrencana');
  }

  function get_historibayar($kodereg,$jenis="REGULER")
  {
    $this->db->where('kode_registrasi',$kodereg);
    $this->db->where('jenis',$jenis);
    $this->db->order_by('nobukti ASC');
    return $this->db->get('historibayar');
  }

  function bayar()
  {
    error_reporting(0);
    $tahunskrg      =date("Y");
    $char           = "";
    $tahunkapotong  = substr($tahunskrg,2,2);
  	$q              = "select (SELECT nobukti FROM historibayar where substr(nobukti,1,2)=$tahunkapotong order by nobukti desc limit 1) as idMaks";
  	$h              = $this->db->query($q);
  	$d              = $h->row_array();
  	$ambilnik       = $d['idMaks'];
  	$autonik        = substr($ambilnik,2,5);
  	$noUrut         = (int)($autonik);
  	$noUrut++;
  	//%03s untuk mengatur 3 karakter di belakang
  	$akhir          = $char . sprintf("%05s", $noUrut);
  	$nobuktis       = "$tahunkapotong$akhir";
  	//ambil data value dari setiap name input type
  	//echo $nobukti;
    //autonumber no. btk
		$q2             = "select (SELECT nobtk FROM historibayar order by nobtk desc limit 1) as idMaks";
    $h2             = $this->db->query($q2);
  	$d2             = $h2->row_array();
		$ambilnik2      = $d2['idMaks'];
  	$autonik2       = $ambilnik2;
  	$noUrut2        = (int)($autonik2);
  	$noUrut2++;


  	$kodekontrak   = $this->input->post('kodekontrak');
  	$nobukti       = $nobuktis;
  	//$cicilanper = $_POST['cicilanper'];
  	$tglbayar      = $this->input->post('tglbayar');
  	$bayar         = str_replace(".","",$this->input->post('bayar'));
  	$kasir         = $this->input->post('kasir');
  	$pilih         = $this->input->post('pilih');
  	$mbe           = $this->input->post('nobtkbtb');
  	$terimadari    = $this->input->post('terimadari');
    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih=="btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}


    $q      = "select (SELECT cicilanke FROM detailrencana where kode_registrasi='$kodekontrak' order by cicilanke desc limit 1) as idMaks";
		$hasil  = $this->db->query($q);
		$data   = $hasil->row_array();
		$autokj = $data['idMaks'];
		$noUrut = (int)($autokj);
		$noUrut++;

    $cek          = $this->db->query("select sum(bayar) as jumlahbayar from historibayar where kode_registrasi='$kodekontrak' order by nobukti asc limit 1")->row_array();
    $jumlahbayar  = $cek['jumlahbayar'];

    $cek1         = $this->db->query("select harga_deal as deal from registrasi where kode_registrasi='$kodekontrak'")->row_array();
    $deal         = $cek1['deal'];

    $jumlah       = $this->db->query("select jenis_regis from registrasi where kode_registrasi='$kodekontrak'")->row_array();
    $jenisregis   = $jumlah['jenis_regis'];

    if($jenisregis=="DANAPINJAMAN"){
      $cinggalong   = $this->db->query("select sum(wajib_bayar) as meng from detailrencana where kode_registrasi='$kodekontrak'")->row_array();
      $meng         = $cinggalong['meng'];
      $danapinjaman = $deal-$meng;
      $sumwb        = $meng;
    }else{
      $sumwb        = $deal;
    }
    $wajibbayar   = $sumwb-$jumlahbayar;

    if ($wajibbayar == "0"){
      //header ("location:admin-home.php?page=bayar-cicilan&id=$kodekontrak&error=2");
    }else if ($bayar>$wajibbayar){
      //header ("location:admin-home.php?page=bayar-cicilan&id=$kodekontrak&error=1");
    }else{
      $id       = $kodekontrak;
      $query    = $this->db->query("SELECT sum(bayar) as haha from historibayar where kode_registrasi='$id'");
      $row      = $query->row_array();
      $n        = 0;
      $jmlbayar =$row['haha'];
      $q        = $this->db->query("select cicilanke, jatuh_tempo, wajib_bayar, count(wajib_bayar) as sumwajib from detailrencana where kode_registrasi='$id'");
      $d        = $q->row_array();
      $sumwajib = $d['sumwajib'];
      $bayaryeuh= $bayar;

      while($n<$sumwajib) {
        $queryrencana = $this->db->query("SELECT * FROM detailrencana where kode_registrasi='$id' and cicilanke='$n'");
        $datarencana  = $queryrencana->row_array();
        $tgl          = $datarencana['jatuh_tempo'];
        $tahun        = substr($tgl,0,4);
        //$bulan=substr($tgl,5,2);
        $bulan        = date("F", strtotime($tgl));
        $wb           = $datarencana['wajib_bayar'];
        $ck           = $n;
        if($n=='0'){
          $meong        = $this->db->query("SELECT tingkat.nama_tingkat from tingkat, registrasi, biaya where biaya.tingkat = tingkat.kode_tingkat and registrasi.kode_biaya = biaya.kode_biaya and registrasi.kode_registrasi='$kodekontrak'");
          $dudu         = $meong->row_array();
          $namatingkat  = $dudu['nama_tingkat'];
          $cetak        = "Registrasi";
        }else{
          $cetak="Cic ke-$n";
        }
        if($jmlbayar>$wb){
          $jmlbayar=$jmlbayar-$wb;
        }else{
          if($jmlbayar>0){
            $kurang=$wb-$jmlbayar;
            if($kurang>0){
              if ($bayaryeuh>0){
                if ($bayaryeuh<$kurang){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  if($kurang<$wb){
                    $ie[$n] = "Pelunasan $cetak; ";
                  }else{
                    $ie[$n] = "$cetak; ";
                  }
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$kurang;
            }else{
              $bayaryeuh=$bayaryeuh-$kurang;
            }
            $jmlbayar=$jmlbayar-$wb;
          }else{
            if($ck=='0'){
              if ($bayaryeuh>0){
                if ($bayaryeuh<$wb){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$wb;
            }else{
              if ($bayaryeuh>0){
                if ($bayaryeuh<$wb){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$wb;
            }
          }
        }
        $n++;
    }

    if ($bayar==$wajibbayar){
      $ket="Pelunasan Pembayaran Cicilan";
    }else{
      $ket="$ie[0]$ie[1]$ie[2]$ie[3]$ie[4]$ie[5]$ie[6]$ie[7]$ie[8]$ie[9]$ie[10]";
    }

    $data = array(
            'nobukti'         => $nobukti,
            'kode_registrasi' => $kodekontrak,
            'tgl'             => $tglbayar,
            'terimadari'      => $terimadari,
            'bayar'           => $bayar,
            'jenis'           => 'REGULER',
            'Keterangan'      => $ket,
            'kasir'           => $kasir,
            'nobtk'           => $nobtk,
            'nobtb'           => $nobtb

    );
    $simpan = $this->db->insert('historibayar',$data);
    if($simpan){
      $cekbayar = $this->db->query("SELECT SUM(bayar) as totalbayar FROM historibayar WHERE kode_registrasi ='$kodekontrak'")->row_array();
      $jmlbayar = $cekbayar['totalbayar'];
      $dataupdate = array(
        'realisasi' => 0
      );
      $updaterealisasi = $this->db->update('detailrencana',$dataupdate,array('kode_registrasi'=>$kodekontrak));
      $detailrencana   = $this->db->get_where('detailrencana',array('kode_registrasi'=>$kodekontrak))->result_array();
      foreach($detailrencana as $r){
        if($r['wajib_bayar'] != $r['realisasi']  AND $jmlbayar  >= $r['wajib_bayar']){
          $data1 = array(
            'realisasi' => $r['wajib_bayar']
          );
          $this->db->update('detailrencana',$data1,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
        }else{
          if($jmlbayar>0 AND $r['wajib_bayar'] !=0){
            $data2 = array(
              'realisasi' => $jmlbayar
            );
            $this->db->update('detailrencana',$data2,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
            echo "perintah2";
          }else{
            $data3 = array(
              'realisasi' => 0
            );
            $this->db->update('detailrencana',$data3,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
          }
        }
        $jmlbayar = $jmlbayar - $r['wajib_bayar'];
      }
      $this->session->set_flashdata('msg',
     '<div class="card bg-c-green order-card">
       <div class="card-block">
         <h6><i class="ti-check"></i> Data Has Been Saved !</h6>
       </div>
     </div>');
      redirect('keuangan/detail/'.$kodekontrak);
    }
  }
  }

  function getHB($nobukti)
  {
    return $this->db->get_where('historibayar',array('nobukti'=>$nobukti));
  }

  function updatebayar(){
    error_reporting(0);
    $kodekontrak   = $this->input->post('kodekontrak');
    $nobukti       = $this->input->post('nobukti');
    $tglbayar      = $this->input->post('tglbayar');
    $bayar         = str_replace(".","",$this->input->post('bayar'));;
    $kasir         = $this->input->post('kasir');
    $pilih         = $this->input->post('pilih');
    $mbe           = $this->input->post('nobtkbtb');
    $terimadari    = $this->input->post('terimadari');
    //echo $mbe;
  	if ($pilih == "btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih == "btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}

    $query            = $this->db->query("SELECT sum(bayar) as haha from historibayar where kode_registrasi='$kodekontrak'");
    $row              = $query->row_array();

    $dodol            = $this->db->query("select*from historibayar where kode_registrasi='$kodekontrak' and nobukti='$nobukti'")->row_array();
    $n                = 0;
    $bayarsebelumnya  = $dodol['bayar'];
    $jmlbayar         = $row['haha']-$bayarsebelumnya;

    $cek1             = $this->db->query("SELECT `harga_deal` FROM `registrasi` WHERE kode_registrasi='$kodekontrak'")->row_array();
    $deal             = $cek1['harga_deal'];
    $wajibbayar       = $deal-$jmlbayar;


    if ($bayar>$wajibbayar){
    }else{
      $q              = $this->db->query("select cicilanke, jatuh_tempo, wajib_bayar, count(wajib_bayar) as sumwajib from detailrencana where kode_registrasi='$kodekontrak'");
      $d              = $q->row_array();
      $sumwajib       = $d['sumwajib'];
      $bayaryeuh      = $bayar;

      while($n<$sumwajib) {

        $queryrencana = $this->db->query("SELECT * FROM detailrencana where kode_registrasi='$kodekontrak' and cicilanke='$n'");
        $datarencana  = $queryrencana->row_array();
        $tgl          = $datarencana['jatuh_tempo'];
        $tahun        = substr($tgl,0,4);
      //$bulan=substr($tgl,5,2);
        $bulan        = date("F", strtotime($tgl));
        $wb           = $datarencana['wajib_bayar'];
        $ck           = $n;
        if($n=='0'){
          $cetak="Registrasi";
        }else{
          $cetak="Cic ke-$n";
        }
        if($jmlbayar>$wb){
          $jmlbayar=$jmlbayar-$wb;
        }else{
          if($jmlbayar>0){
            $kurang=$wb-$jmlbayar;
            if($kurang>0){
              if ($bayaryeuh>0){
                if ($bayaryeuh<$kurang){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  if($kurang<$wb){
                    $ie[$n] = "Pelunasan $cetak; ";
                  }else{
                    $ie[$n] = "$cetak; ";
                  }
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$kurang;
            }else{
              $bayaryeuh=$bayaryeuh-$kurang;
            }
            $jmlbayar=$jmlbayar-$wb;
          }else{
            if($ck=='0'){
              if ($bayaryeuh>0){
                if ($bayaryeuh<$wb){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$wb;
            }else{
              if ($bayaryeuh>0){
                if ($bayaryeuh<$wb){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$wb;
            }
          }
        }
        $n++;
      }
    }
      $ket="$ie[0]$ie[1]$ie[2]$ie[3]$ie[4]$ie[5]$ie[6]$ie[7]$ie[8]$ie[9]$ie[10]";

      $data = array(
        'tgl'         => $tglbayar,
        'terimadari'  => $terimadari,
        'bayar'       => $bayar,
        'jenis'       => 'REGULER',
        'Keterangan'  => $ket,
        'kasir'       => $kasir,
        'nobtk'       => $nobtk,
        'nobtb'       => $nobtb
      );
      $simpan = $this->db->update('historibayar',$data,array('nobukti'=>$nobukti));
      if($simpan){
        $cekbayar = $this->db->query("SELECT SUM(bayar) as totalbayar FROM historibayar WHERE kode_registrasi ='$kodekontrak'")->row_array();
        $jmlbayar = $cekbayar['totalbayar'];
        $dataupdate = array(
          'realisasi' => 0
        );
        $updaterealisasi = $this->db->update('detailrencana',$dataupdate,array('kode_registrasi'=>$kodekontrak));
        $detailrencana   = $this->db->get_where('detailrencana',array('kode_registrasi'=>$kodekontrak))->result_array();
        foreach($detailrencana as $r){
          if($r['wajib_bayar'] != $r['realisasi']  AND $jmlbayar  >= $r['wajib_bayar']){
            $data1 = array(
              'realisasi' => $r['wajib_bayar']
            );
            $this->db->update('detailrencana',$data1,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
          }else{
            if($jmlbayar>0 AND $r['wajib_bayar'] !=0){
              $data2 = array(
                'realisasi' => $jmlbayar
              );
              $this->db->update('detailrencana',$data2,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
              echo "perintah2";
            }else{
              $data3 = array(
                'realisasi' => 0
              );
              $this->db->update('detailrencana',$data3,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
            }
          }
          $jmlbayar = $jmlbayar - $r['wajib_bayar'];
        }
        $this->session->set_flashdata('msg',
       '<div class="card bg-c-green order-card">
         <div class="card-block">
           <h6><i class="ti-check"></i> Data Has Been Saved !</h6>
         </div>
       </div>');
        redirect('keuangan/detail/'.$kodekontrak);
      }


  }


  function hapusbayar($nobukti,$kodekontrak)
  {
    $hapus = $this->db->delete('historibayar',array('nobukti'=>$nobukti));
    if($hapus){
      $cekbayar = $this->db->query("SELECT SUM(bayar) as totalbayar FROM historibayar WHERE kode_registrasi ='$kodekontrak'")->row_array();
      $jmlbayar = $cekbayar['totalbayar'];
      $dataupdate = array(
        'realisasi' => 0
      );
      $updaterealisasi = $this->db->update('detailrencana',$dataupdate,array('kode_registrasi'=>$kodekontrak));
      $detailrencana   = $this->db->get_where('detailrencana',array('kode_registrasi'=>$kodekontrak))->result_array();
      foreach($detailrencana as $r){
        if($r['wajib_bayar'] != $r['realisasi']  AND $jmlbayar  >= $r['wajib_bayar']){
          $data1 = array(
            'realisasi' => $r['wajib_bayar']
          );
          $this->db->update('detailrencana',$data1,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
        }else{
          if($jmlbayar>0 AND $r['wajib_bayar'] !=0){
            $data2 = array(
              'realisasi' => $jmlbayar
            );
            $this->db->update('detailrencana',$data2,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
            echo "perintah2";
          }else{
            $data3 = array(
              'realisasi' => 0
            );
            $this->db->update('detailrencana',$data3,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
          }
        }
        $jmlbayar = $jmlbayar - $r['wajib_bayar'];
      }
      $this->session->set_flashdata('msg',
     '<div class="card bg-c-green order-card">
       <div class="card-block">
         <h6><i class="ti-check"></i> Data Has Been Deleted !</h6>
       </div>
     </div>');
      redirect('keuangan/detail/'.$kodekontrak);
    }
  }

  function cetakkwitansi1($nobukti){
    $this->db->select('historibayar.nobukti,historibayar.kode_registrasi as kodekontrak, biaya.tingkat, registrasi.kode_aplikan, aplikan.nama_lengkap as namamhs, tingkat.nama_tingkat, registrasi.kelas, aplikan.kode_jurusan,nama_jurusan, historibayar.tgl, historibayar.bayar, historibayar.jenis, historibayar.keterangan, historibayar.kasir, historibayar.nobtk, historibayar.nobtb, historibayar.terimadari');
    $this->db->from('historibayar');
    $this->db->join('registrasi','historibayar.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('tingkat','biaya.tingkat = tingkat.kode_tingkat');
    $this->db->where('historibayar.nobukti',$nobukti);
    return $this->db->get();

  }

  function cetakkwitansi2($nobukti){
    $this->db->select('historibayar.nobukti, historibayar.kode_registrasi, historibayar.tgl, historibayar.bayar, historibayar.jenis, historibayar.keterangan, historibayar.kasir, historibayar.nobtk, historibayar.nobtb, historibayar.terimadari');
    $this->db->from('historibayar');
    $this->db->where('nobukti',$nobukti);
    return $this->db->get();
  }

  function hapusregistrasi($kodereg,$kode_aplikan)
  {
    $hapuskontrak = $this->db->delete('registrasi',array('kode_registrasi'=>$kodereg));
    if($hapuskontrak){
      $hapusdetailrencana = $this->db->delete('detailrencana',array('kode_registrasi'=>$kodereg));
      $hapusmhs           = $this->db->delete('mahasiswa',array('kode_aplikan'=>$kode_aplikan));
      if($hapusdetailrencana && $hapusmhs){
        $hapushistori = $this->db->delete('historibayar',array('kode_registrasi'=>$kodereg));
        if($hapushistori){
          $this->session->set_flashdata('msg',
         '<div class="card bg-c-green order-card">
           <div class="card-block">
             <h6><i class="ti-check"></i> Data Has Been Deleted !</h6>
           </div>
         </div>');
          redirect('keuangan/transaksi');
        }
      }
    }
  }

  function hapusregis($kodereg,$kode_aplikan)
  {
    $hapuskontrak = $this->db->delete('registrasi',array('kode_registrasi'=>$kodereg));
    if($hapuskontrak){
      $hapusdetailrencana = $this->db->delete('detailrencana',array('kode_registrasi'=>$kodereg));
      if($hapusdetailrencana){
        $hapushistori = $this->db->delete('historibayar',array('kode_registrasi'=>$kodereg));
        if($hapushistori){
          $this->session->set_flashdata('msg',
         '<div class="card bg-c-green order-card">
           <div class="card-block">
             <h6><i class="ti-check"></i> Data Has Been Deleted !</h6>
           </div>
         </div>');
          redirect('keuangan/transaksi');
        }
      }
    }
  }

  public function getDataPembayaran($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="",$tingkat="",$asalsekolah="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('kode_registrasi,registrasi.kode_aplikan,tgl_registrasi,nama_lengkap,nama_presenter,registrasi.kelas,nama_jurusan,registrasi.kode_biaya,biaya.tingkat,biaya.tahun_akademik,nim,no_hp,biaya.status,status_akademik');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    if($nama_aplikan != ''){
    	$this->db->like('nama_lengkap', $nama_aplikan);
  	}
    if($tahun_akademik != ''){
    	$this->db->where('biaya.tahun_akademik', $tahun_akademik);
  	}

    if($asalsekolah != ''){
    	$this->db->where('aplikan.asal_sekolah', $asalsekolah);
  	}
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->order_by('registrasi.tgl_registrasi','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordPembayaran($nama_aplikan="",$tahun_akademik="",$tingkat="",$asalsekolah="")
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
    if($asalsekolah != ''){
    	$this->db->where('aplikan.asal_sekolah', $asalsekolah);
  	}
    $this->db->where('biaya.tingkat',$tingkat);
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function insert_regissenior(){
    $ta_mkt               = $this->input->post('ta_mkt');
    $kode_jurusan         = $this->input->post('kode_jurusan');
    $ta_aktif             = substr($ta_mkt,2,2);
    $regis                = "SELECT kode_registrasi FROM registrasi
                            INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
                            WHERE tahun_akademik ='$ta_mkt' AND biaya.kode_jurusan = '$kode_jurusan' ORDER BY kode_registrasi DESC LIMIT 1 ";
    $ceknolast            = $this->db->query($regis)->row_array();
    $kodeterakhir         = $ceknolast['kode_registrasi'];
    $kode_registrasi      = buatkode($kodeterakhir,'RE'.$ta_aktif.$kode_jurusan,3);
     //tambah xoxo
    $cekkoderegis  = $this->db->get_where('registrasi',array('kode_registrasi'=>$kode_registrasi))->num_rows();
    if(  $cekkoderegis != 0){
      $kode_registrasi  = buatkode($kode_registrasi ,'RE'.$ta_aktif.$kode_jurusan,3);
    }
    // echo    $kode_registrasi ;
    // die;
    //tambah xoxo
  
    $kode_aplikan         = $this->input->post('kode_aplikan');
  	$kodebiaya            = $this->input->post('kodebiaya');
  	$tglregis             = $this->input->post('tglregis');
  	$gelombang            = $this->input->post('gelombangregis');
  	$diskongelombang      = str_replace(".","",$this->input->post('potgel'));
  	$diskonprestasi       = str_replace(".","",$this->input->post('potpres'));
  	$diskoncash           = str_replace(".","",$this->input->post('potcash'));
  	$diskonlain           = str_replace(".","",$this->input->post('potlainlain'));
  	$hargadeal            = str_replace(".","",$this->input->post('hargadeal'));
  	$registrasi           = str_replace(".","",$this->input->post('jmlregis'));
  	$keterangan           = $this->input->post('keterangan');
    $jenisregis           = 'REGULER';
  	$rencanacicilan       = $this->input->post('jmlcicilan');
  	$cicilanper           = str_replace(".","",$this->input->post('cicilanper'));
  	$tglmulai             = $this->input->post('mulaicicilan');
    $tglreg               = date($tglmulai);
  	$tahun                = substr($tglreg,0,4);
  	$bulan                = substr($tglreg,5,2);
    $krg                  = mktime(0,0,0,date($bulan-1),date(10),date($tahun));
    $tglr                 = date("Y-m-d", $krg);
    $kelas                = $this->input->post('kelas');



    $datareg  = array(
      'kode_registrasi'       => $kode_registrasi,
      'kode_aplikan'          => $kode_aplikan,
      'tgl_registrasi'        => $tglregis,
      'gelombang_registrasi'  => $gelombang,
      'kode_biaya'            => $kodebiaya,
      'pot_gelombang'         => $diskongelombang,
      'pot_prestasi'          => $diskonprestasi,
      'pot_cash'              => $diskoncash,
      'pot_lainlain'          => $diskonlain,
      'harga_deal'            => $hargadeal,
      'biaya_registrasi'      => $registrasi,
      'jml_cicilan'           => $rencanacicilan,
      'cicilanper'            => $cicilanper,
      'keterangan'            => $keterangan,
      'jenis_regis'           => $jenisregis,
      'kelas'                 => $kelas


    );

    $datadetailrencana = array(

      'kode_registrasi' => $kode_registrasi,
      'cicilanke'       => 0,
      'jatuh_tempo'     => $tglr,
      'wajib_bayar'     => $registrasi

    );


    $cekaplikanreg  = $this->db->get_where('registrasi',array('kode_aplikan'=>$kode_aplikan,'kode_biaya'=>$kodebiaya))->num_rows();
    if(empty($cekaplikanreg)){
      $simpanreg      = $this->db->insert('registrasi',$datareg);
      $simpanrencana  = $this->db->insert('detailrencana',$datadetailrencana);
      for ($i=1; $i<=$rencanacicilan; $i++)
      {

        $tambah = mktime(0,0,0,date($bulan),date(10),date($tahun));
        $tglkem = date("Y-m-d", $tambah);

        $datadetailrencana2 = array(

          'kode_registrasi' => $kode_registrasi,
          'cicilanke'       => $i,
          'jatuh_tempo'     => $tglkem,
          'wajib_bayar'     => $cicilanper
        );
        $simpanrencana2 = $this->db->insert('detailrencana',$datadetailrencana2);
        $bulan++;
      }

      if($simpanreg && $simpanrencana){
        redirect('keuangan/editrencana/'.$kode_registrasi);
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Data Sudah Ada !</h6>
          </div>
        </div>');
	    redirect('keuangan/regissenior');
    }
  }

  public function getDataBelumRegisT3($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    if($nama_aplikan != ''){
    	$aplikan = " AND aplikan.nama_lengkap LIKE '%".$nama_aplikan."%' ";
  	}else{
      $aplikan = "";
    }
    if($tahun_akademik != ''){
      $ta = "AND aplikan.tahun_akademik = '".$tahun_akademik."' ";
  	}
    $q = "SELECT nim,mahasiswa.kode_aplikan,nama_lengkap,nama_jurusan,no_hp
          FROM mahasiswa
          INNER JOIN aplikan ON mahasiswa.kode_aplikan = aplikan.kode_aplikan
          INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
          WHERE NOT EXISTS
          (SELECT registrasi.kode_biaya,biaya.tingkat FROM registrasi
          INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
          WHERE registrasi.kode_aplikan = aplikan.kode_aplikan AND biaya.tingkat = '3')".$aplikan.$ta."ORDER BY nama_lengkap ASC LIMIT $rowno,$rowperpage";
 		//$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->query($q);
    return $query->result_array();
 	}

  public function getrecordBelumRegisT3($nama_aplikan="",$tahun_akademik="")
  {
    if($nama_aplikan != ''){
    	$aplikan = " AND aplikan.nama_lengkap LIKE '%".$nama_aplikan."%' ";
  	}else{
      $aplikan = "";
    }
    if($tahun_akademik != ''){
      $ta = "AND aplikan.tahun_akademik = '".$tahun_akademik."' ";
  	}
    $q = "SELECT COUNT(*) as allcount
          FROM mahasiswa
          INNER JOIN aplikan ON mahasiswa.kode_aplikan = aplikan.kode_aplikan
          INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
          WHERE NOT EXISTS
          (SELECT registrasi.kode_biaya,biaya.tingkat FROM registrasi
          INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
          WHERE registrasi.kode_aplikan = aplikan.kode_aplikan AND biaya.tingkat = '3')".$aplikan.$ta;

    $query 	= $this->db->query($q);
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  public function getDataBelumRegisT4($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="")
  {
    if($nama_aplikan != ''){
    	$aplikan = " AND aplikan.nama_lengkap LIKE '%".$nama_aplikan."%' ";
  	}else{
      $aplikan = "";
    }
    if($tahun_akademik != ''){
      $ta = "AND aplikan.tahun_akademik = '".$tahun_akademik."' ";
  	}
    $q = "SELECT nim,mahasiswa.kode_aplikan,nama_lengkap,nama_jurusan,no_hp
          FROM mahasiswa
          INNER JOIN aplikan ON mahasiswa.kode_aplikan = aplikan.kode_aplikan
          INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
          WHERE NOT EXISTS
          (SELECT registrasi.kode_biaya,biaya.tingkat FROM registrasi
          INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
          WHERE registrasi.kode_aplikan = aplikan.kode_aplikan AND biaya.tingkat = '4')".$aplikan.$ta."ORDER BY nama_lengkap ASC LIMIT $rowno,$rowperpage";
 		//$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->query($q);
    return $query->result_array();
 	}

  public function getrecordBelumRegisT4($nama_aplikan="",$tahun_akademik="")
  {
    if($nama_aplikan != ''){
    	$aplikan = " AND aplikan.nama_lengkap LIKE '%".$nama_aplikan."%' ";
  	}else{
      $aplikan = "";
    }
    if($tahun_akademik != ''){
      $ta = "AND aplikan.tahun_akademik = '".$tahun_akademik."' ";
  	}
    $q = "SELECT COUNT(*) as allcount
          FROM mahasiswa
          INNER JOIN aplikan ON mahasiswa.kode_aplikan = aplikan.kode_aplikan
          INNER JOIN master_jurusan ON aplikan.kode_jurusan = master_jurusan.kode_jurusan
          WHERE NOT EXISTS
          (SELECT registrasi.kode_biaya,biaya.tingkat FROM registrasi
          INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
          WHERE registrasi.kode_aplikan = aplikan.kode_aplikan AND biaya.tingkat = '4')".$aplikan.$ta;

    $query 	= $this->db->query($q);
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function get_status()
  {
    $this->db->select('status');
    $this->db->distinct('status');
    $this->db->from('biaya');
    return $this->db->get();
  }

  function getjur($ta,$tingkat){
    $this->db->select('biaya.kode_jurusan,nama_jurusan');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('master_jurusan','biaya.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('biaya.tahun_akademik',$ta);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->group_by('biaya.kode_jurusan');
    return $this->db->get();
  }

  function getKelas($ta,$tingkat,$jurusan){
    $this->db->select('registrasi.kelas');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('biaya.tahun_akademik',$ta);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->where('biaya.kode_jurusan',$jurusan);
    $this->db->group_by('registrasi.kelas');
    return $this->db->get();
  }

  function cetaklaporankelas_hp($ta,$tingkat,$kelas,$batas)
  {
    $tgl       = explode("-",$batas);
    $tahun     = $tgl[0];
    $bulan     = $tgl[1];
    $batastgl  = $tahun."-".$bulan."-31";
    $query = "SELECT registrasi.kode_registrasi,mahasiswa.nim,nama_lengkap,no_hp,nama_ortu,nohp_ortu,mahasiswa.status_akademik,IFNULL(tunggakan,0)-IFNULL(jmlbayar,0) as sisatunggakan,harga_deal,jmlbayarall,IFNULL(harga_deal,0)-IFNULL(jmlbayarall,0) as sisaalltunggakan
    FROM registrasi
    INNER JOIN mahasiswa ON registrasi.kode_aplikan=mahasiswa.kode_aplikan
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    LEFT JOIN (
      SELECT kode_registrasi,SUM(wajib_bayar) as tunggakan
      FROM detailrencana WHERE jatuh_tempo <='$batastgl'
      GROUP BY kode_registrasi
    ) dr ON (registrasi.kode_registrasi = dr.kode_registrasi)

    LEFT JOIN (
      SELECT kode_registrasi,SUM(IF(tgl<='$batastgl',bayar,0))as jmlbayar,SUM(bayar) as jmlbayarall
      FROM historibayar
      GROUP BY kode_registrasi
    ) hb ON (registrasi.kode_registrasi = hb.kode_registrasi)


    WHERE biaya.tahun_akademik ='$ta' AND biaya.tingkat='$tingkat' AND registrasi.kelas ='$kelas'";
    return $this->db->query($query);
  }

  function cetaklaporankelas_rinci($ta,$tingkat,$kelas,$batas)
  {
    $tgl       = explode("-",$batas);
    $tahun     = $tgl[0];
    $bulan     = $tgl[1];
    $batastgl  = $tahun."-".$bulan."-31";
    $thn       = explode("/",$ta);
    $tahun1    = $thn[0];
    $tahun2    = $thn[1];

    $query = "SELECT detailrencana.kode_registrasi,registrasi.kode_aplikan,nim,nama_lengkap,nama_jurusan,biaya,pot_gelombang,pot_prestasi,pot_cash,pot_lainlain,danapinjaman,harga_deal,
    biaya_registrasi,
    SUM(IF(jatuh_tempo <= '$tahun1-06-31',wajib_bayar,0)) as rensj,
    SUM(IF(MONTH(jatuh_tempo) = '7' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar,0)) as renjuli,
    SUM(IF(MONTH(jatuh_tempo) = '8' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar,0)) as renagustus,
    SUM(IF(MONTH(jatuh_tempo) = '9' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar,0)) as renseptember,
    SUM(IF(MONTH(jatuh_tempo) = '10' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar,0)) as renoktober,
    SUM(IF(MONTH(jatuh_tempo) = '11' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar,0)) as rennovember,
    SUM(IF(MONTH(jatuh_tempo) = '12' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar,0)) as rendesember,
    SUM(IF(MONTH(jatuh_tempo) = '1' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar,0)) as renjanuari,
    SUM(IF(MONTH(jatuh_tempo) = '2' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar,0)) as renfebruari,
    SUM(IF(MONTH(jatuh_tempo) = '3' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar,0)) as renmaret,
    SUM(IF(MONTH(jatuh_tempo) = '4' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar,0)) as renapril,
    SUM(IF(MONTH(jatuh_tempo) = '5' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar,0)) as renmei,
    SUM(IF(MONTH(jatuh_tempo) = '6' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar,0)) as renjuni,
    SUM(IF(jatuh_tempo <= '$tahun1-06-31',realisasi,0)) as realsj,
    SUM(IF(MONTH(jatuh_tempo) = '7' AND YEAR(jatuh_tempo)='$tahun1',realisasi,0)) as realjuli,
    SUM(IF(MONTH(jatuh_tempo) = '8' AND YEAR(jatuh_tempo)='$tahun1',realisasi,0)) as realagustus,
    SUM(IF(MONTH(jatuh_tempo) = '9' AND YEAR(jatuh_tempo)='$tahun1',realisasi,0)) as realseptember,
    SUM(IF(MONTH(jatuh_tempo) = '10' AND YEAR(jatuh_tempo)='$tahun1',realisasi,0)) as realoktober,
    SUM(IF(MONTH(jatuh_tempo) = '11' AND YEAR(jatuh_tempo)='$tahun1',realisasi,0)) as realnovember,
    SUM(IF(MONTH(jatuh_tempo) = '12' AND YEAR(jatuh_tempo)='$tahun1',realisasi,0)) as realdesember,
    SUM(IF(MONTH(jatuh_tempo) = '1' AND YEAR(jatuh_tempo)='$tahun2',realisasi,0)) as realjanuari,
    SUM(IF(MONTH(jatuh_tempo) = '2' AND YEAR(jatuh_tempo)='$tahun2',realisasi,0)) as realfebruari,
    SUM(IF(MONTH(jatuh_tempo) = '3' AND YEAR(jatuh_tempo)='$tahun2',realisasi,0)) as realmaret,
    SUM(IF(MONTH(jatuh_tempo) = '4' AND YEAR(jatuh_tempo)='$tahun2',realisasi,0)) as realapril,
    SUM(IF(MONTH(jatuh_tempo) = '5' AND YEAR(jatuh_tempo)='$tahun2',realisasi,0)) as realmei,
    SUM(IF(MONTH(jatuh_tempo) = '6' AND YEAR(jatuh_tempo)='$tahun2',realisasi,0)) as realjuni,

    SUM(IF(jatuh_tempo <= '$tahun1-06-31',wajib_bayar-realisasi,0)) as tungsj,
    SUM(IF(MONTH(jatuh_tempo) = '7' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar-realisasi,0)) as tungjuli,
    SUM(IF(MONTH(jatuh_tempo) = '8' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar-realisasi,0)) as tungagustus,
    SUM(IF(MONTH(jatuh_tempo) = '9' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar-realisasi,0)) as tungseptember,
    SUM(IF(MONTH(jatuh_tempo) = '10' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar-realisasi,0)) as tungoktober,
    SUM(IF(MONTH(jatuh_tempo) = '11' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar-realisasi,0)) as tungnovember,
    SUM(IF(MONTH(jatuh_tempo) = '12' AND YEAR(jatuh_tempo)='$tahun1',wajib_bayar-realisasi,0)) as tungdesember,
    SUM(IF(MONTH(jatuh_tempo) = '1' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar-realisasi,0)) as tungjanuari,
    SUM(IF(MONTH(jatuh_tempo) = '2' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar-realisasi,0)) as tungfebruari,
    SUM(IF(MONTH(jatuh_tempo) = '3' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar-realisasi,0)) as tungmaret,
    SUM(IF(MONTH(jatuh_tempo) = '4' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar-realisasi,0)) as tungapril,
    SUM(IF(MONTH(jatuh_tempo) = '5' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar-realisasi,0)) as tungmei,
    SUM(IF(MONTH(jatuh_tempo) = '6' AND YEAR(jatuh_tempo)='$tahun2',wajib_bayar-realisasi,0)) as tungjuni,
    SUM(IF(jatuh_tempo <= '$batastgl',wajib_bayar-realisasi,0)) as sisasampaidengan,
    SUM(wajib_bayar-realisasi) as sisatunggakan
    FROM detailrencana
    INNER JOIN registrasi ON detailrencana.kode_registrasi = registrasi.kode_registrasi
    INNER JOIN mahasiswa ON registrasi.kode_aplikan = mahasiswa.kode_aplikan
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    INNER JOIN master_jurusan ON biaya.kode_jurusan = master_jurusan.kode_jurusan
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    WHERE biaya.tahun_akademik = '$ta' AND registrasi.kelas = '$kelas' AND biaya.tingkat='$tingkat'
    GROUP BY detailrencana.kode_registrasi
    ORDER BY nama_lengkap ASC";
    return $this->db->query($query);
  }

  function cetaklaporankelas_akhirperiode($ta,$tingkat,$kelas,$batas)
  {
    $tgl       = explode("-",$batas);
    $tahun     = $tgl[0];
    $bulan     = $tgl[1];
    $batastgl  = $tahun."-".$bulan."-31";
    $query = "SELECT mahasiswa.nim,nama_lengkap,no_hp,nama_ortu,nohp_ortu,mahasiswa.status_akademik,tunggakan-jmlbayar as sisatunggakan
    FROM registrasi
    INNER JOIN mahasiswa ON registrasi.kode_aplikan=mahasiswa.kode_aplikan
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    LEFT JOIN (
      SELECT kode_registrasi,SUM(wajib_bayar) as tunggakan
      FROM detailrencana
      GROUP BY kode_registrasi
    ) dr ON (registrasi.kode_registrasi = dr.kode_registrasi)

    LEFT JOIN (
      SELECT kode_registrasi,SUM(bayar) as jmlbayar
      FROM historibayar
      GROUP BY kode_registrasi
    ) hb ON (registrasi.kode_registrasi = hb.kode_registrasi)

    WHERE biaya.tahun_akademik ='$ta' AND biaya.tingkat='$tingkat' AND registrasi.kelas ='$kelas'";
    return $this->db->query($query);
  }

  function getKasir()
  {
    return $this->db->get_where('sys_users',array('level'=>'kasir'));
  }

  function get_profesi($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->select('nobukti,tgl,nobtk,nobtb,historibayar.keterangan,bayar,nama_lengkap,registrasi.kelas,kasir');
    $this->db->from('historibayar');
    $this->db->order_by('nobukti,nobtk','asc');
    $this->db->join('registrasi','historibayar.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->where('tingkat','1');
    $this->db->or_where('tingkat','2');
    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);
    return $this->db->get();
  }

  function get_tingkat3($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->select('nobukti,tgl,nobtk,nobtb,historibayar.keterangan,bayar,nama_lengkap,registrasi.kelas,kasir');
    $this->db->from('historibayar');
    $this->db->order_by('nobukti,nobtk','asc');
    $this->db->join('registrasi','historibayar.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->where('tingkat','3');
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);
    return $this->db->get();
  }

  function get_tingkat4($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);
    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->select('nobukti,tgl,nobtk,nobtb,historibayar.keterangan,bayar,nama_lengkap,registrasi.kelas,kasir');
    $this->db->from('historibayar');
    $this->db->order_by('nobukti,nobtk','asc');
    $this->db->join('registrasi','historibayar.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->where('tingkat','4');
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);
    return $this->db->get();
  }

  function get_karyawan($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="KARYAWAN"){
      $this->db->where('jenis','KARYAWAN');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');
  }

  function get_sewa($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="SEWA"){
      $this->db->where('jenis','SEWA');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_parkir($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="PARKIR"){
      $this->db->where('jenis','PARKIR');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_iht($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="IHT"){
      $this->db->where('jenis','IHT');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_kursus($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="KURSUS"){
      $this->db->where('jenis','KURSUS');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_lainlain($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);
    if(empty($jenis) OR $jenis =="LAINLAIN"){
      $this->db->where('jenis','LAINLAIN');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');
  }

  function get_btk($nobukti){
    $this->db->select('historibayar.nobukti,historibayar.kode_registrasi, biaya.tingkat, mahasiswa.nim, aplikan.nama_lengkap, tingkat.nama_tingkat, registrasi.kelas, biaya.kode_jurusan, historibayar.tgl, historibayar.bayar, historibayar.jenis, historibayar.keterangan, historibayar.kasir, historibayar.nobtk, historibayar.nobtb, historibayar.terimadari');
    $this->db->from('historibayar');
    $this->db->join('registrasi','historibayar.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('tingkat','biaya.tingkat = tingkat.kode_tingkat');
    $this->db->where('historibayar.nobukti',$nobukti);
    return $this->db->get();
  }

  function getSurat($pilihsurat)
  {
    return $this->db->get_where('surat',array('status'=>$pilihsurat));
  }

  function cetaktagihanmhs($koderegistrasi,$batas)
  {
    $tgl       = explode("-",$batas);
    $tahun     = $tgl[0];
    $bulan     = $tgl[1];
    $batastgl  = $tahun."-".$bulan."-31";
    $query     = "SELECT registrasi.kode_registrasi,mahasiswa.nim,nama_lengkap,no_hp,nama_ortu,nohp_ortu,mahasiswa.status_akademik,tunggakan-jmlbayar as sisatunggakan,harga_deal,jmlbayarall,harga_deal-jmlbayarall as sisaalltunggakan,jml_cicilan
    FROM registrasi
    INNER JOIN mahasiswa ON registrasi.kode_aplikan=mahasiswa.kode_aplikan
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    LEFT JOIN (
      SELECT kode_registrasi,SUM(wajib_bayar) as tunggakan
      FROM detailrencana WHERE jatuh_tempo <='$batastgl'
      GROUP BY kode_registrasi
    ) dr ON (registrasi.kode_registrasi = dr.kode_registrasi)

    LEFT JOIN (
      SELECT kode_registrasi,SUM(IF(tgl<='$batastgl',bayar,0))as jmlbayar,SUM(bayar) as jmlbayarall
      FROM historibayar
      GROUP BY kode_registrasi
    ) hb ON (registrasi.kode_registrasi = hb.kode_registrasi)


    WHERE registrasi.kode_registrasi='$koderegistrasi'";
    return $this->db->query($query);
  }


  function getRencana($ta)
  {
    $tahun_akademik = $ta;
    $ta = explode("/",$ta);
    $ta1 = $ta[0];
    $ta2 = $ta[1];

    $query = "SELECT biaya.tingkat,
      SUM(IF(jatuh_tempo < '$ta1-07-01',wajib_bayar,0)) as sebelumjuli,
      SUM(IF(MONTH(jatuh_tempo) = '07' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar,0)) as juli,
      SUM(IF(MONTH(jatuh_tempo) = '08' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar,0)) as agustus,
      SUM(IF(MONTH(jatuh_tempo) = '09' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar,0)) as september,
      SUM(IF(MONTH(jatuh_tempo) = '10' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar,0)) as oktober,
      SUM(IF(MONTH(jatuh_tempo) = '11' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar,0)) as november,
      SUM(IF(MONTH(jatuh_tempo) = '12' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar,0)) as desember,
      SUM(IF(MONTH(jatuh_tempo) = '01' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar,0)) as januari,
      SUM(IF(MONTH(jatuh_tempo) = '02' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar,0)) as februari,
      SUM(IF(MONTH(jatuh_tempo) = '03' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar,0)) as maret,
      SUM(IF(MONTH(jatuh_tempo) = '04' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar,0)) as april,
      SUM(IF(MONTH(jatuh_tempo) = '05' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar,0)) as mei,
      SUM(IF(MONTH(jatuh_tempo) = '06' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar,0)) as juni,
      SUM(wajib_bayar) as totalrencana
      FROM detailrencana
      INNER JOIN registrasi ON detailrencana.kode_registrasi = registrasi.kode_registrasi
      INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
      WHERE biaya.tahun_akademik ='$tahun_akademik'
      GROUP BY biaya.tingkat
    ";
    return $this->db->query($query);
  }

  function getRealisasi($ta)
  {
    $tahun_akademik = $ta;
    $ta = explode("/",$ta);
    $ta1 = $ta[0];
    $ta2 = $ta[1];
    $query = "SELECT biaya.tingkat,
      SUM(IF(jatuh_tempo < '$ta1-07-01',realisasi,0)) as sebelumjuli,
      SUM(IF(MONTH(jatuh_tempo) = '07' AND YEAR(jatuh_tempo) ='$ta1',realisasi,0)) as juli,
      SUM(IF(MONTH(jatuh_tempo) = '08' AND YEAR(jatuh_tempo) ='$ta1',realisasi,0)) as agustus,
      SUM(IF(MONTH(jatuh_tempo) = '09' AND YEAR(jatuh_tempo) ='$ta1',realisasi,0)) as september,
      SUM(IF(MONTH(jatuh_tempo) = '10' AND YEAR(jatuh_tempo) ='$ta1',realisasi,0)) as oktober,
      SUM(IF(MONTH(jatuh_tempo) = '11' AND YEAR(jatuh_tempo) ='$ta1',realisasi,0)) as november,
      SUM(IF(MONTH(jatuh_tempo) = '12' AND YEAR(jatuh_tempo) ='$ta1',realisasi,0)) as desember,
      SUM(IF(MONTH(jatuh_tempo) = '01' AND YEAR(jatuh_tempo) ='$ta2',realisasi,0)) as januari,
      SUM(IF(MONTH(jatuh_tempo) = '02' AND YEAR(jatuh_tempo) ='$ta2',realisasi,0)) as februari,
      SUM(IF(MONTH(jatuh_tempo) = '03' AND YEAR(jatuh_tempo) ='$ta2',realisasi,0)) as maret,
      SUM(IF(MONTH(jatuh_tempo) = '04' AND YEAR(jatuh_tempo) ='$ta2',realisasi,0)) as april,
      SUM(IF(MONTH(jatuh_tempo) = '05' AND YEAR(jatuh_tempo) ='$ta2',realisasi,0)) as mei,
      SUM(IF(MONTH(jatuh_tempo) = '06' AND YEAR(jatuh_tempo) ='$ta2',realisasi,0)) as juni,
      SUM(realisasi) as totalrealisasi
      FROM detailrencana
      INNER JOIN registrasi ON detailrencana.kode_registrasi = registrasi.kode_registrasi
      INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
      WHERE biaya.tahun_akademik ='$tahun_akademik'
      GROUP BY biaya.tingkat
    ";
    return $this->db->query($query);
  }

  function getTunggakan($ta)
  {
    $tahun_akademik = $ta;
    $ta = explode("/",$ta);
    $ta1 = $ta[0];
    $ta2 = $ta[1];
    $query = "SELECT biaya.tingkat,
      SUM(IF(jatuh_tempo < '$ta1-07-01',wajib_bayar-realisasi,0)) as sebelumjuli,
      SUM(IF(MONTH(jatuh_tempo) = '07' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar-realisasi,0)) as juli,
      SUM(IF(MONTH(jatuh_tempo) = '08' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar-realisasi,0)) as agustus,
      SUM(IF(MONTH(jatuh_tempo) = '09' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar-realisasi,0)) as september,
      SUM(IF(MONTH(jatuh_tempo) = '10' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar-realisasi,0)) as oktober,
      SUM(IF(MONTH(jatuh_tempo) = '11' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar-realisasi,0)) as november,
      SUM(IF(MONTH(jatuh_tempo) = '12' AND YEAR(jatuh_tempo) ='$ta1',wajib_bayar-realisasi,0)) as desember,
      SUM(IF(MONTH(jatuh_tempo) = '01' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar-realisasi,0)) as januari,
      SUM(IF(MONTH(jatuh_tempo) = '02' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar-realisasi,0)) as februari,
      SUM(IF(MONTH(jatuh_tempo) = '03' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar-realisasi,0)) as maret,
      SUM(IF(MONTH(jatuh_tempo) = '04' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar-realisasi,0)) as april,
      SUM(IF(MONTH(jatuh_tempo) = '05' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar-realisasi,0)) as mei,
      SUM(IF(MONTH(jatuh_tempo) = '06' AND YEAR(jatuh_tempo) ='$ta2',wajib_bayar-realisasi,0)) as juni,
      SUM(wajib_bayar-realisasi) as totaltunggakan
      FROM detailrencana
      INNER JOIN registrasi ON detailrencana.kode_registrasi = registrasi.kode_registrasi
      INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
      WHERE biaya.tahun_akademik = '$tahun_akademik'
      GROUP BY biaya.tingkat
    ";
    return $this->db->query($query);
  }

  function getMhs($kodeaplikan)
  {
    $this->db->select('mahasiswa.kode_aplikan,nim,nama_lengkap,aplikan.kode_jurusan,nama_jurusan');
    $this->db->from('mahasiswa');
    $this->db->join('aplikan','mahasiswa.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('mahasiswa.kode_aplikan',$kodeaplikan);
    return $this->db->get();
  }

  function getren($kodeaplikan,$tingkat)
  {
    $this->db->select('detailrencana.kode_registrasi,cicilanke,jatuh_tempo,wajib_bayar,realisasi');
    $this->db->from('detailrencana');
    $this->db->join('registrasi','detailrencana.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('registrasi.kode_aplikan',$kodeaplikan);
    $this->db->where('tingkat',$tingkat);
    return $this->db->get();
  }

  function get_historibayartk($kodeaplikan,$tingkat)
  {
    $this->db->select('nobukti,tgl,nobtk,nobtb,bayar');
    $this->db->from('historibayar');
    $this->db->join('registrasi','historibayar.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('registrasi.kode_aplikan',$kodeaplikan);
    $this->db->where('biaya.tingkat',$tingkat);
    return $this->db->get();
  }

  function getredaksisurat() {
    return $this->db->get('surat');
  }

  function updatesurat($kode_surat){
    $perihal      = $this->input->post('perihal');
    $editor1      = $this->input->post('editor1');
    $editor2      = $this->input->post('editor2');

    $data = array(
      'perihal'       => $perihal,
      'isi_surat'     => $editor1,
      'isi_surat2'    => $editor2
    );

    $update = $this->db->update('surat',$data,array('kode_surat'=>$kode_surat));
    if($update){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-success"></i> Redaksi Surat Berhasil di Update!</h6>
          </div>
        </div>');
	    redirect('keuangan/surat');
    }
  }

  function getreg($kodereg){
    $this->db->select('registrasi.kode_registrasi,registrasi.kode_aplikan,nim,nama_lengkap,
    tempat_lahir,tgl_lahir,registrasi.kelas,nama_jurusan,keterangan,tgl_registrasi,
    gelombang_registrasi,biaya_registrasi,registrasi.kode_biaya,biaya,pot_gelombang,pot_prestasi,pot_cash,
    pot_lainlain,penyesuaian,danapinjaman,harga_deal,jml_cicilan,registrasi.jenis_regis,cicilanper');
    $this->db->from('registrasi');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('master_jurusan','biaya.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('registrasi.kode_registrasi',$kodereg);
    return $this->db->get();
  }

  function update_regis(){

    $kodekontrak          = $this->input->post('kodekontrak');
  	$kodebiaya            = $this->input->post('kodebiaya');
  	$tglregis             = $this->input->post('tglregis');
  	$gelombang            = $this->input->post('gelombangregis');
  	$diskongelombang      = str_replace(".","",$this->input->post('potgel'));
  	$diskonprestasi       = str_replace(".","",$this->input->post('potpres'));
  	$diskoncash           = str_replace(".","",$this->input->post('potcash'));
  	$diskonlain           = str_replace(".","",$this->input->post('potlainlain'));
    $penyesuaian          = str_replace(".","",$this->input->post('penyesuaian'));
    $danapinjaman         = str_replace(".","",$this->input->post('danapinjaman'));
  	$hargadeal            = str_replace(".","",$this->input->post('hargadeal'));
  	$registrasi           = str_replace(".","",$this->input->post('jmlregis'));
  	$jenisregis           = $this->input->post('keterangan');
  	$rencanacicilan       = $this->input->post('jmlcicilan');
  	$cicilanper           = str_replace(".","",$this->input->post('cicilanper'));
  	$tglmulai             = $this->input->post('mulaicicilan');
    $tglreg               = date($tglmulai);
  	$tahun                = substr($tglreg,0,4);
  	$bulan                = substr($tglreg,5,2);
    $krg                  = mktime(0,0,0,date($bulan-1),date(10),date($tahun));
    $tglr                 = date("Y-m-d", $krg);

    $datareg  = array(

      'tgl_registrasi'        => $tglregis,
      'gelombang_registrasi'  => $gelombang,
      'kode_biaya'       => $kodebiaya,
      'pot_gelombang'    => $diskongelombang,
      'pot_prestasi'     => $diskonprestasi,
      'pot_cash'         => $diskoncash,
      'pot_lainlain'     => $diskonlain,
      'penyesuaian'      => $penyesuaian,
      'danapinjaman'     => $danapinjaman,
      'harga_deal'       => $hargadeal,
      'biaya_registrasi' => $registrasi,
      'jml_cicilan'      => $rencanacicilan,
      'cicilanper'       => $cicilanper,
      'jenis_regis'      => $jenisregis

    );

    $datadetailrencana = array(

      'kode_registrasi' => $kodekontrak,
      'cicilanke'       => 0,
      'jatuh_tempo'     => $tglr,
      'wajib_bayar'     => $registrasi

    );

    $simpanreg      = $this->db->update('registrasi',$datareg,array('kode_registrasi'=>$kodekontrak));
    $hapusrentemp   = $this->db->delete('temp_detailrencana',array('kode_registrasi'=>$kodekontrak));
    $simpanrencana  = $this->db->insert('temp_detailrencana',$datadetailrencana);
    for ($i=1; $i<=$rencanacicilan; $i++)
    {

      $tambah = mktime(0,0,0,date($bulan),date(10),date($tahun));
      $tglkem = date("Y-m-d", $tambah);

      $datadetailrencana2 = array(

        'kode_registrasi'   => $kodekontrak,
        'cicilanke'         => $i,
        'jatuh_tempo'       => $tglkem,
        'wajib_bayar'       => $cicilanper

      );
      $simpanrencana2 = $this->db->insert('temp_detailrencana',$datadetailrencana2);
      $bulan++;
    }

    if($simpanreg && $simpanrencana){
      redirect('keuangan/editrencana2/'.$kodekontrak);
    }
  }


  function get_rentemp($kodereg){
    $this->db->where('kode_registrasi',$kodereg);
    return $this->db->get('temp_detailrencana');
  }

  function updaterencana2(){
    $id           = $this->input->post('id');
    $kodekontrak  = $id;
    $n            = $this->input->post('jml_cicilan');
    $dp           = $this->input->post('danapinjaman');
    $total        = $this->input->post('total');
    //echo $id;
    $cicilanke0     = $this->input->post('cicilanke0');
  	$jatuhtempo0    = $this->input->post('jatuhtempo0');
  	$wajibbayar0    = $this->input->post('wajibbayar0');
    $tot  = 0;
    for ($i=0; $i<=$n; $i++)
  	{
  		$wajibbayar   = $this->input->post('wajibbayar'.$i);
  		$tot          = $tot  + $wajibbayar;
  		//echo "cic ke $i = $tot <br>";
  	}

    if($tot + $dp !=$total){
    	//echo "total : $tot <br>";
    	//echo "deal : $total";
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Jumlah Rencana Tidak Sesuai Dengan Total Pembayaran !</h6>
          </div>
        </div>');
	    redirect('keuangan/editrencana2/'.$id);
    }else{
      //echo "total : $tot <br>";
    	//echo "deal : $total";

      $delete = $this->db->delete('detailrencana',array('kode_registrasi'=>$id));
      $delete = $this->db->delete('temp_detailrencana',array('kode_registrasi'=>$id));
      $data = array(
        'kode_registrasi' => $id,
        'cicilanke'       => $cicilanke0,
        'jatuh_tempo'     => $jatuhtempo0,
        'wajib_bayar'     => $wajibbayar0
      );

      $simpan = $this->db->insert('detailrencana',$data);

    		for ($i=1; $i<=$n; $i++)
    		{
    			$cicilanke   = $this->input->post('cicilanke'.$i);
    			$jatuhtempo  = $this->input->post('jatuhtempo'.$i);
    			$wajibbayar  = $this->input->post('wajibbayar'.$i);

          $data2 = array(
            'kode_registrasi' => $id,
            'cicilanke'       => $cicilanke,
            'jatuh_tempo'     => $jatuhtempo,
            'wajib_bayar'     => $wajibbayar
          );

          $this->db->insert('detailrencana',$data2);
    		}
    		//header("Location: admin-home.php?page=rincian&id=$id");
    		if ($simpan) {
          $cekbayar = $this->db->query("SELECT SUM(bayar) as totalbayar FROM historibayar WHERE kode_registrasi ='$kodekontrak'")->row_array();
          $jmlbayar = $cekbayar['totalbayar'];
          $dataupdate = array(
            'realisasi' => 0
          );
          $updaterealisasi = $this->db->update('detailrencana',$dataupdate,array('kode_registrasi'=>$kodekontrak));
          $detailrencana   = $this->db->get_where('detailrencana',array('kode_registrasi'=>$kodekontrak))->result_array();
          foreach($detailrencana as $r){
            if($r['wajib_bayar'] != $r['realisasi']  AND $jmlbayar  >= $r['wajib_bayar']){
              $data1 = array(
                'realisasi' => $r['wajib_bayar']
              );
              $this->db->update('detailrencana',$data1,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
            }else{
              if($jmlbayar>0 AND $r['wajib_bayar'] !=0){
                $data2 = array(
                  'realisasi' => $jmlbayar
                );
                $this->db->update('detailrencana',$data2,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
                echo "perintah2";
              }else{
                $data3 = array(
                  'realisasi' => 0
                );
                $this->db->update('detailrencana',$data3,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
              }
            }
            $jmlbayar = $jmlbayar - $r['wajib_bayar'];
          }
          $this->session->set_flashdata('msg',
         '<div class="card bg-c-green order-card">
           <div class="card-block">
             <h6><i class="ti-check"></i> Data Has Been Updated !</h6>
           </div>
         </div>');
          redirect('keuangan/detail/'.$id);
    		}
    }
  }

  public function getDataPenerimaanlain($rowno,$rowperpage,$dari="",$sampai="")
  {

    $this->db->select('nobukti,tgl,jenis,terimadari,keterangan,bayar,nobtk,nobtb,kasir');
    $this->db->from('historibayar');
    if($dari != ''){
    	$this->db->where('tgl >=', $dari);
  	}
    if($sampai != ''){
    	$this->db->where('tgl <=', $sampai);
  	}
    $this->db->where('jenis !=','REGULER');
    $this->db->order_by('tgl','DESC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordPenerimaanlain($dari="",$sampai="")
  {
    $this->db->select('count(*) as allcount');
    $this->db->from('historibayar');
    if($dari != ''){
    	$this->db->where('tgl >=', $dari);
  	}
    if($sampai != ''){
    	$this->db->where('tgl <=', $sampai);
  	}
    $this->db->where('jenis !=','REGULER');
    $this->db->order_by('tgl','DESC');
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  function insertlainlain(){
    error_reporting(0);
    $tahunskrg      =date("Y");
    $char           = "";
    $tahunkapotong  = substr($tahunskrg,2,2);
  	$q              = "select (SELECT nobukti FROM historibayar where substr(nobukti,1,2)=$tahunkapotong order by nobukti desc limit 1) as idMaks";
  	$h              = $this->db->query($q);
  	$d              = $h->row_array();
  	$ambilnik       = $d['idMaks'];
  	$autonik        = substr($ambilnik,2,5);
  	$noUrut         = (int)($autonik);
  	$noUrut++;
  	//%03s untuk mengatur 3 karakter di belakang
  	$akhir          = $char . sprintf("%05s", $noUrut);
  	$nobuktis       = "$tahunkapotong$akhir";
  	//ambil data value dari setiap name input type
  	//echo $nobukti;
    //autonumber no. btk
		$q2             = "select (SELECT nobtk FROM historibayar order by nobtk desc limit 1) as idMaks";
    $h2             = $this->db->query($q2);
  	$d2             = $h2->row_array();
		$ambilnik2      = $d2['idMaks'];
  	$autonik2       = $ambilnik2;
  	$noUrut2        = (int)($autonik2);
  	$noUrut2++;


  	$nobukti       = $nobuktis;
  	//$cicilanper = $_POST['cicilanper'];
  	$tglbayar      = $this->input->post('tglbayar');
  	$bayar         = str_replace(".","",$this->input->post('bayar'));;
  	$kasir         = $this->input->post('kasir');
  	$pilih         = $this->input->post('pilih');
  	$mbe           = $this->input->post('nobtkbtb');
  	$terimadari    = $this->input->post('terimadari');
    $keterangan    = $this->input->post('ket');
    $pilihjenis    = $this->input->post('pilihjenis');
    if($pilihjenis == 'DANA PINJAMAN')
    {
      $kode_transaksi = $this->input->post('kode_transaksi');
    }else{
      $kode_transaksi = "";
    }

    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih=="btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}

    $data = array(
      'nobukti'     => $nobukti,
      'tgl'         => $tglbayar,
      'terimadari'  => $terimadari,
      'bayar'       => $bayar,
      'jenis'       => $pilihjenis,
      'Keterangan'  => $keterangan,
      'kasir'       => $kasir,
      'nobtk'       => $nobtk,
      'nobtb'       => $nobtb,
      'kode_transaksi' => $kode_transaksi

    );
    $simpan = $this->db->insert('historibayar',$data);
    if($simpan){
      if($pilihjenis =='DANA PINJAMAN')
      {
        $this->session->set_flashdata('msg',
       '<div class="card bg-c-green order-card">
         <div class="card-block">
           <h6><i class="ti-check"></i> Data Saved Succesfully !</h6>
         </div>
       </div>');
        redirect('keuangan/detaildanapinjaman/'.$kode_transaksi);
      }else{
        $this->session->set_flashdata('msg',
       '<div class="card bg-c-green order-card">
         <div class="card-block">
           <h6><i class="ti-check"></i> Data Saved Succesfully !</h6>
         </div>
       </div>');
        redirect('keuangan/pembayaranlain');
      }

    }
  }

  function updatelainlain(){
    error_reporting(0);
    $nobukti       = $this->input->post('nobukti');
    $tglbayar      = $this->input->post('tglbayar');
    $bayar         = str_replace(".","",$this->input->post('bayar'));;
    $kasir         = $this->input->post('kasir');
    $pilih         = $this->input->post('pilih');
    $mbe           = $this->input->post('nobtkbtb');
    $terimadari    = $this->input->post('terimadari');
    $keterangan    = $this->input->post('ket');
    $pilihjenis    = $this->input->post('pilihjenis');
    if($pilihjenis == 'DANA PINJAMAN')
    {
      $kode_transaksi = $this->input->post('kode_transaksi');
    }else{
      $kode_transaksi = "";
    }

    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
      $nobtk  = $mbe;
      $nobtb  = "";
      //echo "nobtk : $nobtk, nobtb ga ada";
    }else if ($pilih=="btb"){
      $nobtk  = "";
      $nobtb  = $mbe;
      //echo "nobtb : $nobtb, nobtk ga ada";
    }

    $data = array(
      'tgl'         => $tglbayar,
      'terimadari'  => $terimadari,
      'bayar'       => $bayar,
      'jenis'       => $pilihjenis,
      'Keterangan'  => $keterangan,
      'kasir'       => $kasir,
      'nobtk'       => $nobtk,
      'nobtb'       => $nobtb
    );
    $simpan = $this->db->update('historibayar',$data,array('nobukti'=>$nobukti));
    if($simpan){
      if($pilihjenis =='DANA PINJAMAN')
      {
        $this->session->set_flashdata('msg',
       '<div class="card bg-c-green order-card">
         <div class="card-block">
           <h6><i class="ti-check"></i> Data Saved Succesfully !</h6>
         </div>
       </div>');
        redirect('keuangan/detaildanapinjaman/'.$kode_transaksi);
      }else{
        $this->session->set_flashdata('msg',
       '<div class="card bg-c-green order-card">
         <div class="card-block">
           <h6><i class="ti-check"></i> Data Saved Succesfully !</h6>
         </div>
       </div>');
        redirect('keuangan/pembayaranlain');
      }

    }
  }

  function hapuspenerimaanlain($nobukti){
    $hapus = $this->db->delete('historibayar',array('nobukti'=>$nobukti));
    if($hapus){
      $this->session->set_flashdata('msg',
     '<div class="card bg-c-green order-card">
       <div class="card-block">
         <h6><i class="ti-check"></i> Data Has Been Deleted !</h6>
       </div>
     </div>');
      redirect('keuangan/pembayaranlain');
    }
  }

  function listva($ta,$tingkat,$kelas)
  {
    $this->db->select('va.kode_registrasi,va,nim,nama_lengkap,no_hp,expiredate,tagihan');
    $this->db->from('va');
    $this->db->join('registrasi','va.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('biaya.tahun_akademik',$ta);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->where('registrasi.kelas',$kelas);
    return $this->db->get();
  }

  function getTagihanVA($ta,$tingkat,$kelas,$batas)
  {
    $tgl       = explode("-",$batas);
    $tahun     = $tgl[0];
    $bulan     = $tgl[1];
    $batastgl  = $tahun."-".$bulan."-31";
    $query = "SELECT registrasi.kode_registrasi,mahasiswa.nim,nama_lengkap,no_hp,nama_ortu,nohp_ortu,mahasiswa.status_akademik,IFNULL(tunggakan,0)-IFNULL(jmlbayar,0) as sisatunggakan,harga_deal,jmlbayarall,IFNULL(harga_deal,0)-IFNULL(jmlbayarall,0) as sisaalltunggakan
    FROM registrasi
    INNER JOIN mahasiswa ON registrasi.kode_aplikan=mahasiswa.kode_aplikan
    INNER JOIN aplikan ON registrasi.kode_aplikan = aplikan.kode_aplikan
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    LEFT JOIN (
      SELECT kode_registrasi,SUM(wajib_bayar) as tunggakan
      FROM detailrencana WHERE jatuh_tempo <='$batastgl'
      GROUP BY kode_registrasi
    ) dr ON (registrasi.kode_registrasi = dr.kode_registrasi)

    LEFT JOIN (
      SELECT kode_registrasi,SUM(IF(tgl<='$batastgl',bayar,0))as jmlbayar,SUM(bayar) as jmlbayarall
      FROM historibayar
      GROUP BY kode_registrasi
    ) hb ON (registrasi.kode_registrasi = hb.kode_registrasi)

    WHERE biaya.tahun_akademik ='$ta' AND biaya.tingkat='$tingkat' AND registrasi.kelas ='$kelas' AND registrasi.kode_registrasi NOT IN (SELECT kode_registrasi FROM va) ORDER BY nama_lengkap ASC";
    return $this->db->query($query);
  }

  function getVA($kodereg)
  {
    $this->db->select('va.kode_registrasi,va,nim,nama_lengkap,tagihan,no_hp,expiredate');
    $this->db->from('va');
    $this->db->join('registrasi','va.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->where('va.kode_registrasi',$kodereg);
    return $this->db->get();
  }



  function updateva()
  {

    $koderegistrasi  = $this->input->post('koderegistrasi');
    $kodereg         = substr($koderegistrasi,1,10);
    $va              = $this->input->post('va');
    $namamhs         = $this->input->post('nama');
    $nohp            = $this->input->post('nohp');
    $tagihan         = $this->input->post('tagihan');
    $jmltagihan      = str_replace(".","",$tagihan);
    $date            = $this->input->post('expiredate');
    $ref             = rand(0,1000000000000);

    $tanggal         = explode(" ",$date);
    $tgl             = $tanggal[0];
    $jam             = $tanggal[1];
    //echo $tgl.$jam;
    $expire          = explode("-",$tgl);
    $time            = explode(":",$jam);

    $tahun           = substr($expire[0],2,2);
    $bulan           = $expire[1];
    $hari            = $expire[2];

    $expiredate      = $tahun.$bulan.$hari."2359";



    $idbtn            = 'LP3IWS';
    $key              = 'iJFIBfdfAk4wEt8rFkTl2swQfiNxnUSl';
    $secret           = '4buAMLwFUy';

    $data = array(

      "ref"         => "$ref",
      "va"          => $va,
      "nama"        => $namamhs,
      "layanan"     => "PEMBAYARAN",
      "kodelayanan" => $kodereg,
      "jenisbayar"  => "CICILAN",
      "kodejenisbyr"=> "920",
      "noid"        => $nohp,
      "tagihan"     => $jmltagihan,
      "flag"        => "P",
      "reserve"     => "",
      "angkatan"    => "",
      "expired"     => $expiredate,
      "description" => ""
    );

    $body     = json_encode($data);
    $string   = $idbtn.":".$body.":".$key;
    $sig      = hash_hmac('sha256',$string,$secret);
    $response = $this->_client->request('POST','updVA',[
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded',
        'id'           => $idbtn,
        'key'          => $key,
        'signature'    => $sig
      ],

      'form_params' => $data
    ]);

    // echo $va[$index];
    //$result = json_decode($response->getBody()->getContents(),true);

    $result = $response->getBody()->getContents();
    // return $result;
    // die;
    $r      = json_decode($result,true);
    $rsp    = $r['rsp'];
    if($rsp === '000')
    {
      $datava = array(
        'va'              => $va,
        'tagihan'         => $jmltagihan,
        'expiredate'      => $tgl." 23:59:59"
      );

      $update = $this->db->update('va',$datava,array('kode_registrasi'=>$koderegistrasi));
      if($update){
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-info"></i> Data Berhasil di Update !</h6>
            </div>
          </div>');
        redirect('keuangan/valist');
      }else{
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-pink order-card">
            <div class="card-block">
              <h6><i class="ti-info"></i> Data Gagal di Update !</h6>
            </div>
          </div>');
        redirect('keuangan/valist');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> VA Gagal di Update !</h6>
          </div>
        </div>');
      redirect('keuangan/valist');
    }

  }

  function hapusva($va)
  {
    $va               = $va;
    $idbtn            = 'LP3IWS';
    $key              = 'iJFIBfdfAk4wEt8rFkTl2swQfiNxnUSl';
    $secret           = '4buAMLwFUy';
    $ref              = rand(0,1000000000000);
    $data = array(
      "ref"         => "$ref",
      "va"          => $va
    );

    $body     = json_encode($data);
    $string   = $idbtn.":".$body.":".$key;
    $sig      = hash_hmac('sha256',$string,$secret);
    $response = $this->_client->request('POST','deleteVA',[
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded',
        'id'           => $idbtn,
        'key'          => $key,
        'signature'    => $sig
      ],

      'form_params' => $data
    ]);

    // echo $va[$index];
    //$result = json_decode($response->getBody()->getContents(),true);

    $result = $response->getBody()->getContents();
    $r      = json_decode($result,true);
    $rsp    = $r['rsp'];
    if($rsp === '000')
    {
      $hapus = $this->db->delete('va',array('va'=>$va));
      if($hapus){
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-info"></i> Data Berhasil di Hapus !</h6>
            </div>
          </div>');
        redirect('keuangan/valist');
      }else{
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-pink order-card">
            <div class="card-block">
              <h6><i class="ti-info"></i> Data Gagal di Hapus !</h6>
            </div>
          </div>');
        redirect('keuangan/valist');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> VA Gagal di Hapus !</h6>
          </div>
        </div>');
      redirect('keuangan/valist');
    }
  }

  public function getDataDanapinjaman($rowno,$rowperpage,$namamhs="")
  {
    $this->db->select('registrasi.kode_aplikan,nama_lengkap,SUM(danapinjaman) as danapinjaman,
    (SELECT SUM(bayar) FROM historibayar WHERE  kode_transaksi = registrasi.kode_aplikan AND jenis ="DANA PINJAMAN") as totalbayar');
    $this->db->from('registrasi');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    if($namamhs != ''){
    	$this->db->like('nama_lengkap', $namamhs);
  	}
    $this->db->where('danapinjaman !=','');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordDanapinjaman($namamhs="")
  {
    $this->db->select('count(*) as allcount');
    $this->db->from('registrasi');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    if($namamhs != ''){
    	$this->db->like('nama_lengkap', $namamhs);
  	}
    $this->db->where('danapinjaman !=','');
    $query 	= $this->db->get();
    $result = $query->result_array();
 		return $result[0]['allcount'];
  }

  public function getDataRegisunder30($rowno,$rowperpage,$nama_aplikan="",$tahun_akademik="",$tingkat="")
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->where('cicilanke','0');
    $this->db->where('realisasi < round((30/100)*harga_deal)');
    $this->db->select('detailrencana.kode_registrasi,nim,registrasi.kode_aplikan,nama_lengkap,nama_jurusan,harga_deal,round(((30/100)*harga_deal)) as tigapuluhpersen, realisasi,registrasi.kelas');
    $this->db->from('detailrencana');
    $this->db->join('registrasi','detailrencana.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
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

  public function getrecordRegisunder30($nama_aplikan="",$tahun_akademik="",$tingkat)
  {
    $level = $this->access->get_level();
    $kodepresenter = $this->access->get_username();
    if($level =='presenter')
    {
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->where('cicilanke','0');
    $this->db->where('realisasi < round((30/100)*harga_deal)');
    $this->db->select('count(*) as allcount');
    $this->db->from('detailrencana');
    $this->db->join('registrasi','detailrencana.kode_registrasi = registrasi.kode_registrasi');
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


  function updatenim()
  {
    $kodeaplikan = $this->input->post('kodeaplikan');
    $tingkat    = $this->input->post('tingkat');
    $halaman    = $this->input->post('halaman');
    $nim        = $this->input->post('nim');
    $data = array(
      'nim' => $nim
    );
    $simpan = $this->db->update('mahasiswa',$data,array('kode_aplikan'=>$kodeaplikan));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Data Has been Saved !</h6>
          </div>
        </div>');
      redirect('keuangan/pembayaran/'.$tingkat."/".$halaman);
    }
  }

  function getListPinjaman($kode_aplikan)
  {
    $this->db->select('registrasi.kode_registrasi,danapinjaman,biaya.tahun_akademik');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('kode_aplikan',$kode_aplikan);
    return $this->db->get();
  }

  function getHistoribayarpinjaman($kode_aplikan)
  {
    return $this->db->get_where('historibayar',array('kode_transaksi'=>$kode_aplikan,'jenis'=>'DANA PINJAMAN'));
  }

  function getListUnder30($kodepresenter,$ta)
  {
    $this->db->where('cicilanke','0');
    $this->db->where('realisasi < round((30/100)*harga_deal)');
    $this->db->where('biaya.tahun_akademik',$ta);
    if($kodepresenter !=""){
      $this->db->where('aplikan.kode_presenter',$kodepresenter);
    }
    $this->db->select('detailrencana.kode_registrasi,nim,registrasi.kode_aplikan,nama_lengkap,nama_jurusan,harga_deal,round(((30/100)*harga_deal)) as tigapuluhpersen, realisasi,registrasi.kelas');
    $this->db->from('detailrencana');
    $this->db->join('registrasi','detailrencana.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('master_jurusan','aplikan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->join('mahasiswa','registrasi.kode_aplikan = mahasiswa.kode_aplikan');
    $this->db->join('master_presenter','aplikan.kode_presenter = master_presenter.kode_presenter');
    return $this->db->get();

  }

  function updateemail()
  {
    $email       = $this->input->post('email');
    $kodeaplikan = $this->input->post('kodeaplikan');
    $kodekontrak = $this->input->post('kodekontrak');
    $data = array(
      'email' => $email
    );
    $update = $this->db->update('aplikan',$data,array('kode_aplikan'=>$kodeaplikan));
    if($update)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Data Has been Updated !</h6>
          </div>
        </div>');
      redirect('keuangan/detail/'.$kodekontrak);
    }

  }

  function getNobtklast()
  {
    $this->db->limit(1);
    $this->db->order_by('nobtk','DESC');
    return $this->db->get('historibayar');
  }

  public function sync($tahun_akademik="",$tingkat="")
  {
    $jmlupdate = 0;
    $jmlerror  = 0;
    $jml       = 0;
    $this->db->select('kode_registrasi');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('biaya.tahun_akademik', $tahun_akademik);
    $this->db->where('biaya.tingkat',$tingkat);
  	$query = $this->db->get();
    $data = $query->result_array();
    foreach ($data as $reg) {
      $kodekontrak = $reg['kode_registrasi'];
      $cekbayar = $this->db->query("SELECT SUM(bayar) as totalbayar FROM historibayar WHERE kode_registrasi ='$kodekontrak'")->row_array();
      $jmlbayar = $cekbayar['totalbayar'];
      $dataupdate = array(
        'realisasi' => 0
      );
      $updaterealisasi = $this->db->update('detailrencana',$dataupdate,array('kode_registrasi'=>$kodekontrak));
      $detailrencana   = $this->db->get_where('detailrencana',array('kode_registrasi'=>$kodekontrak))->result_array();
      foreach($detailrencana as $r){
        if($r['wajib_bayar'] != $r['realisasi']  AND $jmlbayar  >= $r['wajib_bayar']){
          $data1 = array(
            'realisasi' => $r['wajib_bayar']
          );
          $update = $this->db->update('detailrencana',$data1,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
        }else{
          if($jmlbayar>0 AND $r['wajib_bayar'] !=0){
            $data2 = array(
              'realisasi' => $jmlbayar
            );
            $update = $this->db->update('detailrencana',$data2,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
            //echo "perintah2";
          }else{
            $data3 = array(
              'realisasi' => 0
            );
            $update = $this->db->update('detailrencana',$data3,array('kode_registrasi'=>$kodekontrak,'cicilanke'=>$r['cicilanke']));
          }
        }
        $jmlbayar = $jmlbayar - $r['wajib_bayar'];

      }
      $jml++;
    }

    $result = [
      'jmlupdate' => $jmlupdate,
      'jmlerror'  => $jmlerror,
      'jmldata'   => $jml
    ];
    return json_encode($result);
 	}

  public function ceksync($tahun_akademik="",$tingkat="")
  {
    $query = "SELECT SUM(IF(realisasi != jmlbayar,1,0)) as notsync
    FROM registrasi
    LEFT JOIN(
    	SELECT historibayar.kode_registrasi,SUM(bayar) as jmlbayar FROM historibayar GROUP BY historibayar.kode_registrasi
    ) hb ON (registrasi.kode_registrasi = hb.kode_registrasi)

    LEFT JOIN(
    	SELECT detailrencana.kode_registrasi,SUM(realisasi) as realisasi FROM detailrencana GROUP BY detailrencana.kode_registrasi
    ) dr ON (registrasi.kode_registrasi = dr.kode_registrasi)

    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    WHERE biaya.tahun_akademik = '$tahun_akademik' AND biaya.tingkat='$tingkat'";
    return $this->db->query($query);
 	}

  function getJmlregis($tahun_akademik,$tingkat)
  {
    $this->db->select('registrasi.kode_registrasi');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->where('biaya.tingkat',$tingkat);
    return $this->db->get();
  }

  function getrekapkasir()
  {
    $tanggal = date("Y-m-d");
    $this->db->select('SUM(bayar) as bayar,kasir');
    $this->db->from('historibayar');
    $this->db->where('tgl',$tanggal);
    $this->db->group_by('kasir');
    return $this->db->get();
  }

  function listkasir()
  {
    return $this->db->get_where('sys_users',array('level'=>'kasir'));
  }

  function getKampus()
  {
    $this->db->group_by('status');
    return $this->db->get('biaya');
  }

  function getbayarregis($tahun_akademik,$kampus)
  {
    $this->db->select('detailrencana.kode_registrasi,tgl_registrasi,registrasi.kode_aplikan,nama_lengkap,realisasi,biaya.kode_jurusan,nama_jurusan,
    biaya.tingkat,nama_tingkat,biaya,harga_deal,registrasi.keterangan');
    $this->db->from('detailrencana');
    $this->db->join('registrasi','detailrencana.kode_registrasi = registrasi.kode_registrasi');
    $this->db->join('aplikan','registrasi.kode_aplikan = aplikan.kode_aplikan');
    $this->db->join('biaya','registrasi.kode_biaya = biaya.kode_biaya');
    $this->db->join('tingkat','biaya.tingkat=tingkat.kode_tingkat');
    $this->db->join('master_jurusan','biaya.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->where('biaya.status',$kampus);
    $this->db->where('cicilanke','0');
    $this->db->order_by('biaya.tingkat,tgl_registrasi','asc');
    return $this->db->get();
  }


  function PotensiOmset($tahun_akademik)
  {
    $this->db->where('biaya.tahun_akademik',$tahun_akademik);
    $this->db->where('biaya.status','LP3I');
    $this->db->select('biaya.kode_jurusan,nama_jurusan,biaya.tingkat,SUM(harga_deal) as omset,COUNT(kode_registrasi) as jmlmhs,nama_tingkat');
    $this->db->from('registrasi');
    $this->db->join('biaya','registrasi.kode_biaya=biaya.kode_biaya');
    $this->db->join('tingkat','biaya.tingkat = tingkat.kode_tingkat');
    $this->db->join('master_jurusan','biaya.kode_jurusan=master_jurusan.kode_jurusan');
    $this->db->group_by('biaya.kode_jurusan,nama_jurusan,biaya.tingkat');
    $this->db->order_by('biaya.kode_jurusan,biaya.tingkat','asc');
    return $this->db->get();
  }


  function PotensiOmset2($tahun_akademik)
  {
    $query = "SELECT biaya.tingkat,biaya.status,konfigurasi_targetkeuangan.jmlmhs as targetjmlmhs,
    COUNT(kode_registrasi) as jmlmhs,
    konfigurasi_targetkeuangan.omset as targetomset,
    SUM(harga_deal) as omset,
    hargaratarata
    FROM registrasi
    INNER JOIN biaya ON registrasi.kode_biaya = biaya.kode_biaya
    LEFT  JOIN konfigurasi_targetkeuangan ON biaya.tingkat = konfigurasi_targetkeuangan.tingkat AND biaya.tahun_akademik = konfigurasi_targetkeuangan.tahun_akademik AND biaya.`status` = konfigurasi_targetkeuangan.status
    WHERE biaya.tahun_akademik ='$tahun_akademik'
    GROUP BY biaya.tingkat,biaya.`status`

    ";

    return $this->db->query($query);
  }


  function getTarget($tahun_akademik)
  {
    return $this->db->get_where('konfigurasi_targetkeuangan',array('tahun_akademik'=>$tahun_akademik));
  }


  function inserttarget()
  {
    $tingkat        = $this->input->post('tingkat');
    $jmlmhs         = str_replace(".","",$this->input->post('jmlmhs'));
    $omset          = str_replace(".","",$this->input->post('omset'));
    $hargaratarata  = str_replace(".","",$this->input->post('hargaratarata'));

    $tahun_akademik = $this->input->post('tahun')."/".$this->input->post('tahun2');
    $status         = $this->input->post('status');
    $ta_aktif       = substr($tahun_akademik,2,2);
    $cek            = $this->db->get_where('konfigurasi_targetkeuangan',array('tingkat'=>$tingkat,'tahun_akademik'=>$tahun_akademik,'status'=>$status))->num_rows();
    $kode_target    = $ta_aktif.$status.'0'.$tingkat;
    // echo $kode_biaya;
    // die;
    $data = array
    (
      'kode_target'     => $kode_target,
      'tingkat'         => $tingkat,
      'tahun_akademik'  => $tahun_akademik,
      'status'          => $status,
      'jmlmhs'          => $jmlmhs,
      'omset'           => $omset,
      'hargaratarata'   => $hargaratarata
    );
    if(empty($cek))
    {
      $simpan = $this->db->insert('konfigurasi_targetkeuangan',$data);
      if($simpan)
      {
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
            </div>
          </div>');
  	    redirect('keuangan/target');
      }
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6><i class="ti-info"></i> Data Allready Exist !</h6>
          </div>
        </div>');
      redirect('keuangan/target');
    }
  }

  function getDataTarget($kode_target)
  {
    return $this->db->get_where('konfigurasi_targetkeuangan',array('kode_target'=>$kode_target));
  }

  function updatetarget()
  {


    $jmlmhs         = str_replace(".","",$this->input->post('jmlmhs'));
    $omset          = str_replace(".","",$this->input->post('omset'));
    $hargaratarata  = str_replace(".","",$this->input->post('hargaratarata'));
    $status         = $this->input->post('status');
    $kode_target    = $this->input->post('kode_target');
    // echo $kode_biaya;
    // die;
    $data = array
    (

      'status'          => $status,
      'jmlmhs'          => $jmlmhs,
      'omset'           => $omset,
      'hargaratarata'   => $hargaratarata
    );

    $simpan = $this->db->update('konfigurasi_targetkeuangan',$data,array('kode_target'=>$kode_target));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/target');
    }

  }

  function getPertanyaandp3()
  {
    $this->db->join('dp3_kategori','dp3_pertanyaan.kode_kategori = dp3_kategori.kode_kategori');
    return $this->db->get('dp3_pertanyaan');
  }

  public function getDataKaryawan($rowno,$rowperpage,$nama_karyawan="")
  {

    $this->db->select('*');
    $this->db->from('karyawan');
    if($nama_karyawan != ''){
    	$this->db->like('nama_karyawan', $nama_karyawan);
  	}
    $this->db->order_by('nama_karyawan','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordKaryawan($nama_karyawan="")
  {
    $this->db->select('count(*) as allcount');
    $this->db->from('karyawan');
    if($nama_karyawan != ''){
    	$this->db->like('nama_karyawan', $nama_karyawan);
  	}
    $query 	= $this->db->get();
    $result = $query->result_array();
    return $result[0]['allcount'];
  }

  function getDivisi()
  {
    return $this->db->get('master_divisi');
  }

  function insert_karyawan()
  {
    $noktp          = $this->input->post('noktp');
    $nik            = $this->input->post('nik');
    $namakaryawan   = $this->input->post('namakaryawan');
    $tempatlahir    = $this->input->post('tempatlahir');
    $tgllahir       = $this->input->post('tgllahir');
    $bulanlahir     = $this->input->post('bulanlahir');
    $tahunlahir     = $this->input->post('tahunlahir');
    $jk             = $this->input->post('jk');
    $alamat         = $this->input->post('alamat');
    $nohp           = $this->input->post('nohp');
    $email          = $this->input->post('email');
    $jabatan        = $this->input->post('jabatan');
    $divisi         = $this->input->post('divisi');
    $tglbergabung   = $this->input->post('tglbergabung');
    $bulanbergabung = $this->input->post('bulanbergabung');
    $tahunbergabung = $this->input->post('tahunbergabung');
    $statuskerja    = $this->input->post('statuskerja');
    $tglgabung      = $tahunbergabung."-".$bulanbergabung."-".$tglbergabung;
    $tgl_lahir      = $tahunlahir."-".$bulanlahir."-".$tgllahir;

    $data = [
      'no_ktp' => $noktp,
      'nik' => $nik,
      'nama_karyawan' => $namakaryawan,
      'jenis_kelamin' => $jk,
      'alamat' => $alamat,
      'status_kerja' => $statuskerja,
      'email' => $email,
      'no_hp' => $nohp,
      'tgl_bergabung' => $tglgabung,
      'tempat_lahir' => $tempatlahir,
      'tgl_lahir' => $tgl_lahir,
      'jabatan' => $jabatan,
      'kode_divisi' => $divisi

    ];

    $simpan = $this->db->insert('karyawan',$data);
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/karyawan');
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-red order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Saved UnSuccesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/karyawan');
    }
  }

  function getKaryawan($nik)
  {
    return $this->db->get_where('karyawan',array('nik'=>$nik));
  }

  function update_karyawan()
  {
    $noktp          = $this->input->post('noktp');
    $nik            = $this->input->post('nik');
    $namakaryawan   = $this->input->post('namakaryawan');
    $tempatlahir    = $this->input->post('tempatlahir');
    $tgllahir       = $this->input->post('tgllahir');
    $bulanlahir     = $this->input->post('bulanlahir');
    $tahunlahir     = $this->input->post('tahunlahir');
    $jk             = $this->input->post('jk');
    $alamat         = $this->input->post('alamat');
    $nohp           = $this->input->post('nohp');
    $email          = $this->input->post('email');
    $jabatan        = $this->input->post('jabatan');
    $divisi         = $this->input->post('divisi');
    $tglbergabung   = $this->input->post('tglbergabung');
    $bulanbergabung = $this->input->post('bulanbergabung');
    $tahunbergabung = $this->input->post('tahunbergabung');
    $statuskerja    = $this->input->post('statuskerja');
    $tglgabung      = $tahunbergabung."-".$bulanbergabung."-".$tglbergabung;
    $tgl_lahir      = $tahunlahir."-".$bulanlahir."-".$tgllahir;

    $data = [
      'no_ktp' => $noktp,
      'nama_karyawan' => $namakaryawan,
      'jenis_kelamin' => $jk,
      'alamat' => $alamat,
      'status_kerja' => $statuskerja,
      'email' => $email,
      'no_hp' => $nohp,
      'tgl_bergabung' => $tglgabung,
      'tempat_lahir' => $tempatlahir,
      'tgl_lahir' => $tgl_lahir,
      'jabatan' => $jabatan,
      'kode_divisi' => $divisi

    ];

    $simpan = $this->db->update('karyawan',$data,array('nik'=>$nik));
    if($simpan)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Updated Succesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/karyawan');
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-red order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Updated UnSuccesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/karyawan');
    }
  }

  function hapuskaryawan($nik)
  {
    $hapus = $this->db->delete('karyawan',array('nik'=>$nik));
    if($hapus)
    {
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Deleted Succesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/karyawan');
    }else{
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-red order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Deleted UnSuccesfully</h6>
          </div>
        </div>');
	    redirect('keuangan/karyawan');
    }
  }

  function listkaryawan()
  {
    $level = $this->access->get_level();
    if($level =='marketing')
    {
      $this->db->where('kode_divisi','MKT');
      $this->db->where('level','2');
    }else if($level=='cnp'){
      $this->db->where('kode_divisi','CNP');
      $this->db->where('level','2');
    }else if($level=='pendidikan'){
      $this->db->where('kode_divisi','PDD');
      $this->db->where('level','2');
    }else if($level=='ict'){
      $this->db->where('kode_divisi','ICT');
      $this->db->where('level','2');
    }else if($level=='bm'){
      //$this->db->where('kode_divisi','BM');
      $this->db->where('level','1');
    }
    $this->db->order_by('tgl_bergabung','ASC');
    return $this->db->get('karyawan');
  }

  function simpandp3()
  {
    $nik = $this->input->post('nik');
    $smt = $this->input->post('smt');
    $tahun = $this->input->post('tahun');
    $thn = substr($tahun,2,2);
    $iddp3 = $thn.$nik.$smt;
    $data = [
      'id_dp3' => $iddp3,
      'nik' => $nik,
      'semester' => $smt,
      'tahun' => $tahun
    ];
    $cek = $this->db->get_where('dp3_karyawan',array('id_dp3'=>$iddp3))->num_rows();
    if($cek != 0)
    {
      return 1;
    }else{
      $simpan = $this->db->insert('dp3_karyawan',$data);
      if($simpan)
      {
        return 1;
      }else{
        return 0;

      }
    }

  }

  function simpanjawabandp3()
  {
    $iddp3 	= $this->input->post('iddp3');
		$soal = $this->input->post('soal');
    $idpiljawaban = $this->input->post('idpiljawaban');

    $data = [
      'id_dp3' => $iddp3,
      'id_pertanyaan' => $soal,
      'id_piljawaban' => $idpiljawaban
    ];

    $dataupdate = [
      'id_piljawaban' => $idpiljawaban
    ];
    $cek = $this->db->get_where('dp3_detailkaryawan',array('id_dp3'=>$iddp3,'id_pertanyaan'=>$soal))->num_rows();
    if($cek != 0)
    {
      $update = $this->db->update('dp3_detailkaryawan',$dataupdate,array('id_dp3'=>$iddp3,'id_pertanyaan'=>$soal));
    }else{
      $simpan = $this->db->insert('dp3_detailkaryawan',$data);
    }
  }

  public function getDataDP3($rowno,$rowperpage,$namakaryawan="",$tahun="",$semester="")
  {
    $level = $this->access->get_level();
    if($level =='marketing')
    {
      $this->db->where('kode_divisi','MKT');
    }else if($level=='cnp'){
      $this->db->where('kode_divisi','CNP');
    }else if($level=='pendidikan'){
      $this->db->where('kode_divisi','PDD');
    }else if($level=='ict'){
      $this->db->where('kode_divisi','ICT');
    }
    $this->db->select('dp3_detailkaryawan.id_dp3,dp3_karyawan.nik,nama_karyawan,semester,tahun,SUM(nilai) as totalnilai');
    $this->db->from('dp3_detailkaryawan');
    $this->db->join('dp3_karyawan','dp3_detailkaryawan.id_dp3 = dp3_karyawan.id_dp3');
    $this->db->join('dp3_piljawaban','dp3_detailkaryawan.id_piljawaban = dp3_piljawaban.id_piljawaban');
    $this->db->join('karyawan','dp3_karyawan.nik = karyawan.nik');
    if($namakaryawan != ''){
    	$this->db->like('nama_karyawan', $namakaryawan);
  	}
    if($tahun != ''){
    	$this->db->where('tahun', $tahun);
    }
    if($semester != ''){
    	$this->db->where('semester', $semester);
    }

    $this->db->group_by('dp3_detailkaryawan.id_dp3,dp3_karyawan.nik,nama_karyawan,semester,tahun');
    $this->db->order_by('tgl_bergabung','ASC');
 		$this->db->limit($rowperpage, $rowno);
  	$query = $this->db->get();
    return $query->result_array();
 	}

  public function getrecordDP3($namakaryawan="",$tahun="",$semester)
  {
    if($namakaryawan 	!= ""){
			$namakaryawan = "AND nama_karyawan like '%".$namakaryawan."%' ";
    }
    if($tahun 	!= ""){
			$tahun = "AND tahun = '".$tahun."' ";
    }

    if($semester 	!= ""){
			$semester = "AND semester = '".$semester."' ";
    }

    $level = $this->access->get_level();
    if($level =='marketing')
    {
      $divisi = "AND karyawan.kode_divisi = 'MKT' ";
    }else if($level=='cnp'){
      $divisi = "AND karyawan.kode_divisi = 'CNP' ";
    }else if($level=='pendidikan'){
      $divisi = "AND karyawan.kode_divisi = 'PDD' ";
    }else if($level=='ict'){
      $divisi = "AND karyawan.kode_divisi = 'ICT' ";
    }
    $query = "SELECT COUNT(*)  as allcount
    FROM (
      SELECT
        count(*) AS allcount
      FROM
        `dp3_detailkaryawan`
        JOIN `dp3_karyawan` ON `dp3_detailkaryawan`.`id_dp3` = `dp3_karyawan`.`id_dp3`
        JOIN `dp3_piljawaban` ON `dp3_detailkaryawan`.`id_piljawaban` = `dp3_piljawaban`.`id_piljawaban`
        JOIN `karyawan` ON `dp3_karyawan`.`nik` = `karyawan`.`nik`
      WHERE dp3_detailkaryawan.id_dp3 != ''"
      .$namakaryawan
      .
      "GROUP BY
        `dp3_detailkaryawan`.`id_dp3`,
        `dp3_karyawan`.`nik`,
        `nama_karyawan`,
        `semester`,
        `tahun`
      ) A";


    $query 	= $this->db->query($query);
    $result = $query->result_array();
    return $result[0]['allcount'];
  }

  function simpanevaluasidp3()
  {
    $iddp3 = $this->input->post('iddp3');
    $nilaipositif = $this->input->post('nilaipositif');
    $nilainegatif = $this->input->post('nilainegatif');
    $komentarkaryawan = $this->input->post('komentarkaryawan');
    $rekomendasi = $this->input->post('rekomendasi');

    $data = [
      'id_dp3' => $iddp3,
      'nilai_positif' => $nilaipositif,
      'nilai_negatif' => $nilainegatif,
      'komentar' => $komentarkaryawan,
      'rekomendasi' => $rekomendasi
    ];

    $dataupdate = [
      'nilai_positif' => $nilaipositif,
      'nilai_negatif' => $nilainegatif,
      'komentar' => $komentarkaryawan,
      'rekomendasi' => $rekomendasi
    ];
    $cek = $this->db->get_where('dp3_evaluasi',array('id_dp3'=>$iddp3))->num_rows();
    if($cek !=0)
    {
      $update = $this->db->update('dp3_evaluasi',$dataupdate,array('id_dp3'=>$iddp3));
      if($update)
      {
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
            </div>
          </div>');
        redirect('keuangan/dp3');
      }else{
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-red order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved UnSuccesfully</h6>
            </div>
          </div>');
        redirect('keuangan/dp3');
      }
    }else{
      $simpan = $this->db->insert('dp3_evaluasi',$data);
      if($simpan)
      {
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
            </div>
          </div>');
        redirect('keuangan/dp3');
      }else{
        $this->session->set_flashdata('msg',
          '<div class="card bg-c-red order-card">
            <div class="card-block">
              <h6><i class="ti-check"></i> Data Saved UnSuccesfully</h6>
            </div>
          </div>');
        redirect('keuangan/dp3');
      }
    }
  }

  function getEvaluasiDp3($iddp3)
  {
    return $this->db->get_where('dp3_evaluasi',array('id_dp3'=>$iddp3));
  }

  function getdp3($iddp3)
  {
    $this->db->join('karyawan','dp3_karyawan.nik = karyawan.nik');
    $this->db->where('id_dp3',$iddp3);
    return $this->db->get('dp3_karyawan');
  }

  function hapusdp3($iddp3)
  {
    $hapusdp3karyawan = $this->db->delete('dp3_karyawan',array('id_dp3'=>$iddp3));
    if($hapusdp3karyawan)
    {
      $hapus_jawaban = $this->db->delete('dp3_detailkaryawan',array('id_dp3'=>$iddp3));
      $hapus_evaluasi = $this->db->delete('dp3_evaluasi',array('id_dp3'=>$iddp3));
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-green order-card">
          <div class="card-block">
            <h6><i class="ti-check"></i> Data Deleted Succesfully</h6>
          </div>
        </div>');
      redirect('keuangan/dp3');
    }else{
      $this->session->set_flashdata('msg',
      '<div class="card bg-c-green order-card">
        <div class="card-block">
          <h6><i class="ti-check"></i> Data Deleted Unsuccessfully</h6>
        </div>
      </div>');
    redirect('keuangan/dp3');
    }
  }

  function getSetDP3()
  {
    return $this->db->get_where('dp3_setting',array('id'=>'1'));
  }
}
