<?php

class StoreRegisterController extends CI_Controller {

 function __construct()
 {
 	parent::__construct();
 	$this->load->model('store');
 }

  public function check_store_credentials()
	  {

	  	$this->form_validation->set_rules('sName', 'Store Name', 'trim|required|callback_check_store_name',TRUE);
	  	$this->form_validation->set_rules('sAddress', 'Store Address', 'trim|required',TRUE);
	  	$this->form_validation->set_rules('sHourStart','Store Hours start', 'trim|required',TRUE);
	  	$this->form_validation->set_rules('sHourClose', 'Store Hours close', 'trim|required', TRUE);


	  	if($this->form_validation->run() == FALSE)
	  	{
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

	  		if($this->store->register_store($data)==TRUE)
	  		{
	  			$this->session->set_flashdata('success', TRUE);
	  			redirect('pagescontroller/storeregister');
	  		}else {
	 			show_404(); //if query was unsucessful;
	  		}
	  	}

	  }//end of check_store_credentials

    public function getStoresByID(){
      $vendorid = $this->input->post('vendorid');

      $this->store->viewStoresByID($vendorid);
    }

	  public function check_store_name()
	  {
	  	$this->form_validation->set_message('check_store_name', 'Name already exist!');

	  	if($this->store->check_name_if_available($this->input->post('sName')))
		{
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

      if($this->form_validation->run()==false)
      {
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

}
