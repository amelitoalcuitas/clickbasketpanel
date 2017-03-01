<?php
class VendorPagesController extends CI_Controller {

	var $categorylist;
	var $delcategorylist;
	var $subcategorylist;
	var $delsubcategorylist;
	var $productlist;
	var $delproductlist;
	var $productRow;
	var $orderlist;
	var $deliveredorders;
	var $vendordata;
	var $ordertoday;
	var $prodnum;
	var $ordersmonth;
	var $vendorreport;
	var $coupons;


	public function __construct(){
		parent::__construct();

		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}else if($this->session->userdata('restriction') != 'vendor'){
    		redirect('login');
    	}	

    	$this->load->model('category');

		if($data = $this->category->get_category()){
			$this->categorylist = $data;
		}

		if($data = $this->category->get_subCategory()){
			$this->subcategorylist = $data;
		}

		if($data = $this->category->get_delcategory()){
			$this->delcategorylist = $data;
		}

		if($data = $this->category->get_delsubCategory()){
			$this->delsubcategorylist = $data;
		}

		$this->load->model('product');

		if($products = $this->product->viewproductbystore()){
			$this->productlist = $products;
		}

		if($products1 = $this->product->viewdeletedproducts()){
			$this->delproductlist = $products1;
		}

		if($products1 = $this->product->getprodnum()){
			$this->prodnum = $products1;
		}

		if($coupon = $this->product->get_coupons()){
			$this->coupons = $coupon;
		}

		$this->load->model('order');

		if($orders = $this->order->get_orders()){
			$this->orderlist = $orders;
		}

		if($orders = $this->order->vendor_report()){
			$this->vendorreport = $orders;
		}

		if($orders = $this->order->get_orders_today()){
			$this->ordertoday = $orders;
		}

		if($orders = $this->order->get_orders_this_month()){
			$this->ordersmonth = $orders;
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
			$data['vendordata'] = $this->vendordata;
			$data['orderstoday'] = $this->ordertoday;
			$data['ordersmonth'] = $this->ordersmonth;
			$data['prodnum'] = $this->prodnum;

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
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header',$data);
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewdelproduct(){

			$data['page'] = 'delprod';
			$data['title'] = 'vendordeletedproducts';
			$data['delproductlist'] = $this->delproductlist;
			$data['vendordata'] = $this->vendordata;

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
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function deletedcategories(){

			$data['page'] = 'delcat';
			$data['title'] = 'deletedcategories';
			$data['delcategorylist'] = $this->delcategorylist;
			$data['delsubcategorylist'] = $this->delsubcategorylist;
			$data['vendordata'] = $this->vendordata;

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
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header',$data);
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function addcategory(){
			$data['page'] = 'six';
			$data['title'] = 'vendoraddcategory';
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewOrders(){
			$data['page'] = 'seven';
			$data['title'] = 'vieworders';
			$data['orderlist'] = $this->orderlist;
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function orderHistory(){
			$data['page'] = 'nine';
			$data['title'] = 'orderhistory';
			$data['deliveredorders'] = $this->deliveredorders;
			$data['vendordata'] = $this->vendordata;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function vendorreport(){
			$data['page'] = 'report';
			$data['title'] = 'vendorreport';
			$data['vendordata'] = $this->vendordata;
			$data['vendorreport'] = $this->vendorreport;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewcoupons(){
			$data['page'] = 'coupon';
			$data['title'] = 'vendorcoupons';
			$data['vendordata'] = $this->vendordata;
			$data['coupons'] = $this->coupons;

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
