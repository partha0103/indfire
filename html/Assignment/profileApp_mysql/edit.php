<?php
$dbc = include("../config.php");
$present_address = $_POST['present_address'];
$permanent_address = $_POST['permanent_address'];
$FK_employer_id =  "SELECT * FROM employer WHERE name = :name LIMIT 1";
$FK_employer_query = $dbc->prepare($FK_employer_id);
$FK_employer_query->bindValue('name', $_POST['company']);
$FK_employer_query->execute();
$FK_employer_id = "";
$user = $FK_employer_query->fetch();
if (!empty($user)) {
    $FK_employer_id = $user['id'];
}
else{
    $insert_employer_table = "INSERT INTO employer (name) VALUES (:name)";
    $insert_employer = $dbc->prepare($insert_employer_table);
    $insert_employer->bindValue('name', $_POST['company'], PDO::PARAM_STR);
    $insert_employer->execute();
    $FK_employer_id = $dbc->lastInsertId();
}
$FK_employment_id =  "SELECT * FROM employment WHERE name = :name LIMIT 1";
$FK_employment_query = $dbc->prepare($FK_employment_id);
$FK_employment_query->bindValue('name', $_POST['position']);
$FK_employment_query->execute();
$FK_employment_id = "";
$user = $FK_employment_query->fetch();

if (!empty($user)) {
    $FK_employment_id = $user['id'];
}
else{
    $insert_employment_table = "INSERT INTO employment (name) VALUES (:name)";
    $insert_employment = $dbc->prepare($insert_employment_table);
    $insert_employment->bindValue(':name', $position, PDO::PARAM_STR);
    $insert_employment->execute();
    $FK_employment_id = $dbc->lastInsertId();
}

$sql = "UPDATE `employee`
		SET `first_name` = :first_name,
		    `middle_name` = :middle_name,
		    `last_name` = :last_name,
		    `employer_id` = :employer_id,
		    `employment_id`= :employment_id
		WHERE `id` = :employee_id";
