<?php
class PagesController extends CI_Controller {

	protected $removedstorelistdata;
	protected $removedvendorslistdata;
	protected $vendorlistdata;
	protected $storelistdata;

	public function __construct(){
		parent::__construct();

		$this->load->model('vendor');

		if ($query = $this->vendor->viewVendors()) {
			$this->vendorlistdata = $query;
		}

		if ($query = $this->vendor->viewRemovedVendors()) {
			$this->removedvendorslistdata = $query;
		}

		$this->load->model('store');

	  if($query = $this->store->viewStores()) {
    	$this->storelistdata = $query;
    }

		if ($query = $this->store->viewRemovedStores()) {
			$this->removedstorelistdata = $query;
		}

		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}else if($this->session->userdata('restriction') != 'superadmin')
    {
    	redirect('login');
    }
	}


	public function index(){
			$data['page'] = 'one';
			$data['title'] = 'dashboard';

			$this->load->view('layouts/header');
			$this->load->view('blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewvendors(){
		    $data['vendorlist'] = $this->vendorlistdata;
		    $data['page'] = 'two';
		    $data['title'] = 'viewvendors';

		    $this->load->view('layouts/header');
		    $this->load->view('blocks/sidenav',$data);
		    $this->load->view('clickbasket',$data);
		    $this->load->view('layouts/footer');
	}

	public function register(){
			$data['storelist'] = $this->storelistdata;
			$data['page'] = 'three';
			$data['title'] = 'register';

			$this->load->view('layouts/header');
			$this->load->view('blocks/sidenav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

		public function viewremovedvendors(){
		    $data['vendorlist'] = $this->removedvendorslistdata;
		    $data['page'] = 'remVen';
		    $data['title'] = 'removedvendors';

		    $this->load->view('layouts/header');
		    $this->load->view('blocks/sidenav',$data);
		    $this->load->view('clickbasket',$data);
		    $this->load->view('layouts/footer');
			}

	 public function viewstores(){
	        $data['page'] = 'four';
	        $data['stores'] = $this->storelistdata;
	        $data['title'] = 'viewstores';

	        $this->load->view('layouts/header');
	        $this->load->view('blocks/sidenav',$data);
	        $this->load->view('clickbasket',$data);
	        $this->load->view('layouts/footer');
	 }

	 public function storeregister(){
 	       $data['page'] = 'five';
 	       $data['title'] = 'storeregister';

	       $this->load->view('layouts/header');
	       $this->load->view('blocks/sidenav',$data);
	       $this->load->view('clickbasket',$data);
	       $this->load->view('layouts/footer');
		}

		public function viewremovedstores(){
 	        $data['page'] = 'remStor';
 	        $data['stores'] = $this->removedstorelistdata;
 	        $data['title'] = 'removedstores';

 	        $this->load->view('layouts/header');
 	        $this->load->view('blocks/sidenav',$data);
 	        $this->load->view('clickbasket',$data);
 	        $this->load->view('layouts/footer');
 	 }

	public function logout(){
		   $this->session->sess_destroy();
		   redirect('login');

	}


}
