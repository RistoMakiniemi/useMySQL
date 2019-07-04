<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Products</h1>
	<br>

	<ul>
		<li><a href="product/create_product.php"><strong>Create</strong></a> - add a product</li>
		<li><a href="product/read_product.php"><strong>Read</strong></a> - find a product</li>
		<li><a href="product/update_product.php"><strong>Update</strong></a> - update a product</li>
		<li><a href="product/delete_product.php"><strong>Delete</strong></a> - delete a product</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
queryproducts($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>