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

    if($stat == 'completed'){
      $decline = 'Order has been completed';
    }else if($stat == 'pending'){
      $decline = 'Order is still pending';
    }else if($stat == 'processing'){
      $decline = 'Order is still processing';
    }
    
    $this->order->change_order_status($id,$stat,$decline);
  }

  public function restoreQty(){
    $id = $this->input->post('id');

    $this->order->restore_qty($id);
  }

  public function getOrdersById(){
    $id = $this->input->post('id');

    $this->order->get_orders_by_id($id);
  }

  public function getOrdersbyStore(){
    print_r(json_encode($this->order->get_order_products()));
  }

  public function getMonthlyOrdersbyStore(){    
    $month = $this->input->post('getmonth');
    print_r(json_encode($this->order->get_monthly_order($month)));
  }
}
