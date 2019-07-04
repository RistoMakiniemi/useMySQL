<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Employee Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch officecodes 
$sql 	= "SELECT officeCode, city FROM offices";
$result = $conn->query($sql);
$offices = array();
while($row = $result->fetch_array()) {
	$offices[$row['officeCode']] = $row['officeCode'] . " - " . $row['city'];
}

// Fetch employeenumbers 
$sql 	= "SELECT employeeNumber, lastName, firstName FROM employees";
$result = $conn->query($sql);
$employees = array();
while($row = $result->fetch_array()) {
	$employees[$row['employeeNumber']] = $row['employeeNumber'] . " - " . $row['lastName'] . " - " . $row['firstName'];
}

// define variables and set to empty values
$nameErr = $emailErr = $comment = "";

$employeeNumber = $officeCode = $reportsTo = 0;
$lastName = $firstName = $extension = $email = $jobTitle = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstName"])) {
		$nameErr = "Name is required";
	} else {
		$firstname = test_input($_POST["firstName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
			$nameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["lastName"])) {
		$nameErr = "Name is required";
	} else {
		$lastname = test_input($_POST["lastName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
			$nameErr = "Only letters and white space allowed";
		}
	}
	
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}
	
	if (empty($_POST["extension"])) {
		$comment = "Extension is required";
	} else {
		$extension = test_input($_POST["extension"]);
	}

    if (empty($_POST["officeCode"])) {
		$comment = "Officecode is required";
	} else {
		$officeCode = test_input($_POST["officeCode"]);
	}

//	$officeCode = $_POST['officeCode'];

	$reportsTo = $_POST['SelectReportsTo'];

    if (empty($_POST["jobTitle"])) {
		$comment = "Jobtitle is required";
	} else {
		$jobTitle = test_input($_POST["jobTitle"]);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['submit'])) {

	$lastName = $_POST['lastName'];
	$firstName = $_POST['firstName'];
	$extension = $_POST['extension'];
	$email     = $_POST['email'];
	$officeCode  = $_POST['officeCode'];
	//$reportsTo  = $_POST['reportsTo'];
	$reportsTo = $_POST['SelectReportsTo'];
	$jobTitle  = $_POST['jobTitle'];
					
	$sql = "INSERT INTO employees ". "(lastName,firstName, extension, email, officeCode, 
		reportsTo, jobTitle) ". "VALUES('$lastName','$firstName','$extension', '$email', 
		$officeCode, $reportsTo, '$jobTitle')";

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
		queryemployeebyid($conn, $last_id);

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	// Close connection
	closeconnection($conn);
}

?>


<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../employees.php">Back to Employees</a>
<br>
<br>
<h2>Add a Employee</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>Firstname:</td>
	   <td><input type = "text" name = "firstName" value="<?php echo $firstName;?>">
		  <span class = "error">* <?php echo $nameErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Lastname:</td>
	   <td><input type = "text" name = "lastName" value="<?php echo $lastName;?>">
		  <span class = "error">* <?php echo $nameErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>E-mail: </td>
	   <td><input type = "text" name = "email" value="<?php echo $email;?>">
		  <span class = "error"> <?php echo $emailErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Extension:</td>
	   <td> <input type = "text" name = "extension" value="<?php echo $extension;?>">
		  <span class = "error"><?php echo $nameErr;?></span>
	   </td>
	</tr>
											
	<tr>
	   <td>OfficeCode:</td>
	   <!-- <td> <input type = "text" name = "officeCode" value="<//?php echo $officeCode;?>"> -->

		<td> <select  name="officeCode">
			<option selected="selected">Choose one</option>
			<?php
			// Iterating through the office array
        	//foreach($products as $item){
			// Loop through cities array
			foreach($offices as $key => $value){
        	?>
            	<option value="<?php echo $key;?>"><?php echo $value; ?></option>
			<?php
        	}
        	?>
        </select>

		<span class = "error">* <?php echo $nameErr;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>ReportsTo:</td>
	   <!-- <td> <input type = "text" name = "reportsTo" value="<//?php echo $reportsTo;?>"> -->
	   	<td> 
		   	<select  name="SelectReportsTo">
				<option selected="selected">Choose one</option>
				<?php
				// Loop through cities array
				foreach($employees as $key => $value){
				?>
					<option value="<?php echo $key;?>"><?php echo $value; ?></option>
				<?php
				}
				?>
			</select>
			<span class = "error">* <?php echo $nameErr;?></span>
	   	</td>
	</tr>
										
	<tr>
	   <td>Jobtitle:</td>
	   <td> <input type = "text" name = "jobTitle" value="<?php echo $jobTitle;?>">
		  <span class = "error"><?php echo $nameErr;?></span>
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

<a href="../employees.php">Back to Employees</a>

</body>
</html>