<?php

class StoreRegisterController extends CI_Controller {

   function __construct(){
   	parent::__construct();
   	$this->load->model('store');
   }

   public function check_store_credentials(){

	  	$this->form_validation->set_rules('sName', 'Store Name', 'trim|required|callback_check_store_name',TRUE);
	  	$this->form_validation->set_rules('sAddress', 'Store Address', 'trim|required',TRUE);
	  	$this->form_validation->set_rules('sHourStart','Store Hours open', 'trim|required',TRUE);
	  	$this->form_validation->set_rules('sHourClose', 'Store Hours close', 'trim|required', TRUE);
      if (empty($_FILES['storeimage']['name'])){
          $this->form_validation->set_rules('storeimage', 'Store Image', 'trim|required', TRUE);
      }

      $new_name                       = 'store_image_'.mt_rand();
      $config['upload_path']          = './assets/images/store_image/';
      $config['allowed_types']        = 'jpg|png|gif';
      $config['overwrite']            = TRUE;
      $config['max_size']             = 1024;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;
      $config['file_name']            = $new_name;
      $config['file_ext']             = 'image/jpeg';

      $this->load->library('upload', $config);

	  	if($this->form_validation->run() == FALSE){
        $data['page'] = 'five';
        $data['title'] = 'storeregister';

        $this->load->view('layouts/header');
        $this->load->view('blocks/sidenav',$data);
        $this->load->view('clickbasket',$data);
        $this->load->view('layouts/footer');
	  	} else {

	  		$data = array('store_name' => $this->input->post('sName'),
	  			'store_address' => $this->input->post('sAddress'),
	  			'time_open' => date("H:i", strtotime($this->input->post('sHourStart'))),
          'time_close' => date("H:i", strtotime($this->input->post('sHourClose')))
	  			);

          if ( ! $this->upload->do_upload('storeimage')){
            $error = $this->upload->display_errors();

            $data['page'] = 'five';
            $data['title'] = 'storeregister';
            $data['error'] = $error;

            $this->load->view('layouts/header');
            $this->load->view('blocks/sidenav',$data);
            $this->load->view('clickbasket',$data);
            $this->load->view('layouts/footer');
          }else{
            if($this->store->register_store($data)==TRUE){
              $this->store->upload_storeimage($this->upload->data('file_name'));
              $this->session->set_flashdata('success', TRUE);
    	  			redirect('admin/addstore');
            }
        }
	  	}

	  }//end of check_store_credentials

  public function getStoresByID(){
    $vendorid = $this->input->post('vendorid');

    $this->store->viewStoresByID($vendorid);
  }

  public function check_store_name(){
  	$this->form_validation->set_message('check_store_name', 'Name already exist!');

  	if($this->store->check_name_if_available($this->input->post('sName'))){
       return true;
    } else {
       return false;
	  }

  }//end of check_store_name

  public function remove_Store(){
    $storeid = $this->input->post('storeid');

    $query = array(
      'store_deleted' => 'true'
    );

    $this->store->removeStore($storeid,$query);
	}

  public function unblockStore(){
    $storeid = $this->input->post('storeid');

    $this->store->unblock_store($storeid);
  }

  public function updateStore(){
    $storeid = $this->input->post('storeid');
    $storename = htmlspecialchars($this->input->post('storename'));
    $storeaddress = htmlspecialchars($this->input->post('storeaddress'));
    $timeopen = $this->input->post('timeopen');
    $timeclose = $this->input->post('timeclose');

    $this->form_validation->set_rules('storename','Category Name','trim|required',TRUE);

    if($this->form_validation->run()==false){
      echo "false";
    }else {
      $data = array(
      'store_name' => $storename,
      'store_address' => $storeaddress,
      'time_open' => $timeopen,
      'time_close' => $timeclose
      );
      if($this->store->updateStore($storeid,$data) == true){
        echo "true";
      }
    }

  }

  public function updateStoreImage(){
      $storeid                        = $this->input->get('storeid');
      $new_name                       = $this->input->get('imagename');
      $config['upload_path']          = './assets/images/store_image/';
      $config['allowed_types']        = 'jpg|png';
      $config['overwrite']            = TRUE;
      $config['max_size']             = 1024;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;
      $config['file_name']            = $new_name;
      $config['file_ext']             = 'image/jpeg';

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('mStoreimage')){
        echo $this->upload->display_errors();
      }else{
        $this->store->update_storeimage($this->upload->data('file_name'), $storeid);
        echo 'success';
      }
  }

}
