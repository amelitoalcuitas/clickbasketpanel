<?php

class Order extends CI_Model{

	public function __construct()
	{
		parent::__construct();

    $this->db->select('*');
    $this->db->join('products','products.prod_id = store_products.prod_id');
    $this->db->join('orders','orders.storeprod_id = store_products.storeprod_id');
    $this->db->join('consumers','consumers.consumer_id = orders.consumer_id');
    $this->db->join('store_products_subcategory','store_products_subcategory.storeprod_id = store_products.storeprod_id');
    $this->db->join('store','store.store_id = store_products_subcategory.store_id');
    $this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));
	}

  public function get_orders(){
    $query = $this->db->get('store_products');
    return $query->result();
  }

}
