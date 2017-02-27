<?php
session_start();
include('layout/header.php');

if(isset($_SESSION['signin'])){
    header("location: dashboard.php");
}

$title = "Employee Registrationtion";

    
 ?>
 <h1 class="bg-danger" id = "block-error" ></h1>
<form class="form-horizontal well" action="register.php" method="post" enctype="multipart/form-data" onsubmit="
    return validateField()">
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
            <div class="col-md-4">
                <input id="first_name" name="first_name" type="text" placeholder="First Name" 
                    value="<?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?>" 
                    class="form-control input-md " onblur="return isValidName('first_name','name_error')" 
                    onfocus = "return isValidName('first_name','name_error')" >
                <p id="name_error" class="text-danger"></p>
                <span class="text-danger"> <?php echo isset($_SESSION['first_name_error']) ? $_SESSION['first_name_error'] : ''; ?>
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="middle_name">Middle Name</label>  
            <div class="col-md-4">
                <input id="middle_name" name="middle_name" type="text" placeholder="middle name" 
                    class="form-control input-md" onblur="return isValidName('middle_name','mn_error')"
                    onfocus = "return isValidName('middle_name','mn_error')">
                <p id="mn_error"></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="last_name">Last name</label>  
            <div class="col-md-4">
                <input id="last_name" name="last_name" type="text" 
                    placeholder="last name" 
                    value="<?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>" 
                    class="form-control input-md" onblur="return isValidName('first_name','ln_error')"
                    onfocus = "return isValidName('last_name','ln_error')">
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
                    class="form-control input-md" required
                    onblur="isValidDateOfBirth('date_of_birth','err_dob')"
                    onfocus ="isValidDateOfBirth('date_of_birth','err_dob')">
                    <p class="text-danger" id="err_dob"></p>
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
                    class="form-control input-md" required>
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
            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="email" 
                    value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"
                    class="form-control input-md" onblur="return isValidEmail('email','err')" onfocus="return isValidEmail('email','err')" required>
                <p id = "err" class="text-danger"></p> 
                <span class="text-danger" id = "psn"> <?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?></span> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Password</label>  
            <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="password"
                    class="form-control input-md" onblur="return isValidPassword('password','err_password')"
                    onfocus = "return isValidPassword('password','err_password')" required>
                <p id = "err_password" class="text-danger"></p>
                <span class="text-danger"> <?php echo isset($_SESSION['error_password']) ? $_SESSION['error_password'] : ''; ?>
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="conform_password">Conform Password</label>  
            <div class="col-md-4">
                <input id="conform_password" name="conform_password" type="password" placeholder="conform password" 
                    class="form-control input-md" 
                    onblur="return isPasswordMatch('password','conform_password','mismatch')"
                    onfocus = "return isPasswordMatch('password','conform_password','mismatch')" required>
                <p id ="mismatch" class="text-danger"></p>    
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
            <div class="col-md-4">
                <input id="zip" name="permanent_zip" type="text" placeholder="Zip Code" 
                    value="<?php echo isset($_SESSION['permanent_zip']) ? $_SESSION['permanent_zip'] : ''; ?>" 
                    class="form-control input-md" onblur = "return isvalidZip('zip', 'zip_error')" onfocus = "
                    return isvalidZip('zip', 'zip_error')" required>
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
                    placeholder="address" class="form-control input-md" >
                </textarea>
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
                <input id="present_city" name="present_city" type="text" placeholder="city" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="present_state">State</label>  
            <div class="col-md-4">
                <input id="present_state" name="present_state" type="text" placeholder="state" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Text InputPhone</label>  
            <div class="col-md-4">
                <input id="phone_no" name="phone_no" type="text" placeholder="Phone#"
                    class="form-control input-md" required>
                <span class="text-danger">
                <?php echo isset($_SESSION['error_phone_no']) ? $_SESSION['error_phone_no'] : ''; ?>
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="prefered_communication">Prefered Communication</label>
            <div class="col-md-4">
                <select id="prefered_communication" name="prefered_communication" class="form-control input-md" >
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
<!-- <script type="text/javascript" src = "script/main.js"></script> -->
<?php
include('layout/footer.php');

if (isset($_SESSION['error'])) {

    $_SESSION = array();
}
?>