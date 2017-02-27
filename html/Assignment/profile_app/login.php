<?php 
        session_start();
        if ($_SESSION['dash']) {
          header("location:dashboard.php");
        }
        #login validation
        if (isset($_POST['signin']) && $_SESSION){
            $password = $_SESSION['password'];
            $email = $_SESSION['email'];
            $_SESSION['signin'] = true;
            if ($password == $_POST['inputPassword'] && $email == $_POST['inputEmail']) { 
              header("location:dashboard.php");
            }
            else{
              $_SESSION['login_error'] = "Invalid credentials";
              header("location:login.php");
            }
        }

        ?>
<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
</head>
     <body>
          <div class="container">
              <div class="row">
                    <form class="form-signin col-md-4 centered" action="login.php" method="post">
                          <legend class="text-center text-info bg-primary">Employee Sign in</legend>
                          <span class="text-danger"> <?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : ''; ?></span>
                          <label for="inputEmail" class="sr-only">Email address</label>
                          <input type="text" id="inputEmail" name="inputEmail" class="form-control" 
                          placeholder="Email address">
                          <br>
                          <label for="inputPassword" class="sr-only">Password</label>
                          <input type="password" id="inputPassword" name="inputPassword" 
                          class="form-control" 
                          placeholder="Password">  
                          <br>
                          <button class="btn btn-lg btn-primary btn-block" type="submit"
                          name="signin">Sign in</button>
                          <br>
                          <button class="btn btn-lg btn-primary btn-block" type="submit" 
                          formaction="registration.php" >Sign up</button>
                    </form>
                </div>
              </div> 
      </body>
</html>