<?php

class Category extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_category_to_db($category){
		$storeid = $this->session->userdata('store_id');
		$data = array('category_name'=>$category);

		$this->db->insert('category', $data);

		$query = $this->db->query("SELECT category_id FROM category WHERE category_name = '".$category."' ORDER BY category_id DESC LIMIT 1");
		$row = $query->row();
		if (isset($row)){
			$storecat = array('store_id' => $storeid, 'category_id' => $row->category_id);
			$this->db->insert('store_category',$storecat);
		}

		return true;
	}

	public function add_subcategory_to_db($subcatname,$catid){
		$storeid = $this->session->userdata('store_id');
		$data = array(
								'subcategory_name' => $subcatname,
								'category_id' => $catid
						);

		$this->db->insert('subcategory', $data);

		return true;
	}

	public function deleteCategory($catid, $data){
		$this->db->select('subcategory_name');
		$this->db->join('subcategory','subcategory.category_id = category.category_id','left');
		$this->db->where('category.category_id',$catid);
		$this->db->where('subcategory_deleted','false');
		$subcat = $this->db->get('category');

		if($subcat->num_rows() > 0){
			echo 'failed';
		}else{
			$this->db->where('category_id', $catid);
			$this->db->update('category',$data);
			$this->db->where('category_id', $catid);
			$this->db->update('subcategory',['subcategory_deleted' => 'true']);
			echo 'success';
		}
    	
  	}

	public function check_if_exist($category){
		$storeid = $this->session->userdata('store_id');
		$query_str = "SELECT * from store_category LEFT JOIN category ON category.category_id = store_category.category_id
		 							WHERE category_name = ? AND store_id = '".$this->session->userdata('store_id')."'";

		$result = $this->db->query($query_str,$category);

		if($result->num_rows() > 0)
		{
			return false;
		} else {
			return true;
		}
	}

	public function check_if_subcat_exist($subcatname,$catid){
		$storeid = $this->session->userdata('store_id');
		$query_str = "SELECT * FROM subcategory WHERE subcategory_name = ? AND category_id = '".$catid."'";

		$result = $this->db->query($query_str,$subcatname);

		if($result->num_rows() > 0)
		{
			return false;
		} else {
			return true;
		}
	}

	public function get_category(){
		$this->db->select('category.category_id, category.category_name, category.category_deleted');
		$this->db->join('store_category', 'store_category.category_id = category.category_id', 'left');
		$this->db->join('subcategory', 'subcategory.category_id = category.category_id', 'left');
  		$this->db->where('store_category.store_id', $this->session->userdata('store_id'));
		$this->db->where('category_deleted','false');
		$this->db->group_by('category.category_name');

		$query = $this->db->get('category');

		if($query){
			return $query->result();
		}
	}

	public function get_delcategory(){
		$this->db->select('category.category_id, category.category_name, category.category_deleted');
		$this->db->join('store_category', 'store_category.category_id = category.category_id', 'left');
		$this->db->join('subcategory', 'subcategory.category_id = category.category_id', 'left');
  		$this->db->where('store_category.store_id', $this->session->userdata('store_id'));
		$this->db->where('category_deleted','true');
		$this->db->group_by('category.category_name');

		$query = $this->db->get('category');

		if($query){
			return $query->result();
		}
	}

	public function get_subCategory(){
		$this->db->select('*');
		$this->db->join('category', 'category.category_id = subcategory.category_id');
		$this->db->join('store_category', 'store_category.category_id = category.category_id');
  		$this->db->where('store_category.store_id', $this->session->userdata('store_id'));
		$this->db->where('subcategory_deleted','false');
		$this->db->order_by('subcategory_name');

		$query = $this->db->get('subcategory');

		if($query){
			return $query->result();
		}
	}

	public function get_delsubCategory(){
		$this->db->select('*');
		$this->db->join('category', 'category.category_id = subcategory.category_id');
		$this->db->join('store_category', 'store_category.category_id = category.category_id');
  		$this->db->where('store_category.store_id', $this->session->userdata('store_id'));
		$this->db->where('subcategory_deleted','true');
		$this->db->order_by('subcategory_name');

		$query = $this->db->get('subcategory');

		if($query){
			return $query->result();
		}
	}

	public function get_subCategoryById($catid){
		$this->db->where('subcategory_deleted','false');
		$this->db->where('subcategory.category_id', $catid);

		$query = $this->db->get('subcategory');

		if($query){
			echo json_encode($query->result());
		}
	}

	public function updateCategory($catid, $data){
		$this->db->where('category_id', $catid);
		if($this->db->update('category', $data)){
			return true;
		}
	}

	public function deleteSubCategory($subcatid, $data, $state){
		$this->db->select('prod_name');
		$this->db->join('store_products','store_products.storeprod_id = store_products_subcategory.storeprod_id','left');
		$this->db->join('products','products.prod_id = store_products.prod_id','left');
		$this->db->where('subcategory_id',$subcatid);
		$this->db->where('storeprod_deleted','false');
		$subcatprod = $this->db->get('store_products_subcategory');

		if($state == 'delete'){
			if($subcatprod->num_rows() > 0){
				echo 'failed';
			}else{
				$this->db->where('subcategory_id', $subcatid);
				$this->db->update('subcategory',$data);
				echo 'success';
			}
		}else{
			$this->db->where('subcategory_id', $subcatid);
			$this->db->update('subcategory',$data);
			echo 'success';
		}		
	}

	public function updateSubCategory($subcatid, $data){
		$this->db->where('subcategory_id', $subcatid);
		if($this->db->update('subcategory', $data)){
			return true;
		}
	}

}
