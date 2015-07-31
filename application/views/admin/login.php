<?php
$user= $this->session->userdata('user_name');
if(isset($user)){
  redirect('','refresh');
}
include_once('/../components/header.php');
?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    	<div class="signup-box aligncenter">
    	<a href="<?php echo base_url()."login/facebook" ; ?>" class="btn btn-social btn-facebook btn-block"><i class="fa fa-facebook"></i>Login with Facebook</a>
    	<a href="<?php echo base_url()."login/google_login" ; ?>" class="btn btn-social btn-google-plus btn-block"><i class="fa fa-google-plus"></i>Login with Google</a>
    	<a href="<?php echo base_url()."login/twitter" ; ?>" class="btn btn-social btn-twitter btn-block"><i class="fa fa-twitter"></i>Login with Twitter</a>
    	<div class="row-separator"><span></span><p>OR</p><span></span></div>
    	<h3>Login with Email</h3>
      	<form>
      		<div class="form-group">
            <input type="email" placeholder="Email Address" class="form-control input-hg">
          	</div>
          	<div class="form-group">
            <input type="password" placeholder="Password" class="form-control input-hg">
          	</div>
          	<div class="form-group">
          	<input type="submit" class="btn btn-secondary btn-block" value="Submit">
          	</div>
      	</form>
      	<span>New User? <a href="admin/signup">Sign up here.</a> </span>
    	</div>
    </div>
  </div>
</div>
<?php include_once('/../components/footer.php'); ?>