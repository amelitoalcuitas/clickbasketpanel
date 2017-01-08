<?php

class SmsController extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function sendSMS()
  {
      $message = urlencode($this->input->post('message'));
      $from = $this->input->post('from');
      $mobilenum = $this->input->post('number');

      $url = "https://www.smsglobal.com/http-api.php?action=sendsms&user=UberFPS&password=JwnzlHYg&from=".$from."&to=".$mobilenum."&text=".$message;

      $result=file_get_contents($url);
      
      echo $result;
  }

}
