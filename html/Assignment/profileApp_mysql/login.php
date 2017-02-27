<?php
session_start();
$title = "Employee login";

if (isset($_SESSION['signin'])) {
    header("location:dashboard.php");
}
include("layout/header.php");
?>
<div class="container">
    <div class="row">
        <form class="form-signin col-md-4 centered" action="login.php" method="post" onsubmit="return validateField()">
            <legend class="text-center text-info bg-primary">Employee Sign in</legend>
            <span class="text-success"> <?php echo isset($login_error) ? $login_error : ''; ?>
            </span>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" id="inputEmail" name="inputEmail" class="form-control" 
                placeholder="Email address" onblur="isValidEmail('#inputEmail')"
                onfocus="isValidEmail('#inputEmail')">
            <p id="err" class="text-danger"></p>
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" 
                class="form-control" 
                placeholder="Password" 
                onblur="isValidPassword('#inputPassword')" 
                onfocus="isValidPassword('#inputPassword')"> 
            <p id="err_password" class="text-danger"></p> 
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit"
                name="signin">Sign in</button>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" 
                formaction="registration.php" >Sign up</button>
        </form> 
    </div>
</div>
<script type="text/javascript" src = "script/script.js"></script>
<?php
include('layout/footer.php');

//login validation
if (isset($_POST['signin'])){
    $dbc = include("../config.php");
    $password = $_POST['inputPassword'];
    $email = $_POST['inputEmail'];
    $unique_email_select = "SELECT * 
                            FROM employee 
                            WHERE email_id = :email_id  
                            LIMIT 1";
    $unique_email_query = $dbc->prepare($unique_email_select);
    $unique_email_query->bindValue(':email_id', $email);
    $unique_email_query->execute();
    $user = $unique_email_query->fetch();
    $password = hash('sha512', $password.'partha');

    if(!empty(scriptr)){
        if($password == $user['password']){
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['signin'] = true;
            $_SESSION['user_id'] = $user['id'];
            header("location:dashboard.php");
          }
        else{
            $login_error = "invalid credentials";
        }
    }
}
?>