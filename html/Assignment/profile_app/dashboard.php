<?php
	session_start();
	  if(!isset($_SESSION['signin'])){
	    header ("Location: login.php");
	  }
	  $_SESSION['dash'] = true;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
</head>
    <body>
          <div class="container">
          <div class="row">
            <form class="form-signout col-md-4 centered" action="signout.php" method="post">
              <h1 class="col-md-8">Hello <span class="text-danger"> <?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?></span></h1>
              <br>
              <br>
              <br>
              <button class="btn btn-lg btn-primary btn-block col-md-3" type="submit" name="signout">Sign out</button>
            </form>
            </div>
          </div> 
      </body>
</html>