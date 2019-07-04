<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App - Offices</h1>

	<ul>
		<li><a href="office/create_office.php"><strong>Create</strong></a> - add a office</li>
		<li><a href="office/read_office.php"><strong>Read</strong></a> - find a office</li>
		<li><a href="office/update_office.php"><strong>Update</strong></a> - update a office</li>
		<li><a href="office/delete_office.php"><strong>Delete</strong></a> - delete a office</li>
		<br>
		<li><a href="index.php">Back to home</a></li>
	</ul>

<?php

//Include the connection script
include 'db_connection.php';

$conn = openconnection();
queryoffices($conn);
closeconnection($conn);

?>

<br>

<a href="index.php">Back to home</a>

</body>
</html>