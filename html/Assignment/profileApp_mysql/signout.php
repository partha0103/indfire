<?php
    session_start();
    
    if(isset($_POST['sign_out'])) // Destroying All Sessions
    {
        $_SESSION = array();
        header("Location: login.php"); // Redirecting To Home Page  
    }
?>