$query = $dbc->prepare($sql);
$query->bindValue('first_name', $_POST['first_name'], PDO::PARAM_STR);
$query->bindValue('last_name',$_POST['last_name'], PDO::PARAM_STR);
$query->bindValue('middle_name',$_POST['middle_name'], PDO::PARAM_STR);
$query->bindValue('employer_id',$FK_employer_id, PDO::PARAM_STR);
$query->bindValue('employment_id',$FK_employment_id, PDO::PARAM_STR);
$query->bindValue('employee_id',$_POST['employee_id'], PDO::PARAM_STR);
$query->execute();
if (isset($present_address)) {
            $FK_present_state_id =  "SELECT * FROM state WHERE name = :name LIMIT 1";
            $FK_present_state_query = $dbc->prepare($FK_present_state_id);
            $FK_present_state_query->bindValue('name', $_POST['present_state']);
            $FK_present_state_query->execute();
            $FK_present_state_id = "";
            $user = $FK_present_state_query->fetch();

            if (!empty($user)) {
                $FK_present_state_id = $user['id'];
            }
            else{
                $insert_present_state_table = "INSERT INTO state (name) VALUES (:name)";
                $insert_present_state_query = $dbc->prepare($insert_present_state_table);
                $insert_present_state_query->bindValue('name', $_POST['present_state'], PDO::PARAM_STR);
                $insert_present_state_query->execute();
                $FK_present_state_id = $dbc->lastInsertId();
            }

            $FK_present_city_id =  "SELECT * FROM city WHERE name = :name LIMIT 1";
            $FK_present_city_query = $dbc->prepare($FK_present_city_id);    
            $FK_present_city_query->bindValue('name', $_POST['present_city'],PDO::PARAM_STR);
            $FK_present_city_query->execute();
            $FK_present_city_id = "";
            $user = $FK_present_city_query->fetch();

            if (!empty($user)) {
                $FK_present_city_id = $user['id'];
            }
            else{
                $insert_present_city_table = "INSERT INTO city (name , state_id) VALUES (:name, :state_id)";
                $insert_present_city_query = $dbc->prepare($insert_present_city_table);
                $insert_present_city_query->bindValue('name', $_POST['present_state'], PDO::PARAM_STR);
                $insert_present_city_query->bindValue(':state_id', $FK_present_state_id, PDO::PARAM_STR);
                $insert_present_city_query->execute();
                $FK_present_city_id = $dbc->lastInsertId();
            }
            $insert_address_table = "UPDATE  `address`
							            SET `type` = :name,
										    `address` = :address,
										    `zip_code` = :zip_code,
										    `employee_id` = :employee_id,
										    `city_id`= :city_id
										WHERE `employee_id` = :id
										 AND   `type` = 'present'";
            $insert_address_querry= $dbc->prepare($insert_address_table);
            $insert_address_querry->bindValue(':name', "present",PDO::PARAM_STR);
            $insert_address_querry->bindValue(':address', $present_address,PDO::PARAM_STR);
            $insert_address_querry->bindValue(':zip_code', $_POST['present_zip'],PDO::PARAM_STR);
            $insert_address_querry->bindValue(':employee_id', $_POST['employee_id'],PDO::PARAM_STR);
            $insert_address_querry->bindValue(':id', $_POST['employee_id'],PDO::PARAM_STR);
            $insert_address_querry->bindValue(':city_id', $FK_present_city_id,PDO::PARAM_STR);
            $insert_address_querry->execute();
            }

        if (isset($permanent_address)) {
            $FK_permanent_state_id =  "SELECT * FROM state WHERE name = :name LIMIT 1";
            $FK_permanent_state_query = $dbc->prepare($FK_permanent_state_id);
            $FK_permanent_state_query->bindValue('name', $_POST['permanent_state'],PDO::PARAM_STR);
            $FK_permanent_state_query->execute();
            $FK_permanent_state_id = "";
            $user = $FK_permanent_state_query->fetch();

            if (!empty($user)) {
                $FK_permanent_state_id = $user['id'];
            }
            else{
                $insert_permanent_state_table = "INSERT INTO state (name) VALUES (:name)";
                $insert_permanent_state_query = $dbc->prepare($insert_permanent_state_table);
                $insert_permanent_state_query->bindValue('name', $_POST['permanent_state'], PDO::PARAM_STR);
                $insert_permanent_state_query ->execute();
                $FK_permanent_state_id = $dbc->lastInsertId();
            }
            $FK_permanent_city_id =  "SELECT * FROM city WHERE name = :name LIMIT 1";
            $FK_permanent_city_query = $dbc->prepare($FK_permanent_city_id);
            $FK_permanent_city_query->bindValue('name', $_POST['permanent_city'],PDO::PARAM_STR);
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
                $insert_permanent_city_query->bindValue('name', $_POST['permanent_city'], PDO::PARAM_STR);
                $insert_permanent_city_query->bindValue(':state_id', $FK_permanent_state_id, PDO::PARAM_STR);
                $insert_permanent_city_query->execute();
                $FK_permanent_city_id = $dbc->lastInsertId();
            }
            $insert_address_table = "UPDATE  `address`
						            SET `type` = :name,
									    `address` = :address,
									    `zip_code` = :zip_code,
									    `employee_id` = :employee_id,
									    `city_id`= :city_id
									WHERE `employee_id` = :id
									AND  type = 'permanent'";
            $insert_address_querry= $dbc->prepare($insert_address_table);
            $insert_address_querry->bindValue(':name', "permanent",PDO::PARAM_STR);
            $insert_address_querry->bindValue(':address', $permanent_address,PDO::PARAM_STR);
            $insert_address_querry->bindValue(':zip_code', $_POST['permanent_zip'],PDO::PARAM_STR);
            $insert_address_querry->bindValue(':employee_id', $_POST['employee_id'],PDO::PARAM_STR);
            $insert_address_querry->bindValue(':city_id', $FK_permanent_city_id,PDO::PARAM_STR);
            $insert_address_querry->bindValue('id', $_POST['employee_id']);
            $insert_address_querry->execute();
            }
            $insert_contact_table = "UPDATE  `contact`
            						 SET `employee_id`= :employee_id
            						 	  `contact_no`= :contact_no
            						 	  `type`= :type
            						 WHERE 
            						 	   `employee_id` = :employee_id";
            $insert_contact_query = $dbc->prepare($insert_contact_table);
            $insert_contact_query->bindValue(':employee_id', $_POST['employee_id'],PDO::PARAM_STR);
            $insert_contact_query->bindValue(':contact_no', $_POST['phone_no'],PDO::PARAM_STR);
            $insert_contact_query->bindValue(':type', 'mobile',PDO::PARAM_STR);
            // $insert_address_querry->bindValue('id', $_POST['employee_id']);
            $insert_contact_query->execute();
  ?>