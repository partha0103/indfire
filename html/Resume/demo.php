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
              <h2 class="form-signin-heading">Please sign in</h2>
              <label for="inputEmail" class="sr-only">Email address</label>
              <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
              <br>
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>  
              <br>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
              <br>
              <button class="btn btn-lg btn-primary btn-block" type="submit" formaction="registration.php" >Sign up
              </button>
            </form>
            </div>
          </div> 
      </body>
</html>