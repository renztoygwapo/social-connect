<?php $this->load->view('/components/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    	<div class="signup-box aligncenter">
    	<a href="#" class="btn btn-social btn-facebook btn-block"><i class="fa fa-facebook"></i>Login with Facebook</a>
    	<a href="#" class="btn btn-social btn-google-plus btn-block"><i class="fa fa-google-plus"></i>Login with Google</a>
    	<a href="#" class="btn btn-social btn-twitter btn-block"><i class="fa fa-twitter"></i>Login with Twitter</a>
    	<div class="row-separator"><span></span><p>OR</p><span></span></div>
    	<h3>Signup with Email</h3>
      	<form>
            <div class="form-group">
            <input type="text" placeholder="Your Name" class="form-control input-hg">
            </div>
      		  <div class="form-group">
            <input type="email" placeholder="Email Address" class="form-control input-hg">
          	</div>
          	<div class="form-group">
            <input type="password" placeholder="Password" class="form-control input-hg">
          	</div>
            <div class="form-group">
            <input type="password" placeholder="Confirm Password" class="form-control input-hg">
            </div>
          	<div class="form-group">
          	<input type="submit" class="btn btn-secondary btn-block" value="Submit">
          	</div>
      	</form>
      	<span>Have an Account? <a href="/">Login here.</a> </span>
    	</div>
    </div>
  </div>
</div>
<?php $this->load->view('/components/footer'); ?>