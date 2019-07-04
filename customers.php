<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Customers</h1>

	

	<ul>
		<li><a href="customer/create_customer.php"><strong>Create</strong></a> - add a customer</li>
		<li><a href="customer/read_customer.php"><strong>Read</strong></a> - find a customer</li>
		<li><a href="customer/update_customer.php"><strong>Update</strong></a> - update a customer</li>
		<li><a href="customer/delete_customer.php"><strong>Delete</strong></a> - delete a customer</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
querycustomers($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>