<?php
	session_start();
	if(isset($_POST['signout'])){
		$_SESSION = array();
		header("location:login.php");
	}
?>