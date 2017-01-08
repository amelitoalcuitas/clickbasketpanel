<?php

class AddProductController extends CI_Controller {

	protected $categorylist;

	public function __construct(){
		parent::__construct();

		$this->load->model('product');

		if($this->session->userdata('restriction')!='admin')
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

}
