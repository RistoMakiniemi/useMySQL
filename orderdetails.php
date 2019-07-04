<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Orderdetails</h1>

	<ul>
		<li><a href="orderdetail/create_orderdetail.php"><strong>Create</strong></a> - add a orderdetail</li>
		<li><a href="orderdetail/read_orderdetail.php"><strong>Read</strong></a> - find a orderdetail</li>
		<li><a href="orderdetail/update_orderdetail.php"><strong>Update</strong></a> - update a orderdetail</li>
		<li><a href="orderdetail/delete_orderdetail.php"><strong>Delete</strong></a> - delete a orderdetail</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
queryorderdetails($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>