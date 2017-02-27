<?php
    $dbc = include("../config.php");
    include('layout/header.php');
    $sql = "SELECT `E`.`id`,
    `E`.`prefix`,     
    `E`.`first_name`,
    `E`.`middle_name`,
    `E`.`last_name`,
    `E`.`email_id`,
`date_of_birth`, 
Concat_ws(`A1`.`address`,' ', `A1`.`zip_code`) AS 'present_add', 
Concat_ws(`A2`.`address`,' ', `A2`.`zip_code`) AS 'permanent_add', 
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
ON `E`.id = contact.employee_id";

    $stmt = $dbc->prepare($sql);
    //echo "<div class='container'>";
    echo "<table class = 'table'>
            <tr>
                <th>Name</th>
                <th>email</th>
                <th>D.O.B</th>
                <th>Present Address</th>
                <th>permanent Address</th>
                 <th>Contact</th>
                  <th>Company</th>
                <th>Position</th>
             </tr>";

        $stmt = $dbc->prepare($sql);
        $stmt->bindValue('present','present');
        $stmt->bindValue('permanent','permanent');
         $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row['prefix'].' '. $row['first_name']. ' '.  $row['middle_name'].' '. $row['last_name']."</td>";
            echo "<td>" .$row['email_id']. "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['present_add'] ."</td>";
             echo "<td>" . $row['permanent_add']. "</td>";
            echo "<td>" . $row['contact']. "</td>";
            echo "<td>" . $row['company']. "</td>";
            echo "<td>" . $row['position']. "</td>";
            echo "</tr>";
        }
    //echo "</div>";
        echo "</table>";
    include('layout/footer.php');
?>