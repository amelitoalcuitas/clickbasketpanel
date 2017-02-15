<?php

class RegistrationController extends CI_Controller{

	 protected  $storelistdata;

	public function __construct(){

		parent::__construct();
		$this->load->model('vendor');
		$this->load->model('store');

	  if($query = $this->store->viewStores()) {
    	$this->storelistdata = $query;
    }
	}


	public function check_user_credentials(){

		$this->form_validation->set_rules('uName','Username', 'trim|required|alpha_numeric|callback_check_username_if_exist',TRUE);
		$this->form_validation->set_rules('eMail', 'Email', 'trim|required|valid_email|callback_check_email_if_exist',TRUE);
		$this->form_validation->set_rules('fName','First Name', 'trim|required',TRUE);
		$this->form_validation->set_rules('lName','Last Name', 'trim|required', TRUE);

		if($this->form_validation->run() == FALSE){
			$data['page'] = 'three';
			$data['title'] = 'vendoraddnewproduct';
			$data['storelist'] = $this->storelistdata;

			$this->load->view('layouts/header');
			$this->load->view('blocks/sidenav',$data);
			$this->load->view('main_pages/register');
			$this->load->view('layouts/footer');
		} else {

		 $rand = md5(random_string('alnum', 16));

			$vendor = array(
				'vendor_fname' => htmlspecialchars($this->input->post('fName')),
				'vendor_lname' => htmlspecialchars($this->input->post('lName')),
				'vendor_username'=> htmlspecialchars($this->input->post('uName')),
				'vendor_email'=> htmlspecialchars($this->input->post('eMail')),
				'vendor_key'=> $rand,
				'restriction' => 'vendor'
			);

			$storeid = array (
				'store_id' => $this->input->post('store_selected')
			);

		 $this->vendor->register_admin($vendor,$storeid);
		 $this->sendEmail($this->input->post('eMail'),$rand,'true');
		 $this->session->set_userdata('success', TRUE);
		 redirect('pagescontroller/register',$success);
		}
	}

	function sendEmail($email,$key,$type){
		$this->load->library('email');

		$this->email->from('clickbasketph@gmail.com', 'ClickBasket');
		$this->email->to($email);

		if($vendor = $this->vendor->getVendorByEmail($email)){
			$this->vendordata = $vendor;
		}

		$data['vendordata'] = $this->vendordata;

		$this->email->subject('ClickBasket: Forgot Password');

		if($type == 'forgotpass'){
			$body = $this->load->view('emails/forgotpassword',$data,TRUE);
		}else{
			$body = $this->load->view('emails/confirmation',$data,TRUE);
		}

		$this->email->message($body);
		if($this->email->send()){
			 echo 'Email sent. '.$this->email->print_debugger();
		 }else{
			 echo $this->email->print_debugger();
		}
	}

	public function check_username_if_exist() {
		$this->form_validation->set_message('check_username_if_exist', 'Username already exist!');

		if($this->vendor->check_username($this->input->post('uName'))){
			return true;
		} else {
			return false;
		}

	} //end of check username

	public function check_email_if_exist(){
		$this->form_validation->set_message('check_email_if_exist', 'Email already exist!');

		if($this->vendor->check_email($this->input->post('eMail')))
		{
			return true;
		} else {
			return false;
		}
	}
	//end of check email

	public function removeVendor(){
		$vendorid = $this->input->post('vendorid');

		$this->vendor->remove_vendor($vendorid);
	}

	public function unblockVendor(){
		$vendorid = $this->input->post('vendorid');

		$this->vendor->unblock_vendor($vendorid);
	}

	public function updateUser(){
		$data =  $this->input->post('input');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$type = '';

		if($name == 'firstname'){
			$type = 'vendor_fname';
		}else if($name == 'lastname'){
			$type = 'vendor_lname';
		}else if($name == 'email'){
			$type = 'vendor_email';
		}else if($name == 'username'){
			$type = 'vendor_username';
		}else if($name == 'password'){
			$type = 'vendor_password';
			$data = md5($this->input->post('input'));
		}

		if($type != ''){
			$update = array($type => $data);
			$this->vendor->update_user($update,$id);
		}

	}

}
