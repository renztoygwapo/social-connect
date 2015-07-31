<?php
$user= $this->session->userdata('user_name');
if(!isset($user)){
	redirect('login/','refresh');
}
include_once('/../components/header.php');
?>
<div class="container">
  <div class="row">
  <h1>WELCOME HOME <?php if(isset($user)){echo $user; } ?> !</h1>
  </div>
</div>
<?php include_once('/../components/footer.php'); ?>