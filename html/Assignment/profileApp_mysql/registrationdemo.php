<?php
session_start();
include('layout/header.php');

if(isset($_SESSION['signin'])){
    header("location: dashboard.php");
}

$title = "Employee Registrationtion";

    
 ?>
 <div class="bg-danger" id = "abc"></div>
<form class="form-horizontal well" id="registration-form" action="register.php" method="post" 
	  enctype="multipart/form-data">
    <fieldset>
        <legend class="text-center text-info bg-info">Employee Registration</legend>
        <div class="form-group">
            <label class="col-md-4 control-label" for="prefix">Prefix</label>
            <div class="col-md-4">
                <select id="prefix" name="prefix" class="form-control input-md" required>
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="first_name">First name</label>  
            <div class="col-md-4" id = "first_name_field">
                <input id="first_name" name="first_name" type="text" placeholder="First Name" 
                    value="<?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?>" 
                    class="form-control input-md " oninput="isValidName('#first_name','#first_name_field')" 
                    required>
                <p id="name_error" class="text-danger"></p>
                <span class="text-danger"> <?php echo isset($_SESSION['first_name_error']) ? $_SESSION['first_name_error'] : ''; ?>
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="middle name">Middle Name</label>  
            <div class="col-md-4" class="middle_name_field">
                <input id="middle_name" name="middle_name" type="text" placeholder="middle name" 
                    class="form-control input-md" oninput="isValidName('#middle_name' , '#middle_name_field')"
                    required>
                <p id="mn_error"></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="ln">Last name</label>  
            <div class="col-md-4" class="last_name_field">
                <input id="last_name" name="last_name" type="text" 
                    placeholder="last name" 
                    value="<?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>" 
                    class="form-control input-md" oninput="isValidName('#last_name' , '#last_name_field')"
                    required>
                <p id ="ln_error"></p>
                <span class="text-danger"> <?php echo isset($_SESSION['last_name_error']) ? $_SESSION['last_name_error'] : ''; ?> 
                </span>
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
                    class="form-control input-md" required oninput="isValidDateOfBirth('#date_of_birth')"
                    >
                <span class="text-danger"> <?php echo isset($_SESSION['date_of_birth_error']) ? 
                $_SESSION['date_of_birth_error'] : ''; ?>
                </span>  
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="cmpny">Company</label>  
            <div class="col-md-4">
                <input id="company" name="company" type="text" placeholder="company"
                    value="<?php echo isset($_SESSION['company']) ? $_SESSION['company'] : ''; ?>"
                    class="form-control input-md" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="position">Position</label>  
            <div class="col-md-4">
                <input id="position" name="position" type="text" placeholder="position" 
                    value="<?php echo isset($_SESSION['position']) ? $_SESSION['position'] : ''; ?>" 
                    class="form-control input-md" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>  
            <div class="col-md-4 has-feedback" id = 'email_field'>
                <input id="email" name="email" type="text" placeholder="email" 
                    value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"
                    class="form-control input-md" oninput="isValidEmail('#email')">
                <p id = "err" class="text-danger"></p> 
                <span class="text-danger" id = "psn"> <?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?></span> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Password</label>  
            <div class="col-md-4" id="password_field">
                <input id="password" name="password" type="password" placeholder="password"
                    class="form-control input-md" oninput="return isValidPassword('#password')">
                <p id = "err_password" class="text-danger"></p>
                <span class="text-danger"> <?php echo isset($_SESSION['error_password']) ? $_SESSION['error_password'] : ''; ?>
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="confirm_password">Confirm Password</label>  
            <div class="col-md-4" id="confirm_password_field">
                <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm password" 
                    class="form-control input-md" 
                    onblur="isPasswordMatch()"
                    onfocus = "isPasswordMatch()">  
                <span class="text-danger"> <?php echo isset($_SESSION['password_match_error']) ? $_SESSION['password_match_error'] : ''; ?></span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_address">Permanent Address</label>  
            <div class="col-md-4">
                <textarea id="permanent_address" name="permanent_address" type="text" 
                    placeholder="address" 
                    value="<?php echo isset($_SESSION['permanent_address']) ? $_SESSION['permanent_address'] : ''; ?>" 
                    class="form-control input-md" required>
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_zip">Zip Code</label>  
            <div class="col-md-4" id="zip_field">
                <input id="permanent_zip" name="permanent_zip" type="text" placeholder="Zip Code" 
                    value="<?php echo isset($_SESSION['permanent_zip']) ? $_SESSION['permanent_zip'] : ''; ?>" 
                    class="form-control input-md" oninput = "isvalidZip('#permanent_zip')">
                <p id = "zip_error"></p>     
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_city">City</label>  
            <div class="col-md-4">
                <input id="permanent_city" name="permanent_city" type="text" placeholder="city"
                    value="<?php echo isset($_SESSION['permanent_city']) ? $_SESSION['permanent_city'] : ''; ?>" 
                    class="form-control input-md" required>
                <span class="text-danger"> <?php echo isset($_SESSION['error_permanent_zip']) ? $_SESSION['error_permanent_zip'] : ''; ?>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_state">State</label>  
            <div class="col-md-4">
                <input id="permanent_state" name="permanent_state" type="text" placeholder="state" 
                    value="<?php echo isset($_SESSION['permanent_state']) ? $_SESSION['permanent_state'] : ''; ?>" 
                    class="form-control input-md" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="present_adddress">Present Address</label>  
            <div class="col-md-4">
                <textarea id="present_address" name="present_address" type="text" 
                    placeholder="address" class="form-control input-md" required></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="present_zip">Zip Code</label>  
            <div class="col-md-4">
                <input id="zip" name="present_zip" type="text" placeholder="Zip Code" class="form-control input-md">
                <span class="text-danger"> <?php echo isset($_SESSION['error_zip']) ? $_SESSION['error_zip'] : ''; ?></span> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="present_city">City</label>  
            <div class="col-md-4">
                <input id="present_city" name="present_city" type="text" placeholder="city" class="form-control input-md" required="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="present_state">State</label>  
            <div class="col-md-4">
                <input id="present_state" name="present_state" type="text" placeholder="state" class="form-control input-md" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Text InputPhone</label>  
            <div class="col-md-4" id="phone_no_field">
                <input id="phone_no" name="phone_no" type="text" placeholder="Phone#"
                    class="form-control input-md" oninput="isValidMobileNo('#phone_no')">
                <span class="text-danger">
                <?php echo isset($_SESSION['error_phone_no']) ? $_SESSION['error_phone_no'] : ''; ?>
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="prefered_communication">Prefered Communication</label>
            <div class="col-md-4">
                <select id="prefered_communication" name="prefered_communication" class="form-control input-md" required>
                    <option>email</option>
                    <option>fax</option>
                    <option>phone</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="image">File upload</label>  
            <div class="col-md-4">
                <input id="profile_image" name="profile_image" type="file" 
                    class="form-control input-md">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="script/script.js"></script>
<?php
include('layout/footer.php');

if (isset($_SESSION['error'])) {

    $_SESSION = array();
}
?>