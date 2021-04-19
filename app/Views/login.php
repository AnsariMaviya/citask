<?php
use Config\Services;
$this->session = Services::session();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

	<style type="text/css">
		body{
			height: 100vh;
		}
		.container{
			position: fixed;
		  	top: 50%;
		  	left: 50%;
		  	transform: translate(-50%, -50%);
		}
	</style>
</head>
<body>
	<?php
	if($this->session->getFlashdata('loginMessage')){
	      echo '<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="d-flex">
			    <div class="toast-body">
			     '.$this->session->getFlashdata('loginMessage').'
			    </div>
			    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			</div> ';
	    }
	    ?>
	<div class="container justify-content-center d-flex">
		<?php
		if(!isset($email)){
		?>
		<div class="col-6">
			<form action="<?=base_url()?>/Login/checkEmail" method="post">
				<div class="text-center"><h2> Login Form</h2></div>
				<div class="mb-3">
				  <label for="emailID" class="form-label">Email address</label>
				  <input type="email" class="form-control" id="emailID" name="emailID" placeholder="name@example.com" required>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-primary">Check Email</button>
				</div>
			</form>
		</div>
		<?php
		}
		else{
	    
		?>

		<div class="col-6">
			<form action="<?=base_url()?>/Login/LoggedIn" method="post">
				<div class="text-center"><h2> Login Form</h2></div>
				<div class="mb-3">
				  <label for="password" class="form-label">Password</label>
				  <input type="password" class="form-control" id="password" name="password" required>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</form>
		</div>
		<?php
		}
		?>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		
	$('.toast').toast('show')
	})
</script>