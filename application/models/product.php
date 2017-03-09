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

				$query = $this->db->query('SELECT prod_id FROM products WHERE prod_name = "'.$product_name[$x].'" ORDER BY prod_id DESC LIMIT 1');
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

	public function getprodnum(){
		$this->db->select('COUNT(products.prod_id) AS prodnum');
		$this->db->from('store_products');
		$this->db->join('products', 'products.prod_id = store_products.prod_id', 'left');
		$this->db->join('store_products_subcategory', 'store_products_subcategory.storeprod_id = store_products.storeprod_id', 'left');
		$this->db->join('store', 'store.store_id = store_products_subcategory.store_id', 'left');
		$this->db->where('store_products.storeprod_deleted','false');
		$this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));

		$query = $this->db->get();

		return $query->row();
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

	public function add_qty($id,$qty,$newbal){
		if($qty > 0){
			$data = array(
					'inventorytrans_type' => 'replenish',
					'trans_quantity' => $qty,
					'storeprod_id' => $id,
					'inventory_balance' => $newbal
				);
		}else{
			$data = array(
					'inventorytrans_type' => 'deplete',
					'trans_quantity' => $qty,
					'storeprod_id' => $id,
					'inventory_balance' => $newbal
				);
		}


		$this->db->insert('store_products_inventory', $data);
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
		$this->db->where('prod_id', $prodid);

		$this->db->update('store_products',array('storeprod_image' => $filename));
	}

	public function get_coupons(){
		// $this->db->select('coupons.*,store_coupons.*,COUNT(store_coupons_discounts.storecoupon_id) AS uses');
		// $this->db->join('store_coupons', 'store_coupons.coupons_id = coupons.coupons_id', 'left');
		// $this->db->join('store_coupons_discounts', 'store_coupons_discounts.storecoupon_id = coupons.coupons_id', 'left');
		// $this->db->where('store_coupons.store_id', $this->session->userdata('store_id'));
		// $this->db->order_by('store_coupons.storecoupon_id','DESC');
		// $query = $this->db->get('coupons');

		$query = $this->db->query('SELECT coupons.*,store_coupons.*, COUNT(store_coupons_discounts.storecoupon_id) AS uses
													FROM coupons
													LEFT JOIN store_coupons ON store_coupons.coupons_id = coupons.coupons_id
														AND store_coupons.storecoupon_id =
															(SELECT MAX(storecoupon_id)
															 FROM store_coupons a
															 WHERE a.coupons_id = coupons.coupons_id)
												  LEFT JOIN store_coupons_discounts ON store_coupons_discounts.storecoupon_id = store_coupons.coupons_id
													WHERE store_coupons.store_id = '.$this->session->userdata("store_id").'
													GROUP BY coupons.coupons_id
													ORDER BY store_coupons.storecoupon_id DESC');

		return $query->result();
	}

	public function add_coupon($code,$coupons,$storecoupons){
		$this->db->select('*');
		$this->db->where('coupons_id',$code);
		$query = $this->db->get('coupons');

		if($query->num_rows() > 0){
			echo 'exist';
		}else{
			$this->db->insert('coupons', $coupons);

			$query = $this->db->query('SELECT coupons_id FROM coupons WHERE coupons_code = "'.$code.'" ORDER BY coupons_id DESC LIMIT 1');
			$row = $query->row();

			if(isset($row)){
				$scoupon = array(
					'coupondiscount_type' => $storecoupons['coupondiscount_type'],
					'coupons_discount' => $storecoupons['coupons_discount'],
					'coupons_max' => $storecoupons['coupons_max'],
					'date_start' => $storecoupons['date_start'],
					'date_end' => $storecoupons['date_end'],
					'coupons_id' => $row->coupons_id,
					'coupons_status' => 'new',
					'store_id' => $this->session->userdata('store_id')
				);
			}

			$this->db->insert('store_coupons', $scoupon);

			echo 'success';
			$this->session->set_flashdata('success',true);
		}
	}

	public function edit_coupon($id,$storecouponid,$coupon,$scoupon){
		$error = 1;

		if($coupon){
			$this->db->where('coupons_id', $id);
			$this->db->update('coupons', $coupon);
			$error = 0;
		}
		if($scoupon){
			$this->db->insert('store_coupons', $scoupon);
			$error = 0;
		}

		if($error == 0){
			$this->session->set_flashdata('success',true);
			return true;
		}

	}

}
