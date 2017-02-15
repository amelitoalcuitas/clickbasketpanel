<?php

class Order extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

  public function get_orders(){
		$this->db->select('*');
		$this->db->from('store_products');
		$this->db->join('store_products_subcategory','store_products_subcategory.storeprod_id = store_products.storeprod_id');
		$this->db->join('products','products.prod_id = store_products.prod_id');
		$this->db->join('orders_store_products', 'orders_store_products.storeprodsub_id = store_products_subcategory.storeprodsub_id');
		$this->db->join('orders', 'orders.order_id = orders_store_products.order_id');
		$this->db->join('consumers','consumers.consumer_id = orders.consumer_id');
		$this->db->join('store','store.store_id = store_products_subcategory.store_id');
		$this->db->where('store_products_subcategory.store_id',1);
		$this->db->where('orders.order_status !=','completed');
		$this->db->group_by('orders_store_products.order_id');
    $query = $this->db->get();

    return $query->result();
  }

	public function get_orders_by_id($id){
		$this->db->select('*');
		$this->db->from('store_products');
		$this->db->join('store_products_subcategory','store_products_subcategory.storeprod_id = store_products.storeprod_id');
		$this->db->join('products','products.prod_id = store_products.prod_id');
		$this->db->join('orders_store_products', 'orders_store_products.storeprodsub_id = store_products_subcategory.storeprodsub_id');
		$this->db->join('orders', 'orders.order_id = orders_store_products.order_id');
		$this->db->join('consumers','consumers.consumer_id = orders.consumer_id');
		$this->db->join('store','store.store_id = store_products_subcategory.store_id');
		$this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));
		$this->db->where('orders.order_id', $id);
		$this->db->where('orders.order_status !=','completed');

		$query = $this->db->get();
		print_r(json_encode($query->result()));
	}

	public function get_delivered_orders(){
		$this->db->select('*');
		$this->db->from('store_products');
		$this->db->join('store_products_subcategory','store_products_subcategory.storeprod_id = store_products.storeprod_id');
		$this->db->join('products','products.prod_id = store_products.prod_id');
		$this->db->join('orders_store_products', 'orders_store_products.storeprodsub_id = store_products_subcategory.storeprodsub_id');
		$this->db->join('orders', 'orders.order_id = orders_store_products.order_id');
		$this->db->join('consumers','consumers.consumer_id = orders.consumer_id');
		$this->db->join('store','store.store_id = store_products_subcategory.store_id');
		$this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));
		$this->db->where('orders.order_status','completed');
		$this->db->group_by('orders_store_products.order_id');

    $query = $this->db->get();
    return $query->result();
  }

	public function change_order_status($id,$stat){
		$this->db->where('order_id',$id);
		$update = array('order_status' => $stat);
		$this->db->update('orders',$update);
	}

	public function get_order_products(){
		$this->db->select('*,sum(orders_store_products.order_qty) AS qty');
		$this->db->from('store_products');
		$this->db->join('store_products_subcategory','store_products_subcategory.storeprod_id = store_products.storeprod_id');
		$this->db->join('products','products.prod_id = store_products.prod_id');
		$this->db->join('orders_store_products', 'orders_store_products.storeprodsub_id = store_products_subcategory.storeprodsub_id');
		$this->db->join('orders', 'orders.order_id = orders_store_products.order_id');
		$this->db->join('consumers','consumers.consumer_id = orders.consumer_id');
		$this->db->join('store','store.store_id = store_products_subcategory.store_id');
		$this->db->where('store_products_subcategory.store_id',$this->session->userdata('store_id'));
		$this->db->where('orders.order_status !=','completed');
		$this->db->group_by('orders_store_products.storeprodsub_id');
		$this->db->limit(5);
		$query = $this->db->get();

		return $query->result();
	}

}
