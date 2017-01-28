<?php

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('vendor');

	}

	public function index(){

		if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('restriction')=='superadmin') {
			redirect('admin');
		} else if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('restriction')=='admin') {

			redirect('vendor');

		} else {
				$this->load->view('login');
		}
	}

	public function checkLogin(){

		$this->form_validation->set_rules('username','Username','required',array('required' => 'Username field is required!'));
		$this->form_validation->set_rules('password','Password','required',array('required' => 'Password field is required!'));
		//for validation

		if($this->form_validation->run() == false){
			$this->load->view('login');

		} else {

			$this->load->model('vendor');
			$name = $this->input->post('username');
			$pass = md5($this->input->post('password'));

					if ($credentials = $this->vendor->login($name, $pass)) {

						if($credentials->restriction == 'admin')
						{

							$userdata = array('name'=> $credentials->vendor_fname.' '.$credentials->vendor_lname,
								'vendor_id' => $credentials->vendor_id,
								'email'=>$credentials->vendor_email,
								'restriction'=>$credentials->restriction,
								'store_id'=>$credentials->store_id,
								'store_name'=>$credentials->store_name,
								'logged_in'=> TRUE
								);

							$this->session->set_userdata($userdata);
							redirect('vendor');

						} else if($credentials->restriction == 'superadmin')
						{
							$userdata = array('name'=> $credentials->superadmin_fname.' '.$credentials->superadmin_lname,
								'email'=>$credentials->superadmin_email,
								'restriction'=>$credentials->restriction,
								'logged_in'=> TRUE
								);

							$this->session->set_userdata($userdata);

							redirect('admin');
						}


					} else {
							$data['error'] = "*Incorrect username or password!";
							$this->load->view('login',$data);
					}
		}
	}	//end of check login

	public function forgotPass(){
			$email = $this->input->post('email');
			$key = $this->input->post('key');

			if($this->vendor->forgot_pass($email,$key) == true){
				echo 'success';
			}else{
				echo 'failed';
			}
	}

	public function changePassword(){
		$key = $this->input->get('vendor_key');
		$id = $this->input->get('vendor_id');

		if($this->vendor->check_key($key,$id) == true && $key != NULL){
			$data['vendorkey'] = $key;
			$data['vendorid'] = $id;

			$this->load->view('changepass',$data);
		} else {
			redirect('login');
		}
	}

	public function changePass(){
		$key = $this->input->post('key');
		$id = $this->input->post('id');
		$pass = md5($this->input->post('pass'));

		$this->vendor->change_password($key,$id,$pass);
	}

}
