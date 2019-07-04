<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Customer Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch employeenumbers 
$sql 	= "SELECT employeeNumber, lastName, firstName FROM employees";
$result = $conn->query($sql);
$employees = array();
while($row = $result->fetch_array()) {
	$employees[$row['employeeNumber']] = $row['employeeNumber'] . " - " . $row['lastName'] . " - " . $row['firstName'];
}

// define variables and set to empty values
$customerNameErr = $contactLastNameErr = $contactFirstNameErr = "";
$phoneErr = $addressLine1Err = $addressLine2Err = $cityErr = $stateErr = "";
$postalCodeErr = $salesRepEmployeeNumberErr = "";
$countryErr = $creditLimitErr = "";

$customerName = $contactLastName = "";
$contactFirstName = $phone = $addressLine1 = $addressLine2 = $city = "";
$state = $postalCode = $country = "";
$creditLimit = 0;
$salesRepEmployeeNumber = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["customerName"])) {
		$customerNameErr = "Customername is required";
	} else {
		$customerName = test_input($_POST["customerName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$customerName)) {
			$customerNameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["contactLastName"])) {
		$contactLastNameErr = "Contact Last Name is required";
	} else {
		$contactLastName = test_input($_POST["contactLastName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$contactLastName)) {
			$contactLastNameErr = "Only letters and white space allowed";
		}
	}
	
	if (empty($_POST["contactFirstName"])) {
		$contactFirstNameErr = "Contact First Name is required";
	} else {
		$contactLastName = test_input($_POST["contactFirstName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$contactFirstName)) {
			$contactFirstNameErr = "Only letters and white space allowed";
		}
	}
	
	if (empty($_POST["phone"])) {
		$phoneErr = "Phone is required";
	} else {
		$phone = test_input($_POST["phone"]);
        // check if phone is valid
        if (!preg_match("/^\+[0-9]{1,2,3} [0-9]{3} [0-9]{3} [0-9]{4}$/",$phone)) {
            $phoneErr = "Invalid Phone Number!";
        }	
    }

    if (empty($_POST["addressLine1"])) {
		$addressLine1Err = "addressLine1 is required";
	} else {
		$addressLine1 = test_input($_POST["addressLine1"]);
		// check if address is well-formed
		if (!preg_match("/^[a-zA-Z]+\ +[0-9]+$/", $addressLine1)) {
			$addressLine1Err = "Address is wrong";
		}
    }
    
    if (empty($_POST["city"])) {
		$cityErr = "City is required";
	} else {
		$city = test_input($_POST["city"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
			$cityErr = "Only letters and white space allowed";
		}
	}

    if (empty($_POST["country"])) {
		$countryErr = "country is required";
	} else {
		$country = test_input($_POST["country"]);
    }

    if (empty($_POST["postalCode"])) {
		$postalCodeErr = "PostalCode is required";
	} else {
        $postalCode = test_input($_POST["postalCode"]);

        // check if postalCode is well-formed
        $ZIPREG=array(
            "USA"=>"^\d{5}([\-]?\d{4})?$",
            "UK"=>"^(GIR|[A-Z]\d[A-Z\d]??|[A-Z]{2}\d[A-Z\d]??)[ ]??(\d[A-Z]{2})$",
            "France"=>"^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$",
            "Swerige"=>"^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$",
            "Finland"=>"^ddddd$"
        );

        if ($ZIPREG[$country]) {
            if (!preg_match("/".$ZIPREG[$country]."/i",$postalCode)){
                $postalCodeErr = "Validation failed, zip/postal code is not valid";
            }
        } else {
            $postalCodeErr = "Validation not available";
        }
	}
    
    if (!empty($_POST["creditLimit"])) {
		$creditLimit = test_input($_POST["creditLimit"]);
		// check if creditLimit is valid
		if (!preg_match("/^[0-9]+(\\.[0-9]+)?$/",$creditLimit)) {
			$creditLimitErr = "Only decimal allowed";
        }
        // if (filter_var($input, FILTER_VALIDATE_FLOAT) === false) {
        //     echo 'not allowed';
        // }
        // else {
        //     echo 'allowed';
        // }
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['submit'])) {

        $customerName = $_POST['customerName'];
        $contactLastName = $_POST['contactLastName'];
        $contactFirstName = $_POST['contactFirstName'];
        $phone     = $_POST['phone'];
        $addressLine1  = $_POST['addressLine1'];
        $addressLine2  = $_POST['addressLine2'];
        $city  = $_POST['city'];
        $state  = $_POST['state'];
        $postalCode  = $_POST['postalCode'];
        $country  = $_POST['country'];
        $salesRepEmployeeNumber  = $_POST['salesRepEmployeeNumber'];
        $creditLimit  = $_POST['creditLimit'];


        $sql = "INSERT INTO customers ". "(customerName, contactLastName, 
            contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, 
            country, salesRepEmployeeNumber, creditLimit) ". "VALUES('$customerName','$contactLastName',
            '$contactFirstName','$phone','$addressLine1','$addressLine2','$city','$state','$postalCode',
            '$country','$salesRepEmployeeNumber','$creditLimit')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
            querycustomerbyid($conn, $last_id);

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Close connection
        closeconnection($conn);
}

?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../customers.php">Back to Customer</a>
<br>
<br>
<h2>Add a Customer</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>Customer Name:</td>
	   <td><input type = "text" name = "customerName" value="<?php echo $customerName;?>">
		  <span class = "error">* <?php echo $customerNameErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Contact LastName:</td>
	   <td><input type = "text" name = "contactLastName" value="<?php echo $contactLastName;?>">
		  <span class = "error">* <?php echo $contactLastNameErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>Contact FirstName: </td>
	   <td><input type = "text" name = "contactFirstName" value="<?php echo $contactFirstName;?>">
		  <span class = "error">* <?php echo $contactFirstNameErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Phone:</td>
	   <td> <input type = "text" name = "phone" value="<?php echo $phone;?>">
		  <span class = "error">* <?php echo $phoneErr;?></span>
	   </td>
	</tr>
											
	<tr>
	   <td>AddressLine1:</td>
	   <td> <input type = "text" name = "addressLine1" value="<?php echo $addressLine1;?>">
		  <span class = "error">* <?php echo $addressLine1Err;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>AddressLine2:</td>
	   <td> <input type = "text" name = "addressLine2" value="<?php echo $addressLine2;?>">
		  <span class = "error"> <?php echo $addressLine2Err;?></span>
	   </td>
	</tr>

	<tr>
	   <td>City:</td>
	   <td> <input type = "text" name = "city" value="<?php echo $city;?>">
		  <span class = "error">* <?php echo $cityErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>State:</td>
	   <td> <input type = "text" name = "state" value="<?php echo $state;?>">
		  <span class = "error"> <?php echo $stateErr;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>PostalCode:</td>
	   <td> <input type = "text" name = "postalCode" value="<?php echo $postalCode;?>">
		  <span class = "error">* <?php echo $postalCodeErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Country:</td>
	   <td> <input type = "text" name = "country" value="<?php echo $country;?>">
		  <span class = "error">* <?php echo $countryErr;?></span>
	   </td>
	</tr>

    <tr>
	   <td>SalesRep EmployeeNumber:</td>
	   <td> 
	   <!-- <input type = "text" name = "salesRepEmployeeNumber" value="<//?php echo $salesRepEmployeeNumber;?>"> -->
	   		<select  name="salesRepEmployeeNumber">
				<option selected="selected">Choose one</option>
				<?php
				// Loop through employees array
				foreach($employees as $key => $value){
				?>
					<option value="<?php echo $key;?>"><?php echo $value; ?></option>
				<?php
				}
				?>
			</select>

		  <span class = "error"> <?php echo $salesRepEmployeeNumberErr;?></span>
	   </td>
	</tr>
    						
	<tr>
	   <td>CreditLimit:</td>
	   <td> <input type = "text" name = "creditLimit" value="<?php echo $creditLimit;?>">
		  <span class = "error"> <?php echo $creditLimitErr;?></span>
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

<a href="../customers.php">Back to Customer</a>

</body>
</html>