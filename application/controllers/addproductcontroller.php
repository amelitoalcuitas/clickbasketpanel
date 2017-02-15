<?php

class AddProductController extends CI_Controller {

	protected $categorylist;

	public function __construct(){
		parent::__construct();

		$this->load->model('product');

		if($this->session->userdata('restriction')!='vendor')
		{
			redirect('login');
		}

		$this->load->model('category');

		if($data = $this->category->get_category())
		{
			$this->categorylist = $data;
		}

	}

	public function check_product_credentials(){

		$product_name = $this->input->post('pname');
	  $product_price = $this->input->post('pprice');
		$product_quantity = $this->input->post('pqty');
		$product_subcat = $this->input->post('pscat');
	  $counter = $this->input->post('count');

		if($this->check_if_thisproduct_exist($product_name,$counter) == true) {
			if($this->product->addProduct($product_name,$product_price,$product_quantity,$product_subcat,$counter) == true)	{
				$this->session->set_flashdata('success', TRUE);
				echo 'success';
			}
		} else {
			echo "false";
		}

	}

	public function getExistingProducts(){
		echo json_encode($this->product->product_exist_array());
	}

	public function check_if_thisproduct_exist($product_name,$counter){
		if($this->product->check_if_exist($product_name,$counter)) {
			return true;
		} else {
			echo 'exist';
			return false;
		}
	}

  public function check_if_product_exist(){
		if($this->product->check_if_exist($this->input->post('pname'))) {
			return true;
		} else {
			echo 'exist';
			return false;
		}
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

}
