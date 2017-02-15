<?php

class Store extends CI_Model {

	function __construct() {
	   parent::__construct();
	}


	public function register_store($data){
		 if($this->db->insert('store', $data)){
		 	return true;
		 } else {
		 	return false;
		 }
	}

	public function check_name_if_available($storename)
	{
		$query_str = "SELECT store_name from store WHERE store_name = ?";

		$result = $this->db->query($query_str,$storename);

		if($result->num_rows() > 0)
		{
			return false;
		} else {
			return true;
		}
	}
	//end of check_name_if_available

	public function viewStores(){
		$this->db->where('store_deleted', 'false');
		$query = $this->db->get('store');
		return $query->result();
	}

	public function viewStoresByID($id){
		$this->db->join('store','store.store_id = store_vendor.store_id','left');
		$this->db->where('store_vendor.vendor_id', $id);
		$this->db->where('store_deleted', 'false');
		$query = $this->db->get('store_vendor');

		if($query){
			echo json_encode($query->result());
		}
	}

	public function viewRemovedStores(){
		$this->db->where('store_deleted', 'true');
		$query = $this->db->get('store');
		return $query->result();
	}

	public function removeStore($storeid,$query){
		$this->db->where('store_id', $storeid);

		$this->db->update('store', $query);
	}

	public function unblock_store($storeid){
		$this->db->where('store_id', $storeid);
		$update = array('store_deleted' => 'false');
		$this->db->update('store', $update);
	}

	public function updateStore($storeid,$data){
		$this->db->where('store_id', $storeid);

		if($this->db->update('store',$data)){
			if($this->db->affected_rows() > 0){
				return true;
			}
		}
	}

	public function update_storeimage($filename,$storeid){
    $this->db->where('store_id', $storeid);

    $this->db->update('store',array('store_image' => $filename));
  }

	public function upload_storeimage($filename){
		$id = $this->db->insert_id();
    $this->db->where('store_id', $id);

    $this->db->update('store',array('store_image' => $filename));
  }

}
