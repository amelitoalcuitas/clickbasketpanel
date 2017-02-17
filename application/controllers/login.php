<?php

class Login extends CI_Controller {

	var $vendordata;

	public function __construct(){
		parent::__construct();

		$this->load->model('vendor');

	}

	public function index(){

		if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('restriction')=='superadmin') {
			redirect('admin');
		} else if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('restriction')=='vendor') {

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

							if($credentials->restriction == 'vendor') {
								if($credentials->vendor_status == 'confirmed'){
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
								}else{
									$data['error'] = "<center> Account is not yet verified! <br> Please check your email. </center>";
									$this->load->view('login',$data);
								}
							} else if($credentials->restriction == 'superadmin') {
								$userdata = array('name'=> $credentials->superadmin_fname.' '.$credentials->superadmin_lname,
									'email'=>$credentials->superadmin_email,
									'restriction'=>$credentials->restriction,
									'logged_in'=> TRUE
									);

								$this->session->set_userdata($userdata);

								redirect('admin');
							}

				} else {
							$data['error'] = "<center> Incorrect username or password! </center>";
							$this->load->view('login',$data);
			 }
		}
	}	//end of check login

	public function forgotPass(){
			$email = $this->input->post('email');
			$key = $this->input->post('key');
			$type = 'forgotpass';

			if($this->vendor->forgot_pass($email,$key) == true){
				$this->sendEmail($email,$key,$type);
				echo 'success';
			}else{
				echo 'failed';
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

// DELETE THIS AFTER TESTING ---------------------------------------------------
	public function forgotpassword(){
		$email = 'macsho10@gmail.com';
		if($vendor = $this->vendor->getVendorByEmail($email)){
			$this->vendordata = $vendor;
		}

		$data['vendordata'] = $this->vendordata;
		$this->load->view('emails/confirmation',$data);
	}
// DELETE THIS AFTER TESTING ---------------------------------------------------


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

	public function confirmAccount(){
		$key = $this->input->get('vendor_key');
		$id = $this->input->get('vendor_id');

		$this->vendor->confirm_account($id);

		if($this->vendor->check_key($key,$id) == true && $key != NULL){
			$data['vendorkey'] = $key;
			$data['vendorid'] = $id;

			$this->load->view('confirmation',$data);
		} else {
			redirect('login');
		}
	}

	public function setUnamePass(){
		$key = $this->input->post('key');
		$id = $this->input->post('id');
		$uname =  $this->input->post('uname');
		$pass = md5($this->input->post('pass'));

		$this->vendor->set_unamepass($key,$id,$pass,$uname);
	}

	public function changePass(){
		$key = $this->input->post('key');
		$id = $this->input->post('id');
		$pass = md5($this->input->post('pass'));

		$this->vendor->change_password($key,$id,$pass);
	}

}
