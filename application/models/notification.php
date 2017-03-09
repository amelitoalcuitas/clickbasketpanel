<?php

class Notification extends CI_Model{

	public function __construct()
	{
		parent::__construct();

		$this->db->select('*');
		$this->db->where('store_id',$this->session->userdata('store_id'));
	}

	public function getNotifCount(){
		$this->db->where('status','unread');
		$this->db->order_by('notif_time','desc');

    $query = $this->db->get('notification');

		echo json_encode($query->result());
	}

  public function getNotification(){
		$this->db->order_by('notif_time','desc');

    $query = $this->db->limit(8)->get('notification');

    if($query->num_rows() > 0){

			foreach ($query->result() as $row) {
				if($row->status == 'unread'){
					echo '<li style="background:#e9e9e9;">
									<a href="'.base_url('vendor/viewOrders?id='.$row->order_id).'" onclick="notifRead('.$row->notif_id.')" class=" waves-effect waves-block">
										<div class="icon-circle bg-purple">
												<i class="material-icons">settings</i>
										</div>
										<div class="menu-info">
												<h4>'.$row->notif_title.'</h4>
												<p>
														<i class="material-icons">access_time</i>
														<time class="timeago" datetime="'.$row->notif_time.'">'.$row->notif_time.'</time>
												</p>
										</div>
									</a>
								</li>';
				}else{
					echo '<li>
									<a href="'.base_url('vendor/viewOrders?id='.$row->order_id).'" onclick="notifRead('.$row->notif_id.')" class=" waves-effect waves-block">
										<div class="icon-circle bg-purple">
												<i class="material-icons">settings</i>
										</div>
										<div class="menu-info">
												<h4>'.$row->notif_title.'</h4>
												<p>
														<i class="material-icons">access_time</i>
														<time class="timeago" datetime="'.$row->notif_time.'">'.$row->notif_time.'</time>
												</p>
										</div>
									</a>
								</li>';
				}
			}
		}else{
			echo '';
    }
  }

	public function notifRead($id){
		$read = array('status' => 'read');
		$this->db->where('notif_id',$id);

		$this->db->update('notification',$read);
	}

}
