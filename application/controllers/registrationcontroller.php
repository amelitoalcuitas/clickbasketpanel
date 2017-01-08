<?php

class RegistrationController extends CI_Controller{

	 protected  $storelistdata;

	public function __construct()
	{

		parent::__construct();
		$this->load->model('vendor');
		$this->load->model('store');

	  if($query = $this->store->viewStores()) {
    	$this->storelistdata = $query;
    }
	}


	public function check_user_credentials(){

		$this->form_validation->set_rules('uName','Username', 'trim|required|alpha_numeric|callback_check_username_if_exist',TRUE);
		$this->form_validation->set_rules('pass','Password', 'trim|required|alpha_numeric|min_length[6]',TRUE);
		$this->form_validation->set_rules('eMail', 'Email', 'trim|required|valid_email|callback_check_email_if_exist',TRUE);
		$this->form_validation->set_rules('cPass','Password confirmation', 'trim|required|alpha_numeric|min_length[6]|matches[pass]',TRUE);
		$this->form_validation->set_rules('fName','First Name', 'trim|required',TRUE);
		$this->form_validation->set_rules('lName','Last Name', 'trim|required', TRUE);

		if($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'three';
			$data['storelist'] = $this->storelistdata;
			$this->load->view('layouts/header');
			$this->load->view('blocks/sidenav',$data);
			$this->load->view('main_pages/register');
			$this->load->view('layouts/footer');
		} else {

			$vendor = array(
				'vendor_fname' => htmlspecialchars($this->input->post('fName')),
				'vendor_lname' => htmlspecialchars($this->input->post('lName')),
				'vendor_username'=> htmlspecialchars($this->input->post('uName')),
				'vendor_password'=> md5(htmlspecialchars($this->input->post('pass'))),
				'vendor_email'=> htmlspecialchars($this->input->post('eMail')),
				'restriction' => 'admin'
			);

			$storeid = array (
				'store_id' => $this->input->post('store_selected')
			);

				 $this->vendor->register_admin($vendor,$storeid);
				 $this->session->set_flashdata('success', TRUE);
				 redirect('pagescontroller/register',$success);
		}
	}

	public function check_username_if_exist() {
		$this->form_validation->set_message('check_username_if_exist', 'Username already exist!');

		if($this->vendor->check_username($this->input->post('uName')))
		{
			return true;
		} else {
			return false;
		}

	} //end of check username

	public function check_email_if_exist()
	{
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
}
