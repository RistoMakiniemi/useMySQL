<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Orders</h1>

	<ul>
		<li><a href="order/create_order.php"><strong>Create</strong></a> - add a order</li>
		<li><a href="order/read_order.php"><strong>Read</strong></a> - find a order</li>
		<li><a href="order/update_order.php"><strong>Update</strong></a> - update a order</li>
		<li><a href="order/delete_order.php"><strong>Delete</strong></a> - delete a order</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
queryorders($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>