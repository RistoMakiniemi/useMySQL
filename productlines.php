<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Productlines</h1>

	

	<ul>
		<li><a href="productline/create_productline.php"><strong>Create</strong></a> - add a productline</li>
		<li><a href="productline/read_productline.php"><strong>Read</strong></a> - find a productline</li>
		<li><a href="productline/update_productline.php"><strong>Update</strong></a> - update a productline</li>
		<li><a href="productline/delete_productline.php"><strong>Delete</strong></a> - delete a productline</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
queryproductlines($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>