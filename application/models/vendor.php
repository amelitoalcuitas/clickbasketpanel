<?php
class Vendor extends CI_Model{

  public function login($name, $pass){

    $this->db->select('*');
    $this->db->from('store_vendor');
    $this->db->join('vendor', 'vendor.vendor_id = store_vendor.vendor_id', 'left');
    $this->db->join('store', 'store.store_id = store_vendor.store_id', 'left');
    $this->db->where('vendor_username', $name);
    $this->db->where('vendor_password', $pass);
    $this->db->where('vendor_deleted', 'false');

    $query = $this->db->get();

    if($query->num_rows() > 0){
      return $query->row();
    } // checks if there are rows from users > 0

    $this->db->select('superadmin_fname, superadmin_lname , superadmin_email, restriction');
    $this->db->from('superadmin');
    $this->db->where('superadmin_username', $name);
    $this->db->where('superadmin_password', $pass);

    $rs_str = $this->db->get();

    if($rs_str->num_rows() > 0){
      return $rs_str->row();
    }

    if($query->num_rows()== 0 AND $rs_str->num_rows() == 0){
      return false;
    }

  }
  // end of login

  public function viewVendors(){
    $this->db->join('store_vendor','store_vendor.vendor_id = vendor.vendor_id','left');
    $this->db->join('store','store.store_id = store_vendor.store_id','left');
    $this->db->where('vendor_deleted', 'false');
    $query = $this->db->get('vendor');
    return $query->result();
  }
  //end of view users

  public function viewVendorByID(){
    $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
    $query = $this->db->get('vendor');
    return $query->row();
  }

  public function viewRemovedVendors(){
    $this->db->join('store_vendor','store_vendor.vendor_id = vendor.vendor_id','left');
    $this->db->join('store','store.store_id = store_vendor.store_id','left');
    $this->db->where('vendor_deleted', 'true');
    $query = $this->db->get('vendor');
    return $query->result();
  }


  function register_admin($vendor,$storeid){
      $this->db->insert('vendor', $vendor);

      $query = $this->db->query("SELECT vendor_id FROM vendor WHERE vendor_username = "."'".$vendor['vendor_username']."'");
      $row = $query->row();
      if (isset($row)){
        $storevendor = array('vendor_id' => $row->vendor_id, 'store_id' => $storeid['store_id']);
        $this->db->insert('store_vendor',$storevendor);
      }

  }

  function check_username($username){
    $query_str = "SELECT vendor_username from vendor WHERE vendor_username = ?";

    $result = $this->db->query($query_str,$username);

    if($result->num_rows() > 0){
      return false;
    } else {
      return true;
    }
  }

  function check_email($email){
    $query_str = "SELECT vendor_email from vendor WHERE vendor_email = ?";

    $result = $this->db->query($query_str,$email);

    if($result->num_rows() > 0){
      return false;
    } else {
      return true;
    }
  }

  public function remove_vendor($id){
    $this->db->where('vendor_id', $id);
    $update = array('vendor_deleted' => 'true');
    $this->db->update('vendor',$update);
  }

  public function unblock_vendor($id){
    $this->db->where('vendor_id', $id);
    $update = array('vendor_deleted' => 'false');
    $this->db->update('vendor',$update);
  }

  public function forgot_pass($email,$key){
    $query_str = "SELECT * from vendor WHERE vendor_deleted = 'false' AND vendor_email = ?";

    $result = $this->db->query($query_str,$email);

    if($result->num_rows() > 0){
      $update = array('vendor_key' => $key);
      $this->db->where('vendor_email',$email);
      $this->db->update('vendor',$update);
      return true;
    } else {
      return false;
    }

  }

  public function update_user($update){
    $id = $this->session->userdata('vendor_id');

    $this->db->where('vendor_id',$id);
    $this->db->update('vendor',$update);
  }

  public function check_key($key,$id){
    $this->db->where('vendor_id',$id);
    $this->db->where('vendor_deleted','false');
    $this->db->where('vendor_key',$key);

    $result = $this->db->get('vendor');

    if($result->num_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

  public function change_password($key,$id,$pass){
    $this->db->where('vendor_id',$id);
    $this->db->where('vendor_deleted','false');
    $this->db->where('vendor_key',$key);

    $this->db->update('vendor',array('vendor_password' => $pass, 'vendor_key' => NULL));
  }

  public function upload_profpic(){
    
  }

}
