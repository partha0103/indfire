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
        `A1`.`address` as present_add,
        `A1`.`zip_code` as present_zip, 
        `A2`.`address` as permanent_add,
        `A2`.`zip_code` as permanent_zip,
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
        where `E`.id = :emp_id";
$stmt = $dbc->prepare($sql);
$stmt->bindValue('present','present');
$stmt->bindValue('permanent','permanent');
$stmt->bindValue(':emp_id', $emp_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);