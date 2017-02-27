<?php

class OrderController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('order');
  }

  public function changeOrderStatus(){
    $id = $this->input->post('id');
    $stat = $this->input->post('stat');
    $decline = $this->input->post('inputValue');

    if(!$stat){
      $stat = 'Order has been completed';
    }
    
    $this->order->change_order_status($id,$stat,$decline);
  }

  public function getOrdersById(){
    $id = $this->input->post('id');

    $this->order->get_orders_by_id($id);
  }

  public function getOrdersbyStore(){
    print_r(json_encode($this->order->get_order_products()));
  }

  public function getMonthlyOrdersbyStore(){
    print_r(json_encode($this->order->get_monthly_order()));
  }
}
