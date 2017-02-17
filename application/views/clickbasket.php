<?php


if($this->session->userdata('logged_in')==TRUE){

	if($this->session->userdata('restriction') == 'superadmin' && $this->session->userdata('restriction')!= 'vendor' ){
			if ($title == 'dashboard'){
				$this->load->view('content/dashboard');
			}
			if ($title == 'viewvendors'){
				$this->load->view('content/vendorslist_content');
			}
			if ($title == 'register'){
				$this->load->view('content/registeradmin');
			}
			if ($title == 'removedvendors'){
				$this->load->view('content/removedvendors_content');
			}
			if ($title == 'viewstores'){
				 $this->load->view('content/storelist_content');
			}
			if ($title == 'storeregister'){
				$this->load->view('content/registerstore');
			}
			if ($title == 'removedstores'){
				$this->load->view('content/removedstores_content');
			}
	 }

	 if($this->session->userdata('restriction') == 'vendor' && $this->session->userdata('restriction')!='superadmin'){
		 	if ($title == 'vendordashboard'){
				 $this->load->view('vendor_content/view_dashboard');
			}
			if($title == 'vendorviewproducts'){
				$this->load->view('vendor_content/view_product_list');
			}
			if($title == 'vendordeletedproducts'){
				$this->load->view('vendor_content/deletedproducts');
			}
			if($title == 'vendorviewcategories'){
				$this->load->view('vendor_content/view_categories');
			}
			if($title == 'deletedcategories'){
				$this->load->view('vendor_content/deletedcategories');
			}
			if($title == 'vendoraddnewproduct'){
				 $this->load->view('vendor_content/add_product_content');
			}
			if($title == 'vieworders'){
				 $this->load->view('vendor_content/view_orders');
			}
			if($title == 'orderhistory'){
				 $this->load->view('vendor_content/order_history');
			}
			if($title == 'profile'){
				 $this->load->view('vendor_content/profile');
			}
	 }

}else {
	redirect('login');
}


 ?>
