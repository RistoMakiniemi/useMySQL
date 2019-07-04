<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Office Form</title>
</head>
<body>

<?php
// define variables and set to empty values

$cityErr = $phoneErr = $addressLine1Err = $countryErr = $postalCodeErr = $territoryErr = "";
$city = $phone = $addressLine1 = $addressLine2 = $state = $country = $postalCode = $territory = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["city"])) {
		$cityErr = "City is required";
	} else {
		$city = test_input($_POST["city"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
			$cityErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["phone"])) {
		$phoneErr = "Phonenumber is required";
	} else {
		$phone = test_input($_POST["phone"]);
		// check if phone is valid
		if (!preg_match("/^\+[0-9 -]{1,3}[0-9 -]{4}[0-9 -]{4}[0-9]{4}$/",$phone)) {
			$phoneErr = "Invalid Phonenumber!";
		}
	}
	
	if (empty($_POST["addressLine1"])) {
		$addressErr = "addressLine1 is required";
	} else {
		$addressLine1 = test_input($_POST["addressLine1"]);
		// check if address is well-formed
		if (!preg_match("/^[a-zA-Z]+\ +[0-9]+$/", $addressLine1Err)) {
			$addressErr = "Address is wrong";
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

    if (empty($_POST["territory"])) {
		$territoryErr = "Territory To is required";
	} else {
		$territory = test_input($_POST["territory"]);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Include the connection script
include '../db_connection.php';

if (isset($_POST['submit'])) {

	/* Attempt MySQL server connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password) */
    $conn = openconnection();

    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2     = $_POST['addressLine2'];
    $state  = $_POST['state'];
    $country  = $_POST['country'];
    $postalCode  = $_POST['postalCode'];
    $territory  = $_POST['territory'];
                    
    $sql = "INSERT INTO offices ". "(city, phone, addressLine1, addressLine2, state, 
        country, postalCode, territory) ". "VALUES('$city','$phone','$addressLine1',
        '$addressLine2','$state','$country','$postalCode','$territory')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
        queryofficebyid($conn, $last_id);

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    closeconnection($conn);
}

?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../offices.php">Back to Office</a>
<br>
<br>
<h2>Add a Office</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>City:</td>
	   <td><input type = "text" name = "city" value="<?php echo $city;?>">
		  <span class = "error">* <?php echo $cityErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Phone:</td>
	   <td><input type = "text" name = "phone" value="<?php echo $phone;?>">
		  <span class = "error">* <?php echo $phoneErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>AddressLine1: </td>
	   <td><input type = "text" name = "addressLine1" value="<?php echo $addressLine1;?>">
		  <span class = "error">* <?php echo $addressLine1Err;?></span>
	   </td>
	</tr>

	<tr>
	   <td>addressLine2:</td>
	   <td> <input type = "text" name = "addressLine2" value="<?php echo $addressLine2;?>">
		  <span class = "error"> <?php echo $addressLine1Err;?></span>
	   </td>
	</tr>
											
	<tr>
	   <td>State:</td>
	   <td> <input type = "text" name = "state" value="<?php echo $state;?>">
		  <!-- <span class = "error"> <?php echo $nameErr;?></span> -->
	   </td>
	</tr>
										
	<tr>
	   <td>Country:</td>
	   <td> <input type = "text" name = "country" value="<?php echo $country;?>">
		  <span class = "error">* <?php echo $countryErr;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>PostalCode:</td>
	   <td> <input type = "text" name = "postalCode" value="<?php echo $postalCode;?>">
		  <span class = "error">* <?php echo $postalCodeErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Territory:</td>
	   <td> <input type = "text" name = "territory" value="<?php echo $territory;?>">
		  <span class = "error">* <?php echo $territoryErr;?></span>
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

<a href="../offices.php">Back to Office</a>

</body>
</html>