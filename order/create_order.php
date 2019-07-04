<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Order Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch customers 
$sql 	= "SELECT customerNumber, customerName FROM customers";
$result = $conn->query($sql);
$customers = array();
while($row = $result->fetch_array()) {
	$customers[$row['customerNumber']] = $row['customerNumber'] . " - " . $row['customerName'];
}

// define variables and set to empty values
$customerNumberErr = "";
$orderDateErr = $requiredDateErr = $shippedDateErr = $statusErr = $commentsErr = ""; 

$customerNumber = 0;
$orderDate = $requiredDate = $shippedDate = $status = $comments = ""; 
        

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["orderDate"])) {
		$orderDateErr = "OrderDate is required";
	} else {
        $orderDate = test_input($_POST["orderDate"]);
        $m = 0;
		// check if date is well-formed
        if (preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $orderDate, $m) || 
            preg_match("/^(\d{1,2})-(\d{1,2})-(\d{4})$/", $orderDate, $m)) {
            if (!checkdate(intval($m[2]), intval($m[3]), intval($m[1]))) {
                $orderDateErr = "Invalid Date!";
            }
        } else {
			$orderDateErr = "Invalid date format";
		}
	}

    if (empty($_POST["requiredDate"])) {
		$requiredDateErr = "RequiredDate is required";
	} else {
        $requiredDate = test_input($_POST["requiredDate"]);
        $m = 0;
		// check if date is well-formed
        if (preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $requiredDate, $m) || 
            preg_match("/^(\d{1,2})-(\d{1,2})-(\d{4})$/", $requiredDate, $m)) {
            if (!checkdate(intval($m[2]), intval($m[3]), intval($m[1]))) {
                $requiredDateErr = "Invalid Date!";
            }
        } else {
			$requiredDateErr = "Invalid date format";
		}
	}
    
    if ($_POST["shippedDate"]) {
        $shippedDate = test_input($_POST["shippedDate"]);
        $m = 0;
		// check if date is well-formed
        if (preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $shippedDate, $m) || 
            preg_match("/^(\d{1,2})-(\d{1,2})-(\d{4})$/", $shippedDate, $m)) {
            if (!checkdate(intval($m[2]), intval($m[3]), intval($m[1]))) {
                $shippedDateErr = "Invalid Date!";
            }
        } else {
			$shippedDateErr = "Invalid date format";
		}
	}
    
    if (empty($_POST["status"])) {
		$statusErr = "status is required";
	} else {
		$status = test_input($_POST["status"]);
		// check if status only contains letters
		if (!preg_match("/^[a-zA-Z ]*$/",$status)) {
			$statusErr = "Only letters allowed";
		}
	}

	if (empty($_POST["comments"])) {
		$commentsErr = "comments is required";
	} else {
		$comments = test_input($_POST["comments"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z0-9\w ]*$/",$comments)) {
			$commentsErr = "Only letters, numbers and white space allowed";
		}
	}
	
	if (empty($_POST["customerNumber"])) {
		$customerNumberErr = "CustomerNumber is required";
	} else {
		$customerNumber = test_input($_POST["customerNumber"]);
		// check if customerNumber contains numbers
		if (!preg_match("/^[0-9]*$/",$customerNumber)) {
			$customerNumberErr = "Only numbers allowed";
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

	$orderDate = $_POST['orderDate'];
	$requiredDate = $_POST['requiredDate'];
	$shippedDate = $_POST['shippedDate'];
	$status     = $_POST['status'];
	$comments  = $_POST['comments'];
	$customerNumber = $_POST['customerNumber'];
					
	$sql = "INSERT INTO orders ". "(orderDate, requiredDate, shippedDate, status, 
        comments, customerNumber) ". "VALUES('$orderDate','$requiredDate','$shippedDate', '$status', 
		'$comments', '$customerNumber')";

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
		queryorderbyid($conn, $last_id);

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	// Close connection
	closeconnection($conn);
}

?>


<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../orders.php">Back to Orders</a>
<br>
<br>
<h2>Add a Order</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>OrderDate:</td>
	   <td><input type = "date" name = "orderDate" value="<?php echo $orderDate;?>">
		  <span class = "error">* <?php echo $orderDateErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>RequiredDate:</td>
	   <td><input type = "date" name = "requiredDate" value="<?php echo $requiredDate;?>">
		  <span class = "error">* <?php echo $requiredDateErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>ShippedDate: </td>
	   <td><input type = "date" name = "shippedDate" value="<?php echo $shippedDate;?>">
		  <span class = "error"> <?php echo $shippedDateErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Status:</td>
	   <!-- <td> <input type = "text" name = "status" value="<//?php echo $status;?>"> -->
	   <td> <select  name="status">
			<option selected="selected">Choose one</option>
			<option >Shipped</option>
			<option >Resolved</option>
			<option >Cancelled</option>
			<option >On Hold</option>
			<option >Disputed</option>
			<option >In Process</option>
		</select>	
		  <span class = "error">* <?php echo $statusErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Comments:</td>
	   <!-- <td> <input type = "text" name = "comments" value="<//?php echo $comments;?>"> -->
	   <td><textarea name="comments" rows="10" cols="50" value="<?php echo $comments;?>"></textarea>
		  <span class = "error"><?php echo $commentsErr;?></span>
	   </td>
	</tr>
    					
	<tr>
	   <td>CustomerNumber:</td>
	   <!-- <td> <input type = "text" name = "officeCode" value="<//?php echo $officeCode;?>"> -->

		<td> <select  name="customerNumber">
			<option selected="selected">Choose one</option>
			<?php
			// Loop through customers array
			foreach($customers as $key => $value) {
        	?>
            	<option value="<?php echo $key;?>"><?php echo $value; ?></option>
			<?php
        	}
        	?>
        </select>

		<span class = "error">* <?php echo $customerNumberErr;?></span>
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

<a href="../orders.php">Back to Orders</a>

</body>
</html>