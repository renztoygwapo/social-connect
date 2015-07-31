<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>SOCIAL CONNECT</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/styles.css" />
</head>
<!-- END HEAD -->
<body>
<div class="container-fluid">
<div class="row">
	<nav class="navbar navbar-default" role="navigation">
		<div id="logo"><a href="/">Company Name</a></div>
        		<div class="navbar-header">
					    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
					     <i class="fa fa-bars"></i>
					    </button>
				</div>
					  <div class="collapse navbar-collapse" id="navbar-collapse-01">
					    <ul class="nav navbar-nav">	
	              		  <li><a href="<?php echo base_url(); ?>">Signup</a></li>
	              		  <li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php if(isset($user)){echo $user; } ?><b class="caret"></b></a>
					        <span class="dropdown-arrow"></span>
					        <ul class="dropdown-menu">
					         <img src="<?php if ($this->session->userdata('user_picture')) { 
                                           echo $this->session->userdata('user_picture');  
                                            } else{echo "https://gravatar.com/avatar";}?>" alt="Profile Picture">
					          <li><a href="#">Home</a></li>
					          <li><a href="#">Account Settings</a></li>
					          <li class="divider"></li>
					          <li><a href="<?php if ($this->session->userdata('logout_url')) { 
                                         echo $this->session->userdata('logout_url');  
                                          }else { echo "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=". base_url()."login/logout" ; }?>" >Log out</a></li>
					        </ul>
					      </li>	
					      <li><a href="#fakelink">Become a Tutor</a> </li>
					      <li class="active"><a href="#fakelink">Login</a></li>
	              		  <li><a href="<?php echo base_url(); ?>">Signup</a></li>
	        
					   
					    </ul> 		      
					  </div><!-- /.navbar-collapse -->
					
	</nav>
</div>
</div>
