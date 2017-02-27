<?php
    session_start();
    define(NAME, ':name');
    define(PRESENT_ADDRESS, 'present_address');  
    define(PERMANENT_ADDRESS, 'permanent_address');
    define(FIRST_NAME, 'first_name');
    define(TYPE, ':type');

    //Validation of inputs
if(isset($_POST['submit'])) {
    $prefix = $_POST['prefix'];
    $first_name = $_POST[FIRST_NAME];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $company = $_POST['company'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conform_password= $_POST['conform_password'];
    $present_city = $_POST['present_city'];
    $present_zip = $_POST['present_zip'];
    $present_state = $_POST['present_state'];
    $permanent_address = $_POST[PERMANENT_ADDRESS];
    $present_address = $_POST[PRESENT_ADDRESS];
    $permanent_city = $_POST['permanent_city'];
    $permanent_zip = $_POST['permanent_zip'];
    $permanent_state = $_POST['permanent_state'];
    $phone_no = $_POST['phone_no'];
    $image = $_FILES['profile_image']['name'];
    $error = 0;

    //email validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL) ){
        $_SESSION['email'] = $email;
    }
    else{
        $_SESSION['email_error']="insert a valid email";
        $error++;
    }

    //name validation
    if ( (preg_match("/[^a-zA-Z'-]/", $first_name)) || (preg_match("/[^a-zA-Z'-]/", $last_name)) ){
        $_SESSION['first_name_error'] = 'Include only letters';
        $_SESSION['last_name_error'] = 'Include only letters';
        $error++ ;
    }
    else{
        $_SESSION[FIRST_NAME] = $first_name;
        $_SESSION['last_name'] = $last_name;
    }
    
    // passsword validation
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)){
        $_SESSION['error_password'] = "Password must contain 8 letters and it should 
        contain both number and alphabet";
        $error++;
    }

    //conform password validation
    if ($password == $conform_password){
        $_SESSION['password'] = $password;
    }
    else{
        $error++;
        $_SESSION['password_match_error'] = "password not matched";
    }

    //zip validation
    if( strlen($present_zip)==6 && ctype_digit($present_zip) ){
        $_SESSION['present_zip'] = $present_zip;
    }
    else{
        $_SESSION['error_zip'] = "invalid zip";
        $error++;
    }

    //permanent zip validation
    if(strlen($permanent_zip)==6 && ctype_digit($permanent_zip)){
        $_SESSION['permanent_zip'] = $permanent_zip;
    }
    else{
        $_SESSION['error__permanent_zip'] = "invalid zip";
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

    //direction condition
    if ($error == 0) {
        //tabase operations
        $dbc = include("../config.php");
        $unique_email_select = "SELECT * FROM employee WHERE email_id = :email_id LIMIT 1";
        $unique_email_query = $dbc->prepare($unique_email_select);
        $unique_email_query->bindValue('email_id', $email);
        $unique_email_query->execute();

        //ecking of existance of duplicate key
        if ($unique_email_query->fetchColumn() == 1) {
            echo "Duplicate email id in database";
            header("location:registration.php");
        }

        //age upload
        if (isset($image)) {
            $imageDirectory = '/var/www/html/Assignment/profileApp_mysql/image';
            $imageName = time().rand().rand().'.jpg';
            $tmp_dir = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp_dir, $imageDirectory . '/' . $imageName);
            $photo_location = $imageName;
        }
        else {
            $photo_location = '';
        }

        $FK_employer_id =  "SELECT * FROM employer WHERE name = :name LIMIT 1";
        $FK_employer_query = $dbc->prepare($FK_employer_id);
        $FK_employer_query->bindValue('name', $company);
        $FK_employer_query->execute();
        $FK_employer_id = "";
        $user = $FK_employer_query->fetch();

        if (!empty($user)) {
            $FK_employer_id = $user['id'];
        }
        else{
            $insert_employer_table = "INSERT INTO employer (name) VALUES (:name)";
            $insert_employer = $dbc->prepare($insert_employer_table);
            $insert_employer->bindValue(NAME, $company, PDO::PARAM_STR);
            $insert_employer->execute();
            $FK_employer_id = $dbc->lastInsertId();
        }

        $FK_employment_id =  "SELECT * FROM employment WHERE name = :name LIMIT 1";
        $FK_employment_query = $dbc->prepare($FK_employment_id);
        $FK_employment_query->bindValue('name', $position);
        $FK_employment_query->execute();
        $FK_employment_id = "";
        $user = $FK_employment_query->fetch();

        if (!empty($user)) {
            $FK_employment_id = $user['id'];
        }
        else{
            $insert_employment_table = "INSERT INTO employment (name) VALUES (:name)";
            $insert_employment = $dbc->prepare($insert_employment_table);
            $insert_employment->bindValue(NAME, $position, PDO::PARAM_STR);
            $insert_employment->execute();
            $FK_employment_id = $dbc->lastInsertId();
        }

        $password = hash('sha512', $password.'partha');
        $insert_employee_table = "INSERT INTO employee( prefix, first_name, middle_name, last_name, gender, date_of_birth, email_id, password, employer_id, employment_id,photo_location) 
            VALUES (:prefix, :first_name, :middle_name, :last_name, :gender, :date_of_birth, :email_id, :password, 
            :employer_id, :employment_id, :photo_location)";
        $insert_employee_querry = $dbc->prepare($insert_employee_table);
        $insert_employee_querry->bindValue(':prefix', $prefix);
        $insert_employee_querry->bindValue(':first_name', $first_name);
        $insert_employee_querry->bindValue(':middle_name', $middle_name);
        $insert_employee_querry->bindValue(':last_name', $last_name);
        $insert_employee_querry->bindValue(':gender', $gender);
        $insert_employee_querry->bindValue(':date_of_birth', $date_of_birth);   
        $insert_employee_querry->bindValue(':email_id', $email);
        $insert_employee_querry->bindValue(':password', $password);
        $insert_employee_querry->bindValue(':employer_id', $FK_employer_id);
        $insert_employee_querry->bindValue(':employment_id', $FK_employment_id);
        $insert_employee_querry->bindValue(':photo_location', $photo_location);
        $insert_employee_querry->execute();
        $FK_employee_id = $dbc->lastInsertId();

        if (isset($present_address)) {          
            $FK_present_state_id =  "SELECT * FROM state WHERE name = :name LIMIT 1";
            $FK_present_state_query = $dbc->prepare($FK_present_state_id);
            $FK_present_state_query->bindValue('name', $present_state);
            $FK_present_state_query->execute();
            $FK_present_state_id = "";
            $user = $FK_present_state_query->fetch();

            if (!empty($user)) {
                $FK_present_state_id = $user['id'];
            }
            else{
                $insert_present_state_table = "INSERT INTO state (name) VALUES (:name)";
                $insert_present_state_query = $dbc->prepare($insert_present_state_table);
                $insert_present_state_query->bindValue(NAME, $present_state, PDO::PARAM_STR);
                $insert_present_state_query->execute();
                $FK_present_state_id = $dbc->lastInsertId(); 
            }

            $FK_present_city_id =  "SELECT * FROM city WHERE name = :name LIMIT 1";
            $FK_present_city_query = $dbc->prepare($FK_present_city_id);    
            $FK_present_city_query->bindValue(NAME, $present_city);
            $FK_present_city_query->execute();
            $FK_present_city_id = "";
            $user = $FK_present_city_query->fetch();

            if (!empty($user)) {
                $FK_present_city_id = $user['id'];
            }
            else{
                $insert_present_city_table = "INSERT INTO city (name , state_id) VALUES (:name, :state_id)";
                $insert_present_city_query = $dbc->prepare($insert_present_city_table);
                $insert_present_city_query->bindValue(NAME, $present_city, PDO::PARAM_STR);
                $insert_present_city_query->bindValue(':state_id', $FK_present_state_id, PDO::PARAM_STR);
                $insert_present_city_query->execute();
                $FK_present_city_id = $dbc->lastInsertId();
            }
            $insert_address_table = "INSERT INTO address(type,address,zip_code,employee_id, city_id) 
            VALUES (:type, :address,:zip_code, :FK_employee_id , :FK_city_id)";
            $insert_address_querry= $dbc->prepare($insert_address_table);
            $insert_address_querry->bindValue(TYPE, "present");
            $insert_address_querry->bindValue(':address', $present_address);
            $insert_address_querry->bindValue(':zip_code', $present_zip);
            $insert_address_querry->bindValue(':FK_employee_id', $FK_employee_id);
            $insert_address_querry->bindValue(':FK_city_id', $FK_present_city_id);
            $insert_address_querry->execute();
            }

        if (isset($permanent_address)) {
            $FK_permanent_state_id =  "SELECT * FROM state WHERE name = :name LIMIT 1";
            $FK_permanent_state_query = $dbc->prepare($FK_permanent_state_id);
            $FK_permanent_state_query->bindValue('name', $permanent_state);
            $FK_permanent_state_query->execute();
            $FK_permanent_state_id = "";
            $user = $FK_permanent_state_query->fetch();

            if (!empty($user)) {
                $FK_permanent_state_id = $user['id'];
            }
            else{
                $insert_permanent_state_table = "INSERT INTO state (name) VALUES (:name)";
                $insert_permanent_state_query = $dbc->prepare($insert_permanent_state_table);
                $insert_permanent_state_query->bindValue(NAME, $permanent_state, PDO::PARAM_STR);
                $insert_permanent_state_query ->execute();
                $FK_permanent_state_id = $dbc->lastInsertId();
            }
            $FK_permanent_city_id =  "SELECT * FROM city WHERE name = :name LIMIT 1";
            $FK_permanent_city_query = $dbc->prepare($FK_permanent_city_id);
            $FK_permanent_city_query->bindValue(NAME, $permanent_city);
            $FK_permanent_city_query->execute();
            $user = $FK_permanent_city_query->fetch();
            $FK_permanent_city_id = "";

            if (!empty($user)) {
                $FK_permanent_city_id = $user['id'];
            }
            else{
                $insert_permanent_city_table = "INSERT INTO city (name , state_id) 
                                                VALUES (:name, :state_id)";
                $insert_permanent_city_query = $dbc->prepare($insert_permanent_city_table);
                $insert_permanent_city_query->bindValue(NAME, $permanent_city, PDO::PARAM_STR);
                $insert_permanent_city_query->bindValue(':state_id', $FK_permanent_state_id, PDO::PARAM_STR);
                $insert_permanent_city_query->execute();
                $FK_permanent_city_id = $dbc->lastInsertId();
            }
                $insert_address_table = "INSERT INTO address(type, address, zip_code, employee_id, city_id) 
                                        VALUES (:type, :address,:zip_code, :FK_employee_id , :FK_city_id)";
                $insert_address_querry= $dbc->prepare($insert_address_table);
                $insert_address_querry->bindValue(TYPE, "permanent");
                $insert_address_querry->bindValue(':address', $permanent_address);
                $insert_address_querry->bindValue(':zip_code', $permanent_zip);
                $insert_address_querry->bindValue(':FK_employee_id', $FK_employee_id);
                $insert_address_querry->bindValue(':FK_city_id', $FK_permanent_city_id);
                $insert_address_querry->execute();
            }
            $insert_contact_table = "INSERT INTO contact(employee_id, contact_no,type) 
                VALUES (:employee_id, :contact_no , :type)";
            $insert_contact_query = $dbc->prepare($insert_contact_table);
            $insert_contact_query->bindValue(':employee_id', $FK_employee_id);
            $insert_contact_query->bindValue(':contact_no', $phone_no);
            $insert_contact_query->bindValue(TYPE, 'mobile');
            $insert_contact_query->execute();

            echo 'Congratssss!!!!!!!!!!!!!!!!! you are being redirected now';
            header("refresh:5;url=login.php");
        }
    else{
        $_SESSION[PERMANENT_ADDRESS] = $permanent_address;
        $_SESSION[PRESENT_ADDRESS] = $preseent_address;
        $_SESSION['permanent_state'] = $permanent_state;
        $_SESSION['present_state'] = $present_state;
        $_SESSION['permanent_city'] = $permanent_city;
        $_SESSION['present_city'] = $present_city;
        $_SESSION['company'] = $company;
        $_SESSION['position'] = $position;
        $_SESSION['error'] = true;
        header("location:registration.php");
    }
}
 ?>