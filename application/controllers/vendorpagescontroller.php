<?php
class VendorPagesController extends CI_Controller {

	var $categorylist;
	var $subcategorylist;
	var $productlist;
	var $productRow;
	var $orderlist;
	var $deliveredorders;
	var $vendordata;

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}else if($this->session->userdata('restriction') != 'admin'){
    	redirect('login');
    }

    	$this->load->model('category');

    	if($data = $this->category->get_category()){
    		$this->categorylist = $data;
    	}

			if($data = $this->category->get_subCategory()){
    		$this->subcategorylist = $data;
    	}

    	$this->load->model('product');

    	if($products = $this->product->viewproductbystore()){
    		$this->productlist = $products;
    	}

			$this->load->model('order');

			if($orders = $this->order->get_orders()){
				$this->orderlist = $orders;
			}

			if($delivered = $this->order->get_delivered_orders()){
				$this->deliveredorders = $delivered;
			}

			$this->load->model('vendor');

			if($vendor = $this->vendor->viewVendorByID()){
				$this->vendordata = $vendor;
			}
	}

	public function index(){
			$data['page'] = 'one';
			$data['title'] = 'vendordashboard';

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewproduct(){

			$data['page'] = 'four';
			$data['title'] = 'vendorviewproducts';
			$data['productlist'] = $this->productlist;
			$data['categorylist'] = $this->categorylist;
			$data['subcategorylist'] = $this->subcategorylist;

			$this->load->view('layouts/header',$data);
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewcategories(){

			$data['page'] = 'categ';
			$data['title'] = 'vendorviewcategories';
			$data['categorylist'] = $this->categorylist;
			$data['subcategorylist'] = $this->subcategorylist;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function addproduct(){
			$data['page'] = 'five';
			$data['title'] = 'vendoraddnewproduct';
			$data['categorylist'] = $this->categorylist;
			$data['subcategorylist'] = $this->subcategorylist;

			$this->load->view('layouts/header',$data);
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function addcategory(){
			$data['page'] = 'six';
			$data['title'] = 'vendoraddcategory';

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewOrders(){
			$data['page'] = 'seven';
			$data['title'] = 'vieworders';
			$data['orderlist'] = $this->orderlist;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function orderHistory(){
			$data['page'] = 'nine';
			$data['title'] = 'orderhistory';
			$data['deliveredorders'] = $this->deliveredorders;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function profile(){
			$data['page'] = 'ten';
			$data['title'] = 'profile';
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function logout(){
		   $this->session->sess_destroy();
		   redirect('login');
	}

}
