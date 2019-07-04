<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Payments</h1>

	<ul>
		<li><a href="payment/create_payment.php"><strong>Create</strong></a> - add a payment</li>
		<li><a href="payment/read_payment.php"><strong>Read</strong></a> - find a payment</li>
		<li><a href="payment/update_payment.php"><strong>Update</strong></a> - update a payment</li>
		<li><a href="payment/delete_payment.php"><strong>Delete</strong></a> - delete a payment</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
querypayments($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>