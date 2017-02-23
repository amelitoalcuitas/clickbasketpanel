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
		$product_desc = $this->input->post('pdesc');
		$product_quantity = $this->input->post('pqty');
		$product_subcat = $this->input->post('pscat');
	  	$counter = $this->input->post('count');

		if($this->check_if_thisproduct_exist($product_name,$counter) == true) {
			if($this->product->addProduct($product_name,$product_desc,$product_price,$product_quantity,$product_subcat,$counter) == true)	{
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
		if($this->product->check_if_exist($this->input->post('pname'),1)) {
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

		$this->product->deleteProduct($prodid,$data,'delete');
	}

	public function restoreProduct(){
		$prodid = $this->input->post('productid');

		$data = array(
		'storeprod_deleted' => 'false'
		);

		$this->product->deleteProduct($prodid,$data,'restore');
	}

	public function addDiscount(){
		$discount = $this->input->post('discount');
		$prodid = $this->input->post('id');
		$dateStart = $this->input->post('dateStart');
		$dateEnd = $this->input->post('dateEnd');
		$dType = $this->input->post('dType');

		$data = array(
			'discount_type' => $dType,
			'discount' => $discount,
			'storeprod_id' => $prodid,
			'date_start' => $dateStart,
			'date_end' => $dateEnd
		);

		$this->product->add_discount($prodid,$data);
	}

	public function getDiscountById(){
		$id = $this->input->post('id');
		$this->product->get_DiscountById($id);
	}

	public function updateProductImage(){
			$currentname 										= $this->input->get('imagename');

			if($currentname == 'prod_image_def.jpg'){
				$new_name = 'prod_image_'.mt_rand();
			}else{
				$new_name = $currentname;
			}

      $prodid                        	= $this->input->get('prodid');
      $config['upload_path']          = './assets/images/prod_image/';
      $config['allowed_types']        = 'jpg|png|jpeg|gif';
      $config['overwrite']            = TRUE;
      $config['max_size']             = 2048;
      $config['max_width']            = 1024;
      $config['max_height']           = 1024;
      $config['file_name']            = $new_name;
      $config['file_ext']             = 'image/jpeg';

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('mProdImage')){
        echo $this->upload->display_errors();
      }else{
        $this->product->update_prodimage($this->upload->data('file_name'), $prodid);
        echo 'success';
      }
  }

	public function check_if_product_existsingle(){
		if($this->product->check_if_existsingle($this->input->post('pname'),$this->input->post('sproductid'))) {
			return true;
		} else {
			echo 'exist';
			return false;
		}
	}

	public function updateProduct(){
		$sprodid = $this->input->post('sproductid');
		$prodid = $this->input->post('productid');
		$prodname = htmlspecialchars($this->input->post('pname'));
		$prodcat = $this->input->post('pcategory');
		$prodsubcat = $this->input->post('psubcategory');
		$prodprice = $this->input->post('pprice');
		$proddesc = $this->input->post('desc');

		$this->form_validation->set_rules('pname','Product Name','trim|required',TRUE);
		$this->form_validation->set_rules('pname','Product Name','trim|required|callback_check_if_product_existsingle',TRUE);

		if($this->form_validation->run()==false){
			echo "false";
		}else {
			$products = array(
			'prod_desc' => $proddesc,
			'prod_name' => $prodname
			);

			$storeprod =  array(
			'storeprod_price' => $prodprice
			);

			$subcategory = array(
			'subcategory_id' => $prodsubcat
			);

			if($this->product->updateProduct($sprodid,$prodid,$products,$storeprod,$subcategory) == true)
			{
				echo "true";
			}
		}
	}

}
