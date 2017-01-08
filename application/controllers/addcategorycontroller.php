<?php

class AddCategoryController extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('category');

		if($this->session->userdata('restriction')!='admin')
		{
			redirect('login');
		}

	}

	public function check_category_name(){
		$this->form_validation->set_rules('catName','Category','trim|required|callback_check_if_category_exist',TRUE);

		if($this->form_validation->run()==false) {
			echo "false";
		} else {
			$data = ucwords($this->input->post('catName'));

			if($this->category->add_category_to_db($data) == true) {
				$this->session->set_flashdata('success', TRUE);
				echo "true";
			}
		}
	}//end of check_category_name

	public function check_if_category_exist(){
		$this->form_validation->set_message('check_if_category_exist', 'Category already exist!');

		if($this->category->check_if_exist($this->input->post('catName'))) {
			return true;
		} else {
			echo 'exist';
			return false;
		}
	}

	public function check_subcat_name(){
		$this->form_validation->set_rules('subCatName','Category','trim|required|callback_check_if_subcategory_exist',TRUE);

		if($this->form_validation->run()==false) {
			echo "false";
		} else {
			$subcatname = ucwords($this->input->post('subCatName'));
			$catid = $this->input->post('catId');

			if($this->category->add_subcategory_to_db($subcatname,$catid) == true) {
				$this->session->set_flashdata('success', TRUE);
				echo "true";
			}
		}
	}//end of check_subcat_name

	public function check_if_subcategory_exist(){
		$this->form_validation->set_message('check_if_subcategory_exist', 'Sub-Category already exist!');

		if($this->category->check_if_subcat_exist($this->input->post('subCatName'),$this->input->post('catId'))) {
			return true;
		} else {
			echo 'exist';
			return false;
		}
	}

	public function deletecategory(){
		$catid = $this->input->post('categoryid');

		$data = array(
			'category_deleted' => 'true'
		);

		$this->category->deletecategory($catid, $data);
	}

	public function updateCategory(){
		$catid = $this->input->post('catid');
		$catname = htmlspecialchars(ucwords($this->input->post('catName')));

		$this->form_validation->set_rules('catName','Category Name','trim|required|callback_check_if_category_exist',TRUE);

		if($this->form_validation->run()==false)
		{
			echo "false";
		}else {
			$data = array(
			'category_name' => $catname,
			);

			if($this->category->updateCategory($catid,$data) == true)
			{
				echo "true";
			}
		}

	}

	public function getsubCategoryById(){
		$catid = $this->input->post('subcatid');

		$this->category->get_subCategoryById($catid);
	}

}
