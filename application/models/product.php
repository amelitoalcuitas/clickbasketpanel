<?php

class Product extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->db->select('*, SUM(trans_quantity) AS balance');
		$this->db->from('store_products');
		$this->db->join('products', 'products.prod_id = store_products.prod_id', 'left');
		$this->db->join('store_products_subcategory', 'store_products_subcategory.storeprod_id = store_products.storeprod_id', 'left');
		$this->db->join('store', 'store.store_id = store_products_subcategory.store_id', 'left');
		$this->db->join('store_products_inventory', 'store_products_inventory.storeprod_id = store_products.storeprod_id', 'left');

	}

	public function addProduct($product_name,$product_desc,$product_price,$product_quantity,$product_subcat,$counter){

		for ($x = 0; $x <= $counter-1; $x++) {

				$query_prod = array('prod_name' => $product_name[$x], 'prod_desc' => $product_desc[$x]);

				$this->db->insert('products',$query_prod);

				$query = $this->db->query("SELECT prod_id FROM products WHERE prod_name = '".$product_name[$x]."' ORDER BY prod_id DESC LIMIT 1");
				$row = $query->row();
				if (isset($row)){
					$query_storeprod = array(
											'storeprod_price' => $product_price[$x],
											'prod_id' => $row->prod_id
										);

					$this->db->insert('store_products',$query_storeprod);
				}

				$query2 = $this->db->query("SELECT storeprod_id FROM store_products WHERE prod_id = ".$row->prod_id);
				$row2 = $query2->row();
				if (isset($row2)){
					$query_storeinv = array(
											'inventorytrans_type' => 'replenish',
											'trans_quantity' => $product_quantity[$x],
											'storeprod_id' => $row2	->storeprod_id,
											'inventory_balance' => $product_quantity[$x]
										);

					$query_subcat = array(
										'subcategory_id' => $product_subcat[$x],
										'storeprod_id' => $row2	->storeprod_id,
										'store_id' => $this->session->userdata('store_id')
									);

					$this->db->insert('store_products_subcategory',$query_subcat);
					$this->db->insert('store_products_inventory',$query_storeinv);
				}

		}

		if($x == $counter){
			return true;
		} else{
			return false;
		}

	}

	public function check_if_exist($product,$count){
		$exist = 0;
		$indexarray = array();

		for($i = 0; $i < $count; $i++){
			$query_str = "SELECT * FROM store_products_subcategory
										LEFT JOIN store_products ON store_products.storeprod_id = store_products_subcategory.storeprod_id
										LEFT JOIN products ON products.prod_id = store_products.prod_id
										WHERE store_products_subcategory.store_id = ".$this->session->userdata('store_id')." AND prod_name = '".$product[$i]."'";

			$result = $this->db->query($query_str);

			if($result->num_rows() > 0){
				$indexarray[] = $i;
				$exist--;
			} else {
				$exist++;
			}
		}

		$this->session->set_flashdata('indexarray',$indexarray);

		if($exist == $count){
			return true;
		}else{
			return false;
		}
	}

	public function product_exist_array(){
		$index = 	$this->session->flashdata('indexarray');
		return $index;
	}

	public function viewproductbystore(){
		$this->db->join('subcategory', 'subcategory.subcategory_id = store_products_subcategory.subcategory_id', 'left');
		$this->db->join('category', 'category.category_id = subcategory.category_id', 'left');
		$this->db->where('store_products.storeprod_deleted','false');
		$this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));
		$this->db->order_by('products.prod_name');
		$this->db->group_by('products.prod_name');

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	public function viewdeletedproducts(){
		$this->db->select('*, SUM(trans_quantity) AS balance');
		$this->db->from('store_products');
		$this->db->join('products', 'products.prod_id = store_products.prod_id', 'left');
		$this->db->join('store_products_subcategory', 'store_products_subcategory.storeprod_id = store_products.storeprod_id', 'left');
		$this->db->join('store', 'store.store_id = store_products_subcategory.store_id', 'left');
		$this->db->join('store_products_inventory', 'store_products_inventory.storeprod_id = store_products.storeprod_id', 'left');
		$this->db->join('subcategory', 'subcategory.subcategory_id = store_products_subcategory.subcategory_id', 'left');
		$this->db->join('category', 'category.category_id = subcategory.category_id', 'left');
		$this->db->where('store_products.storeprod_deleted','true');
		$this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));
		$this->db->order_by('products.prod_name');
		$this->db->group_by('products.prod_name');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}


	public function deleteProduct($prodid, $data, $state){
		if($state == 'delete'){
			$this->db->where('prod_id', $prodid);
			$this->db->update('store_products', $data);
			echo 'success';
		}else if($state == 'restore'){
			$this->db->select('*');
			$this->db->join('store_products_subcategory','store_products_subcategory.subcategory_id = subcategory.subcategory_id','left');			
			$this->db->join('store_products','store_products.storeprod_id = store_products_subcategory.storeprod_id','left');
			$this->db->where('store_products.prod_id', $prodid);
			$this->db->where('subcategory.subcategory_deleted','false');
			$subcat = $this->db->get('subcategory');

			if($subcat->num_rows() > 0){
				$this->db->where('prod_id', $prodid);
				$this->db->update('store_products', $data);
				echo 'success';
			}else{
				echo 'failed';
			}
		}
	}

	public function get_DiscountById($id){
		$this->db->where('storeprod_id', $id);
		$query = $this->db->get('store_products_discounts');

		echo json_encode($query->row());
	}

	public function add_discount($prodid, $data){
		$this->db->select('*');
		$this->db->where('storeprod_id',$prodid);
		$query = $this->db->get('store_products_discounts');

		if($query->num_rows() >0){
			$this->db->where('storeprod_id', $prodid);
			$this->db->update('store_products_discounts',$data);
		}else{
			$this->db->insert('store_products_discounts', $data);
		}
	}

	public function updateProduct($sprodid,$prodid,$products,$storeprod,$subcategory){
		$error = 1;

		if($products){
			$this->db->where('prod_id', $prodid);
			$this->db->update('products', $products);
			$error = 0;
		}
		if($storeprod){
			$this->db->where('storeprod_id', $sprodid);
			$this->db->update('store_products', $storeprod);
			$error = 0;
		}

		if($subcategory){
			$this->db->where('storeprod_id', $sprodid);
			$this->db->update('store_products_subcategory', $subcategory);
			$error = 0;
		}

		if($error == 0){
			return true;
		}

  }

	public function check_if_existsingle($product,$prodid){

	$query_str = "SELECT * FROM store_products_subcategory
								LEFT JOIN store_products ON store_products.storeprod_id = store_products_subcategory.storeprod_id
								LEFT JOIN products ON products.prod_id = store_products.prod_id
								WHERE store_products_subcategory.store_id = ".$this->session->userdata('store_id')." AND prod_name = '".$product."' AND store_products.prod_id !=".$prodid."";

	$result = $this->db->query($query_str);

		if($result->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}


	public function update_prodimage($filename,$prodid){
		$this->db->where('storeprod_id', $prodid);

		$this->db->update('store_products',array('storeprod_image' => $filename));
	}

}
