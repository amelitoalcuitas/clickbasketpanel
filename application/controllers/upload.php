<?php

class Upload extends CI_Controller {

    public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
    }

    public function do_upload(){
        $new_name = $this->
        $config['upload_path']          = './assets/images/prof_pic/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = $new_name;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')){
          echo $this->upload->display_errors();
        }else{

          echo 'success';
        }
    }
}
