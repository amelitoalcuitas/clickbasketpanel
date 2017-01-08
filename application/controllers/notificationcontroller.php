<?php

class NotificationController extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('notification');
  }

  public function get_notification(){
    $this->notification->getNotification();
  }

  public function get_count(){
    $this->notification->getNotifCount();
  }

  public function notif_read(){
    $id = $this->input->post('notifid');
    $this->notification->notifRead($id);
  }

}
