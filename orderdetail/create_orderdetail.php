<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Orderdetails Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch orders 
$sql 	= "SELECT orderNumber FROM orders";
$result = $conn->query($sql);
$orders = array();
while($row = $result->fetch_array()) {
	$orders[$row['orderNumber']] = $row['orderNumber'];
}

// Fetch products 
$sql 	= "SELECT productCode, productName FROM products";
$result = $conn->query($sql);
$products = array();
while($row = $result->fetch_array()) {
	$products[$row['productCode']] = $row['productCode'] . " - " . $row['productName'];
}

// define variables and set to empty values
$orderNumberErr = $productCodeErr = $quantityOrderedErr = $priceEachErr = $orderLineNumberErr = "";
$orderNumber = $productCode = $quantityOrdered = $priceEach = $orderLineNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["orderNumber"])) {
		$orderNumberErr = "OrderNumber is required";
	} else {
		$orderNumber = test_input($_POST["orderNumber"]);
		// check if orderNumber contains numbers
		if (!preg_match("/^[0-9]*$/",$orderNumber)) {
			$orderNumberErr = "Only numbers allowed";
		}
	}

	if (empty($_POST["productCode"])) {
		$productCodeErr = "ProductCode is required";
	} else {
		$productCode = test_input($_POST["productCode"]);
		// check if customerNumber contains numbers
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$productCode)) {
			$productCodeErr = "Only numbers allowed";
		}
	}

	if (empty($_POST["quantityOrdered"])) {
		$quantityOrderedErr = "QuantityOrdered is required";
	} else {
		$quantityOrdered = test_input($_POST["quantityOrdered"]);
		// check if quantityOrdered contains numbers
		if (!preg_match("/^[0-9]*$/",$quantityOrdered)) {
			$quantityOrderedErr = "Only numbers allowed";
		}
	}

	if (empty($_POST["priceEach"])) {
		$priceEachErr = "PriceEach is required";
	} else {
		$priceEach = test_input($_POST["priceEach"]);
		// check if priceEach contains numbers
		if (!preg_match("/^[0-9]*$/",$priceEach)) {
			$priceEachErr = "Only numbers allowed";
		}
	}

    if (empty($_POST["orderLineNumber"])) {
		$orderLineNumberErr = "OrderLineNumber is required";
	} else {
		$orderLineNumber = test_input($_POST["orderLineNumber"]);
		// check if orderLineNumber contains numbers
		if (!preg_match("/^[0-9]*$/",$orderLineNumber)) {
			$orderLineNumberErr = "Only numbers allowed";
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['submit'])) {

	$orderNumber = $_POST['orderNumber'];
	$productCode = $_POST['productCode'];
	$quantityOrdered = $_POST['quantityOrdered'];
	$priceEach     = $_POST['priceEach'];
	$orderLineNumber  = $_POST['orderLineNumber'];
					
	$sql = "INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) 
        VALUES('$orderNumber', '$productCode', '$quantityOrdered', '$priceEach', '$orderLineNumber')";

	if ($conn->query($sql) === TRUE) {
		//$last_id = $conn->insert_id;
		echo "New record created successfully." . "OrderNumber = " . $orderNumber . " and productCode = " . $productCode . "</br>";
		queryorderdetailsbyids($conn, $orderNumber, $productCode);

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	// Close connection
	closeconnection($conn);
}

?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../orderdetails.php">Back to Orderdetails</a>
<br>
<br>
<h2>Add a Orderdetail</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
    <tr>
        <td>OrderNumber:</td>
		<td> <select  name="orderNumber">
			<option selected="selected">Choose one</option>
			<?php
			// Loop through orders array
			foreach($orders as $key => $value) {
        	?>
            	<option value="<?php echo $key;?>"><?php echo $value; ?></option>
			<?php
        	}
        	?>
        </select>

		<span class = "error">* <?php echo $orderNumberErr;?></span>
	    </td>
	</tr>
										
	<tr>
	    <td>ProductCode:</td>
		<td> <select  name="productCode">
			<option selected="selected">Choose one</option>
			<?php
			// Loop through prducts array
			foreach($products as $key => $value) {
        	?>
            	<option value="<?php echo $key;?>"><?php echo $value; ?></option>
			<?php
        	}
        	?>
        </select>

		<span class = "error">* <?php echo $productCodeErr;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>quantityOrdered:</td>
	   <td><input type = "text" name = "quantityOrdered" value="<?php echo $quantityOrdered;?>">
		  <span class = "error">* <?php echo $quantityOrderedErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>PriceEach:</td>
	   <td><input type = "text" name = "priceEach" value="<?php echo $priceEach;?>">
		  <span class = "error">* <?php echo $priceEachErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>OrderLineNumber: </td>
	   <td><input type = "text" name = "orderLineNumber" value="<?php echo $orderLineNumber;?>">
		  <span class = "error">* <?php echo $orderLineNumberErr;?></span>
	   </td>
	</tr>
    					
	<tr>
	   <td>
		  <input type = "submit" name = "submit" value = "Submit"> 
	   </td>
	</tr>
	
 </table>
</form>

<br>

<a href="../orderdetails.php">Back to Orderdetails</a>

</body>
</html>