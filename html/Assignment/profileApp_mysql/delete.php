<?php
	$dbc = include("../config.php");
	$emp_id = $_POST['id'];
  $query = "DELETE FROM employee WHERE id = :emp_id";
  $employee_data = $dbc->prepare($query);
  $employee_data->bindValue(':emp_id', $emp_id);
  $employee_data->execute();
?>