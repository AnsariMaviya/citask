<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
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
	<div class="container justify-content-center d-flex">
		<div class="col-6">
			<form action="<?=base_url()?>/Register/insert" method="post">
				<div class="mb-3">
				  <label for="emailID" class="form-label">First Name</label>
				  <input type="text" class="form-control" id="fname" name="fname" required>
				</div>
				<div class="mb-3">
				  <label for="emailID" class="form-label">Last Name</label>
				  <input type="text" class="form-control" id="lname" name="lname" required>
				</div>
				<div class="mb-3">
				  <label for="emailID" class="form-label">Email ID</label>
				  <input type="email" class="form-control" id="emailID" name="email" value="<?=$email?>" readonly>
				</div>
				<div class="mb-3">
				  <label for="emailID" class="form-label">Password</label>
				  <input type="password" class="form-control" id="pwd" name="pwd" required>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-primary">Register</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>