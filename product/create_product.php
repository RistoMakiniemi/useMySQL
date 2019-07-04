<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Product Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch productlines 
$sql 	= "SELECT productLine FROM productlines";
$result = $conn->query($sql);
$sel_productlines = array();
while($row = $result->fetch_array()) {
	$sel_productlines[$row['productLine']] = $row['productLine'];
}

 // Close connection
 closeconnection($conn);

// define variables and set to empty values
$productCodeErr = $productNameErr = $productLineErr = $productScaleErr = $productVendorErr = "";
$productDescriptionErr = $quantityInStockErr = "";
$buyPriceErr = $MSRPErr = "";

$productCode = $productName = $productLine = $productScale = $productVendor = "";
$productDescription = "";
$quantityInStock = $buyPrice = $MSRP = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["productCode"])) {
		$productCodeErr = "ProductCode is required";
	} else {
		$productCode = test_input($_POST["productCode"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/",$productCode)) {
			$productCodeErr = "Only letters, number and undercore allowed";
		}
	}

    if (empty($_POST["productName"])) {
		$productNameErr = "ProductName is required";
	} else {
		$productName = test_input($_POST["productName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$productName)) {
			$productNameErr = "Only letters and white space allowed";
		}
	}

    if (empty($_POST["productLine"])) {
		$productLineErr = "ProductLine is required";
	} else {
		$productLine = test_input($_POST["productLine"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$productLine)) {
			$productLineErr = "Only letters and white space allowed";
		}
	}

    if (empty($_POST["productScale"])) {
		$productScaleErr = "ProductScale is required";
	} else {
		$productScale = test_input($_POST["productScale"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[0-9:]*(?:_[0-9]+)*$/",$productScale)) {
			$productScaleErr = "Only numbers and semicolon allowed";
		}
	}

    if (empty($_POST["productVendor"])) {
		$productVendorErr = "ProductVendor is required";
	} else {
		$productVendor = test_input($_POST["productVendor"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$productVendor)) {
			$productVendorErr = "Only letters and white space allowed";
		}
	}

    if (empty($_POST["productDescription"])) {
		$productDescriptionErr = "ProductDescription is required";
	} else {
		$productDescription = test_input($_POST["productDescription"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z0-9,.'` ]*$/",$productDescription)) {
			$productDescriptionErr = "Only letters, numbers and white space allowed";
		}
    }
    
    if (empty($_POST["quantityInStock"])) {
		$quantityInStockErr = "QuantityInStock is required";
	} else {
		$quantityInStock = test_input($_POST["quantityInStock"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[0-9]{0,6}$/",$quantityInStock)) {
			$quantityInStockErr = "Only numbers allowed";
		}
    }
    
    if (empty($_POST["buyPrice"])) {
		$buyPriceErr = "BuyPrice is required";
	} else {
		$buyPrice = test_input($_POST["buyPrice"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[0-9.0-9]{0,12}$/",$buyPrice)) {
			$buyPriceErr = "Only numbers(decimal) allowed";
		}
    }
    
    if (empty($_POST["MSRP"])) {
		$MSRPErr = "MSRP is required";
	} else {
		$MSRP = test_input($_POST["MSRP"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[0-9.0-9]{0,12}$/",$MSRP)) {
			$MSRPErr = "Only numbers(decimal) allowed";
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

	$conn = openconnection();

    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor  = $_POST['productVendor'];
    $productDescription  = $_POST['productDescription'];
    $quantityInStock  = $_POST['quantityInStock'];
    $buyPrice  = $_POST['buyPrice'];
    $MSRP  = $_POST['MSRP'];
                    
    $sql = "INSERT INTO products ". "(productCode, productName, productLine, productScale, productVendor, 
        productDescription, quantityInStock, buyPrice, MSRP) ". "VALUES('$productCode','$productName',
        '$productLine','$productScale','$productVendor',
        '$productDescription', '$quantityInStock', '$buyPrice', '$MSRP')";

    if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
        queryproductbyid($conn, $last_id);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    closeconnection($conn);
}

?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../products.php">Back to Products</a>
<br>
<br>
<h2>Add a Product</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>ProductCode:</td>
	   <td><input type = "text" name = "productCode" value="<?php echo $productCode;?>">
		  <span class = "error">* <?php echo $productCodeErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>ProductName:</td>
	   <td><input type = "text" name = "productName" value="<?php echo $productName;?>">
		  <span class = "error">* <?php echo $productNameErr;?></span>
	   </td>
	</tr>
	
	<tr>
	   <td>ProductLine: </td>
	   <td>
	   		<!-- <input type = "text" name = "productLine" value="<//?php echo $productLine;?>"> -->
			<select  name="productLine">
				<option selected="selected">Choose one</option>
				<?php
				// Loop through productlines array
				foreach($sel_productlines as $key => $value){
				?>
					<option value="<?php echo $key;?>"><?php echo $value; ?></option>
				<?php
				}
				?>
			</select>
		  
		  <span class = "error">* <?php echo $productLineErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>ProductScale:</td>
	   <td> <input type = "text" name = "productScale" value="<?php echo $productScale;?>">
		  <span class = "error">* <?php echo $productScaleErr;?></span>
	   </td>
	</tr>
											
	<tr>
	   <td>ProductVendor:</td>
	   <td> <input type = "text" name = "productVendor" value="<?php echo $productVendor;?>">
		  <span class = "error">* <?php echo $productVendorErr;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>ProductDescription:</td>
	   <td> <textarea name="productDescription" rows="10" cols="60" value="<?php echo $productDescription;?>"><?php echo $productDescription;?></textarea>

	   <!-- <input type = "text" name = "productDescription" value="<//?php echo $productDescription;?>"> -->  
		  <span class = "error">* <?php echo $productDescriptionErr;?></span>
	   </td>
	</tr>
										
	<tr>
	   <td>QuantityInStock:</td>
	   <td> <input type = "text" name = "quantityInStock" value="<?php echo $quantityInStock;?>">
		  <span class = "error">* <?php echo $quantityInStockErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>BuyPrice:</td>
	   <td> <input type = "text" name = "buyPrice" value="<?php echo $buyPrice;?>">
		  <span class = "error">* <?php echo $buyPriceErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>MSRP:</td>
	   <td> <input type = "text" name = "MSRP" value="<?php echo $MSRP;?>">
		  <span class = "error">* <?php echo $MSRPErr;?></span>
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

<a href="../products.php">Back to Products</a>

</body>
</html>