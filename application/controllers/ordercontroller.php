<?php

class OrderController extends CI_Controller{

  public function __construct(){
    parent::__construct();

  }

  function changeOrderStatus(){
    $id = $this->input->post('id');
    $stat = $this->input->post('stat');
    $this->load->model('order');
    $this->order->change_order_status($id,$stat);
  }

}
