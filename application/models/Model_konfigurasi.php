<?php

class Model_konfigurasi extends CI_Model
{
  function getConfpmb()
  {
    return $this->db->get_where('konfigurasi_pmb',array('id'=>1));
  }

  function update_confpmb()
  {
    $branch_manager    = $this->input->post('bm');
    $ho_mkt            = $this->input->post('homarketing');
    $ta_mkt            = $this->input->post('tamkt');
    $biaya_pendaftaran = $this->input->post('biayapendaftaran');
    $petugas_pmb       = $this->input->post('petugaspmb');
    $ho_pdd            = $this->input->post('hopdd');
    $ta_pdd            = $this->input->post('tapdd');
    $semester_aktif    = $this->input->post('semester_aktif');
    $ho_keuangan       = $this->input->post('hokeuangan');
    $kasir             = $this->input->post('kasir');

    $data = array(
      'branch_manager'    => $branch_manager,
      'ho_mkt'            => $ho_mkt,
      'ta_mkt'            => $ta_mkt,
      'biaya_pendaftaran' => $biaya_pendaftaran,
      'petugas_pmb'       => $petugas_pmb,
      'ho_pdd'            => $ho_pdd,
      'ta_pdd'            => $ta_pdd,
      'semester_aktif'    => $semester_aktif,
      'ho_keuangan'       => $ho_keuangan,
      'petugas_kasir'     => $kasir
    );

    $update = $this->db->update('konfigurasi_pmb',$data,array('id'=>1));
    if($update){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Updated</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/pmb');
    }

  }

  function inputmasterjurusan()
  {
    $kodejurusan  = $this->input->post('kodejurusan');
    $namajurusan  = $this->input->post('namajurusan');
    $data = array(
      'kode_jurusan' => $kodejurusan,
      'nama_jurusan' => $namajurusan
    );
    $simpan = $this->db->insert('master_jurusan',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/masterjurusan');
    }
  }

  function listMasterjurusan()
  {
    return $this->db->get('master_jurusan');
  }

  function hapusmasterjurusan($kode_jurusan)
  {
    $hapus = $this->db->delete('master_jurusan',array('kode_jurusan'=>$kode_jurusan));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/masterjurusan');
    }
  }

  function getmasterJurusan($kode_jurusan)
  {
    return $this->db->get_where('master_jurusan',array('kode_jurusan'=>$kode_jurusan));
  }

  function updatemasterjurusan()
  {
    $kodejurusan  = $this->input->post('kodejurusan');
    $namajurusan  = $this->input->post('namajurusan');
    $data = array(
      'nama_jurusan' => $namajurusan
    );
    $simpan = $this->db->update('master_jurusan',$data,array('kode_jurusan'=>$kodejurusan));
    if($simpan){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Updated</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/masterjurusan');
    }
  }

  function listJurusan($ta_mkt)
  {
    $this->db->select('id,ta_mkt,konfigurasi_jurusan.kode_jurusan,nama_jurusan');
    $this->db->from('konfigurasi_jurusan');
    $this->db->join('master_jurusan','konfigurasi_jurusan.kode_jurusan = master_jurusan.kode_jurusan');
    $this->db->where('ta_mkt',$ta_mkt);
    return $this->db->get();
  }

  function inputjurusan()
  {
    $kodejurusan  = $this->input->post('kodejurusan');
    $ta_mkt       = $this->input->post('ta_mkt');
    $data = array(
      'kode_jurusan' => $kodejurusan,
      'ta_mkt'       => $ta_mkt
    );

    $cek = $this->db->get_where('konfigurasi_jurusan',array('kode_jurusan'=>$kodejurusan,'ta_mkt'=>$ta_mkt))->num_rows();
    if(!empty($cek)){
      $this->session->set_flashdata('msg',
        '<div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6><i class="ti-na"></i> Data Allready Exist</h6>
            </div>
        </div>');
    	redirect('konfigurasi/jurusan');
    }else{
      $simpan = $this->db->insert('konfigurasi_jurusan',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
  	        '<div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
                </div>
            </div>');
  	    	redirect('konfigurasi/jurusan');
      }
    }
  }

  function hapusjurusan($id)
  {
    $hapus = $this->db->delete('konfigurasi_jurusan',array('id'=>$id));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/jurusan');
    }
  }
 function inputuser()
  {
    $username  = $this->input->post('username');
    $password  = $this->input->post('password');
    $fullname  = $this->input->post('fullname');
    $level  = $this->input->post('level');
    $jabatan  = $this->input->post('jabatan');
    $data = array(
      'username' => $username,
      'password' => password_hash($password , PASSWORD_DEFAULT),
      'fullname' => $fullname,
      'level' => $level,
      'active' => 1,
      'foto'=> 'user.png',
      'jabatan' => $jabatan
    );
    $simpan = $this->db->insert('sys_users',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
          '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Saved Succesfully</h6>
              </div>
          </div>');
        redirect('konfigurasi/user');
    }
  }

  function listUser()
  {
    return $this->db->get('sys_users');
  }
  function listUserByLogin($user)
  {
    return $this->db->get_where('sys_users',array('username'=>$user));
  }
  function hapususer($kode_jurusan)
  {
    $hapus = $this->db->delete('sys_users',array('username'=>$kode_jurusan));
    if($hapus){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Deleted</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/user');
    }
  }
  function getuserbyname($username)
  {
    return $this->db->get_where('sys_users',array('username'=>$username));
  }
  function listLevel()
  {
    return $this->db->get('sys_level');
  }
  
  function updateuser()
  {
  $usernameawal  = $this->input->post('usernameawal');
    $username  = $this->input->post('username');
    $fullname  = $this->input->post('fullname');
    $level  = $this->input->post('level');
    $password  = $this->input->post('password');
    $jabatan  = $this->input->post('jabatan');
    $data = array(
      'username' => $username,
      'fullname' => $fullname,
      'level' => $level,
      'active' => 1,
      'password' =>    password_hash($password , PASSWORD_DEFAULT),
      'jabatan' => $jabatan,
 
    );
    $simpan = $this->db->update('sys_users',$data,array('username'=> $usernameawal ));
    if($simpan){
      $this->session->set_flashdata('msg',
	        '<div class="card bg-c-green order-card">
              <div class="card-block">
                  <h6><i class="ti-check"></i> Data Has Been Updated</h6>
              </div>
          </div>');
	    	redirect('konfigurasi/user');
    }
  }

}
