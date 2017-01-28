<?php


if($this->session->userdata('logged_in')==TRUE)
{

	if($this->session->userdata('restriction')=='superadmin' && $this->session->userdata('restriction')!= 'admin' )//parent if
	{
			if ($title == 'dashboard'){
				$this->load->view('main_pages/dashboard');
			}
			if ($title == 'viewvendors'){
				$this->load->view('main_pages/vendorlist');
			}
			if ($title == 'register'){
				$this->load->view('main_pages/register');
			}
			if ($title == 'removedvendors'){
				$this->load->view('main_pages/removedvendors');
			}
			if ($title == 'viewstores'){
				 $this->load->view('main_pages/storelist');
			}
			if ($title == 'storeregister'){
				$this->load->view('main_pages/storeregister');
			}
			if ($title == 'removedstores'){
				$this->load->view('main_pages/removedstores');
			}
	 }

	 if($this->session->userdata('restriction')=='admin' && $this->session->userdata('restriction')!='superadmin')
	 {
		 	if ($title == 'vendordashboard')
			{
				 $this->load->view('vendor_main_pages/vendordashboard');
			}

			if($title == 'vendorviewproducts')
			{
				$this->load->view('vendor_main_pages/viewproducts');
			}
			if($title == 'vendorviewcategories')
			{
				$this->load->view('vendor_main_pages/viewcategories');
			}
			if($title == 'vendoraddnewproduct')
			{
				 $this->load->view('vendor_main_pages/addproduct');
			}
			if($title == 'vendoraddcategory')
			{
				 $this->load->view('vendor_main_pages/addcategory');
			}
			if($title == 'vieworders')
			{
				 $this->load->view('vendor_main_pages/vieworders');
			}
			if($title == 'deliverystatus')
			{
				 $this->load->view('vendor_main_pages/deliverystatus');
			}
			if($title == 'orderhistory')
			{
				 $this->load->view('vendor_main_pages/orderhistory');
			}
			if($title == 'profile')
			{
				 $this->load->view('vendor_main_pages/profile');
			}
	 }

}else {
	redirect('login');
}


 ?>
