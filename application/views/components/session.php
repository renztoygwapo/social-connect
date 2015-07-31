<?php if (!$this->session->userdata('user_name')) { 
	redirect('admin/login'); }   
$user = $this->session->userdata('user_name'); ?>