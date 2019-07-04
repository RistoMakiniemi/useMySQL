<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Employee</h1>

	

	<ul>
		<li><a href="employee/create_employee.php"><strong>Create</strong></a> - add a employee</li>
		<li><a href="employee/read_employee.php"><strong>Read</strong></a> - find a employee</li>
		<li><a href="employee/update_employee.php"><strong>Update</strong></a> - update a employee</li>
		<li><a href="employee/delete_employee.php"><strong>Delete</strong></a> - delete a employee</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
queryemployees($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>