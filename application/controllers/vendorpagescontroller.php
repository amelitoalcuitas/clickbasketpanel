<?php
class VendorPagesController extends CI_Controller {

	var $categorylist;
	var $subcategorylist;
	var $productlist;
	var $productRow;
	var $orderlist;

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}else if($this->session->userdata('restriction') != 'admin')
      {
        	redirect('login');
      }

    	$this->load->model('category');

    	if($data = $this->category->get_category())
    	{
    		$this->categorylist = $data;
    	}

			if($data = $this->category->get_subCategory())
    	{
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


	}

	public function index()
	{
			$data['page'] = 'one';
			$data['title'] = 'vendordashboard';

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewproduct()
	{

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

	public function viewcategories()
	{

			$data['page'] = 'categ';
			$data['title'] = 'vendorviewcategories';
			$data['categorylist'] = $this->categorylist;
			$data['subcategorylist'] = $this->subcategorylist;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function addproduct()
	{
			$data['page'] = 'five';
			$data['title'] = 'vendoraddnewproduct';
			$data['categorylist'] = $this->categorylist;
			$data['subcategorylist'] = $this->subcategorylist;

			$this->load->view('layouts/header',$data);
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function addcategory()
	{
			$data['page'] = 'six';
			$data['title'] = 'vendoraddcategory';

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function viewOrders()
	{
			$data['page'] = 'seven';
			$data['title'] = 'vieworders';
			$data['orderlist'] = $this->orderlist;

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function deliveryStatus()
	{
			$data['page'] = 'eight';
			$data['title'] = 'deliverystatus';

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

	public function orderHistory()
	{
			$data['page'] = 'nine';
			$data['title'] = 'orderhistory';

			$this->load->view('layouts/header');
			$this->load->view('vendor_blocks/SideNav',$data);
			$this->load->view('clickbasket',$data);
			$this->load->view('layouts/footer');
	}

		public function logout()
		{
			   $this->session->sess_destroy();
			   redirect('login');
		}

		public function deleteProduct(){
			$prodid = $this->input->post('productid');

	    $data = array(
	    'storeprod_deleted' => 'true'
	    );

	    $this->product->deleteProduct($prodid,$data);
		}

		public function updateProduct(){
			$sprodid = $this->input->post('sproductid');
			$prodid = $this->input->post('productid');
			$prodname = htmlspecialchars($this->input->post('pname'));
			$prodcat = $this->input->post('pcategory');
			$prodsubcat = $this->input->post('psubcategory');
			$prodqty = $this->input->post('pquantity');
			$prodprice = $this->input->post('pprice');

			$this->form_validation->set_rules('pname','Product Name','trim|required',TRUE);
			//$this->form_validation->set_rules('pname','Product Name','trim|required|callback_check_if_product_exist',TRUE);


			if($this->form_validation->run()==false)
			{
				echo "false";
			}else {
				$products = array(
		    'prod_name' => $prodname
		    );

				$storeprod =  array(
				'storeprod_price' => $prodprice
		    );

				$subcategory = array(
				'subcategory_id' => $prodsubcat
				);

				$inventory =  array(
				'inventory_stock' => $prodqty
		    );

				if($this->product->updateProduct($sprodid,$prodid,$products,$storeprod,$inventory,$subcategory) == true)
				{
					echo "true";
				}
			}
		}

		public function check_if_product_exist(){
			//$this->form_validation->set_message('check_if_product_exist', 'Product already exist!');

			if($this->product->check_if_exist($this->input->post('pname'))) {
				return true;
			} else {
				echo 'exist';
				return false;
			}
		}

}
