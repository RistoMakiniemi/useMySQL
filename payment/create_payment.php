<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Payment Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch customer numbers 
$sql 	= "SELECT customerNumber, customerName FROM customers";
$result = $conn->query($sql);
$customers = array();
while($row = $result->fetch_array()) {
	$customers[$row['customerNumber']] = $row['customerNumber'] . " - " . $row['customerName'];
}

// define variables and set to empty values
$customerNumberErr = $checkNumberErr = $paymentDateErr = $amountErr = "";
$customerNumber = $checkNumber = $paymentDate = $amount = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["customerNumber"])) {
		$customerNumberErr = "Customer number is required";
	} else {
        $customerNumber = test_input($_POST["customerNumber"]);
		// check if name only contains letters and numbers
		if (!preg_match("/^[0-9]*$/",$customerNumber)) {
			$customerNumberErr = "Only numbers allowed";
		}
    }

	if (empty($_POST["checkNumber"])) {
		$checkNumberErr = "CheckNumber is required";
	} else {
		$checkNumber = test_input($_POST["checkNumber"]);
		// check if name only contains letters and numbers
		if (!preg_match("/^[a-zA-Z0-9]*$/",$checkNumber)) {
			$checkNumberErr = "Only letters and numbers allowed";
		}
	}
	
	if (empty($_POST["paymentDate"])) {
		$paymentDateErr = "paymentDate is required";
	} else {
        $paymentDate = test_input($_POST["paymentDate"]);
        $m = 0;
		// check if date is well-formed
        if (preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $paymentDate, $m) || 
            preg_match("/^(\d{1,2})-(\d{1,2})-(\d{4})$/", $paymentDate, $m)) {
            if (!checkdate(intval($m[2]), intval($m[3]), intval($m[1]))) {
                $paymentDateErr = "Invalid Date!";
            }
        } else {
			$paymentDateErr = "Invalid date format";
		}
	}
	
	if (empty($_POST["amount"])) {
		$amountErr = "Amount is required";
	} else {
		$amount = test_input($_POST["amount"]);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['submit'])) {

	$customerNumber = $_POST['customerNumber'];
	$checkNumber = $_POST['checkNumber'];
	$paymentDate = $_POST['paymentDate'];
	$amount     = $_POST['amount'];
					
	$sql = "INSERT INTO payments (customerNumber,checkNumber, paymentDate, amount)
        VALUES('$customerNumber','$checkNumber','$paymentDate', '$amount')";

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
		querypaymentbyid($conn, $last_id);

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	// Close connection
	closeconnection($conn);
}

?>


<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../payments.php">Back to Payments</a>
<br>
<br>
<h2>Add a Payment</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>CustomerNumber:</td>
	   <!-- <td> <input type = "text" name = "customerNumber" value="<//?php echo $customerNumber;?>"> -->

       <td> <select  name="customerNumber">
			<option selected="selected">Choose one</option>
			<?php
			// Loop through customers array
			foreach($customers as $key => $value){
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
	   <td>CheckNumber:</td>
	   <td><input type = "text" name = "checkNumber" value="<?php echo $checkNumber;?>">
		  <span class = "error">* <?php echo $checkNumberErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>PaymentDate: </td>
	   <td><input type = "date" name = "paymentDate" value="<?php echo $paymentDate;?>">
		  <span class = "error">* <?php echo $paymentDateErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Amount:</td>
	   <td> <input type = "text" name = "amount" value="<?php echo $amount;?>">
		  <span class = "error">* <?php echo $amountErr;?></span>
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

<a href="../payments.php">Back to Payments</a>

</body>
</html>