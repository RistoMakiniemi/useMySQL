<?php
$employeeNumber = $officeCode = $reportsTo = 0;
$lastName = $firstName = $extension = $email = $jobTitle = "";

$conn = 0;
/*
echo "<h2>Your Input:</h2>";
echo $firstName;
echo "<br>";
echo $lastName;
echo "<br>";
echo $email;
echo "<br>";
echo $officeCode;
echo "<br>";
echo $reportsTo;
echo "<br>";
echo $jobTitle;
*/

 
//createconnection();
//queryemployees();

function openconnection() {
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
	$db = 'ictossaaja_mysql';
	
	// Create connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

	// Check connection
	if ($conn->connect_error) {
		die("Database connection failed: " . $conn->connect_error);
	}

	//echo 'Connected successfully</br>';
	return $conn;
}

function queryoffices($conn)
{
	// Some Query
	$sql 	= "SELECT officeCode, city, phone, addressLine1, addressLine2, state, country, postalCode, territory FROM offices";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>officecode</th>";
				echo "<th>city</th>";
				echo "<th>phone</th>";
				echo "<th>addressLine1</th>";
				echo "<th>addressLine2</th>";
				echo "<th>state</th>";
				echo "<th>country</th>";
				echo "<th>postalcode</th>";
				echo "<th>territory</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['officeCode'] . "</td>";
				echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['phone'] . "</td>";
				echo "<td>" . $row['addressLine1'] . "</td>";
				echo "<td>" . $row['addressLine2'] . "</td>";
				echo "<td>" . $row['state'] . "</td>";
				echo "<td>" . $row['country'] . "</td>";
				echo "<td>" . $row['postalCode'] . "</td>";
				echo "<td>" . $row['territory'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryofficebyid($conn, $last_id) 
{
	// Some Query
	$sql 	= "SELECT officeCode, city, phone, addressLine1, addressLine2, state, 
	country, postalCode, territory FROM offices WHERE officeCode = '$last_id'";
	$result = $conn->query($sql);
	
	if(! $result ) {
	die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>office code</th>";
				echo "<th>city</th>";
				echo "<th>phone</th>";
				echo "<th>addressLine1</th>";
				echo "<th>addressLine2</th>";
				echo "<th>state</th>";
				echo "<th>country</th>";
				echo "<th>postalCode</th>";
				echo "<th>territory</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['officeCode'] . "</td>";
				echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['phone'] . "</td>";
				echo "<td>" . $row['addressLine1'] . "</td>";
				echo "<td>" . $row['addressLine2'] . "</td>";
				echo "<td>" . $row['state'] . "</td>";
				echo "<td>" . $row['country'] . "</td>";
				echo "<td>" . $row['postalCode'] . "</td>";
				echo "<td>" . $row['territory'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
}

function queryofficebycity($conn, $city) 
{
	// Some Query
	$sql 	= "SELECT officeCode, city, phone, addressLine1, addressLine2, state, 
	country, postalCode, territory FROM offices WHERE city = '$city'";
	$result = $conn->query($sql);
	
	if(! $result ) {
	die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>office code</th>";
				echo "<th>city</th>";
				echo "<th>phone</th>";
				echo "<th>addressLine1</th>";
				echo "<th>addressLine2</th>";
				echo "<th>state</th>";
				echo "<th>country</th>";
				echo "<th>postalCode</th>";
				echo "<th>territory</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['officeCode'] . "</td>";
				echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['phone'] . "</td>";
				echo "<td>" . $row['addressLine1'] . "</td>";
				echo "<td>" . $row['addressLine2'] . "</td>";
				echo "<td>" . $row['state'] . "</td>";
				echo "<td>" . $row['country'] . "</td>";
				echo "<td>" . $row['postalCode'] . "</td>";
				echo "<td>" . $row['territory'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
}
 
function queryemployees($conn)
{
	// Some Query
	$sql 	= "SELECT employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle FROM employees";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>employee number</th>";
				echo "<th>first_name</th>";
				echo "<th>last_name</th>";
				echo "<th>extension</th>";
				echo "<th>email</th>";
				echo "<th>officecode</th>";
				echo "<th>report to</th>";
				echo "<th>jobtitle</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['employeeNumber'] . "</td>";
				echo "<td>" . $row['firstName'] . "</td>";
				echo "<td>" . $row['lastName'] . "</td>";
				echo "<td>" . $row['extension'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['officeCode'] . "</td>";
				echo "<td>" . $row['reportsTo'] . "</td>";
				echo "<td>" . $row['jobTitle'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryemployeebyid($conn, $last_id) 
{
	// Some Query
	$sql 	= "SELECT employeeNumber, lastName, firstName, extension, 
		email, officeCode, reportsTo, jobTitle FROM employees WHERE employeeNumber = '$last_id'";
	$result = $conn->query($sql);
	
	if(! $result ) {
	die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>employee number</th>";
				echo "<th>first_name</th>";
				echo "<th>last_name</th>";
				echo "<th>extension</th>";
				echo "<th>email</th>";
				echo "<th>officecode</th>";
				echo "<th>report to</th>";
				echo "<th>jobtitle</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['employeeNumber'] . "</td>";
				echo "<td>" . $row['firstName'] . "</td>";
				echo "<td>" . $row['lastName'] . "</td>";
				echo "<td>" . $row['extension'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['officeCode'] . "</td>";
				echo "<td>" . $row['reportsTo'] . "</td>";
				echo "<td>" . $row['jobTitle'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
}

 
function insert_employee()
{
	if(isset($_POST['submit'])) {
		$lastname=$_POST['lastName'];
		$firstname=$_POST['firstName'];
		$extension=$_POST['extension'];
		$email=$_POST['email'];
		$officeCode=$_POST['officeCode'];
		$reportsTo=$_POST['reportsTo'];
		$jobTitle=$_POST['jobTitle'];

		$query = "INSERT INTO employees (lastname, firstName, extension, email, officeCode, reportsTo, jobTitle)
			VALUES ('$lastname', '$firstName', '$extension', '$email', $officeCode, $reportsTo, '$jobTitle')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	 }
}

function querycustomers($conn)
{
	// Some Query
	$sql 	= "SELECT customerNumber, customerName, contactLastName, contactFirstName, 
		phone, addressLine1, addressLine2, city, state, postalCode, country, 
		salesRepEmployeeNumber, creditLimit FROM customers";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>customer number</th>";
				echo "<th>customerName</th>";
				echo "<th>contactLastName</th>";
				echo "<th>contactFirstName</th>";
				echo "<th>phone</th>";
				echo "<th>addressLine1</th>";
				echo "<th>addressLine2</th>";
				echo "<th>city</th>";
				echo "<th>state</th>";
				echo "<th>postalCode</th>";
				echo "<th>country</th>";
				echo "<th>salesRepEmployeeNumber</th>";
				echo "<th>creditLimit</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['customerNumber'] . "</td>";
				echo "<td>" . $row['customerName'] . "</td>";
				echo "<td>" . $row['contactLastName'] . "</td>";
				echo "<td>" . $row['contactFirstName'] . "</td>";
				echo "<td>" . $row['phone'] . "</td>";
				echo "<td>" . $row['addressLine1'] . "</td>";
				echo "<td>" . $row['addressLine2'] . "</td>";
				echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['state'] . "</td>";
				echo "<td>" . $row['postalCode'] . "</td>";
				echo "<td>" . $row['country'] . "</td>";
				echo "<td>" . $row['salesRepEmployeeNumber'] . "</td>";
				echo "<td>" . $row['creditLimit'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function querycustomerbyid($conn, $last_id) 
{
	// Some Query
	$sql 	= "SELECT customerNumber, customerName, contactLastName, contactFirstName, 
	phone, addressLine1, addressLine2, city, state, postalCode, country, 
	salesRepEmployeeNumber, creditLimit FROM customers WHERE customerNumber = '$last_id'";
	$result = $conn->query($sql);
	
	if(! $result ) {
	die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
			echo "<th>customer number</th>";
			echo "<th>customerName</th>";
			echo "<th>contactLastName</th>";
			echo "<th>contactFirstName</th>";
			echo "<th>phone</th>";
			echo "<th>addressLine1</th>";
			echo "<th>addressLine2</th>";
			echo "<th>city</th>";
			echo "<th>state</th>";
			echo "<th>postalCode</th>";
			echo "<th>country</th>";
			echo "<th>salesRepEmployeeNumber</th>";
			echo "<th>creditLimit</th>";
		echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
			echo "<td>" . $row['customerNumber'] . "</td>";
			echo "<td>" . $row['customerName'] . "</td>";
			echo "<td>" . $row['contactLastName'] . "</td>";
			echo "<td>" . $row['contactFirstName'] . "</td>";
			echo "<td>" . $row['phone'] . "</td>";
			echo "<td>" . $row['addressLine1'] . "</td>";
			echo "<td>" . $row['addressLine2'] . "</td>";
			echo "<td>" . $row['city'] . "</td>";
			echo "<td>" . $row['state'] . "</td>";
			echo "<td>" . $row['postalCode'] . "</td>";
			echo "<td>" . $row['country'] . "</td>";
			echo "<td>" . $row['salesRepEmployeeNumber'] . "</td>";
			echo "<td>" . $row['creditLimit'] . "</td>";
		echo "</tr>";
		}
		echo "</table></br>";
	}
}

function queryproductlines($conn)
{
	// Some Query
	$sql 	= "SELECT productLine, textDescription, htmlDescription, image FROM productlines";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th width=10%>productLine</th>";
				echo "<th width=50%>textDescription</th>";
				echo "<th width=20%>htmlDescription</th>";
				echo "<th width=20%>image</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td width=10%>" . $row['productLine'] . "</td>";
				echo "<td width=50%>" . $row['textDescription'] . "</td>";
				echo "<td width=20%>" . $row['htmlDescription'] . "</td>";
				echo "<td width=20%>" . $row['image'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryproductlinebyid($conn, $last_id) 
{
	// Some Query
	$sql 	= "SELECT productLine, textDescription, htmlDescription, image 
		FROM productlines WHERE productLine = '$last_id'";
	$result = $conn->query($sql);
	
	if(! $result ) {
		die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>office code</th>";
				echo "<th>city</th>";
				echo "<th>phone</th>";
				echo "<th>addressLine1</th>";
				echo "<th>addressLine2</th>";
				echo "<th>state</th>";
				echo "<th>country</th>";
				echo "<th>postalCode</th>";
				echo "<th>territory</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['officeCode'] . "</td>";
				echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['phone'] . "</td>";
				echo "<td>" . $row['addressLine1'] . "</td>";
				echo "<td>" . $row['addressLine2'] . "</td>";
				echo "<td>" . $row['state'] . "</td>";
				echo "<td>" . $row['country'] . "</td>";
				echo "<td>" . $row['postalCode'] . "</td>";
				echo "<td>" . $row['territory'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
}

function queryproducts($conn)
{
	// Some Query
	$sql 	= "SELECT productCode, productName, productLine, productScale, productVendor, 
		productDescription, quantityInStock, buyPrice, MSRP FROM products";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>productCode</th>";
				echo "<th>productName</th>";
				echo "<th>productLine</th>";
				echo "<th>productScale</th>";
				echo "<th>productVendor</th>";
				echo "<th>productDescription</th>";
				echo "<th>quantityInStock</th>";
				echo "<th>buyPrice</th>";
				echo "<th>MSRP</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['productCode'] . "</td>";
				echo "<td>" . $row['productName'] . "</td>";
				echo "<td>" . $row['productLine'] . "</td>";
				echo "<td>" . $row['productScale'] . "</td>";
				echo "<td>" . $row['productVendor'] . "</td>";
				echo "<td>" . $row['productDescription'] . "</td>";
				echo "<td>" . $row['quantityInStock'] . "</td>";
				echo "<td>" . $row['buyPrice'] . "</td>";
				echo "<td>" . $row['MSRP'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryproductbyid($conn, $last_id)
{
	// Some Query
	$sql 	= "SELECT productCode, productName, productLine, productScale, productVendor, 
		productDescription, quantityInStock, buyPrice, MSRP FROM products WHERE productCode = '$last_id'";
	$result = $conn->query($sql);
	
	if(! $result ) {
		die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>productCode</th>";
				echo "<th>productName</th>";
				echo "<th>productLine</th>";
				echo "<th>productScale</th>";
				echo "<th>productVendor</th>";
				echo "<th>productDescription</th>";
				echo "<th>quantityInStock</th>";
				echo "<th>buyPrice</th>";
				echo "<th>MSRP</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['productCode'] . "</td>";
				echo "<td>" . $row['productName'] . "</td>";
				echo "<td>" . $row['productLine'] . "</td>";
				echo "<td>" . $row['productScale'] . "</td>";
				echo "<td>" . $row['productVendor'] . "</td>";
				echo "<td>" . $row['productDescription'] . "</td>";
				echo "<td>" . $row['quantityInStock'] . "</td>";
				echo "<td>" . $row['buyPrice'] . "</td>";
				echo "<td>" . $row['MSRP'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryorders($conn)
{
	// Some Query
	$sql 	= "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, 
		comments, customerNumber FROM orders";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>orderNumber</th>";
				echo "<th>orderDate</th>";
				echo "<th>requiredDate</th>";
				echo "<th>shippedDate</th>";
				echo "<th>status</th>";
				echo "<th>comments</th>";
				echo "<th>customerNumber</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['orderNumber'] . "</td>";
				echo "<td>" . $row['orderDate'] . "</td>";
				echo "<td>" . $row['requiredDate'] . "</td>";
				echo "<td>" . $row['shippedDate'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['comments'] . "</td>";
				echo "<td>" . $row['customerNumber'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryorderbyid($conn, $last_id)
{
	// Some Query
	$sql 	= "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, 
		comments, customerNumber FROM orders WHERE orderNumber = '$last_id'";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>orderNumber</th>";
				echo "<th>orderDate</th>";
				echo "<th>requiredDate</th>";
				echo "<th>shippedDate</th>";
				echo "<th>status</th>";
				echo "<th>comments</th>";
				echo "<th>customerNumber</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['orderNumber'] . "</td>";
				echo "<td>" . $row['orderDate'] . "</td>";
				echo "<td>" . $row['requiredDate'] . "</td>";
				echo "<td>" . $row['shippedDate'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['comments'] . "</td>";
				echo "<td>" . $row['customerNumber'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryorderdetails($conn)
{
	// Some Query
	$sql 	= "SELECT orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber FROM orderdetails";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>orderNumber</th>";
				echo "<th>productCode</th>";
				echo "<th>quantityOrdered</th>";
				echo "<th>priceEach</th>";
				echo "<th>orderLineNumber</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['orderNumber'] . "</td>";
				echo "<td>" . $row['productCode'] . "</td>";
				echo "<td>" . $row['quantityOrdered'] . "</td>";
				echo "<td>" . $row['priceEach'] . "</td>";
				echo "<td>" . $row['orderLineNumber'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function queryorderdetailsbyids($conn, $last_id1, $last_id2)
{
	// Some Query
	$sql 	= "SELECT orderNumber, productCode, quantityOrdered, 
		priceEach, orderLineNumber FROM orderdetails WHERE orderNumber = '$last_id1' AND productCode = '$last_id2'";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>orderNumber</th>";
				echo "<th>productCode</th>";
				echo "<th>quantityOrdered</th>";
				echo "<th>priceEach</th>";
				echo "<th>orderLineNumber</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['orderNumber'] . "</td>";
				echo "<td>" . $row['productCode'] . "</td>";
				echo "<td>" . $row['quantityOrdered'] . "</td>";
				echo "<td>" . $row['priceEach'] . "</td>";
				echo "<td>" . $row['orderLineNumber'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function querypayments($conn)
{
	// Some Query
	$sql 	= "SELECT customerNumber, checkNumber, paymentDate, amount FROM payments";
	$result = $conn->query($sql);
	   
    if(! $result ) {
      die('Could not get data: ' . $conn->error);
    } else {
	   echo "Number of rows: $result->num_rows";
    }

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>customerNumber</th>";
				echo "<th>checkNumber</th>";
				echo "<th>paymentDate</th>";
				echo "<th>amount</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['customerNumber'] . "</td>";
				echo "<td>" . $row['checkNumber'] . "</td>";
				echo "<td>" . $row['paymentDate'] . "</td>";
				echo "<td>" . $row['amount'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

function querypaymentbyid($conn, $last_id)
{
	// Some Query
	$sql 	= "SELECT customerNumber,checkNumber, paymentDate, amount FROM payments WHERE customerNumber = '$last_id'";
	$result = $conn->query($sql);
	
	if(! $result ) {
		die('Could not get data: ' . $conn->error);
	}

	if($result->num_rows > 0) {
		echo "<table>";
			echo "<tr>";
				echo "<th>customerNumber</th>";
				echo "<th>checkNumber</th>";
				echo "<th>paymentDate</th>";
				echo "<th>amount</th>";
			echo "</tr>";
		while($row = $result->fetch_array()) {
			echo "<tr>";
				echo "<td>" . $row['customerNumber'] . "</td>";
				echo "<td>" . $row['checkNumber'] . "</td>";
				echo "<td>" . $row['paymentDate'] . "</td>";
				echo "<td>" . $row['amount'] . "</td>";
			echo "</tr>";
		}
		echo "</table></br>";
	}
	// Free result set
	#$result->free();
}

// close connection
function closeconnection($conn)
{
	$conn->close();
}

?>