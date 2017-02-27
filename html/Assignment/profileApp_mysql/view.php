<?php
	$dbc = include("../config.php");
	$emp_id = $_POST['id'];
	$sql =  "SELECT `E`.`id`,
        `E`.`prefix`,     
        `E`.`first_name`,
        `E`.`middle_name`,
        `E`.`last_name`,
        `E`.`email_id`,
        `date_of_birth`, 
        Concat_ws(`A1`.`address`,'  ', `A1`.`zip_code`) AS 'present_add', 
        Concat_ws(`A2`.`address`,'  ', `A2`.`zip_code`) AS 'permanent_add', 
        employer.name AS company, 
        employment.name AS position, 
        contact.contact_no AS contact 
        FROM `employee` `E` 
        LEFT JOIN `address` `A1` 
        ON `E`.id = `A1`.employee_id 
        AND `A1`.`type` = :present 
        LEFT JOIN `address` `A2` 
        ON `E`.id = `A2`.employee_id 
        AND `A2`.`type` = :permanent 
        LEFT JOIN employer 
        ON `E`.employer_id = employer.id 
        LEFT JOIN employment 
        ON `E`.employment_id = employment.id 
        LEFT JOIN contact 
        ON `E`.id = contact.employee_id
        WHERE `E`.id = :id";
$stmt = $dbc->prepare($sql);
$stmt->bindValue('id',$emp_id);
$stmt->bindValue('present','present');
$stmt->bindValue('permanent','permanent');
$stmt->execute();
$employee_info = $stmt->fetch();
    // echo json_encode($employee_info); 
    include('layout/header.php');
    echo  "<h1>" . $employee_info['first_name'] . " " . $employee_info['middle_name'] . " " . $employee_info['last_name'] . " " . "</h1>";
    echo "<p><strong>D.O.B:</strong> ".$employee_info['date_of_birth'] . "</p>" ;
    echo "<p><strong>Email:</strong> ".$employee_info['email_id'] . "</p>" ;
    echo "<p><strong>Present Address:</strong> ".$employee_info['present_add'] . "</p>" ;
    echo "<p><strong>Permanent Address:</strong> ".$employee_info['permanent_add'] . "</p>" ;
    echo "<p><strong>Company:</strong> ".$employee_info['company'] . "</p>" ;
    echo "<p><strong>Position:</strong> ".$employee_info['position'] . "</p>" ;
 ?>