<?php

class Upload extends CI_Controller {

    public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url', 'file'));
            $this->load->model('vendor');
    }

    public function do_upload(){
        $new_name = 'vendor_'.$this->session->userdata('vendor_id').'_ppic';
        $config['upload_path']          = './assets/images/prof_pic/';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']            = TRUE;
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = $new_name;
        $config['file_ext']            = 'image/jpeg';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')){
          echo $this->upload->display_errors();
        }else{
          $this->vendor->upload_profpic($this->upload->data('file_name'));
          echo 'success';
        }
    }
}
