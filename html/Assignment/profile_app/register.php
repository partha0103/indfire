<?php
	session_start();
	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$first_name = trim($_POST['first_name']);
		$phone_number = trim($_POST['phone']);
		$password = trim($_POST['password']);
		$conform_password = trim($_POST['conform_password']);
		$last_name = trim($_POST['last_name']);
		$zip = trim($_POST['zip']);
		$phone_no = trim($_POST['phone_no']);
		$error = 0;
		$_SESSION['signin'] = false; 
		
		#email Validation
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['email'] = $email;
		}
		else{
			$_SESSION['email_error']="insert a valid email";
			$error++;
		}

		#name validation
		if ((preg_match("/[^a-zA-Z'-]/", $first_name)) || (preg_match("/[^a-zA-Z'-]/", $last_name))){
			$_SESSION['first_name_error'] = 'Include only letters';
			$_SESSION['last_name_error'] = 'Include only letters';
			$error++ ;
		}
		else{
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
		}

		#passsword validation
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)){
			$_SESSION['error_password'] = "Password must contain 8 letters and it should contain both number and alphabet";
			$error++;
		}
		else{
			$_SESSION['password'] = $password;
		}

		#conform password validation
		if ($password == $conform_password){
			$_SESSION['password'] = $password;
		}
		else{
			$error++;
			$_SESSION['password_match_error'] = "password not matched";
		}

		#zip validation
		if(strlen($zip)==6 && ctype_digit($zip)){
			$_SESSION['zip'] = $zip;
		}
		else{
			$_SESSION['error_zip'] = "invalid zip";
			$error++;
		}

		#phone_no validation
		if(strlen($phone_no)==10 && ctype_digit($phone_no)){
			$_SESSION['phone_no'] = $phone_no;
		}
		else{
			$_SESSION['error_phone_no'] = "invalid phone no";
			$error++;
		}

$_SESSION['company'] = $_POST['company'];
		#redirection condition
		if ($error == 0) {
			echo "registration succsessfull";
			header("location:login.php");
		}
		else{
			header("location:registration.php");
		}
	}	
?>
