<?php 

use GuzzleHttp\Client;

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-OzuR3UfRebzqnHWiYOdcV8T8', 'production' => false);
				$this->load->library('midtrans');
				$this->midtrans->config($params);
				$this->load->helper('url');
				$this->load->model('Model_pembayaran');
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {

		// Required
		$transaction_details = array(
		  'order_id' => date("Ymd").rand(),
		  'gross_amount' => str_replace(".","",$this->input->post('bayar')), // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id'=> $this->input->post('kodekontrak'),
		  'price' => str_replace(".","",$this->input->post('bayar')),
		  'quantity' => 1,
		  'name' => "Pembayaran Cicilan "
		);



		// Optional
		$item_details = array ($item1_details);

		// Optional
		$billing_address = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'address'       => "Mangga 20",
		  'city'          => "Jakarta",
		  'postal_code'   => "16602",
		  'phone'         => "081122334455",
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $this->input->post('terimadari'),

		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'day',
            'duration'  => 2
        );

        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {


    	$result = json_decode($this->input->post('result_data'),true);
			$kodekontrak = $this->input->post('kodekontrak');
			$terimadari=$this->input->post('terimadari');
			$order_id=$result['order_id'];
			$bayar=$result['gross_amount'];
			$payment_type=$result['payment_type'];
			$transaction_time=$result['transaction_time'];
			$transaction_status=$result['transaction_status'];
			$bank=$result['va_numbers'][0]['bank'];
			$va_number = $result['va_numbers'][0]['va_number'];
			$url = $result['pdf_url'];

			$data = array(
				'order_id' => $order_id,
				'kodekontrak'=>$kodekontrak,
				'terimadari'=>$terimadari,
				'bayar'=>$bayar,
				'payment_type' => $payment_type,
				'transaction_time' => $transaction_time,
				'transaction_status' => $transaction_status,
				'bank' => $bank,
				'va_number' => $va_number,
				'url'	=> $url
			);

			$this->db->insert('midtrans_transaction',$data);

			redirect('snap/detail/'.$order_id);
    	//echo 'RESULT <br><pre>';
    	//var_dump($result);
    	//echo '</pre>' ;



    }


		function detail(){
			$data['username'] = $this->access->get_username();
	    $data['fullname'] = $this->access->get_fullname();
	    $data['level']	  = $this->access->get_level();
			$order_id					= $this->uri->segment(3);
			$data['detail']		= $this->Model_pembayaran->getdetailmidtrans($order_id)->row_array();
			$this->template->display('pembayaran/detailmidtrans', $data);
		}

		function cekstatus(){
			// $url = file_get_contents("https://api.sandbox.midtrans.com/v2/9692/status");
			// $data = json_decode($url);
			// var_dump($url);

		
			$s = $this->Model_pembayaran->cekstatus();	
			echo $s['transaction_status'];
		}

}
