<?php
 	session_start();

 ?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Employee Registration</title>
		<link rel="stylesheet" type="text/css" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>

		<form class="form-horizontal" action="register.php" method="post">
				<fieldset>
						<legend class="text-center text-info bg-info">Employee Registration</legend>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="prefix">Prefix</label>
							  <div class="col-md-4">
								    <select id="prefix" name="prefix" class="form-control input-md" required>
								      <option>Mr.</option>
								      <option>Mrs.</option>
								      <option>Miss.</option>
								    </select>
							  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							  <label class="col-md-4 control-label" for="first_name">First name</label>  
							  <div class="col-md-4">
								  	<input id="first_name" name="first_name" type="text" placeholder="first name" class="form-control input-md" required>
								  	<span class="text-danger"> <?php echo isset($_SESSION['first_name_error']) ? $_SESSION['first_name_error'] : ''; ?></span> 
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="middle name">Middle Name</label>  
							  <div class="col-md-4">
							  		<input id="middle_name" name="middle_name" type="text" placeholder="middle name" class="form-control input-md" required>
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="ln">Last name</label>  
							  <div class="col-md-4">
							  		<input id="last_name" name="last_name" type="text" placeholder="last name" class="form-control input-md" required="">
							  		<span class="text-danger"> <?php echo isset($_SESSION['last_name_error']) ? $_SESSION['last_name_error'] : ''; ?></span>
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="gender">Gender</label>
							  <div class="col-md-4"> 
								    <label class="radio-inline" for="gender">
									      <input type="radio" name="gender" id="gender" value="male" checked="checked">
									      male
								    </label> 
								    <label class="radio-inline" for="gender">
									      <input type="radio" name="gender" id="gender" value="female">
									      female
								    </label>
							  </div>
						</div>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="date_of_birth">Date of Birth</label>  
							  <div class="col-md-4">
							  		<input id="date_of_birth" name="date_of_birth" type="Date" placeholder="date of birth" 
							  		class="form-control input-md" required="">  
							  </div>
						</div>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="cmpny">Company</label>  
							  <div class="col-md-4">
							  		<input id="company" name="company" type="text" placeholder="company" 
							  		class="form-control input-md" required="">
							   </div>
						</div>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="position">Position</label>  
							  <div class="col-md-4">
							  		<input id="position" name="position" type="text" placeholder="position" class="form-control input-md" required>
							   </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="email">Email</label>  
							  <div class="col-md-4">
							  		<input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required=""> 
							  	<span class="text-danger"> <?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?></span> 
							  </div>
						</div>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="password">Password</label>  
							  <div class="col-md-4">
							  		<input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
							  		<span class="text-danger"> <?php echo isset($_SESSION['error_password']) ? $_SESSION['error_password'] : ''; ?></span> 
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="conform_password">Conform Password</label>  
							  <div class="col-md-4">
							  		<input id="conform_password" name="conform_password" type="password" placeholder="conform password" class="form-control input-md" required>
							  		<span class="text-danger"> <?php echo isset($_SESSION['password_match_error']) ? $_SESSION['password_match_error'] : ''; ?></span> 
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="address type">Address type</label>
							  <div class="col-md-4">
								    <select id="address_type" name="address_type" class="form-control input-md" required>
								      <option>permanent</option>
								      <option>present</option>
								    </select>
							  </div>
						</div>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="location">Location</label>  
							  <div class="col-md-4">
							  		<input id="location" name="location" type="text" placeholder="location" class="form-control input-md" required>
							  </div>
						</div>
						<div class="form-group">
							  <label class="col-md-4 control-label" for="city">City</label>  
							  <div class="col-md-4">
							  		<input id="city" name="city" type="text" placeholder="city" class="form-control input-md" required="">
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="zip">Zip Code</label>  
							  <div class="col-md-4">
							  		<input id="zip" name="zip" type="text" placeholder="Zip Code" class="form-control input-md" required="">
							  		<span class="text-danger"> <?php echo isset($_SESSION['error_zip']) ? $_SESSION['error_zip'] : ''; ?></span>   
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="city">State</label>  
							  <div class="col-md-4">
							  		<input id="state" name="state" type="text" placeholder="state" class="form-control input-md" required>
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="phone">Text InputPhone</label>  
							  <div class="col-md-4">
							  		<input id="phone_no" name="phone_no" type="text" placeholder="Phone#" class="form-control input-md" required="">
							  		<span class="text-danger">
							  		<?php echo isset($_SESSION['error_phone_no']) ? $_SESSION['error_phone_no'] : ''; ?>
							  		</span> 
							  </div>
						</div>

						<div class="form-group">
							  <label class="col-md-4 control-label" for="submit"></label>
							  <div class="col-md-4">
							    	<button id="submit" name="submit" class="btn btn-primary">Submit</button>
							  </div>
						</div>

				</fieldset>
			</form>
			<?php 
				$_SESSION = array(); 
				?>
		</body>
	</html>