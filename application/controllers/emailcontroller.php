<?php

class EmailController extends CI_Controller{

  public function __construct(){
    parent::__construct();
  }

  function index(){
    $this->load->library('email');

    $this->email->from('postmaster@localhost', 'Postmaster');
    $this->email->to('clickbasket@localhost');

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');
    if($this->email->send()){
      echo 'Email sent. '.$this->email->print_debugger();
     }else{
       echo $this->email->print_debugger();
    }
  }

}
